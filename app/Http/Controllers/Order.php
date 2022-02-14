<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\cart_item_component_model;
use App\Models\cart_model;
use App\Models\Customer;
use App\Models\Customer_Coupon_model;
use App\Models\Order_item_component;
use App\Models\Order_items_model;
use App\Models\Order_model;
use App\Models\Order_steps_model;
use App\Models\payment_log;
use App\Notifications\FirebaseNotification;
use App\Services\NotificationService;
use App\Services\OrderOnlinePayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use URL;

class Order extends Controller
{
    //
    function order_details($order_id)
    {

        $order_customer = DB::table('orders')
            ->join('customer_address as ad', 'ad.id', 'orders.customer_address_id')
            ->join('customers', 'customers.id', 'orders.customer_id')
//            ->join('area as a', 'a.id', 'ad.area_id')
//            ->join('city as c', 'c.id', 'a.city_id')
            ->where('orders.id', $order_id)
            ->where('orders.restaurant_id', Auth::id())
            ->select(DB::raw("ad.address AS address"), 'orders.id', 'customers.username', 'customers.phone_number', 'orders.note', 'orders.total_cost_after as total_value')->first();
//        dd(DB::getQueryLog());
        //dd($order_customer);
//        DB::enableQueryLog();
        $order_items = DB::table('orders')
            ->join('order_items', 'order_items.order_id', 'orders.id')
            ->join('item', 'item.id', 'order_items.item_id')
            ->where('orders.id', $order_id)
            ->select('order_items.id', 'item.id as item_id', 'item.item_name_en', 'order_items.item_count')->get();
//        dd(DB::getQueryLog());
        foreach ($order_items as $item) {
//            dd($item->id);
            $item_component = DB::table('component')
                ->join('order_items_component', 'order_items_component.component_id', 'component.id')
                ->where('order_items_component.order_item_id', $item->id)
                ->select('component.id', 'component.component_name_en')->get();
//            dd($item_component);
            $item->item_component = $item_component;
        }
//        dd($order_items);
//        ->join('order_items_component','order_items_component.order_item_id','order_items.id')
//        ->join('component','component.id','order_items_component.component_id')
//    dd($order);

        $data = array();
        array_push($data, ['order_customer' => $order_customer, 'order_items' => $order_items]);
        return ($data);

//        return view('layout/order/order-details', ['order_customer' => $order_customer, 'order_items' => $order_items]);
//
    }

    function show_orders()
    {
        $acct_type_id = Session::get('account_type_id');
        if ($acct_type_id != 1)
            $qu = 'select o.id, s.username as customer, d.account_name as restaurant,o.order_stop_log_id ,o.created_at ,o.total_cost_after,o.note,ad.address, lo.step_id,st.step_name_en,p.pay_type_name,lo.step_id
        from orders o
            join customers s on o.customer_id=s.id
            join  account d on o.restaurant_id=d.id
            join customer_address ad on o.customer_address_id =ad.id

            join  order_steps_log lo on lo.id=o.order_stop_log_id
            join order_steps st on st.id=lo.step_id
            join payment_type p on p.id= o.payment_type_id
            where lo.step_id not in (3,6)
            and  o.restaurant_id =' . Auth::id();
        else
            $qu = 'select o.id, s.username as customer, d.account_name as restaurant,o.order_stop_log_id ,o.created_at ,o.total_cost_after,o.note,ad.address, lo.step_id,st.step_name_en,p.pay_type_name,lo.step_id
        from orders o
            join customers s on o.customer_id=s.id
            join  account d on o.restaurant_id=d.id
            join customer_address ad on o.customer_address_id =ad.id

            join  order_steps_log lo on lo.id=o.order_stop_log_id
            join order_steps st on st.id=lo.step_id
            join payment_type p on p.id= o.payment_type_id
            where lo.step_id not in (3,6)';
//        dd($qu);
        $results = DB::select($qu);

//dd($results);
        return view('layout/order/show-orders', ['orders' => $results, 'acct_type_id' => $acct_type_id]);

    }

    function show_rejected_orders()
    {
        $acct_type_id = Session::get('account_type_id');
        if ($acct_type_id != 1)
            $qu = 'select o.id, s.username as customer, d.account_name as restaurant,o.order_stop_log_id ,o.created_at ,o.total_cost_before,o.note,ad.address, lo.step_id,lo.restaurant_note,st.step_name_en,p.pay_type_name,lo.step_id
        from orders o
            join customers s on o.customer_id=s.id
            join  account d on o.restaurant_id=d.id
            join customer_address ad on o.customer_address_id =ad.id
            join  order_steps_log lo on lo.id=o.order_stop_log_id
            join order_steps st on st.id=lo.step_id
            join payment_type p on p.id= o.payment_type_id
            where lo.step_id =3
            and  o.restaurant_id =' . Auth::id();
        else
            $qu = 'select o.id, s.username as customer, d.account_name as restaurant,o.order_stop_log_id ,o.created_at ,o.total_cost_before,o.note,ad.address, lo.step_id,lo.restaurant_note,st.step_name_en,p.pay_type_name,lo.step_id
        from orders o
            join customers s on o.customer_id=s.id
            join  account d on o.restaurant_id=d.id
            join customer_address ad on o.customer_address_id =ad.id
            join  order_steps_log lo on lo.id=o.order_stop_log_id
            join order_steps st on st.id=lo.step_id
            join payment_type p on p.id= o.payment_type_id
            where lo.step_id =3';

        $results = DB::select($qu);


        return view('layout/order/show-rejected-orders', ['orders' => $results, 'acct_type_id' => $acct_type_id = $acct_type_id]);
    }

    function show_not_finished_orders()
    {
        $acct_type_id = Session::get('account_type_id');
        if ($acct_type_id != 1)
            $qu = 'select o.id, s.username as customer, d.account_name as restaurant,o.order_stop_log_id ,o.created_at ,o.total_cost_before,o.note,ad.address, lo.step_id,lo.restaurant_note,st.step_name_en,p.pay_type_name,lo.step_id
        from orders o
            join customers s on o.customer_id=s.id
            join  account d on o.restaurant_id=d.id
            join customer_address ad on o.customer_address_id =ad.id
            join  order_steps_log lo on lo.id=o.order_stop_log_id
            join order_steps st on st.id=lo.step_id
            join payment_type p on p.id= o.payment_type_id
            where lo.step_id =6
            and  o.restaurant_id =' . Auth::id();
        else
            $qu = 'select o.id, s.username as customer, d.account_name as restaurant,o.order_stop_log_id ,o.created_at ,o.total_cost_before,o.note,ad.address, lo.step_id,lo.restaurant_note,st.step_name_en,p.pay_type_name,lo.step_id
        from orders o
            join customers s on o.customer_id=s.id
            join  account d on o.restaurant_id=d.id
            join customer_address ad on o.customer_address_id =ad.id
            join  order_steps_log lo on lo.id=o.order_stop_log_id
            join order_steps st on st.id=lo.step_id
            join payment_type p on p.id= o.payment_type_id
            where lo.step_id =6';

        $results = DB::select($qu);

//dd($results);
        return view('layout/order/show-rejected-orders', ['orders' => $results, 'acct_type_id' => $acct_type_id = $acct_type_id]);
    }

    function create_order(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'token' => 'required|String',
//                'cart_id' => 'required|numeric|gt:0',
                'language_id' => 'required|numeric',
                'currency_id' => 'required|numeric',
                'total_cost_before' => 'required|numeric',
                'tax_id' => 'required|numeric',
                'total_cost_after' => 'required|numeric',
                'user_address_id' => 'required|numeric',
                'has_coupon' => 'required|numeric',
                'coupon_code' => 'nullable|string',
                'note' => 'nullable|string|min:3',
                'payment_type' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('user_id');
                $token = $request->input('token');
//                $cart_id = $request->input('cart_id');
                $language_id = $request->input('language_id');
                $currency_id = $request->input('currency_id');
                $total_cost_before = $request->input('total_cost_before');
                $tax_id = $request->input('tax_id');
                $total_cost_after = $request->input('total_cost_after');
                $source_address_id = $request->input('user_address_id');
                $payment_type = $request->input('payment_type');
                $has_coupon = $request->input('has_coupon');
                $note = null;
                if ($request->input('note') != null) {
                    $note = $request->input('note');
                }
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {
                    $cart_exist = cart_model::where('status_id', 2)->where('customer_id', $customer->id)->first();

                    if ($cart_exist != null) {
                        $cart_id = $cart_exist->id;
                        $cart_items = DB::table('cart_items')
                            ->join('item', 'item.id', 'cart_items.item_id')
                            ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                            ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                            ->where('cart_items.cart_id', $cart_id)
                            ->where('item.item_status_id', 1)
                            ->where('account_currency.currency_id', $currency_id)
                            ->select('cart_items.id', 'cart_items.cart_id', 'cart_items.offer_id', 'cart_items.item_id', 'cart_items.item_count', 'item.restaurant_id', 'item_price_currency.price')
                            ->get();
//dd($cart_items);
                        $item_cart_ids = array();
                        $restaurant_id = 0;
                        if ($cart_exist != null && count($cart_items) > 0) {
                            foreach ($cart_items as $item) {
                                array_push($item_cart_ids, $item->id);
                                $restaurant_id = $item->restaurant_id;
                            }
//                            $cart_item_component = cart_item_component_model::whereIn('cart_item_id', $item_cart_ids)->get();
//                    dd($cart_item_component);
//                            if (count($cart_item_component) > 0) {
                            if ($request->input('has_coupon') == 1) {

                                $coupon_class = new Coupon();
                                $res = $coupon_class->validate_coupon($request);

//                                $request['restaurant_id']=$restaurant_id;
//                                $res = $coupon_class->validate_coupon_website($request);

                                if ($res ['status'] == true) {

//
                                    $customer_add = DB::table('customer_address')->where('customer_id', $customer->id)->where('address_main_id', $source_address_id)->first();
//
                                    if ($customer_add != null) {
                                        $order_model = new Order_model();
                                        $order_model->customer_id = $customer->id;
                                        $order_model->restaurant_id = $restaurant_id;
                                        $order_model->tax_id = $tax_id;
                                        $order_model->cart_id = $cart_id;
                                        $order_model->total_cost_before = $total_cost_before;
                                        $order_model->total_cost_after = $total_cost_after;
                                        $order_model->customer_address_id = $customer_add->id;
                                        $order_model->payment_type_id = $payment_type;
                                        $order_model->has_coupon = $has_coupon;
                                        $order_model->currency_id = $currency_id;
                                        if ($note != null) {
                                            $order_model->note = $note;
                                        }

                                        $order_model->save();

                                        $order_id = $order_model->id;
//                                    DB::table('cart')->where('id', $cart_id)->update(['status_id', 1]);
                                        DB::table('cart')
                                            ->where('id', $cart_id)
                                            ->update(['status_id' => 1]);
                                        $order_steps_model = new Order_steps_model();
                                        $order_steps_model->order_id = $order_id;
                                        $order_steps_model->step_id = 1;
                                        $order_steps_model->created_by = $customer->id;
                                        $order_steps_model->save();

                                        $order_steps_id = $order_steps_model->id;

                                        $order_model = new Order_model();
                                        $order_model->exists = true;
                                        $order_model->id = $order_id;
                                        $order_model->order_stop_log_id = $order_steps_id;
                                        $order_model->save();

                                        $Customer_Coupon_model = new Customer_Coupon_model();
                                        $Customer_Coupon_model->order_id = $order_id;
                                        $Customer_Coupon_model->customer_id = $customer->id;
                                        $Customer_Coupon_model->coupon_id = $res['ret_data'][0]['coupon_id'];
                                        $Customer_Coupon_model->save();

                                        $payment_typ_model = new payment_log();
                                        $payment_typ_model->order_id = $order_id;
                                        $payment_typ_model->payment_amount = $total_cost_after;
                                        $payment_typ_model->save();

                                        foreach ($cart_items as $value) {
                                            $Order_items_model = new Order_items_model();
                                            if ($value->offer_id != null) {
                                                $offer = DB::table('offer')
                                                    ->join('offer_price_currency', 'offer_price_currency.offer_id', 'offer.id')
                                                    ->join('account_currency', 'account_currency.id', 'offer_price_currency.acc_currency_id')
                                                    ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                                    ->where('offer_id', $value->offer_id)
                                                    ->where('offer.approve','=',1)
                                                    ->where('account_currency.currency_id', $currency_id)
                                                    ->select('offer_price_currency.price')->first();
                                                $value->price = $offer->price;
                                                $Order_items_model->offer_id = $value->offer_id;
                                            }
                                            $Order_items_model->order_id = $order_id;
                                            $Order_items_model->item_id = $value->item_id;
                                            $Order_items_model->item_count = $value->item_count;
                                            $Order_items_model->item_price = $value->price;
                                            $Order_items_model->created_by = $customer->id;
                                            $Order_items_model->save();
                                            $order_item_id = $Order_items_model->id;
//                                                $arr = $cart_item_component;
                                            $cart_item_component = cart_item_component_model::where('cart_item_id', $value->id)->get();
                                            if ($cart_item_component != null && count($cart_item_component) > 0) {
                                                foreach ($cart_item_component as $com_cart) {
                                                    $Order_items_component_model = new Order_item_component();
                                                    $Order_items_component_model->order_item_id = $order_item_id;
                                                    $Order_items_component_model->component_id = $com_cart['component_id'];
                                                    $Order_items_component_model->created_by = $customer->id;
                                                    $Order_items_component_model->save();
                                                }
                                            }


                                        }

                                        NotificationService::NotifyRestaurant('order', $customer->id, $restaurant_id, 'New Order', 'New order has been made.', 'New order has been made.');
                                        if ($language_id == 1)
                                            $order_status = DB::table('orders')
                                                ->join('order_steps_log', 'order_steps_log.order_id', 'orders.id')
                                                ->join('order_steps', 'order_steps.id', 'order_steps_log.step_id')
                                                ->where('orders.id', $order_id)->select('order_steps.step_name_en as step_name')->first();
                                        else
                                            $order_status = DB::table('orders')
                                                ->join('order_steps_log', 'order_steps_log.order_id', 'orders.id')
                                                ->join('order_steps', 'order_steps.id', 'order_steps_log.step_id')
                                                ->where('orders.id', $order_id)->select('order_steps.step_name_ar as step_name')->first();
                                        if ($language_id == 1)
                                            $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_en as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,count(favorites.place_id) as favorites_count';
                                        else
                                            $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_ar as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,count(favorites.place_id) as favorites_count';

                                        $from = '     from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join work_status st on st.id=ac.work_status_id
                                    left join favorites on favorites.place_id= ac.id
                                  ';
                                        $where = ' where ac.status_id=1 and ac.account_type_id=2 and  ac.id=' . $restaurant_id;
                                        $query = $select . ' ' . $from . ' ' . $where;
                                        $res = DB::select($query);
//                            dd($res);
                                        if ($language_id == 1)
                                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("restaurant_sub_category.id,sub_category.sub_category_name,restaurant_sub_category.image_path")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $res[0]->restaurant_id)->get();
                                        else
                                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("restaurant_sub_category.id,sub_category.sub_category_name_ar as sub_category_name ,restaurant_sub_category.image_path")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $res[0]->restaurant_id)->get();

                                        $res[0]->menus = $menu_names->implode('sub_category_name', ', ');

                                        $restaurant_curr = DB::table('account as ac')->join('account_currency  as ac_cu', 'ac_cu.account_id', 'ac.id')->where('ac.id', $res[0]->restaurant_id)->where('ac_cu.currency_id', $currency_id)->where('ac.status_id', 1)->get('ac_cu.*');

                                        $minprice = DB::table('item_price_currency')->select('*')->where('created_by', '=', $res[0]->restaurant_id)->where('acc_currency_id', $restaurant_curr[0]->id)->min('price');

                                        $maxprice = DB::table('item_price_currency')->select('*')->where('created_by', '=', $res[0]->restaurant_id)->where('acc_currency_id', $restaurant_curr[0]->id)->max('price');

                                        $res[0]->minPrice = $minprice;
                                        $res[0]->maxPrice = $maxprice;

                                        if ($res[0]->logo_path != null)
                                            $res[0]->logo_path = URL::to('/') . '/restaurants/logo/' . $res[0]->restaurant_id . '/' . $res[0]->logo_path;
//                            dd($res);
                                        $rowCount = DB::table('evaluation')->where('restaurant_id', '=', $res[0]->restaurant_id)
                                            ->count();
//
                                        $total_eval = DB::table('evaluation')
                                            ->where('restaurant_id', $res[0]->restaurant_id)
                                            ->sum(\DB::raw('IFNULL(taste_value,0) + IFNULL(clean_value,0)  + IFNULL(delivery_value,0) '));

                                        if ($total_eval > 0) {
                                            $res[0]->evaluation = ceil($total_eval / ($rowCount * 3));
                                        } else {
                                            $res[0]->evaluation = 3;
                                        }
                                        $ret_data = array();
                                        $res = $res[0];
                                        $ret_data = array('order_id'=>$order_id,'order_status' => $order_status->step_name, 'total_value' => $total_cost_after, 'restaurant_info' => $res);

                                        $response['msg'] = 'successfully';
                                        $response['status'] = true;
                                        $response['ret_data'] = $ret_data;
                                        return $response;
                                    } else {
                                        $response['msg'] = 'error in customer address';
                                        $response['status'] = false;
                                        return $response;
                                    }

                                } else {
                                    return $res;
                                }


                            } else {

                                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
//dd($customer);
                                if ($customer != null) {
                                    $customer_add = DB::table('customer_address')->where('customer_id', $customer->id)->where('address_main_id', $source_address_id)->first();
//dd($source_address_id);
                                    if ($customer_add != null) {

                                        $order_model = new Order_model();
                                        $order_model->customer_id = $customer->id;
                                        $order_model->tax_id = $tax_id;
                                        $order_model->cart_id = $cart_id;
                                        $order_model->restaurant_id = $restaurant_id;
                                        $order_model->total_cost_before = $total_cost_before;
                                        $order_model->total_cost_after = $total_cost_after;
                                        $order_model->customer_address_id = $customer_add->id;
                                        $order_model->payment_type_id = $payment_type;
                                        $order_model->has_coupon = $has_coupon;
                                        $order_model->currency_id = $currency_id;
                                        if ($note != null) {
                                            $order_model->note = $note;
                                        }
                                        $order_model->save();

                                        $order_id = $order_model->id;
                                        DB::table('cart')
                                            ->where('id', $cart_id)
                                            ->update(['status_id' => 1]);
                                        $order_steps_model = new Order_steps_model();
                                        $order_steps_model->order_id = $order_id;
                                        $order_steps_model->step_id = 1;
                                        $order_steps_model->created_by = $customer->id;
                                        $order_steps_model->save();

                                        $order_steps_id = $order_steps_model->id;

                                        $order_model = new Order_model();
                                        $order_model->exists = true;
                                        $order_model->id = $order_id;
                                        $order_model->order_stop_log_id = $order_steps_id;
                                        $order_model->save();

                                        $payment_typ_model = new payment_log();
                                        $payment_typ_model->order_id = $order_id;
                                        $payment_typ_model->payment_amount = $total_cost_after;
                                        $payment_typ_model->save();


                                        //   dd($items[$j]);
                                        foreach ($cart_items as $value) {
//                                            dd($value->offer_id);
                                            $Order_items_model = new Order_items_model();
                                            if ($value->offer_id != null) {
                                                $offer = DB::table('offer')
                                                    ->join('offer_price_currency', 'offer_price_currency.offer_id', 'offer.id')
                                                    ->join('account_currency', 'account_currency.id', 'offer_price_currency.acc_currency_id')
                                                    ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                                    ->where('offer_id', $value->offer_id)
                                                    ->where('account_currency.currency_id', $currency_id)
                                                    ->select('offer_price_currency.price')->first();
                                                $value->price = $offer->price;
                                                $Order_items_model->offer_id = $value->offer_id;
                                            }
                                            $Order_items_model->order_id = $order_id;

                                            $Order_items_model->item_id = $value->item_id;
                                            $Order_items_model->item_count = $value->item_count;
                                            $Order_items_model->item_price = $value->price;
                                            $Order_items_model->created_by = $customer->id;
                                            $Order_items_model->save();
                                            $order_item_id = $Order_items_model->id;
//                                            $arr = $cart_item_component;

                                            $cart_item_component = cart_item_component_model::where('cart_item_id', $value->id)->get();
                                            if ($cart_item_component != null && count($cart_item_component) > 0) {
                                                foreach ($cart_item_component as $com_cart) {
                                                    $Order_items_component_model = new Order_item_component();
                                                    $Order_items_component_model->order_item_id = $order_item_id;
                                                    $Order_items_component_model->component_id = $com_cart['component_id'];
                                                    $Order_items_component_model->created_by = $customer->id;
                                                    $Order_items_component_model->save();
                                                }
                                            }

                                        }

                                        NotificationService::NotifyRestaurant('order', $customer->id, $restaurant_id, 'New Order', 'New order has been made.', 'New order has been made.');
                                        if ($language_id == 1)
                                            $order_status = DB::table('orders')
                                                ->join('order_steps_log', 'order_steps_log.order_id', 'orders.id')
                                                ->join('order_steps', 'order_steps.id', 'order_steps_log.step_id')
                                                ->where('orders.id', $order_id)->select('order_steps.step_name_en as step_name')->first();
                                        else
                                            $order_status = DB::table('orders')
                                                ->join('order_steps_log', 'order_steps_log.order_id', 'orders.id')
                                                ->join('order_steps', 'order_steps.id', 'order_steps_log.step_id')
                                                ->where('orders.id', $order_id)->select('order_steps.step_name_ar as step_name')->first();
                                        if ($language_id == 1)
                                            $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_en as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,count(favorites.place_id) as favorites_count';
                                        else
                                            $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_ar as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,count(favorites.place_id) as favorites_count';

                                        $from = '     from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join work_status st on st.id=ac.work_status_id
                                    left join favorites on favorites.place_id= ac.id
                                  ';
                                        $where = ' where ac.status_id=1 and ac.account_type_id=2 and  ac.id=' . $restaurant_id;
                                        $query = $select . ' ' . $from . ' ' . $where;
                                        $res = DB::select($query);
//                            dd($res);
                                        if ($language_id == 1)
                                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("restaurant_sub_category.id,sub_category.sub_category_name,restaurant_sub_category.image_path")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $res[0]->restaurant_id)->get();
                                        else
                                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("restaurant_sub_category.id,sub_category.sub_category_name_ar as sub_category_name ,restaurant_sub_category.image_path")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $res[0]->restaurant_id)->get();

                                        $res[0]->menus = $menu_names->implode('sub_category_name', ', ');

                                        $restaurant_curr = DB::table('account as ac')->join('account_currency  as ac_cu', 'ac_cu.account_id', 'ac.id')->where('ac.id', $res[0]->restaurant_id)->where('ac_cu.currency_id', $currency_id)->where('ac.status_id', 1)->get('ac_cu.*');

                                        $minprice = DB::table('item_price_currency')->select('*')->where('created_by', '=', $res[0]->restaurant_id)->where('acc_currency_id', $restaurant_curr[0]->id)->min('price');

                                        $maxprice = DB::table('item_price_currency')->select('*')->where('created_by', '=', $res[0]->restaurant_id)->where('acc_currency_id', $restaurant_curr[0]->id)->max('price');

                                        $res[0]->minPrice = $minprice;
                                        $res[0]->maxPrice = $maxprice;

                                        if ($res[0]->logo_path != null)
                                            $res[0]->logo_path = URL::to('/') . '/restaurants/logo/' . $res[0]->restaurant_id . '/' . $res[0]->logo_path;
//                            dd($res);
                                        $rowCount = DB::table('evaluation')->where('restaurant_id', '=', $res[0]->restaurant_id)
                                            ->count();
//
                                        $total_eval = DB::table('evaluation')
                                            ->where('restaurant_id', $res[0]->restaurant_id)
                                            ->sum(\DB::raw('IFNULL(taste_value,0) + IFNULL(clean_value,0)  + IFNULL(delivery_value,0) '));

                                        if ($total_eval > 0) {
                                            $res[0]->evaluation = ceil($total_eval / ($rowCount * 3));
                                        } else {
                                            $res[0]->evaluation = 3;
                                        }
                                        $ret_data = array();
                                        $res = $res[0];
                                        $ret_data = array('order_id'=>$order_id,'order_status' => $order_status->step_name, 'total_value' => $total_cost_after, 'restaurant_info' => $res);

                                        $response['msg'] = 'successfully';
                                        $response['status'] = true;
                                        $response['ret_data'] = $ret_data;
                                        return $response;
                                    } else {
                                        $response['msg'] = 'error in customer address';
                                        $response['status'] = false;
                                        return $response;
                                    }

                                } else {
                                    $response['msg'] = 'Your account is inactive';
                                    $response['status'] = false;
                                    return $response;
                                }
                            }
//                        $response['msg'] = 'error';
//                        $response['status'] = false;
//                        return $response;
//                            } else {
//                                $response['msg'] = 'error in cart Meals';
//                                $response['status'] = false;
//                                $response['ret_dat'] = array('cart_id' => $cart_id);
//                                return $response;
//                            }

                        } else {
                            $response['msg'] = 'There are no meals in the cart';
                            $response['status'] = false;
                            $response['ret_dat'] = array('cart_id' => $cart_id);
                            return $response;
                        }

                    } else {

                        $response['msg'] = 'cart is empty';
                        $response['status'] = false;
//                    $response['ret_dat'] = array('cart_id' => $cart_id);
                        return $response;
                    }
                } else {
                    $response['msg'] = 'Your account is inactive';
                    $response['status'] = false;
                    return $response;
                }


            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;

    }

    function pass_order(Request $request)
    {
        $response = default_ret_array();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'step_id' => 'required|numeric',
                'order_id' => 'required|numeric',
                'flag' => 'required|numeric',
                'ord_step_id' => 'required|numeric',
                'restaurant_note' => 'nullable|string',
//                'customer_note' =>'nullable|string',
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $step_id = $request->input('step_id');
                $order_id = $request->input('order_id');
                $flag = $request->input('flag');
                $ord_step_id = $request->input('ord_step_id');
                $restaurant_note = $request->input('restaurant_note');
//                $customer_note= $request->input('customer_note');

                if ($step_id == 1 && $flag == 1) {
                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->exists = true;
                    if ($restaurant_note != null)
                        $order_steps_model->restaurant_note = $restaurant_note;
                    $order_steps_model->id = $ord_step_id;
                    $order_steps_model->done_at = Carbon::now()->toDateTimeString();
                    $order_steps_model->done_by = Auth::id();
                    $order_steps_model->save();

                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->order_id = $order_id;
                    $order_steps_model->step_id = 2;
                    $order_steps_model->created_by = Auth::id();
                    $order_steps_model->save();

                    $order_steps_id = $order_steps_model->id;


                    $order_model = new Order_model();
                    $order_model->exists = true;
                    $order_model->id = $order_id;
                    $order_model->order_stop_log_id = $order_steps_id;
                    $order_model->save();

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    return $response;
                    /* push notification*/
                } else if ($step_id == 1 && $flag == 0) {
                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->exists = true;
                    $order_steps_model->id = $ord_step_id;
                    if ($restaurant_note != null)
                        $order_steps_model->restaurant_note = $restaurant_note;
                    $order_steps_model->done_at = Carbon::now()->toDateTimeString();
                    $order_steps_model->done_by = Auth::id();
                    $order_steps_model->save();


                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->order_id = $order_id;
                    $order_steps_model->step_id = 3;
                    $order_steps_model->created_by = Auth::id();
                    $order_steps_model->save();

                    $order_steps_id = $order_steps_model->id;


                    $order_model = new Order_model();
                    $order_model->exists = true;
                    $order_model->id = $order_id;
                    $order_model->order_stop_log_id = $order_steps_id;
                    $order_model->done = 0;
                    $order_model->done_date = Carbon::now()->toDateTimeString();;
                    $order_model->save();

                    $customer_coupon = DB::table('customer_coupon')
                        ->where('order_id', $order_id)
                        ->where('customer_id')->first();
                    if ($customer_coupon != null) {
                        DB::table('customer_coupon')
                            ->where('id', $customer_coupon->id)
                            ->where('order_id', $order_id)
                            ->where('customer_id')->delete();
                    }
                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    return $response;
                    /* push notification*/

                } else if ($step_id == 2 && $flag == 1) {
                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->exists = true;
                    $order_steps_model->id = $ord_step_id;
                    if ($restaurant_note != null)
                        $order_steps_model->restaurant_note = $restaurant_note;
                    $order_steps_model->done_at = Carbon::now()->toDateTimeString();
                    $order_steps_model->done_by = Auth::id();
                    $order_steps_model->save();


                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->order_id = $order_id;
                    $order_steps_model->step_id = 4;
                    $order_steps_model->created_by = Auth::id();
                    $order_steps_model->save();

                    $order_steps_id = $order_steps_model->id;


                    $order_model = new Order_model();
                    $order_model->exists = true;
                    $order_model->id = $order_id;
                    $order_model->order_stop_log_id = $order_steps_id;
                    $order_model->save();

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    return $response;
                    /* push notification*/
                } else if ($step_id == 2 && $flag == 0) {
                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->exists = true;
                    $order_steps_model->id = $ord_step_id;
                    if ($restaurant_note != null)
                        $order_steps_model->restaurant_note = $restaurant_note;
                    $order_steps_model->done_at = Carbon::now()->toDateTimeString();
                    $order_steps_model->done_by = Auth::id();
                    $order_steps_model->save();


                    $order_steps_model = new Order_steps_model();

                    $order_steps_model->order_id = $order_id;
                    $order_steps_model->step_id = 3;
                    $order_steps_model->created_by = Auth::id();
                    $order_steps_model->save();

                    $order_steps_id = $order_steps_model->id;


                    $order_model = new Order_model();
                    $order_model->exists = true;
                    $order_model->id = $order_id;
                    $order_model->order_stop_log_id = $order_steps_id;
                    $order_model->done = 0;
                    $order_model->done_date = Carbon::now()->toDateTimeString();;
                    $order_model->save();

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    return $response;
                    /* push notification*/

                } else if ($step_id == 4 && $flag == 1) {
                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->exists = true;
                    $order_steps_model->id = $ord_step_id;
                    if ($restaurant_note != null)
                        $order_steps_model->restaurant_note = $restaurant_note;
                    $order_steps_model->done_at = Carbon::now()->toDateTimeString();
                    $order_steps_model->done_by = Auth::id();
                    $order_steps_model->save();


                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->order_id = $order_id;
                    $order_steps_model->step_id = 5;
                    $order_steps_model->created_by = Auth::id();
                    $order_steps_model->done_at = Carbon::now()->toDateTimeString();
                    $order_steps_model->done_by = Auth::id();
                    $order_steps_model->save();

                    $order_steps_id = $order_steps_model->id;


                    $order_model = new Order_model();
                    $order_model->exists = true;
                    $order_model->id = $order_id;
                    $order_model->order_stop_log_id = $order_steps_id;
                    $order_model->done = 1;
                    $order_model->done_date = Carbon::now()->toDateTimeString();;
                    $order_model->save();

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    return $response;
                    /* push notification*/
                } else if ($step_id == 4 && $flag == 0) {
                    $order_steps_model = new Order_steps_model();
                    $order_steps_model->exists = true;
                    $order_steps_model->id = $ord_step_id;
                    if ($restaurant_note != null)
                        $order_steps_model->restaurant_note = $restaurant_note;
                    $order_steps_model->done_at = Carbon::now()->toDateTimeString();
                    $order_steps_model->done_by = Auth::id();
                    $order_steps_model->save();


                    $order_steps_model = new Order_steps_model();

                    $order_steps_model->order_id = $order_id;
                    $order_steps_model->step_id = 6;
                    $order_steps_model->done_at = Carbon::now()->toDateTimeString();
                    $order_steps_model->done_by = Auth::id();
                    $order_steps_model->created_by = Auth::id();
                    $order_steps_model->save();

                    $order_steps_id = $order_steps_model->id;


                    $order_model = new Order_model();
                    $order_model->exists = true;
                    $order_model->id = $order_id;
                    $order_model->order_stop_log_id = $order_steps_id;
                    $order_model->done = 0;
                    $order_model->done_date = Carbon::now()->toDateTimeString();;
                    $order_model->save();

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    return $response;
                    /* push notification*/

                } else {

                }
            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;

    }

    function print_order(Request $request)
    {
//        dd($request->input());
        $order_id = $request->input('order_id');
        $customer_name = $request->input('customer_name');
        $create_date = $request->input('create_date');
        $location = $request->input('location');
        $cost = $request->input('cost');
        $rest_note = $request->input('rest_note');
        $customer_note = $request->input('customer_note');


        $q = 'select t. item_name_en,it.item_count ,it.* from order_items it
              join item t on t.id=it.item_id
              where order_id =' . $order_id;
        $results = DB::select($q);
        $array = array();
//dd($results);

        foreach ($results as $item) {

            $q = 'select com.component_name_en from order_items_component  it_com
                  join component com on com.id=it_com.component_id
                  where order_item_id =' . $item->id;
            $compo = DB::select($q);
            $item->component = $compo;
//            $array = array_add($array, $item->item_name_en, $compo);

        }
//dd($results);
        return view('layout/order/order-print-page', ['items' => $results, 'order_id' => $order_id, 'customer_name' => $customer_name, 'create_date' => $create_date, 'location' => $location, 'cost' => $cost, 'rest_note' => $rest_note, 'customer_note' => $customer_note]);
    }

    function get_orders_count(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'source_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('source_id');

                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
                if ($customer != null) {

                    $q = 'select count(*) as orders_count
                             from   account as res
                             join orders as ord on ord.restaurant_id=res.id
                            join customer_address as addr on addr.id=ord.customer_address_id
                            LEFT JOIN customer_coupon as cu_cop on cu_cop.order_id=ord.id
                            LEFT JOIN  coupon as co on co.id=cu_cop.coupon_id
                            join payment_type as pay on pay.id=ord.payment_type_id
                            join order_steps_log as ord_log on ord_log.id=ord.order_stop_log_id
                            join order_steps as ord_st on ord_st.id=ord_log.step_id
                       where ord.customer_id =' . $source_id . ' and ord.done is null';
//                   dd($q);
                    $all_details = DB::select($q);
//                    dd($all_details[0]->orders_count);
                    if ($all_details != null && $all_details[0]->orders_count > 0) {
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $all_details;
                        return $response;
                    } else {
                        $response['msg'] = 'you don\'t have new orders';
                        $response['status'] = false;
                        return $response;
                    }


                } else {
                    $response['msg'] = 'Your account is inactive';
                    $response['status'] = false;
                    return $response;
                }
            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_orders(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
//                'currency_id'=>'required|numeric',
                'token' => 'required|String',
                'language_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('user_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $token = $request->input('token');
                $language_id = $request->input('language_id');
//                $currency_id = $request->input('currency_id');
//                DB::enableQueryLog();
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')

//                     dd(DB::getQueryLog());
//                dd($customer);
                if ($customer != null) {
                    if ($limit == null) {
                        $limit = 5;
                    }
                    if ($offset == null) {
                        $offset = 0;
                    }
                    $total_row = 'select res.id,res.account_name as restaurant_name,res.logo_path,ord.id as order_id,ord.created_at as order_create_date,ord.total_cost_after,ord.total_cost_after,ord_st.step_name_en as step_name,ord_log.created_at as step_create_date
                             from   account as res
                             join orders as ord on ord.restaurant_id=res.id
                             join order_steps_log as ord_log on ord_log.id=ord.order_stop_log_id
                             join order_steps as ord_st on ord_st.id=ord_log.step_id
                       where ord.customer_id =' . $customer->id;
                    $total_row_count = count(DB::select($total_row));
                    if ($total_row_count > 0) {
                        if ($language_id == 1)
                            $q = 'select res.id,res.account_name as restaurant_name,res.logo_path,ord.id as order_id,ord.created_at as order_create_date,ord.total_cost_after,ord.total_cost_after,ord_st.step_name_en as step_name,ord_log.created_at as step_create_date
                             from   account as res
                             join orders as ord on ord.restaurant_id=res.id
                             join order_steps_log as ord_log on ord_log.id=ord.order_stop_log_id
                             join order_steps as ord_st on ord_st.id=ord_log.step_id
                       where ord.customer_id =' . $customer->id . ' LIMIT ' . $offset . ', ' . $limit;
                        else
                            $q = 'select res.id, res.account_name as restaurant_name,res.logo_path,ord.id as order_id,ord.created_at as order_create_date,ord.total_cost_after,ord_st.step_name_ar as step_name,ord_log.created_at as step_create_date
                             from   account as res
                             join orders as ord on ord.restaurant_id=res.id
                             join order_steps_log as ord_log on ord_log.id=ord.order_stop_log_id
                             join order_steps as ord_st on ord_st.id=ord_log.step_id
                       where ord.customer_id =' . $customer->id . ' LIMIT ' . $offset . ', ' . $limit;

                        $all_details = DB::select($q);
                        if ($all_details != null) {
                            foreach ($all_details as $acc) {
                                if ($acc->logo_path != null)
                                    $acc->logo_path = URL::to('/') . '/restaurants/logo/' . $acc->id . '/' . $acc->logo_path;

                            }

                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $all_details;
                            $response['total_ordrs'] = $total_row_count;
                            $response['total_page'] = ceil($total_row_count / $limit);
                            return $response;
                        } else {
                            $response['msg'] = 'you don\'t have orders';
                            $response['status'] = false;
                            return $response;
                        }

                    } else {
                        $response['msg'] = 'you don\'t have orders';
                        $response['status'] = false;
                        return $response;
                    }


                } else {
                    $response['msg'] = 'Your account is inactive';
                    $response['status'] = false;
                    return $response;
                }
            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_all_orders_count(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'source_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('source_id');

                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
                if ($customer != null) {

                    $q = 'select count(*) as orders_count
                             from   account as res
                             join orders as ord on ord.restaurant_id=res.id
                            join customer_address as addr on addr.id=ord.customer_address_id
                            LEFT JOIN customer_coupon as cu_cop on cu_cop.order_id=ord.id
                            LEFT JOIN  coupon as co on co.id=cu_cop.coupon_id
                            join payment_type as pay on pay.id=ord.payment_type_id
                            join order_steps_log as ord_log on ord_log.id=ord.order_stop_log_id
                            join order_steps as ord_st on ord_st.id=ord_log.step_id
                       where ord.customer_id =' . $source_id;
//                   dd($q);
                    $all_details = DB::select($q);
//                    dd($all_details[0]->orders_count);
                    if ($all_details != null && $all_details[0]->orders_count > 0) {
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $all_details;
                        return $response;
                    } else {
                        $response['msg'] = 'you don\'t have orders';
                        $response['status'] = false;
                        return $response;
                    }


                } else {
                    $response['msg'] = 'Your account is inactive';
                    $response['status'] = false;
                    return $response;
                }
            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_all_orders(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'source_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('source_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {
                    if ($limit == null) {
                        $limit = 5;
                    }
                    if ($offset == null) {
                        $offset = 0;
                    }
                    $q = 'select res.account_name as restaurant_name,ord.id as order_id,ord.created_at as order_create_date,ord.total_cost_before,ord.has_coupon,co.coupon_code,ord.total_cost_after,addr.latitude,addr.longitude,addr.building_num,pay.pay_type_name,ord_st.step_name_en,ord_st.step_name_ar,ord_log.created_at as step_create_date
                             from   account as res
                             join orders as ord on ord.restaurant_id=res.id
                            join customer_address as addr on addr.id=ord.customer_address_id
                            LEFT JOIN customer_coupon as cu_cop on cu_cop.order_id=ord.id
                            LEFT JOIN  coupon as co on co.id=cu_cop.coupon_id
                            join payment_type as pay on pay.id=ord.payment_type_id
                            join order_steps_log as ord_log on ord_log.id=ord.order_stop_log_id
                            join order_steps as ord_st on ord_st.id=ord_log.step_id
                       where ord.customer_id =' . $source_id . ' LIMIT ' . $offset . ', ' . $limit;
                    $all_details = DB::select($q);
                    if (count($all_details) > 0) {
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $all_details;
                        return $response;
                    } else {
                        $response['msg'] = 'you don\'t have  orders';
                        $response['status'] = false;
                        return $response;
                    }


                } else {
                    $response['msg'] = 'Your account is inactive';
                    $response['status'] = false;
                    return $response;
                }
            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    public function verify_order(Request $request)
    {
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'token' => 'required',
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            }
            $token = $request->input('token');
            $order = Order_model::where('token', $token)->update(['payment_verfication' => '1', 'token' => null]);
            if ($order) {
                return response()->json(['success' => true, 'message' => ['Order has been completed']]);
            } else {
                return response()->json(['success' => false, 'message' => ['An error occurred']]);
            }
        }
    }


    function check_out(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'token' => 'required|String',
                'language_id' => 'required|numeric',
                'currency_id' => 'required|numeric',
                'total_cost_before' => 'required|numeric',
                'tax_id' => 'required|numeric',
                'total_cost_after' => 'required|numeric',
                'user_address_id' => 'required|numeric',
                'has_coupon' => 'required|numeric',
                'coupon_code' => 'nullable|string',
                'note' => 'nullable|string|min:3',
                'payment_type' => 'required|numeric',
                'items_content' => 'required',
                'restaurant_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('user_id');
                $token = $request->input('token');

                $language_id = $request->input('language_id');
                $currency_id = $request->input('currency_id');
                $total_cost_before = $request->input('total_cost_before');
                $tax_id = $request->input('tax_id');
                $total_cost_after = $request->input('total_cost_after');
                $source_address_id = $request->input('user_address_id');
                $payment_type = $request->input('payment_type');
                $has_coupon = $request->input('has_coupon');
                $items_content = $request->input('items_content');
                $restaurant_id = $request->input('restaurant_id');
                $note = null;
                if ($request->input('note') != null) {
                    $note = $request->input('note');
                }
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {

                    if ($items_content != null) {
                        $items_content = json_decode($items_content);
                        $customer_add = DB::table('customer_address')->where('customer_id', $customer->id)->where('address_main_id', $source_address_id)->first();
                        if ($customer_add != null) {
                            if ($request->input('has_coupon') == 1) {
                                $coupon_class = new Coupon();
                                $res = $coupon_class->validate_coupon_website($request);
                                if ($res ['status'] == true) {
                                    DB::beginTransaction();
                                    $order_model = new Order_model();
                                    $order_model->customer_id = $customer->id;
                                    $order_model->tax_id = $tax_id;
                                    $order_model->cart_id = 0;
                                    $order_model->restaurant_id = $restaurant_id;
                                    $order_model->total_cost_before = $total_cost_before;
                                    $order_model->total_cost_after = $total_cost_after;
                                    $order_model->customer_address_id = $customer_add->id;
                                    $order_model->payment_type_id = $payment_type;
                                    $order_model->has_coupon = $has_coupon;
                                    $order_model->currency_id = $currency_id;
                                    if ($note != null) {
                                        $order_model->note = $note;
                                    }
                                    $order_model->save();

                                    $order_id = $order_model->id;
                                    $Customer_Coupon_model = new Customer_Coupon_model();
                                    $Customer_Coupon_model->order_id = $order_id;
                                    $Customer_Coupon_model->customer_id = $customer->id;
                                    $Customer_Coupon_model->coupon_id = $res['ret_data'][0]['coupon_id'];
                                    $Customer_Coupon_model->save();
                                    $order_steps_model = new Order_steps_model();
                                    $order_steps_model->order_id = $order_id;
                                    $order_steps_model->step_id = 1;
                                    $order_steps_model->created_by = $customer->id;
                                    $order_steps_model->save();

                                    $order_steps_id = $order_steps_model->id;

                                    $order_model = new Order_model();
                                    $order_model->exists = true;
                                    $order_model->id = $order_id;
                                    $order_model->order_stop_log_id = $order_steps_id;
                                    $order_model->save();

                                    $payment_typ_model = new payment_log();
                                    $payment_typ_model->order_id = $order_id;
                                    $payment_typ_model->payment_amount = $total_cost_after;
                                    $payment_typ_model->save();


                                    foreach ($items_content as $value) {
                                        $component_arr = explode(',', $value->component);
//                                        if (!empty($value->component) && count($component_arr) > 0 && $component_arr[0] != "") {
                                        $Order_items_model = new Order_items_model();
                                        $Order_items_model->order_id = $order_id;
                                        $Order_items_model->item_id = $value->item_id;
                                        $Order_items_model->item_count = $value->count;
                                        $Order_items_model->created_by = $customer->id;
                                        if ($value->offer_id != null && !empty($value->offer_id)) {
                                            $offer = DB::table('offer')
                                                ->join('offer_price_currency', 'offer_price_currency.offer_id', 'offer.id')
                                                ->join('account_currency', 'account_currency.id', 'offer_price_currency.acc_currency_id')
                                                ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                                ->where('offer_id', $value->offer_id)
                                                ->where('account_currency.currency_id', $currency_id)
                                                ->select('offer_price_currency.price')->first();
                                            $value->price = $offer->price;
                                            $Order_items_model->offer_id = $value->offer_id;
                                        }
                                        $Order_items_model->item_price = $value->price;

                                        $Order_items_model->save();


                                        $order_item_id = $Order_items_model->id;
                                        if (!empty($value->component) && count($component_arr) > 0 && $component_arr[0] != "") {
                                            for ($i = 0; $i < count($component_arr); $i++) {
                                                $order_item_component = new Order_item_component();
                                                $order_item_component->order_item_id = $order_item_id;
                                                $order_item_component->component_id = $component_arr[$i];
                                                $order_item_component->save();
                                            }
                                        }

//                                        } else {
//                                            DB::rollBack();
//                                            $response['msg'] = 'please add components';
//                                            $response['status'] = false;
//                                            return $response;
//                                        }

                                    }

                                    NotificationService::NotifyRestaurant('order', $customer_add->id, $restaurant_id, 'New Order', 'New order has been made.', 'New order has been made.');
                                    DB::commit();
                                    $response['msg'] = 'successfully';
                                    $response['status'] = true;
                                    $response['ret_data'] = $order_id;
                                    return $response;

                                } else {
                                    return $res;
                                }
                            } else {
                                DB::beginTransaction();
                                $order_model = new Order_model();
                                $order_model->customer_id = $customer->id;
                                $order_model->tax_id = $tax_id;
                                $order_model->cart_id = 0;
                                $order_model->restaurant_id = $restaurant_id;
                                $order_model->total_cost_before = $total_cost_before;
                                $order_model->total_cost_after = $total_cost_after;
                                $order_model->customer_address_id = $customer_add->id;
                                $order_model->payment_type_id = $payment_type;
                                $order_model->has_coupon = $has_coupon;
                                $order_model->currency_id = $currency_id;
                                if ($note != null) {
                                    $order_model->note = $note;
                                }
                                $order_model->save();

                                $order_id = $order_model->id;
                                $order_steps_model = new Order_steps_model();
                                $order_steps_model->order_id = $order_id;
                                $order_steps_model->step_id = 1;
                                $order_steps_model->created_by = $customer->id;
                                $order_steps_model->save();

                                $order_steps_id = $order_steps_model->id;

                                $order_model = new Order_model();
                                $order_model->exists = true;
                                $order_model->id = $order_id;
                                $order_model->order_stop_log_id = $order_steps_id;
                                $order_model->save();

                                $payment_typ_model = new payment_log();
                                $payment_typ_model->order_id = $order_id;
                                $payment_typ_model->payment_amount = $total_cost_after;
                                $payment_typ_model->save();


                                foreach ($items_content as $value) {
                                    $component_arr = explode(',', $value->component);
//                                    if (!empty($value->component) && count($component_arr) > 0 && $component_arr[0] != "") {
                                    $Order_items_model = new Order_items_model();
                                    $Order_items_model->order_id = $order_id;
                                    $Order_items_model->item_id = $value->item_id;
                                    $Order_items_model->item_count = $value->count;
                                    $Order_items_model->created_by = $customer->id;
                                    if ($value->offer_id != null && !empty($value->offer_id)) {
                                        $offer = DB::table('offer')
                                            ->join('offer_price_currency', 'offer_price_currency.offer_id', 'offer.id')
                                            ->join('account_currency', 'account_currency.id', 'offer_price_currency.acc_currency_id')
                                            ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                            ->where('offer_id', $value->offer_id)
                                            ->where('account_currency.currency_id', $currency_id)
                                            ->select('offer_price_currency.price')->first();
                                        $value->price = $offer->price;
                                        $Order_items_model->offer_id = $value->offer_id;
                                    }
                                    $Order_items_model->item_price = $value->price;

                                    $Order_items_model->save();


                                    $order_item_id = $Order_items_model->id;
                                    if (!empty($value->component) && count($component_arr) > 0 && $component_arr[0] != "") {
                                        for ($i = 0; $i < count($component_arr); $i++) {
                                            $order_item_component = new Order_item_component();
                                            $order_item_component->order_item_id = $order_item_id;
                                            $order_item_component->component_id = $component_arr[$i];
                                            $order_item_component->save();
                                        }
                                    }

//                                    } else {
//                                        DB::rollBack();
//                                        $response['msg'] = 'please add components';
//                                        $response['status'] = false;
//                                        return $response;
//                                    }
                                }
                                NotificationService::NotifyRestaurant('order', $customer->id, $restaurant_id, 'New Order', 'New order has been made.', 'New order has been made.');
                                DB::commit();
                                $response['msg'] = 'successfully';
                                $response['status'] = true;
                                $response['ret_data'] = $order_id;
                                return $response;

                            }

                        } else {
                            $response['msg'] = 'error in customer address';
                            $response['status'] = false;
                            return $response;
                        }
                    } else {
                        $response['msg'] = 'Your account is inactive';
                        $response['status'] = false;
                        return $response;
                    }


                }
            }
            $response['msg'] = 'pad request  method';
            $response['status'] = false;
            return $response;
        }
    }


    function get_order_by_id(Request $request)
    {

        $response = default_ret_array();
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'order_id' => 'required|numeric',
            'currency_id' => 'required|numeric',
            'token' => 'required|String',
            'language_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $response['msg'] = $validator->errors()->all();
            return $response;
        } else {
            $source_id = $request->input('user_id');
            $order_id = $request->input('order_id');
            $currency_id = $request->input('currency_id');
            $token = $request->input('token');
            $language_id = $request->input('language_id');
//                DB::enableQueryLog();
            $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')

//                     dd(DB::getQueryLog());
//                dd($customer);
            if ($customer != null) {

                if ($language_id == 1)
                    $q = 'select res.id,res.account_name as restaurant_name,res.logo_path,ord.id as order_id,ord.created_at as order_create_date,ord.total_cost_after,ord.total_cost_after,ord_st.step_name_en as step_name,ord_log.created_at as step_create_date
                             from   account as res
                             join orders as ord on ord.restaurant_id=res.id
                             join order_steps_log as ord_log on ord_log.id=ord.order_stop_log_id
                             join order_steps as ord_st on ord_st.id=ord_log.step_id
                       where ord.customer_id =' . $customer->id . ' and  ord.id =  ' . $order_id;
                else
                    $q = 'select res.id, res.account_name as restaurant_name,res.logo_path,ord.id as order_id,ord.created_at as order_create_date,ord.total_cost_after,ord_st.step_name_ar as step_name,ord_log.created_at as step_create_date
                             from   account as res
                             join orders as ord on ord.restaurant_id=res.id
                             join order_steps_log as ord_log on ord_log.id=ord.order_stop_log_id
                             join order_steps as ord_st on ord_st.id=ord_log.step_id
                       where ord.customer_id =' . $customer->id . ' and  ord.id =  ' . $order_id;

                $all_details = DB::select($q);
//                dd($all_details);
                if ($all_details != null) {
                    foreach ($all_details as $acc) {
                        if ($acc->logo_path != null)
                            $acc->logo_path = URL::to('/') . '/restaurants/logo/' . $acc->id . '/' . $acc->logo_path;

                    }
                    $ret_data = array();
                    array_push($ret_data, ['order_details' => $all_details]);
                    DB::enableQueryLog();
                    if ($language_id == 1)
                        $items = DB::table('order_items')
                            ->join('item', 'order_items.item_id', 'item.id')
                            ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                            ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                            ->join('currency', 'account_currency.currency_id', 'currency.id')
                            ->select('item.id', 'item.item_name_en as item_name', 'item.description_en as description', 'order_items.item_price as price', 'item.photo_url', 'order_items.item_count')
                            ->where('order_items.order_id', $order_id)
                            ->where('currency.id', $currency_id)
                            ->get();

                    else
                        $items = DB::table('order_items')
                            ->join('item', 'order_items.item_id', 'item.id')
                            ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                            ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                            ->join('currency', 'account_currency.currency_id', 'currency.id')
                            ->select('item.id', 'item.item_name_ar as item_name', 'item.description_ar as description', 'order_items.item_price as price', 'item.photo_url', 'order_items.item_count')
                            ->where('order_items.order_id', $order_id)
                            ->where('currency.id', $currency_id)
                            ->get();

//                    $items_details = DB::select($items);
//                    dd(DB::getQueryLog());
                    if ($items != null) {
                        foreach ($items as $item) {
                            if ($item->photo_url != null)
                                $item->photo_url = URL::to('/') . '/items/' . $item->id . '/' . $item->photo_url;
                        }
                        array_push($ret_data, ['items_details' => $items]);
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $ret_data;
                    } else {
                        $response['msg'] = 'This restaurant does not deal with this currency so the meal details will not appear';
                        $response['status'] = false;
                        $response['ret_data'] = $ret_data;
                    }

                    return $response;
                } else {
                    $response['msg'] = 'you don\'t have orders';
                    $response['status'] = false;
                    return $response;
                }


            } else {
                $response['msg'] = 'Your account is inactive';
                $response['status'] = false;
                return $response;
            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }


}
