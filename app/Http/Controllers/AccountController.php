<?php

namespace App\Http\Controllers;

use App\Jobs\StoreRestaurantLogo;
use App\Mail\ApplicationCompleted;
use App\Mail\VerifyMail;
use App\Models\AccountPaymentLog;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Package;
use App\Models\verifyAccount;
use App\Services\CcavenueService;
use App\Services\NotificationService;
use Carbon\Carbon;
use App\Models\Owner;
use App\Models\Account;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Session;
use URL;

class AccountController extends Controller
{
    public function dashboard()
    {
        $restaurantsNum = Account::where('account_type_id', 2)->where('approved', 1)->count();
        $packages = Package::count();
        $payments = DB::table('accounts_payment_log')->sum('amount');
        $customers = Customer::count();
        $cashPayments = AccountPaymentLog::where('orderNo', '=', null)->count();
        $onlinePayments = AccountPaymentLog::where('orderNo', '!=', null)->count();
        $categories = Category::pluck('category_name');
        $categoryIds = Category::pluck('id');
//        $categoriesChartData = DB::table('account')
//            ->join('category', 'category.id', '=', 'account.resturant_category_id')
//            ->where('account.account_type_id', 2)->where('approved', 1)
//            ->selectRaw('COUNT(account.id) as count')->groupBy(DB::Raw('IFNULL( category.id , 0 )'))->pluck('count');
//
//        return $categoriesChartData;
        $categoriesChartData = $categoryIds->map(function ($index) {
            return Account::where('account_type_id', 2)->where('resturant_category_id', $index)->where('approved', 1)->count();
        });

        $data = collect([]);
        $data->put('categories', $categories);
        $data->put('categoriesChartData', $categoriesChartData);
        $data->put('restaurantsNum', $restaurantsNum);
        $data->put('cashPayments', $cashPayments);
        $data->put('onlinePayments', $onlinePayments);
        $data->put('packages', $packages);
        $data->put('customers', $customers);
        $data->put('payments', $payments);

        return view('layout.home', compact('data'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = array(
                'login' => 'required||min:3|max:30',
                'password' => 'required|min:3|max:30',
            );
            $messages = [
                'login.required' => __('Email or Username is required'),
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            } else {
                $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'account_name';
                $account = Account::where($fieldType, '=', $request->login)->first();

                if ($account) {
                    $result = Hash::check($request->password, $account->password);
                    if ($result) {
                        Session::put('account_type_id', $account->account_type_id);
                        Session::put('account_id', $account->id);
                        //  dd( Session::get('account_type_id'));
                        if ($account->account_type_id == Account::IS_ADMIN || $account->account_type_id == Account::IS_RESTAURANT) {
                            $credentials = [
                                $fieldType => $request->login,
                                'password' => $request->password,
                            ];
                            $result = Auth::attempt($credentials, $request->remember == true ? true : '');
                            if ($result) {
                                return response()->json([
                                    'result' => 'true',
                                ]);
                            }
                        }
                    }
                }
                return response()->json([
                    'result' => 'credentials',
                    'message' => 'Incorrect username or password.',
                ]);
            }
        }
        return view('layout.auth.sign-in');
    }

    public function signup(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = array(
                'business_name' => 'required|min:3|max:30|unique:account,account_name',
                'email' => 'required|email|regex:/^\S*$/u|unique:account,email',
                'password' => 'required|confirmed|min:5|max:30',
                'phone_number' => 'required|phone:AE',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            } else {
                $account = new Account();
                $account->account_name = $request->business_name;
                $account->email = $request->email;
                $account->phone_number = $request->phone_number;
                $account->account_type_id = Account::IS_RESTAURANT;
                $account->status_id = 3;
                $account->work_status_id = 2;
                $account->password = Hash::make($request->password);
                $account->opening_time = date("H:i", strtotime("12:00"));
                $account->closing_time = date("H:i", strtotime("22:00"));
                $account->save();
                if ($account) {
                    event(new Registered($account));
                    NotificationService::NotifyAdmin('initial', $account->id, "New Restaurant", "new application has been created.", "new application has been created.");
                    Auth::loginUsingId($account->id);
                    return response()->json([
                        'result' => 'true',
                        'message' => 'Check your email',
                    ]);
                }
            }
        }
        return view('layout.auth.sign-up');
    }

    public function signup_wizard()
    {
        session()->forget('data');
        $account = Auth::user();
        $data = [];
        $data['account'] = $account;
        session()->push('data', $data);

        if ($account->resturant_category_id == null || (bool)empty($account->sub_category) || $account->license_path == null) {
            return Redirect::route('general-information-step');
        } else {
            $data['general-information-step'] = 'done';
            session()->put('data', $data);
        }

        if ($account->owner == null) {
            return Redirect::route('owner-details-step');
        } else {
            $data['owner-details-step'] = 'done';
            session()->put('data', $data);
        }

        if ($account->address == null) {
            return Redirect::route('bank-address-step');
        } else {
            $data['bank-address-step'] = 'done';
            session()->put('data', $data);
        }

        if (!$account->package || !$account->payment) {
            return Redirect::route('select-package-step');
        } else {
            $data['select-package-step'] = 'done';
            session()->put('data', $data);
        }

        return Redirect::route('finished-application');
    }

    public function general_information_step(Request $request)
    {


        $account = Auth::user();
        $sub_categories_ids = $account->sub_category->modelKeys();

        if ($request->isMethod('post')) {

            $rules = array(
                'category' => 'required',
                'sub_category' => 'required',
                'license' => "required|mimes:pdf|max:500",
                'logo' => 'required|mimes:jpeg,jpg,png|max:1000'
            );

            $messages = [
                'logo.max' => 'Restaurant Logo Maximum Picture size is 1MB'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            } else {
                $path = '/restaurants/license/' . $account->id;
                if (!Storage::exists($path)) {
                    Storage::makeDirectory($path, $mode = 0777, true, true);
                    $file = $request->file('license');
                    $originalFile = $file->getClientOriginalName();
                    $file->move(storage_path('/app/' . $path), $originalFile);
                } else {
                    $FileSystem = new Filesystem();
                    $directory = storage_path() . '/app/restaurants/license/' . $account->id;
                    if ($FileSystem->exists($directory)) {
                        // Get all files in this directory.
                        $files = $FileSystem->files($directory);
                        // Check if directory is empty.
                        if (!empty($files)) {
                            $FileSystem->delete($files);
                        }
                        $file = $request->file('license');
                        $originalFile = $file->getClientOriginalName();
                        $file->move($directory, $originalFile);
                    }
                }

//                $image = $request->file('logo');
//                dispatch(function () use ($image, $account) {
//                    $image->move(public_path() . '/restaurants/temporary_logos/', $imageName = uniqid());
//                    $extension = $image->getClientOriginalExtension();
//                    $imagePath = $imageName . '.' . $extension;
//                    $job = new StoreRestaurantLogo(auth()->id(), $extension, $imageName);
//                    $this->dispatch($job);
//                    $account->update(['logo_path' => $imagePath]);
//                })->afterResponse();

                $path = public_path() . '/restaurants/logo/' . $account->id;
                if (!File::exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                    $image = $request->file('logo');
                    $input['imagename'] = time() . '.' . $image->extension();
                    $img = Image::make($image->path());
                    $img->resize(100, 250, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . '/' . $input['imagename']);
                } else {
                    $FileSystem = new Filesystem();
                    $directory = public_path() . '/restaurants/logo/' . $account->id;
                    if ($FileSystem->exists($directory)) {
                        // Get all files in this directory.
                        $files = $FileSystem->files($directory);
                        // Check if directory is empty.
                        if (!empty($files)) {
                            $FileSystem->delete($files);
                        }
                        $image = $request->file('logo');
                        $input['imagename'] = time() . '.' . $image->extension();
                        $img = Image::make($image->path());
                        $img->resize(100, 250, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($directory . '/' . $input['imagename']);
                    }
                }
                preg_match_all('!\d+!', $request->sub_category, $sub_categories);
                $account->logo_path = $input['imagename'];
                $account->resturant_category_id = $request->category;
                $account->license_path = $originalFile;
                $result = $account->save();

                if ($result) {
                    $account->sub_category()->sync($sub_categories[0]);
                }

                if (!session()->has('data.general-information-step')) {
                    session()->put('data.general-information-step', 'done');
                }
                return response()->json([
                    'result' => 'success'
                ]);
            }
        }
        return view('layout.profile.general-information-step', compact('account', 'sub_categories_ids'));
    }

    public function owner_details_step(Request $request)
    {
        if (!session()->get('data.account')) {
            return Redirect::route('signup_wizard');
        }
        $account = session()->get('data.account')->load('owner');

        if ($account->resturant_category_id == null || (bool)empty($account->sub_category) || $account->license_path == null) {
            return Redirect::route('general-information-step');
        }

        if ($request->isMethod('post')) {

            $rules = array(
                'national_number' => 'required|min:18|max:18',
                'owner_name' => 'required|min:3|max:30',
                'owner_email' => 'required|regex:/^\S*$/u|email|',
                'office_number' => ['required', 'regex:/^(02|04|06|07)[0-9]{6,7}$/'],
            );

            $messages = [
                "national_number.min" => "Not valid national number",
                "national_number.max" => "Not valid national number"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            } else {
                if ($account->owner == null) {
                    $owner = new Owner();
                    $owner->national_number = $request->national_number;
                    $owner->account_name = $request->owner_name;
                    $owner->phone_number = $request->office_number;
                    $owner->email = $request->owner_email;
                    $owner->save();
                    if ($owner) {
                        $account->owner()->associate($owner);
                        $account->save();

                    }
                } else {
                    $account->owner->national_number = $request->national_number;
                    $account->owner->account_name = $request->owner_name;
                    $account->owner->phone_number = $request->office_number;
                    $account->owner->email = $request->owner_email;
                    $account->push();
                }

                if (!session()->has('data.owner-details-step')) {
                    session()->put('data.owner-details-step', 'done');
                }
                return response()->json([
                    'result' => 'success'
                ]);
            }
        }
        return view('layout.profile.owner-details-step', compact('account'));
    }

    public function bank_address_step(Request $request)
    {
        $account = Auth::user();

        if ($account->owner == null) {
            return Redirect::route('owner-details-step');
        }

        if ($request->isMethod('post')) {

            $rules = array(
                'long' => 'required',
                'address' => 'required|min:3|max:200',
                'description' => 'required|min:3|max:200',
            );

            if ($request->paymentCheckBox) {
                $rules['bank_name'] = 'required|min:3|max:30';
                $rules['bank_number'] = 'required|iban';
            }

            $messages = [
                'bank_number.iban' => __('validation.iban'),
                'long.required' => 'Please select location',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            } else {
                $account->description = $request->description;
                $account->save();
                if ($request->paymentCheckBox) {
                    if ($account->bank == null) {
                        $account->bank()->create([
                            'bank_name' => $request->bank_name,
                            'iban' => $request->bank_number,
                        ]);
                    } else {
                        $account->bank->bank_name = $request->bank_name;
                        $account->bank->iban = $request->bank_number;
                        $account->push();
                    }
                }

                try {

                    $array_of_piece = preg_split('/ ([,\-]) /', $request->address);
                    $inputCountry = $array_of_piece[count($array_of_piece) - 1];
                    $inputCity = $array_of_piece[count($array_of_piece) - 2];
                    $inputArea = $array_of_piece[count($array_of_piece) - 3];
                    $CountryResult = DB::table('country')->where('country_name', $inputCountry)->first();
                    $CityResult = DB::table('city')->where('city_name', $inputCity)->first();
                    $AreaResult = DB::table('area')->where('area_name', $inputArea)->first();
                    $areaId = $AreaResult != null ? $AreaResult->id : '';

                    if (!$CountryResult) {
                        $newCountry = new Country();
                        $newCountry->country_name = $inputCountry;
                        $newCountry->save();

                        $newCity = new City();
                        $newCity->city_name = $inputCity;
                        $newCity->country_id = $newCountry->id;
                        $newCity->save();

                        $newArea = new Area();
                        $newArea->area_name = $inputArea;
                        $newArea->city_id = $newCity->id;
                        $newArea->save();

                        $areaId = $newArea->id;
                    } else {
                        if (!$CityResult) {
                            $newCity = new City();
                            $newCity->city_name = $inputCity;
                            $newCity->country_id = $CountryResult->id;
                            $newCity->save();

                            $newArea = new Area();
                            $newArea->area_name = $inputArea;
                            $newArea->city_id = $newCity->id;
                            $newArea->save();

                            $areaId = $newArea->id;

                        } else {
                            if (!$AreaResult) {
                                $newArea = new Area();
                                $newArea->area_name = $inputArea;
                                $newArea->city_id = $CityResult->id;
                                $newArea->save();

                                $areaId = $newArea->id;

                            }
                        }
                    }
//                if ($account->address == null) {
//
//                $account->address()->create([
//                    'area_id' => $areaId,
//                    'address' => $request->address,
//                    'latitude' => $request->lat,
//                    'longitude' => $request->long,
//                    'account_id' => $account->id,
//                ]);
//                } else {
                    $account->address()->updateOrCreate(
                        ['account_id' => $account->id],
                        [
                            'area_id' => $areaId,
                            'address' => $request->address,
                            'latitude' => $request->lat,
                            'longitude' => $request->long,
                        ]);
                } catch (\Exception $error) {
                    return response()->json([
                        'result' => 'address_exception',
                        'message' => 'Address entered in invalid address',
                        'error' => $error,
                    ]);
                }

                if (!session()->has('data.bank-address-step')) {
                    session()->put('data.bank-address-step', 'done');
                }
                return response()->json([
                    'result' => 'success'
                ]);
            }
        }
        return view('layout.profile.bank-address-step', compact('account'));
    }

    public function select_package_step(Request $request)
    {
        $account = Auth::user();
        $packages = Package::where('category_id', Auth::user()->resturant_category_id)->get();
        $package = $request->has('package') ? Package::find($request->package) : '';
//        $payments = DB::table('accounts_payment_log')->where('account_id', $account->id)->where('status', 'initial')->get();

        if ($account->address == null) {
            return Redirect::route('bank-address-step');
        }
        if ($request->isMethod('post')) {
            $rules = array(
                'package' => 'required',
                'termsCheckbox' => 'required',
            );
            $messages = [
                'package.required' => __('A package must be selected'),
                'termsCheckbox.required' => 'Please mark the checkbox if you want to proceed'
            ];
            if (isset($package) && $package->cost != 0) {
                $rules['payment_method'] = 'required';
                if ($request->payment_method) {
                    if ($request->payment_method == 1) {
                        $rules['code'] = 'required';
                    } else {
                        $rules['code'] = '';
                    }
                }
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            }

            if (isset($package) && $package->cost != 0) {
                if ($request->payment_method == 2) {
                    session()->put('selected-package', $request->package);
                    if ($request->code) {
                        session()->put('selected-code', $request->code);
                    }
                    try {
                        $response = (new CcavenueService())->generateUrl($account, $package->cost);
                    } catch (\Exception $error) {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'unknown error occurred',
                            'error' => $error,
                        ]);
                    }
                    if ($response->success) {
                        return response()->json([
                            'result' => 'successModal',
                            'payment_url' => $response->url
                        ]);
                    }
                } else if ($request->payment_method == 1) {
                    $response = Http::get(Package::validateCode, $request->code);
                    if ($response['id'] == 0) {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'Invalid marketing code',
                        ]);
                    } else {
                        $payment = AccountPaymentLog::create([
                            'account_id' => Auth::id(),
                            'amount' => $package->cost,
                            'status' => 'initial',
                            'code_id' => $response['id'],
                            'done' => 0,
                        ]);
                    }
                    if ($payment) {
                        $account->sales_id = $response['id'];
                        $account->status_id = 4;
                        $account->save();
                    }
                }
            } elseif ($package->cost === 0) {
                $account->package_id = $request->package;
                $account->status_id = 4;
                $account->save();
            }

            Mail::to($account->email)->send(new ApplicationCompleted());
            NotificationService::NotifyAdmin('initial', $account->id, "Application completed", "New application has been completed.", "New application has been completed.");

            if ($account) {
                if (!session()->has('data.select-package-step')) {
                    session()->put('data.select-package-step', 'done');
                }
                return response()->json([
                    'result' => 'success',
                ]);
            }
        }
        return view('layout.profile.select-package-step', compact('account', 'packages'));
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }

    public function create_admin(Request $request)
    {

        if ($request->isMethod('post')) {
            $rules = array(
                'account_name' => 'required|min:3|max:30|unique:account,account_name',
                'email' => 'required|email|regex:/^\S*$/u|unique:account,email',
                'national_number' => 'required|min:18|max:18',
                'password' => 'required|confirmed|min:3|max:30',
                'mobile_number' => 'required|phone:AE',
                'role' => 'required',
            );

            $messages = [
                "national_number.min" => "Not valid national number",
                "national_number.max" => "Not valid national number"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors()
                ]);
            } else {
                $account = new Account();
                $account->account_name = $request->account_name;
                $account->email = $request->email;
                $account->national_number = $request->national_number;
                $account->phone_number = $request->mobile_number;
                $account->email_verified_at = Carbon::now()->toDateTimeString();
                $account->password = Hash::make($request->password);
                $account->approved = 1;
                $account->account_type_id = 1;
                $account->status_id = 1;
                $account->save();
                $account->role()->attach($request->role);
                if ($account) {
                    return response()->json([
                        'result' => 'success'
                    ]);
                }
            }
        }
        return view('layout.admin.create-admin');
    }

    public function show_admin()
    {
        $admins = Account::where('account_type_id', 1)->where('id', '!=', Auth::id())->get();
        return view('layout.admin.show-admins', compact('admins'));
    }

    public function delete_admin(Account $account)
    {
        if (auth()->user()->cannot('delete-admin') || $account->id = Account::SUPER_ADMIN) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $account->delete();

        return response()->json([
            'result' => 'success',
            'message' => 'Account has been deleted'
        ]);
    }

    public function update_admin(Request $request, Account $account)
    {
        if (($request->user()->cannot('edit-admin') && auth()->id() != $account->id) || ($account->id == Account::SUPER_ADMIN && auth()->id() != Account::SUPER_ADMIN) || $account->account_type_id == Account::IS_RESTAURANT) {
            abort(Response::HTTP_NOT_FOUND);
        }

        if ($request->isMethod('POST')) {

            $rules = array(
                'account_name' => 'required|min:3|max:30|unique:account,account_name,' . $account->id,
                'email' => 'required|email|regex:/^\S*$/u|unique:account,email,' . $account->id,
                'national_number' => 'required|min:18|max:18',
                'mobile_number' => 'required|phone:AE',
            );
            $messages = [
                "national_number.min" => "Not valid national number",
                "national_number.max" => "Not valid national number"
            ];

            if ($request->password) {
                $rules['password'] = 'required|confirmed|min:5|max:30';
            }


            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors()
                ]);
            } else {
                $account->account_name = $request->account_name;
                $account->email = $request->email;
                $account->national_number = $request->national_number;
                $account->phone_number = $request->mobile_number;
                if ($request->password) {
                    $account->password = Hash::make($request->password);
                }
                $account->save();
                if ($account) {
                    return response()->json([
                        'result' => 'success',
                        'message' => 'profile has been updated'
                    ]);
                } else {
                    return response()->json([
                        'result' => 'exception',
                        'message' => 'Something went wrong'
                    ]);
                }
            }
        }
        return view('layout.admin.update-admin', compact('account'));
    }

    public function api_restaurant_registration(Request $request)
    {
        $rules = array(
            'restaurantName' => 'required',
            'email' => 'required|email|regex:/^\S*$/u',
            'password' => 'required',
            'phone_number' => 'required|phone:AE',
        );
        $validData = $request->validate($rules);
        $account = Account::create([
            'account_name' => $validData['restaurantName'],
            'email' => $validData['email'],
            'phone_number' => $validData['phone_number'],
            'account_type_id' => 2,
            'status_id' => 3,
            'password' => Hash::make($validData['password'])
        ]);
        $verifyAccount = verifyAccount::create([
            'account_id' => $account->id,
            'token' => sha1(time())
        ]);
        if ($verifyAccount) {
            Mail::to($account->email)->send(new VerifyMail($account));
        }

        $token = $account->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }

    public function api_restaurant_login(Request $request)
    {

        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );

        $validData = $request->validate($rules);

        try {
            $restaurant = Account::where('email', $request->email)->first();

            if (!$restaurant || !Hash::check($request->password, $restaurant->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $token = $restaurant->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $restaurant,
                'token' => $token
            ];

            return response($response, 201);

        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }

    public function check_email(Request $request)
    {

        $rules = ['email' => 'required|email|unique:account|unique:customers|unique:owners'];

        $validData = $request->validate($rules);

        if ($validData['email']) {
            return response()->json([
                'success' => 'true',
                'message' => 'the email is valid',
            ]);
        }
    }

    public function check_phone_number(Request $request)
    {
        $rules = ['phone_number' => 'required|phone:AE|unique:account|unique:customers|unique:owners'];

        $messages = ['phone_number.unique' => 'Phone number is already registered'];

        $validData = $request->validate($rules, $messages);

        if ($validData['phone_number']) {
            return response()->json([
                'success' => 'true',
                'message' => 'the phone number is valid'
            ]);
        }
    }

    public function handlePayment(Request $request)
    {
        $package = Package::find(session()->get('selected-package'));
        if ($request->encResp) {
            if (session()->has('selected-code')) {
                $body['code'] = session()->get('selected-code');
                $CodeResponse = Http::get(Package::validateCode, $body);
                session()->forget('selected-code');
                if ($CodeResponse['id'] == 0) {
                    return Redirect::route('select-package-step')->withErrors(['msg' => 'Reference code is invalid']);
                } else {
                    $body['encResp'] = $request->encResp;
                    $body['working_key'] = env('INDIPAY_WORKING_KEY');
//                    $response = Http::post($url, $body);
                    $response = (new CcavenueService())->checkResponse($body);
                    if ($response->success == false) {
                        return Redirect::route('select-package-step');
                    } else if ($response->success == true) {

                        if (AccountPaymentLog::where('status', 'initial')->where('account_id', auth()->id())->exists()) {
                            return AccountPaymentLog::where('status', 'initial')->where('account_id', auth()->id())->delete();
                        }

                        $payment = AccountPaymentLog::create([
                            'account_id' => Auth::id(),
                            'amount' => $response->data->amount,
                            'status' => 'initial',
                            'code_id' => $CodeResponse['id'],
                            'orderNo' => $response->data->order_id,
                            'done' => 1,
                            'done_date' => Carbon::now()->toDateTimeString()
                        ]);

                        if ($payment) {
                            Account::where('id', Auth::id())->update(['package_id' => $package->id, 'status_id' => 4, 'sales_id' => $CodeResponse['id']]);
                            Mail::to(Auth::user()->email)->send(new ApplicationCompleted());
                            NotificationService::NotifyAdmin('initial', Auth::id(), "Application completed", "New application has been completed.", "New application has been completed.");
                            if (!session()->has('data.select-package-step')) {
                                session()->put('data.select-package-step', 'done');
                            }
                            return Redirect::route('finished-application');
                        }
                    }
                }
            } else {
                $body['encResp'] = $request->encResp;
                $body['working_key'] = env('INDIPAY_WORKING_KEY');
                $response = (new CcavenueService())->checkResponse($body);
//                $response = Http::post($url, $body);
                if ($response->success == false) {
                    return Redirect::route('select-package-step');
                } elseif ($response->success == true) {

                    if (AccountPaymentLog::where('status', 'initial')->where('account_id', auth()->id())->exists()) {
                        AccountPaymentLog::where('status', 'initial')->where('account_id', auth()->id())->delete();
                    }

                    $payment = AccountPaymentLog::create([
                        'account_id' => Auth::id(),
                        'amount' => $response->data->amount,
                        'status' => 'initial',
                        'orderNo' => $response->data->order_id,
                        'done' => 1,
                        'done_date' => Carbon::now()->toDateTimeString()
                    ]);

                    if ($payment) {
                        Account::where('id', Auth::id())->update(['package_id' => $package->id, 'status_id' => 4]);
                        Mail::to(Auth::user()->email)->send(new ApplicationCompleted());
                        NotificationService::NotifyAdmin('initial', Auth::id(), "Application completed", "New application has been completed.", "New application has been completed.");
                        if (!session()->has('data.select-package-step')) {
                            session()->put('data.select-package-step', 'done');
                        }
                        return Redirect::route('finished-application');
                    }
                }
            }

        } else {
            return Redirect::route('select-package-step');
        }
    }

    public function verifyUser($token)
    {
        $verifyAccount = verifyAccount::where('token', $token)->first();
        if (isset($verifyAccount)) {
            $account = $verifyAccount->account;
            if ($account->email_verified_at == null) {
                $verifyAccount->account->email_verified_at = Carbon::now()->toDateTimeString();
                $verifyAccount->account->save();
            }
            verifyAccount::where('token', $token)->delete();
            Auth::loginUsingId($account->id);
            return Redirect::route('signup_wizard');
        } else {
            abort(404);
        }
    }

    public function show_customers()
    {
        $customers = Customer::with('status', 'order')->get();
        return view('layout.customer.show-customers', compact('customers'));
    }

    function get_accounts_by_filters(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'currency_id' => 'required|numeric',
                'min_price' => 'nullable|numeric',
                'max_price' => 'nullable|numeric',
                'name' => 'nullable|string',
                'work_status' => 'nullable|numeric',
                'rate_value' => 'nullable|numeric'

            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $language_id = $request->input('language_id');
                $currency_id = $request->input('currency_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $min_price = $request->input('min_price');
                $max_price = $request->input('max_price');
                $name = $request->input('name');
                $rate_value = $request->input('rate_value');
                $online = $request->input('work_status');

                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
//                $account_currency_id = DB::table('account_currency')->where('currency_id', $currency_id)->select('id')->first();
//                dd($account_currency_id->id);
                if ($online != null || $name != null || $min_price != null || $max_price != null || $rate_value != null) {
                    if ($language_id == 1)
                        $select = 'select ac.id As account_id, ac.account_name ,work_status.status_name_en as status,ac.phone_number,ac.opening_time,ac.closing_time,ad.address,ad.latitude,ad.longitude,ac.logo_path';

//                        $select = 'select ac.id As account_id, ac.account_name ,work_status.status_name_en as status,ac.phone_number,ac.opening_time,ac.closing_time,ad.address,ad.latitude,ad.longitude,ac.logo_path,(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution';
                    else
                        $select = 'select ac.id As account_id, ac.account_name ,work_status.status_name_ar as status,ac.phone_number,ac.opening_time,ac.closing_time,ad.address,ad.latitude,ad.longitude,ac.logo_path';

                    $group_by = ' ';
                    $from = 'from account as ac';
                    $join = 'join account_currency ac_cu on ac_cu.account_id=ac.id
                    join address ad on ad.account_id=ac.id
                    join work_status on work_status.id=ac.work_status_id
                    ';

                    $where = 'where 1=1 and ac.account_type_id=2 and ac.status_id=1 and ac_cu.currency_id = ' . $currency_id;
                    if ($name != null) {
                        $where .= ' and ac.account_name like \'%' . $name . '%\'';
                    }
                    if ($online != null) {
                        $where .= ' and ac.work_status_id =' . $online;
                    }
//
                    if ($min_price != null && $max_price != null) {
                        $join .= ' join item_price_currency ON item_price_currency.acc_currency_id=ac_cu.id';
                        $where .= ' and item_price_currency.price >=' . $min_price . ' and item_price_currency.price<=' . $max_price;
                    }
                    $group_by = ' GROUP BY account_id';
                    if ($rate_value != null) {
                        $select .= ' , ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3))  as evalution';
                        $join .= ' left join evaluation on evaluation.restaurant_id= ac.id';
                        $group_by = ' GROUP BY account_id, ac.account_name ,ac.phone_number,ac.opening_time,ac.closing_time,ad.address,ad.latitude,ad.longitude,ac.logo_path
                    having evalution >=' . $rate_value;

                    }
//                    else {
//                        $group_by = ' GROUP BY account_id, ac.account_name ,ac.phone_number,ac.opening_time,ac.closing_time,ad.address,ad.latitude,ad.longitude,ac.logo_path
//                    having evalution !=null';
//                    }
                    $q = $select . ' ' . $from . ' ' . $join . ' ' . $where . ' ' . $group_by;
//                    dd($q);
                    DB::enableQueryLog();
                    $res_count = DB::select($q);
//                    dd(DB::getQueryLog());
                    if (count($res_count) > 0) {
                        $query = $q . ' LIMIT ' . $offset . ', ' . $limit;
                        $res_count = DB::select($query);

                        if (count($res_count) > 0) {
                            foreach ($res_count as $account) {
                                if ($account->logo_path != null)
                                    $account->logo_path = URL::to('/') . '/restaurants/logo/' . $account->account_id . '/' . $account->logo_path;
                                if ($language_id == 1)
                                    $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $account->account_id)->get();
                                else
                                    $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name_ar as sub_category_name ")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $account->account_id)->get();
                                $eval = DB::table('evaluation')
                                    ->selectRaw("(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution")
                                    ->where('restaurant_id', $account->account_id)->get();

                                $account->menus = $menu_names->implode('sub_category_name', ', ');
                                $account->evalution = $eval[0]->evalution;
                            }
                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $res_count;
                            $response['page_count'] = ceil(count($res_count) / $limit);
                            $response['total_rows'] = count($res_count);
                            return $response;
                        } else {
                            $response['msg'] = 'There is no place within the applied filters';
                            $response['status'] = false;
                            return $response;
                        }
                    } else {
                        $response['msg'] = 'There are no places within the applied filters';
                        $response['status'] = false;
                        return $response;
                    }

                } else {
                    $response['msg'] = 'At least one filter must be entered';
                    $response['status'] = false;
                    return $response;
                }

            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }

    function grantPrivileges(Request $request, Account $account)
    {

        abort_if(auth()->id() == $account->id || $account->id == Account::SUPER_ADMIN, Response::HTTP_NOT_FOUND);

        if ($request->isMethod('POST')) {
            $rules = ['role' => 'required'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'errors' => $validator->errors()
                    ]
                );
            }
            $account->role()->sync($request->role);
            return response()->json(
                [
                    'status' => true,
                ]
            );
        }
        return view('layout.admin.grant-privileges', compact('account'));
    }
}
