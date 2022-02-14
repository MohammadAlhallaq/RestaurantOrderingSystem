<?php

namespace App\Http\Controllers\API\Portal;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemDetailsResource;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantDetailsResource;
use App\Http\Resources\RestaurantMenuDetailsResource;
use App\Http\Resources\RestaurantSearchCollection;
use App\Http\Resources\ReviewCollection;
use App\Mail\VerifyMail;
use App\Models\AccountCurrency;
use App\Models\Address;
use App\Models\AnotherAccount;
use App\Models\Article;
use App\Models\Comment_model;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Account;
use App\Models\item;
use App\Models\RestaurantSubCategory;
use App\Models\verifyAccount;
use App\Services\NotificationService;
use Crypt;
use Config;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Session;
use Validator;
use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PayUService\Exception;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\Mail\SendCompanyWelcomeNote;


class RestaurantController extends Controller
{
    /**
     * PortalController constructor.
     */
    public function __construct()
    {

    }

    function check_email(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:account|unique:customers|unique:owners'
        ]);
        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }

        return response()->json(['success' => $success, 'message' => []]);
    }

    function check_email_phone(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc',
            'mobile' => 'required',
        ]);
        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }
        //check email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:account|unique:customers|unique:owners'
        ]);
        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }
        //check phone
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|phone:AE|unique:account|unique:customers|unique:owners'
        ]);
        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }
        return response()->json(['success' => $success, 'message' => []]);
    }

    //for admin
    function insert_admin(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:account|unique:customers|unique:owners'
        ]);

        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }
        try {
            $account = Account::create([
                'account_name' => $request->company_name,
                'email' => $request->email,
                'phone_number' => (isset($request->phone)) ? $request->phone : '',
                'account_type_id' => 1,
                'status_id' => 1,
                'password' => $request->password,
                'main_id' => $request->id,
                'approved' => 1
            ]);
            return response()->json(['success' => true, 'message' => []]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => ['An error occurred']]);
        }
    }

    //for vendor
    function insert_vendor(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:account|unique:customers|unique:owners'
        ]);
        $language_id = $request->get('language_id') != null ? $request->get('language_id') : 1;


        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }
        try {
            $account = Account::create([
                'account_name' => $request->company_name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'account_type_id' => 2,
                'status_id' => 3,
                'work_status_id' => 2,
                'password' => $request->password,
                'main_id' => $request->id
            ]);
            $verifyAccount = verifyAccount::create([
                'account_id' => $account->id,
                'token' => sha1(time())
            ]);
            if ($verifyAccount) {
                NotificationService::NotifyAdmin('initial', $account->id, "New Restaurant", "new application has been created.", "new application has been created.");
                Mail::to($account->email)->send(new VerifyMail($account, $language_id));
            }
            return response()->json(['success' => true, 'message' => []]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => ['An error occurred']]);
        }
    }

    //add support
    function add_support(Request $request)
    {
        $create = Support::create($request->all());
        if ($create->id) {
            return response()->json([
                'success' => true,
                'errors' => [],
                'message' => 'Ticket support was added successfully.'
            ]);
        }
        return response()->json([
            'success' => false,
            'errors' => [
                'An error Occurs !'
            ]
        ]);
    }

    //insert user insert_user
    function insert_user(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:account|unique:customers|unique:owners'
        ]);

        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }
        try {
            $account = Customer::create([
                'username' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'password' => $request->password,
                'status_id' => 1,
                'main_id' => $request->id
            ]);
            return response()->json(['success' => true, 'message' => []]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => ['An error occurred']]);
        }
    }

    //get restaurant menu
    function get_restaurant_menu(Request $request)
    {
        $id = $request->get('id');
        $data = AnotherAccount::with('sub_category.items.price.accountCurrency.Currency', 'sub_category.category', 'address')->where('id', '=', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    function get_restaurant_menu_v2(Request $request)
    {
        $rules = array(
            'id' => 'required|numeric',
            'currency_id' => 'required|numeric',
        );

        $request->validate($rules);

        $id = $request->get('id');
        $currency_id = $request->get('currency_id');
        $all_currencies = Currency::all()->pluck('id')->toArray();
        if (!in_array($currency_id, $all_currencies)) {
            return response()->json([
                'success' => false,
                'data' => ['not supported currency']
            ]);
        }
        $currency = AccountCurrency::where('currency_id', $currency_id)->where('account_id', $id)->first();
        if ($currency) {
            $res = AnotherAccount::Where('id', $id)->select('id', 'account_name', 'email', 'phone_number', 'description', 'opening_time', 'closing_time', 'resturant_category_id')->first();
            if ($res) {
                $data = $res->load(['sub_category.sub_category_name', 'sub_category.items.price' => function ($query) use ($currency) {
                    return $query->where('acc_currency_id', $currency->id);
                }, 'address', 'category']);
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => ['No restaurant for the specified id']
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'data' => ['No prices for the specified currency']
            ]);
        }

    }

    //insert_temp_order
    function insert_temp_order(Request $request)
    {
        //delete
        DB::table('temp_orders')->where('user_id', '=', $request->get('user_id'))
            ->where('type', '=', $request->get('type'))
            ->delete();
        $id = DB::table('temp_orders')->insert([
            'user_id' => $request->get('user_id'),
            'type' => $request->get('type'),
            'data' => json_encode($request->get('data'))
        ]);
        return response()->json([
            'id' => DB::getPdo()->lastInsertId()
        ]);
    }

    //delete_temp_order
    function delete_temp_order(Request $request)
    {
        DB::table('temp_orders')->where('user_id', '=', $request->get('user_id'))
            ->where('type', '=', $request->get('type'))
            ->delete();
    }

    //get_temp_order
    function get_temp_order(Request $request)
    {
        $info = DB::table('temp_orders')
            ->where('id', '=', $request->get('id'))
            ->first();
        return response()->json($info);
    }

    //insert_order_payments
    function insert_order_payments(Request $request)
    {
        DB::table('order_user_subscriptions')->insert($request->get('data'));
    }

    function get_articles()
    {
        return ArticleCollection::make(Article::with(['sub_category.restaurants'])->get());
    }

    function get_restaurant_details(Request $request)
    {
        $rules = array(
            'restaurant_id' => 'required|numeric',
        );

        $request->validate($rules);
        $restaurant_id = $request->get('restaurant_id');
        $currency_id = $request->get('currency_id') != null ? $request->get('currency_id') : 1;

        $restaurant = Account::RestaurantDetails($restaurant_id, $currency_id)->first();

        if ($restaurant) {
            return RestaurantDetailsResource::make($restaurant);
        }
        return response()->json([
            'result' => false,
            'message' => 'no restaurant found for the specified main id'
        ]);
    }

    function show_restaurants(Request $request)
    {
        $page = $request->get('page') != null ? $request->get('page') : 1;
        $limit = $request->get('limit') != null ? $request->get('limit') : 10;

        return RestaurantCollection::make(Account::AllRestaurants($page, $limit)->get());
    }

    function all_reviews(Request $request)
    {
        $rules = array(
            'restaurant_id' => 'required|numeric',
        );
        $request->validate($rules);

        $limit = $request->get('limit') != null ? $request->get('limit') : 5;
        $page = $request->get('page') != null ? $request->get('page') : 1;
        $restaurant_id = $request->get('restaurant_id');

        $restaurant = Account::where('account_type_id', 2)->where('approved', 1)->where('status_id', 1)->where('id', $restaurant_id)->first();

        if ($restaurant) {
            $reviews = Comment_model::with('source')
                ->where('destination_id', $restaurant_id)
                ->skip(($page - 1) * $limit)
                ->take($limit)
                ->get();

            return ReviewCollection::make($reviews);
        }

        return response()->json([
            'result' => false,
            'message' => 'no restaurant found for the specified id'
        ]);

    }

    function restaurants_by_coordinates(Request $request)
    {
        $rules = [
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
            'sub_category' => 'array',
            'radius' => 'numeric'
        ];

        $request->validate($rules);
        $lng = $request->get('lng');
        $lat = $request->get('lat');
        $radius = $request->get('radius') != null ? $request->get('radius') : 10;
        $limit = $request->get('limit') != null ? $request->get('limit') : 10;
        $page = $request->get('page') != null ? $request->get('page') : 1;
        $currency_id = $request->get('currency_id') != null ? $request->get('currency_id') : 1;
        $category = $request->get('category') != null ? $request->get('category') : null;
        $sub_category = $request->get('sub_category') != null ? $request->get('sub_category') : null;

        $restaurants = Account::RestaurantsByCoordinates($currency_id, $sub_category, $category, $lng, $lat, $radius);
        $data['count'] = $restaurants->count();
        $data['restaurants'] = $restaurants
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();

        return RestaurantSearchCollection::make($data);
    }

    function get_restaurant_menu_details(Request $request)
    {

        $rules = array(
            'restaurant_id' => 'required|numeric',
        );

        $request->validate($rules);
        $restaurant_id = $request->get('restaurant_id');
        $currency_id = $request->get('currency_id') != null ? $request->get('currency_id') : 1;

        $currency = AccountCurrency::where('currency_id', $currency_id)->where('account_id', $restaurant_id)->first();
        if (!$currency) {
            $currency = AccountCurrency::where('account_id', $restaurant_id)->first();
        }

        $restaurant = Account::RestaurantMenuDetails($restaurant_id, $currency_id, $currency)->first();

        if ($restaurant) {
            return RestaurantMenuDetailsResource::make($restaurant);
        }

        return response()->json([
            'result' => false,
            'message' => 'no restaurant found for the specified id'
        ]);
    }

    function all_items(Request $request)
    {
        $rules = array(
            'restaurant_id' => 'required|numeric',
        );
        $request->validate($rules);
        $restaurant_id = $request->get('restaurant_id');
        $currency_id = $request->get('currency_id') != null ? $request->get('currency_id') : 1;
        $limit = $request->get('limit') != null ? $request->get('limit') : 10;
        $page = $request->get('page') != null ? $request->get('page') : 1;

        $currency = AccountCurrency::where('currency_id', $currency_id)->where('account_id', $restaurant_id)->first();
        if (!$currency) {
            $currency = AccountCurrency::where('account_id', $restaurant_id)->first();
        }

        $restaurant = Account::where('account_type_id', 2)->where('approved', 1)->where('id', $restaurant_id)->first();

        if ($restaurant) {
            $items = item::with(['price' => function ($query) use ($currency) {
                $query->where('acc_currency_id', $currency->id);
            }])
                ->where('restaurant_id', $restaurant_id)
                ->when(request('item_name'), function ($q) {
                    $q->where('item_name_en', 'like', '%' . request('item_name') . '%')
                        ->orWhere('item_name_ar', 'like', '%' . request('item_name') . '%');
                })
                ->skip(($page - 1) * $limit)
                ->take($limit)
                ->get();

            return ItemCollection::make($items);
        }
        return response()->json([
            'result' => false,
            'message' => 'no restaurant found for the specified id'
        ]);
    }

    function all_sub_category_items(Request $request)
    {
        $rules = array(
            'restaurant_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
        );
        $request->validate($rules);

        $restaurant_id = $request->get('restaurant_id');
        $sub_category_id = $request->get('sub_category_id');
        $currency_id = $request->get('currency_id') != null ? $request->get('currency_id') : 1;
        $limit = $request->get('limit') != null ? $request->get('limit') : 10;
        $page = $request->get('page') != null ? $request->get('page') : 1;

        $currency = AccountCurrency::where('currency_id', $currency_id)->where('account_id', $restaurant_id)->first();
        if (!$currency) {
            $currency = AccountCurrency::where('account_id', $restaurant_id)->first();
        }

        $usb_category = RestaurantSubCategory::where('restaurant_id', $restaurant_id)->where('sub_category_id', $sub_category_id)->first();
        if (!$usb_category) {
            $usb_category = RestaurantSubCategory::where('restaurant_id', $restaurant_id)->first();
        }

        $restaurant = Account::where('account_type_id', 2)->where('approved', 1)->where('id', $restaurant_id)->where('status_id', 1)->first();

        if ($restaurant) {
            $items = item::with(['price' => function ($query) use ($currency) {
                return $query->where('acc_currency_id', $currency->id);
            }])
                ->where('restaurant_id', $restaurant_id)
                ->where('sub_cat_id', $usb_category->id)
                ->when(request('item_name'), function ($q) {
                    $q->where('item_name_en', 'like', '%' . request('item_name') . '%')
                        ->orWhere('item_name_ar', 'like', '%' . request('item_name') . '%');
                })
                ->skip(($page - 1) * $limit)
                ->take($limit)
                ->get();

            return ItemCollection::make($items);
        }
        return response()->json([
            'result' => false,
            'message' => 'no restaurant found for the specified id'
        ]);
    }

    function can_deliver(Request $request)
    {
        $rules = [
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
            'restaurant_id' => 'required|numeric',
            'radius' => 'numeric'
        ];

        $request->validate($rules);
        $lng = $request->get('lng');
        $lat = $request->get('lat');
        $restaurant_id = $request->get('restaurant_id');
        $radius = $request->get('radius') != null ? $request->get('radius') : 30;

        $result = Address::query()
            ->where('account_id', $restaurant_id)
            ->select(
                DB::raw("( 6371 * acos( cos( radians($lat) ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians($lng)
                       ) + sin( radians($lat) ) *
                       sin( radians( latitude ) ) )
                     ) AS distance"))
            ->first();

        if ($result) {
            if ($result->distance <= $radius) {
                return response()->json([
                    'result' => true,
                ]);
            }
            return response()->json([
                'result' => false,
            ]);
        }
        return response()->json([
            'result' => false,
            'message' => 'no restaurant found for the specified id'
        ]);

    }

    function item_components(Request $request)
    {

        $rules = [
            'item_id' => 'required|numeric',
            'restaurant_id' => 'required|numeric'
        ];

        $request->validate($rules);
        $item_id = $request->get('item_id');
        $restaurant_id = $request->get('restaurant_id');
        $currency_id = $request->get('currency_id') != null ? $request->get('currency_id') : 1;

        $currency = AccountCurrency::where('currency_id', $currency_id)->where('account_id', $restaurant_id)->first();
        if (!$currency) {
            $currency = AccountCurrency::where('account_id', $restaurant_id)->first();
        }

        $item = item::with(['components', 'components.prices' => function ($query) use ($currency) {
            return $query->where('acc_currency_id', $currency->id);

        }])->where('id', $item_id)
            ->where('item_status_id', 1)
            ->where('restaurant_id', $restaurant_id)
            ->first();

        if ($item) {
            return ItemDetailsResource::collection($item->components);
        }
        return response()->json([
            'result' => false,
            'message' => 'no item found for the specified id'
        ]);
    }
}
