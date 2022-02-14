<?php

namespace App\Http\Controllers;

use App\Mail\ApproveApplication;
use App\Mail\SendNotes;
use App\Models\Account;
use App\Models\AccountPaymentLog;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\MinPriceModel;
use App\Models\Owner;
use App\Models\Package;
use App\Services\CcavenueService;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use File;

class RestaurantController extends Controller
{
    function all_restaurants()
    {
        $restaurants = Account::where('account_type_id', 2)->where('approved', 1)
            ->with(['category:id,category_name', 'status:id,status'])->get();
        return view('layout.restaurant.show_restaurants', compact('restaurants'));
    }

    function changeStatus(Request $request)
    {
        $result = Account::where('id', $request->restaurant_id)->first();
        $result->update([
            'status_id' => $result->status_id == 1 ? 2 : 1,
        ]);

        if ($result) {
            return response()->json([
                'result' => 'true',
            ]);
        }
    }

    function restaurantChangeStatus(Request $request)
    {
        if ($request->user()->cannot('manage-restaurants') && auth()->user()->account_type_id == Account::IS_ADMIN) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $result = Account::where('id', $request->restaurant_id)->first();
        $result->update([
            'work_status_id' => $result->work_status_id == 1 ? 2 : 1,
        ]);

        if ($result) {
            return response()->json([
                'result' => 'true',
            ]);
        }
    }

    function non_approved_restaurant()
    {
        $restaurants = Account::with(['owner', 'address'])->where('account_type_id', 2)->Where('approved', null)->where('status_id', 4)->get();
        return view('layout.restaurant.non-approved-restaurants', compact('restaurants'));
    }

    function view_license($id)
    {

        $account = Account::findOrFail($id);

        $file_name = $account->license_path;

        $filePath = 'restaurants/license/' . $id . '/' . $file_name;
        // file not found

        if (!Storage::exists($filePath)) {
            abort(404);
        }

        $pdfContent = Storage::path($filePath);

        return response()->file($pdfContent);
    }

    public function approve_application($id)
    {
        $account = Account::FindorFail($id);
        $payment = $account->payment;
        if ($payment->done == 0) {
            return response()->json([
                'status' => 'payment_exception',
                'message' => 'Please check the application payment and accept it'
            ]);
        }
        $date = Carbon::now();
        $expiration_date = $date->addMonths($account->package->duration)->toDateTimeString();
        $account->package_expiration_at = $expiration_date;
        $account->status_id = 1;
        $account->approved = 1;
        $account->save();
        if ($account) {
            $maildata = [
                'title' => 'Dear ' . $account->account_name,
                'message' => 'Your application has been reviewed by our team',
                'url' => route('login'),
            ];

            try {
                Mail::to($account->email)->send(new ApproveApplication($maildata));
                return response()->json([
                    'result' => 'success',
                    'message' => 'Application has been approved'
                ]);
            } catch (\Exception $error) {
                return response()->json([
                    'status_code' => 500,
                    'message' => $error,
                ]);
            }
        }
    }

    public function send_notes(Request $request, $id)
    {
        $owner = Owner::findorfail($id);

        if ($request->isMethod('post')) {
            $rules = [
                'note' => 'required|min:3|max:250',
                'subject' => 'required|min:3|max:20'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors()
                ]);
            } else {
                $maildata = [
                    'title' => 'Dear ' . $owner->account_name,
                    'subject' => $request->subject,
                    'note' => $request->note,
                    'url' => route('login'),
                ];
                try {
                    Mail::to($owner->email)->send(new SendNotes($maildata));
                    return response()->json([
                        'result' => 'success',
                        'message' => 'Email has been sent',
                    ]);
                } catch (\Exception $error) {
                    return response()->json([
                        'status_code' => 500,
                        'message' => $error,
                    ]);
                }
            }
        }
        return view('mails.send-notes-form', compact('owner'));
    }

    public function check_payments(Request $request)
    {

        $payments = AccountPaymentLog::with('account')->where('done', 0)->where('status', 'initial')->get();
        return view('layout.payments.cash-payments', compact('payments'));

    }

    public function restaurant_profile(Account $account)
    {
        if (Gate::denies('restaurant-profile', $account)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('layout.profile.profile', compact('account'));
    }

    public function clock_picker(Request $request)
    {

        $rules = [
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'result' => 'false',
                'errors' => $validator->errors()
            ]);
        } else {
            $account = Account::findorfail(Auth::id());
            $account->opening_time = $request->opening_time;
            $account->closing_time = $request->closing_time;
            $account->save();
            return response()->json([
                'result' => 'true',
                'message' => 'Time has been updated'
            ]);
        }
    }

    public function accept_payment($id)
    {

        $payment = AccountPaymentLog::findorfail($id);
        if ($payment) {
            $payment->done = 1;
            $payment->done_date = Carbon::now()->toDateTimeString();
            $payment->save();
        } else {
            abort(404);
        }
        return response()->json([
            'result' => 'success',
            'message' => 'Payment has been accepted'
        ]);
    }

    public function account_by_code($id)
    {
        $accounts = DB::table('account')->where('sales_id', $id)->get(['id', 'account_name']);
        return response()->json([
            'success' => true,
            'companies' => $accounts,
            'message' => ""
        ]);
    }

    public function sub_category_image(Request $request)
    {
        $sub_cat_pivot = DB::table('restaurant_sub_category')->where('id', $request->pivot_id)->first();

        $rules = array(
            'pivot_id' => "required",
            'image' => 'required|mimes:jpeg,jpg,png|max:500'
        );

        $messages = [
            'image.max' => 'Restaurant Logo Maximum Picture size is 500 KB'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'result' => 'false',
                'errors' => $validator->errors(),
            ]);
        } else {
            $path = public_path() . '/restaurants/sub_categories/' . $sub_cat_pivot->id;
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
                $image = $request->file('image');
                $input['imagename'] = time() . '.' . $image->extension();
                $img = Image::make($image->path());
                $img->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path . '/' . $input['imagename']);
            } else {
                $FileSystem = new Filesystem();
                $directory = public_path() . '/restaurants/sub_categories/' . $sub_cat_pivot->id;
                if ($FileSystem->exists($directory)) {
                    // Get all files in this directory.
                    $files = $FileSystem->files($directory);
                    // Check if directory is empty.
                    if (!empty($files)) {
                        $FileSystem->delete($files);
                    }
                    $image = $request->file('image');
                    $input['imagename'] = time() . '.' . $image->extension();
                    $img = Image::make($image->path());
                    $img->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($directory . '/' . $input['imagename']);
                }
            }

            auth()->user()->sub_category()->updateExistingPivot($sub_cat_pivot->sub_category_id,
                [
                    'image_path' => $input['imagename']
                ]
            );

            return response()->json([
                'result' => 'success',
                'message' => 'Image has been uploaded',
            ]);
        }

    }

    public function renew_subscription(Request $request)
    {
        $account = Auth::user();
        $packages = Package::where('category_id', $account->resturant_category_id)->get();
        $package = $request->has('package') ? Package::find($request->package) : '';

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
                        $response = (new CcavenueService())->generateRenewUrl($account, $package->cost);
                    } catch (\Exception $error) {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'unknown error occurred',
                            'error' => $error,
                        ]);
                    }
                    if ($response->success == true) {
                        return response()->json([
                            'result' => 'successModal',
                            'payment_url' => $response->url
                        ]);
                    } else {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'unknown error occurred'
                        ]);
                    }
                } else if ($request->payment_method == 1) {
                    $body['code'] = $request->code;
                    $response = Http::get(Package::validateCode, $body);
                    if ($response['id'] == 0) {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'Invalid marketing code',
                        ]);
                    } else {
                        $payment = AccountPaymentLog::create([
                            'account_id' => Auth::id(),
                            'amount' => $package->cost,
                            'status' => 'renew',
                            'code_id' => $response['id'],
                            'done' => 1,
                            'done_date' => Carbon::now()->toDateTimeString()
                        ]);
                    }
                    if ($payment) {
                        $date = Carbon::now();
                        $expiration_date = $date->addMonths($package->duration)->toDateTimeString();
                        $account->package_expiration_at = $expiration_date;
                        $account->sales_id = $response['id'];
                        $account->status_id = 1;
                        $account->package_id = $request->package;
                        $account->save();

                        //                            todo
//                            notify the admin about the restaurant renew and insert in the database
                        NotificationService::NotifyAdmin('renew', $account->id, 'Renew subscription', 'Restaurant has renewed subscription', 'Restaurant has renewed subscription');
                        return response()->json([
                            'result' => 'success',
                        ]);
                    }
                }
            } elseif ($package->cost === 0) {
                $date = Carbon::now();
                $expiration_date = $date->addMonths($package->duration)->toDateTimeString();
                $account->package_expiration_at = $expiration_date;
                $account->package_id = $request->package;
                $account->save();
                return response()->json([
                    'result' => 'success',
                ]);
            }
        }
        return view('layout.profile.renew-subscription', compact('packages', 'account'));
    }

    public function handlePayment_renew(Request $request)
    {
        $package = Package::findorfail(session()->get('selected-package'));
        $account = Auth::user();
        if ($request->encResp) {
            if (session()->has('selected-code')) {
                $body['code'] = session()->get('selected-code');
                $CodeResponse = Http::get(Package::validateCode, $body);
                session()->forget('selected-code');
                if ($CodeResponse['id'] == 0) {
                    if (Carbon::now()->toDateTimeString() > Auth::user()->package_expiration_at) {
                        return Redirect::route('renew-subscription')->withErrors(['msg' => 'Reference code is invalid']);
                    }
                    return Redirect::route('change-package')->withErrors(['msg' => 'Reference code is invalid']);
                } else {
                    $body['encResp'] = $request->encResp;
                    $body['working_key'] = env('INDIPAY_WORKING_KEY');
                    $response = (new CcavenueService())->checkResponse($body);
                    if ($response->success == false) {
                        return Redirect::route('profile', $account->id);
                    } else if ($response->success == true) {
                        $payment = AccountPaymentLog::create([
                            'account_id' => Auth::id(),
                            'amount' => $response->data->amount,
                            'status' => 'renew',
                            'code_id' => $CodeResponse['id'],
                            'orderNo' => $response->data->order_id,
                            'done' => 1,
                            'done_date' => Carbon::now()->toDateTimeString()
                        ]);
                        if ($payment) {
                            $date = Carbon::now();
                            $expiration_date = $date->addMonths($package->duration)->toDateTimeString();
                            $account->package_expiration_at = $expiration_date;
                            $account->status_id = 1;
                            $account->sales_id = $CodeResponse['id'];
                            $account->package_id = $package->id;
                            $account->save();

                            NotificationService::NotifyAdmin('renew', $account->id, 'Renew subscription', 'Restaurant has renewed subscription', 'Restaurant has renewed subscription');
                            return Redirect::route('profile', $account->id);
                        }
                    }
                }
            } else {
                $body['encResp'] = $request->encResp;
                $body['working_key'] = env('INDIPAY_WORKING_KEY');
                $response = (new CcavenueService())->checkResponse($body);
                if ($response->success == false) {
                    return Redirect::route('profile', $account->id);
                } else if ($response->success == true) {
                    $payment = AccountPaymentLog::create([
                        'account_id' => Auth::id(),
                        'amount' => $response->data->amount,
                        'status' => 'renew',
                        'orderNo' => $response->data->order_id,
                        'done' => 1,
                        'done_date' => Carbon::now()->toDateTimeString()
                    ]);

                    if ($payment) {
                        $date = Carbon::now();
                        $expiration_date = $date->addMonths($package->duration)->toDateTimeString();
                        $account->package_expiration_at = $expiration_date;
                        $account->status_id = 1;
                        $account->package_id = $package->id;
                        $account->save();

                        NotificationService::NotifyAdmin('renew', $account->id, 'Renew subscription', 'Restaurant has renewed subscription', 'Restaurant has renewed subscription');
                        return Redirect::route('profile', $account->id);
                    }
                }
            }
        } else {
            return Redirect::route('profile', $account->id);
        }
    }

    public function change_package(Request $request)
    {
        $account = Auth::user();
        $packages = Package::where('category_id', $account->resturant_category_id)->get();
        $package = $request->has('package') ? Package::find($request->package) : '';


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
                        $response = (new CcavenueService())->generateRenewUrl($account, $package->cost);
                    } catch (\Exception $error) {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'unknown error occurred',
                            'error' => $error,
                        ]);
                    }
                    if ($response->success == true) {
                        return response()->json([
                            'result' => 'successModal',
                            'payment_url' => $response->url
                        ]);
                    } else {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'unknown error occurred'
                        ]);
                    }
                } else if ($request->payment_method == 1) {
                    $body['code'] = $request->code;
                    $response = Http::get(Package::validateCode, $body);
                    if ($response['id'] == 0) {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'Invalid marketing code',
                        ]);
                    } else {
                        $payment = AccountPaymentLog::create([
                            'account_id' => Auth::id(),
                            'amount' => $package->cost,
                            'status' => 'renew',
                            'code_id' => $response['id'],
                            'done' => 1,
                            'done_date' => Carbon::now()->toDateTimeString()
                        ]);
                    }
                    if ($payment) {
                        $date = Carbon::now();
                        $expiration_date = $date->addMonths($package->duration)->toDateTimeString();
                        $account->package_expiration_at = $expiration_date;
                        $account->sales_id = $response['id'];
                        $account->status_id = 1;
                        $account->package_id = $request->package;
                        $account->save();
                        return response()->json([
                            'result' => 'success',
                        ]);
                    }
                }
            } elseif ($package->cost === 0) {
                $date = Carbon::now();
                $expiration_date = $date->addMonths($package->duration)->toDateTimeString();
                $account->package_expiration_at = $expiration_date;
                $account->package_id = $request->package;
                $account->save();
                return response()->json([
                    'result' => 'success',
                ]);
            }
        }
        return view('layout.profile.change-package', compact('packages', 'account'));
    }

    public function update_restaurant_info(Request $request, Account $account)
    {
        if (Gate::denies('restaurant-profile', $account)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $currencies = $account->currency->modelKeys();
        $sub_categories = $account->sub_category->modelKeys();
        $parent_sub_categories = DB::table('parent_sub_category')->get();

        if ($request->isMethod('POST')) {

            $rules = array(
                'currency' => 'required',
                'account_name' => 'required|min:3|max:30|unique:account,account_name,' . $account->id,
                'email' => 'required|email|regex:/^\S*$/u|unique:account,email,' . $account->id,
                'address' => 'required|min:3|max:200',
                'description' => 'required|min:3|max:300',
                'mobile_number' => 'required|phone:AE',
                'long' => 'required',
                'lat' => 'required',
            );
            $messages = [
                'logo.max' => 'Restaurant Logo Maximum Picture size is 500 KB'
            ];

            if ($request->file('logo')) {
                $rules['logo'] = 'mimes:jpeg,jpg,png|max:500';
            }
            if ($request->password) {
                $rules['password'] = 'required|confirmed|min:5|max:30';
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            } else {

                $sub_category_ids = explode(',', $request->sub_category);

                $currenciesIds = explode(',', $request->currency);
                $currencyArrayDiff = array_diff($currencies, $currenciesIds);

                if (count($currencyArrayDiff) != 0) {
                    try {
//                        foreach ($currencyArrayDiff as $currencyId) {
//                            $pivotData[] = DB::table('account_currency')->where('account_id', $restaurant->id)->where('currency_id', $currencyId)->get()->pluck('id')->toArray()[0];
//                        }
                        $pivotData = DB::table('account_currency')->where('account_id', $account->id)->wherein('currency_id', $currencyArrayDiff)->pluck('id');


//                        foreach ($pivotData as $pivotId) {
                        DB::table('item_price_currency')->whereIn('acc_currency_id', $pivotData)->delete();
                        DB::table('offer_price_currency')->whereIn('acc_currency_id', $pivotData)->delete();
                        DB::table('coupon_currency')->whereIn('acc_currency_id', $pivotData)->delete();
                        DB::table('component_price_currency')->whereIn('acc_currency_id', $pivotData)->delete();
                        DB::table('min_price_currency')->where('account_id', $account->id)->whereIn('currency_id', $currencyArrayDiff)->delete();
//                        }

                    } catch (\Exception $error) {
                        return response()->json([
                            'result' => 'exception',
                            'message' => 'unknown error occurred',
                            'error' => $error,
                        ]);
                    }
                }
                $account->currency()->sync($currenciesIds);
                $account->sub_category()->attach($sub_category_ids);

                if ($request->file('logo')) {
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

                    } else {
                        File::makeDirectory($directory, $mode = 0777, true, true);
                        $image = $request->file('logo');
                        $input['imagename'] = time() . '.' . $image->extension();
                        $img = Image::make($image->path());
                        $img->resize(100, 250, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($directory . '/' . $input['imagename']);
                    }
                    $account->logo_path = $request->file('logo') ? $input['imagename'] : $account->logo_path;
                    $account->save();
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

                    $account->address()->update([
                        'area_id' => $areaId,
                        'address' => $request->address,
                        'latitude' => $request->lat,
                        'longitude' => $request->long,
                    ]);

                    $account->description = $request->description;
                    $account->account_name = $request->account_name;
                    $account->email = $request->email;
                    $account->phone_number = $request->mobile_number;
                    if ($request->password) {
                        $account->password = Hash::make($request->password);
                    }
                    $account->save();

                    return response()->json([
                        'result' => 'success',
                        'message' => 'Profile has been updated'
                    ]);
                } catch (\Exception $error) {
                    return response()->json([
                        'result' => 'address_exception',
                        'message' => 'Address entered in invalid address',
                        'error' => $error,
                    ]);
                }
            }
        }
        return view('layout.restaurant.update-restaurant-info', compact('account', 'currencies', 'sub_categories', 'parent_sub_categories'));

    }

    public function set_currency(Request $request)
    {

        if ($request->isMethod('post')) {

            $rules = [
                'currency' => 'required',
                'opening_time' => 'required|date_format:H:i',
                'closing_time' => 'required|date_format:H:i',
            ];

            $messages = [
                'currency.required' => 'Please select at least on currency'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors(),
                ]);
            } else {
                preg_match_all('!\d+!', $request->currency, $currencies);
                try {
                    $account = Auth::user();
                    $account->currency()->sync($currencies[0]);
                    $account->update([
                        'opening_time' => $request->opening_time,
                        'closing_time' => $request->closing_time
                    ]);

                    return response()->json([
                        'result' => 'success',
                    ]);
                } catch (\Exception $error) {
                    return response()->json([
                        'status_code' => 500,
                        'message' => $error,
                    ]);
                }
            }
        }
        return view('layout.restaurant.set-currency');
    }

    public function update_min_price_order_currency(Request $request)
    {
        $account = Auth::user();
        $currencies = $account->currency;

        $rules = collect();
        $messages = [
            'required' => 'Minimum Price Fields Are Required.',
            'numeric' => 'Minimum Price Fields Must Be Numeric.',
        ];
        $currencies->map(function ($currency) use ($rules) {
            $rules->put('currency-' . $currency->id, 'required|numeric');
        });

        $validator = Validator::make($request->all(), $rules->toArray(), $messages);

        $data = $request->all();
        if ($validator->fails()) {
            return response()->json([
                'result' => 'false',
                'errors' => $validator->errors(),
            ]);
        }

        foreach ($data as $index => $value) {
            MinPriceModel::updateOrCreate([
                'account_id' => $account->id,
                'currency_id' => Str::AfterDash($index)
            ], [
                'min_price' => $value,
            ]);
        }
        return response()->json([
            'result' => 'true',
            'message' => 'Minimum Price Has Been Updated',
        ]);
    }
}
