<?php

namespace App\Http\Controllers;

use App\Models\cart_item_model;
use App\Models\cart_model;
use App\Models\coupon_currency_model;
use App\Models\Coupon_model;
use App\Models\item_price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Illuminate\Support\MessageBag;

class Coupon extends Controller
{
    function add_coupon(Request $request)
    {

        $item_controller = new item();
        $cur_arr = $item_controller->get_restaurant_currency();

        if ($request->isMethod('post')) {
            //  dd($request->input());
            $validator = Validator::make($request->all(), [
                'couponCode' => 'required|string|min:3|max:255',
//                'couponValue' => 'required|numeric',
                'coupon_status' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect('add-coupon')
                    ->withInput()
                    ->withErrors($validator);
            } else {

                for ($i = 1; $i <= count($cur_arr); $i++) {
                    $v = $this->validate($request, ['couponValue' . $cur_arr[$i - 1]->id => 'required|numeric']);
                    $v1 = $this->validate($request, ['currency' . $cur_arr[$i - 1]->id => 'required|string']);

                }

                $coupons = Coupon_model::where('coupon_code', '=', $request->input('couponCode'))->first();
                if ($coupons === null) {
                    // coupon does not exist
                    $couponCode = $request->input('couponCode');
//                    $couponValue = $request->input('couponValue');
                    $coupon_status = $request->input('coupon_status');


                    $coupon_model = new \App\Models\Coupon_model();

                    $coupon_model->coupon_code = $couponCode;
//                    $coupon_model->coupon_value = $couponValue;
                    $coupon_model->status_id = $coupon_status;
                    $coupon_model->created_by = Auth::id();
                    $coupon_model->save();
                    $coupon_id = $coupon_model->id;
                    for ($i = 1; $i <= count($cur_arr); $i++) {
                        $coupon_currency_model = new coupon_currency_model();
                        $coupon_currency_model->coupon_id = $coupon_id;
                        $coupon_currency_model->coupon_value = $request->input('couponValue' . $cur_arr[$i - 1]->id);
                        $coupon_currency_model->acc_currency_id = $cur_arr[$i - 1]->id;
                        $coupon_currency_model->created_by = Auth::id();
                        $coupon_currency_model->save();
                    }

                    return redirect()->route('show-coupon');
                } else {
                    // coupon exits
                    $errors = new MessageBag();

                    // add your error messages:
                    $errors->add('Coupon Code', ' Coupon Code already exist,please add another code');

                    return redirect('add-coupon')
                        ->withInput()->withErrors($errors);
                }


            }
        }

        $staus_arr = DB::select('select * from coupon_status');

        return view('layout/coupon/add-coupon', ['status_arr' => $staus_arr, 'currency' => $cur_arr]);

    }

    function show_coupon()
    {

        $q = 'select c.id, c.coupon_code,c.created_at, c.updated_at,s.status_name_en
        from coupon c join coupon_status s on c.status_id =s.id where c.created_by = ' . Auth::id();
        $results = DB::select($q);

        return view('layout/coupon/show-coupon', ['coupons' => $results]);
    }

    function edit_coupon($coupon_id, Request $request)
    {
        $item_controller = new item();
        $cur_arr = $item_controller->get_restaurant_currency();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'couponCode' => 'required|string|min:3|max:255',
//                'couponValue' => 'required|numeric',
                'coupon_status' => 'required'
            ]);
            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            } else {
                for ($i = 1; $i <= count($cur_arr); $i++) {
                    $v = $this->validate($request, ['couponValue' . $cur_arr[$i - 1]->id => 'required|numeric']);
                    $v1 = $this->validate($request, ['currency' . $cur_arr[$i - 1]->id => 'required|string']);

                }
                $couponCode = $request->input('couponCode');
//                $couponValue = $request->input('couponValue');
                $coupon_status = $request->input('coupon_status');


                $coupon_model = new \App\Models\Coupon_model();

                $coupon_model->exists = true;
                $coupon_model->id = $coupon_id;
//                $coupon_model->coupon_code = $couponCode;
//                $coupon_model->coupon_value = $couponValue;
                $coupon_model->status_id = $coupon_status;
                $coupon_model->save();

                return redirect('show-coupon')->with('status', "edit successfully");

            }

        }
        $coupon_model = new \App\Models\Coupon_model();
        $coupon = $coupon_model::find($coupon_id);

//        $currency = DB::select('select * from currency');
        $currency_added = coupon_currency_model::select('coupon_value', 'acc_currency_id')
            ->where('coupon_id', $coupon_id)->orderBy('acc_currency_id')->get();

        $arr = array();
        foreach ($cur_arr as $c) {
            foreach ($currency_added as $r) {
                if ($c->id == $r->acc_currency_id) {

                    $c->coupon_value = $r->coupon_value;

                }

            }
        }
        $staus_arr = DB::select('select * from coupon_status');
//dd($cur_arr);
        return view('layout/coupon/edit-coupon', ['coupon' => $coupon, 'staus_arr' => $staus_arr, 'currency' => $cur_arr]);
    }

    function validate_coupon(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
//                'has_coupon' => 'required|numeric',
                'coupon_code' => 'required|String',
                'user_id' => 'required|numeric',
                'token' => 'required|String',
                'currency_id' => 'required|numeric',
//                'cart_id' => 'required|numeric|gt:0'
            ]);

            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
//                $cart_id = $request->input('cart_id');
                $currency_id = $request->input('currency_id');
//                $has_coupon = $request->input('has_coupon');
//                if ($has_coupon == 1) {
                $coupon_code = $request->input('coupon_code');
                $source_id = $request->input('user_id');
                $token = $request->input('token');
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {
                    $coupon = DB::table('coupon')
                        ->join('coupon_currency', 'coupon_currency.coupon_id', 'coupon.id')
                        ->join('account_currency', 'account_currency.id', 'coupon_currency.acc_currency_id')
                        ->where('account_currency.currency_id', $currency_id)
                        ->where('coupon_code', $coupon_code)->select('coupon.id', 'coupon.status_id', 'coupon.created_by', 'coupon_currency.coupon_value')->first();
//                        dd($coupon);
                    if ($coupon != null) {
                        if ($coupon->status_id == 1) {
                            $resturant = DB::table('account')->where('id', $coupon->created_by)->where('status_id', 1)->first();
                            if ($resturant != null) {
                                $cart_exist = cart_model::where('status_id', 2)->where('customer_id', $customer->id)->first();
                                if ($cart_exist != null) {
                                    $cart_id = $cart_exist->id;
                                    $row_cart = cart_item_model::where('cart_id', $cart_id)->first();
                                    if ($row_cart != null) {
                                        $row_cart_father = \App\Models\item::where('id', $row_cart->item_id)->first();
                                        if ($row_cart_father->restaurant_id == $coupon->created_by) {
                                            $coupon_customer = DB::table('customer_coupon')->where('customer_id', $customer->id)->where('coupon_id', $coupon->id)->first();
                                            $ret_data = array();
                                            array_push($ret_data, ['coupon_id' => $coupon->id, 'coupon_value' => $coupon->coupon_value]);
                                            if ($coupon_customer == null) {
                                                $response['msg'] = 'successfully';
                                                $response['status'] = true;
                                                $response['ret_data'] = $ret_data;

                                                return $response;
                                            } else {
                                                $response['msg'] = 'This code has already been used';
                                                $response['status'] = false;
                                                return $response;
                                            }
                                        } else {
                                            $response['msg'] = 'The coupon entered does not apply to the selected restaurant';
                                            $response['status'] = false;
                                            return $response;
                                        }


                                    } else {
                                        $response['msg'] = 'Please choose at least one meal to be able to take benefit of the coupon discount';
                                        $response['status'] = false;
                                        return $response;
                                    }


                                } else {
                                    $response['msg'] = 'empty cart';
                                    $response['status'] = false;
//                                        $response['ret_dat'] = array('cart_id' => $cart_id);
                                    return $response;
                                }


                            } else {
                                $response['msg'] = 'Restaurant account  is  inactive';
                                $response['status'] = false;
                                return $response;
                            }

                        } else {
                            $response['msg'] = 'coupon code is  inactive';
                            $response['status'] = false;
                            return $response;
                        }

                    } else {

                        $response['msg'] = 'please check coupon code';
                        $response['status'] = false;
                        return $response;


                    }
                } else {
                    $response['msg'] = 'Your account is inactive';
                    $response['status'] = false;
                    return $response;
                }

//                } else {
//                    $response['msg'] = 'error in request,please add coupon code';
//                    $response['status'] = false;
//                    return $response;
//                }
            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }

    function validate_coupon_website(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [

                'coupon_code' => 'required|String',
                'user_id' => 'required|numeric',
                'token' => 'required|String',
                'currency_id' => 'required|numeric',
                'restaurant_id' => 'required|numeric',

            ]);

            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $currency_id = $request->input('currency_id');
                $coupon_code = $request->input('coupon_code');
                $source_id = $request->input('user_id');
                $token = $request->input('token');
                $restaurant_id = $request->input('restaurant_id');
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {
                    $coupon = DB::table('coupon')
                        ->join('coupon_currency', 'coupon_currency.coupon_id', 'coupon.id')
                        ->join('account_currency', 'account_currency.id', 'coupon_currency.acc_currency_id')
                        ->where('account_currency.currency_id', $currency_id)
                        ->where('coupon_code', $coupon_code)
                        ->select('coupon.id', 'coupon.status_id', 'coupon.created_by', 'coupon_currency.coupon_value')->first();
//                        dd($coupon);
                    if ($coupon != null) {
                        if ($coupon->status_id == 1) {
                            $resturant = DB::table('account')->where('id', $coupon->created_by)->where('status_id', 1)->first();
                            if ($resturant != null) {
                                if ($restaurant_id == $coupon->created_by) {
                                    $coupon_customer = DB::table('customer_coupon')->where('customer_id', $customer->id)->where('coupon_id', $coupon->id)->first();
                                    $ret_data = array();
                                    array_push($ret_data, ['coupon_id' => $coupon->id, 'coupon_value' => $coupon->coupon_value]);
                                    if ($coupon_customer == null) {
                                        $response['msg'] = 'successfully';
                                        $response['status'] = true;
                                        $response['ret_data'] = $ret_data;

                                        return $response;
                                    } else {
                                        $response['msg'] = 'This code has already been used';
                                        $response['status'] = false;
                                        return $response;
                                    }
                                } else {
                                    $response['msg'] = 'The coupon entered does not apply to the selected restaurant';
                                    $response['status'] = false;
                                    return $response;
                                }


                            } else {
                                $response['msg'] = 'Restaurant account  is  inactive';
                                $response['status'] = false;
                                return $response;
                            }

                        } else {
                            $response['msg'] = 'coupon code is  inactive';
                            $response['status'] = false;
                            return $response;
                        }

                    } else {

                        $response['msg'] = 'please check coupon code';
                        $response['status'] = false;
                        return $response;


                    }
                } else {
                    $response['msg'] = 'Your account is inactive';
                    $response['status'] = false;
                    return $response;
                }

//                } else {
//                    $response['msg'] = 'error in request,please add coupon code';
//                    $response['status'] = false;
//                    return $response;
//                }
            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }
}
