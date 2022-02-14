<?php

namespace App\Http\Controllers;

use App\Models\cart_item_component_model;
use App\Models\cart_item_model;
use App\Models\cart_model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use URL;


class Cart extends Controller
{
    function add_to_cart(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'token' => 'required|String',
//                'cart_id' => 'nullable|numeric',
                'cart_content' => 'required'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('user_id');
                $token = $request->input('token');
//                $cart_id = $request->input('cart_id');
                $cart_content = $request->input('cart_content');
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
//               dd($cart_id) ;
                if ($customer != null) {
                    $cart_exist = cart_model::where('customer_id', $customer->id)->where('status_id', 2)->first();
//                    dd($cart_exist->id);
                    if ($cart_exist != null && $cart_exist->id > 0) {
                        $cart_id = $cart_exist->id;
//                        $cart_exist = cart_model::where('id', $cart_id)->where('customer_id', $source_id)->first();
                        if ($cart_exist != null) {
                            $cart_content = json_decode($cart_content);
                            foreach ($cart_content as $cart_item) {
                                $item = cart_item_model::where('item_id', $cart_item->item_id)->where('cart_id', $cart_id)->first();
//                           dd($item->id);
                                if ($item === null) {
                                    // item doesn't exist
                                    $row_cart = cart_item_model::where('cart_id', $cart_id)->first();
                                    if ($row_cart != null) {
                                        $row_cart_father = \App\Models\item::where('id', $row_cart->item_id)->first();
                                        $cart_item_father = \App\Models\item::where('id', $cart_item->item_id)->first();
//                                  dd($row_cart_father->restaurant_id ,$cart_item_father->restaurant_id);
                                        if ($row_cart_father->restaurant_id == $cart_item_father->restaurant_id) {
                                            $cart_item_model = new cart_item_model();
                                            $component_arr = explode(',', $cart_item->component);
//                                            dd();
                                            // if (!empty($cart_item->component) && count($component_arr) > 0 && $component_arr[0] != "") {
                                            $cart_item_model->cart_id = $cart_id;
                                            $cart_item_model->item_id = $cart_item->item_id;
                                            $cart_item_model->item_count = $cart_item->count;
                                            if ($cart_item->offer_id != null && !empty($cart_item->offer_id)) {
                                                $offer = DB::table('offer')
                                                    ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                                    ->where('id', $cart_item->offer_id)->first();
                                                if ($offer != null) {
                                                    $cart_item_model->offer_id = $cart_item->offer_id;
                                                } else {
                                                    $response['msg'] = 'error happen with offer';
                                                    $response['status'] = false;
                                                    return $response;
                                                }
                                            }
                                            $cart_item_model->save();
                                            if (count($component_arr) > 0 && $component_arr[0] != "") {
                                                for ($i = 0; $i < count($component_arr); $i++) {
                                                    $cart_item_component = new cart_item_component_model();
                                                    $cart_item_component->cart_item_id = $cart_item_model->id;
                                                    $cart_item_component->component_id = $component_arr[$i];
                                                    $cart_item_component->save();

                                                }
                                            }
                                            $response['msg'] = 'added successfully';
                                            $response['status'] = true;
                                            $response['ret_data'] = array('cart_id' => $cart_id);
                                            return $response;
//                                            } else {
//                                                $response['msg'] = 'please add components';
//                                                $response['status'] = false;
//                                                return $response;
//                                            }

                                        } else {
                                            $response['msg'] = 'Choose a meal from the same restaurant in the cart';
                                            $response['status'] = false;
                                            unset($response['ret_data']);
                                            return $response;
                                        }

                                    } else {
                                        $cart_item_model = new cart_item_model();
                                        $component_arr = explode(',', $cart_item->component);
//                                        if (!empty($cart_item->component) && count($component_arr) > 0 && $component_arr[0] != "") {
                                        $cart_item_model->cart_id = $cart_id;
                                        $cart_item_model->item_id = $cart_item->item_id;
                                        $cart_item_model->item_count = $cart_item->count;
                                        if ($cart_item->offer_id != null && !empty($cart_item->offer_id)) {
                                            $offer = DB::table('offer')
                                                ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                                ->where('id', $cart_item->offer_id)->first();
                                            if ($offer != null) {
                                                $cart_item_model->offer_id = $cart_item->offer_id;
                                            } else {
                                                $response['msg'] = 'error happen with offer';
                                                $response['status'] = false;
                                                return $response;
                                            }
                                        }
                                        $cart_item_model->save();
                                        if (count($component_arr) > 0 && $component_arr[0] != "") {
                                            for ($i = 0; $i < count($component_arr); $i++) {
                                                $cart_item_component = new cart_item_component_model();
                                                $cart_item_component->cart_item_id = $cart_item_model->id;
                                                $cart_item_component->component_id = $component_arr[$i];
                                                $cart_item_component->save();

                                            }
                                        }


                                        $response['msg'] = 'added successfully';
                                        $response['status'] = true;
                                        $response['ret_data'] = array('cart_id' => $cart_id);
                                        return $response;
//                                        } else {
//                                            $response['msg'] = 'please add components';
//                                            $response['status'] = false;
//                                            return $response;
//                                        }

                                    }


//                              dd($row_cart[0]->item_id);

                                } else {
//                                $component_arr = explode(',', $cart_item->component);
//                                $res = cart_item_component_model::where('cart_item_id', $item->id)->whereNotIn('component_id', $component_arr)->delete();
//                                for ($i = 0; $i < count($component_arr); $i++) {
//                                    $component = cart_item_component_model::where('cart_item_id', $item->id)->where('component_id', $component_arr[$i])->first();
//                                    if ($component == null) {
//                                        $cart_item_component = new cart_item_component_model();
//                                        $cart_item_component->cart_item_id = $item->id;
//                                        $cart_item_component->component_id = $component_arr[$i];
//                                        $cart_item_component->save();
//                                    }
//
//                                }
                                    $response['msg'] = 'meal is already exist';
                                    $response['status'] = false;
                                    $response['ret_data'] = array('cart_id' => $cart_id);
                                    return $response;

                                }
                            }
                            $response['msg'] = 'added successfully';
                            $response['status'] = true;
                            $response['ret_data'] = array('cart_id' => $cart_id);
                            return $response;
                        } else {
                            $response['msg'] = 'error in cart id ';
                            $response['status'] = false;
                            $response['ret_data'] = array('cart_id' => $cart_id);
                            return $response;
                        }

                    } else {
                        $cart_model = new cart_model();
                        $cart_model->customer_id = $customer->id;
                        $cart_model->status_id = 2;
                        $cart_model->save();
                        $cart_id = $cart_model->id;
                        $cart_content = json_decode($cart_content);
//                        dd($cart_content);
                        foreach ($cart_content as $cart_item) {
//                            dd($cart_item);
//                         dd( implode(',' ,$cart_item->component))  ;
                            $component_arr = explode(',', $cart_item->component);
//                            if (!empty($cart_item->component) && count($component_arr) > 0 && $component_arr[0] != "") {
                            $cart_item_model = new cart_item_model();

                            $cart_item_model->cart_id = $cart_id;
                            $cart_item_model->item_id = $cart_item->item_id;
                            $cart_item_model->item_count = $cart_item->count;
                            if ($cart_item->offer_id != null && !empty($cart_item->offer_id)) {
                                $offer = DB::table('offer')
                                    ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                    ->where('id', $cart_item->offer_id)->first();
                                if ($offer != null) {
                                    $cart_item_model->offer_id = $cart_item->offer_id;
                                } else {
                                    $response['msg'] = 'error happen with offer';
                                    $response['status'] = false;
                                    return $response;
                                }
                            }
                            $cart_item_model->save();
                            if (count($component_arr) > 0 && $component_arr[0] != "") {
                                for ($i = 0; $i < count($component_arr); $i++) {
                                    $cart_item_component = new cart_item_component_model();
                                    $cart_item_component->cart_item_id = $cart_item_model->id;
                                    $cart_item_component->component_id = $component_arr[$i];
                                    $cart_item_component->save();

                                }
                            }
//                            } else {
//                                $response['msg'] = 'please add components';
//                                $response['status'] = false;
//                                return $response;
//                            }

                        }
                        $response['msg'] = 'added successfully';
                        $response['status'] = true;
                        $response['ret_data'] = array('cart_id' => $cart_id);
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

    function remove_from_cart(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'token' => 'required|String',
//                'cart_id' => 'required|numeric|gt:0',
                'item_id' => 'required|numeric|gt:0'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('user_id');
                $token = $request->input('token');
//                $cart_id = $request->input('cart_id');
                $item_id = $request->input('item_id');
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')

//               dd($cart_id) ;
                if ($customer != null) {
                    $cart_exist = cart_model::where('customer_id', $customer->id)->where('status_id', 2)->first();


//                    $cart_exist = cart_model::where('id', $cart_id)->where('customer_id', $source_id)->first();
                    if ($cart_exist != null) {
                        $cart_id = $cart_exist->id;
                        $item = cart_item_model::where('item_id', $item_id)->where('cart_id', $cart_id)->first();
//                           dd($item->id);
                        if ($item === null) {
                            // item doesn't exist
                            $response['msg'] = 'The meal is not in the cart';
                            $response['status'] = false;
                            $response['ret_data'] = array('cart_id' => $cart_id);
                            return $response;
                        } else {
                            $components = cart_item_component_model::where('cart_item_id', $item->id)->get();
                            if ($components != null && count($components) > 0) {
                                cart_item_component_model::where('cart_item_id', $item->id)->delete();
                            }
                            $item = cart_item_model::where('item_id', $item_id)->where('cart_id', $cart_id)->delete();
                            $response['msg'] = 'removed successfully';
                            $response['status'] = true;
                            $response['ret_data'] = array('cart_id' => $cart_id);
                            return $response;

                        }
                    } else {
                        $response['msg'] = 'error in cart id ';
                        $response['status'] = false;
//                        $response['ret_data'] = array('cart_id' => $cart_id);
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

    function update_cart(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'token' => 'required|String',
//                'cart_id' => 'required|numeric|gt:0',
                'item_details' => 'required'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('user_id');
                $token = $request->input('token');
//                $cart_id = $request->input('cart_id');
                $item_details = $request->input('item_details');
                $item_details = json_decode($item_details);
//                dd($item_details);
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
//               dd($cart_id) ;
                if ($customer != null) {
                    $cart_exist = cart_model::where('status_id', 2)->where('customer_id', $customer->id)->first();
                    if ($cart_exist != null) {
                        $cart_id = $cart_exist->id;
                        $item = cart_item_model::where('item_id', $item_details[0]->item_id)->where('cart_id', $cart_id)->first();
//                           dd($item->id);
                        if ($item === null) {
                            // item doesn't exist
                            $response['msg'] = 'The meal is not in the cart';
                            $response['status'] = false;
                            $response['ret_data'] = array('cart_id' => $cart_id);
                            return $response;
                        } else {
                            DB::beginTransaction();
                            if ($item_details[0]->offer_id != null && !empty($item_details[0]->offer_id)) {
                                $offer = DB::table('offer')
                                    ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                    ->where('id', $item_details[0]->offer_id)->first();
                                if ($offer != null) {
                                    cart_item_model::where('item_id', $item_details[0]->item_id)->where('cart_id', $cart_id)->update(['offer_id' => $item_details[0]->offer_id]);
                                } else {
                                    cart_item_model::where('item_id', $item_details[0]->item_id)->where('cart_id', $cart_id)->update(['offer_id' => NULL]);

                                }
                            }
                            cart_item_model::where('item_id', $item_details[0]->item_id)->where('cart_id', $cart_id)->update(['item_count' => $item_details[0]->count]);

                            $component_arr = explode(',', $item_details[0]->component);
//                            if (!empty($item_details[0]->component) && count($component_arr) > 0 && $component_arr[0] != "")
                            $res = cart_item_component_model::where('cart_item_id', $item->id)->whereNotIn('component_id', $component_arr)->delete();

                            if (count($component_arr) > 0 && $component_arr[0] != "") {
                                for ($i = 0; $i < count($component_arr); $i++) {
                                    $component = cart_item_component_model::where('cart_item_id', $item->id)->where('component_id', $component_arr[$i])->first();
                                    if ($component == null) {
                                        $cart_item_component = new cart_item_component_model();
                                        $cart_item_component->cart_item_id = $item->id;
                                        $cart_item_component->component_id = $component_arr[$i];
                                        $cart_item_component->save();
                                    }

                                }
                            }


                            DB::commit();
                            $response['msg'] = 'updated successfully';
                            $response['status'] = true;
                            $response['ret_data'] = array('cart_id' => $cart_id);
                            return $response;


                        }
                    } else {
                        $response['msg'] = 'error in cart id ';
                        $response['status'] = false;
//                        $response['ret_data'] = array('cart_id' => $cart_id);
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

    function show_cart(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'token' => 'required|String',
//                'cart_id' => 'required|numeric|gt:0',
                'language_id' => 'required|numeric',
                'currency_id' => 'required|numeric'
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
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')

                if ($customer != null) {
                    $cart_exist = cart_model::where('status_id', 2)->where('customer_id', $customer->id)->first();

                    if ($cart_exist != null) {
                        $cart_id = $cart_exist->id;
                        if ($language_id == 1)
                            $item = DB::table('cart_items')
                                ->join('item', 'item.id', 'cart_items.item_id')
                                ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                                ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                                ->where('cart_items.cart_id', $cart_id)
                                ->where('item_status_id', 1)
                                ->where('account_currency.currency_id', $currency_id)
                                ->select('cart_items.cart_id', 'cart_items.offer_id', 'cart_items.id as cart_item_id', 'cart_items.item_count as count', 'item.item_name_en as item_name', 'item.id as item_id', 'item.photo_url', 'item_price_currency.price', 'item.restaurant_id')->get();
                        else
                            $item = DB::table('cart_items')
                                ->join('item', 'item.id', 'cart_items.item_id')
                                ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                                ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                                ->where('cart_items.cart_id', $cart_id)
                                ->where('item_status_id', 1)
                                ->where('account_currency.currency_id', $currency_id)
                                ->select('cart_items.cart_id', 'cart_items.offer_id', 'cart_items.id as cart_item_id', 'cart_items.item_count as count', 'item.id as item_id', 'item.item_name_ar as item_name', 'item.photo_url', 'item_price_currency.price', 'item.restaurant_id')->get();

                        if (count($item) > 0) {
                            $tot_pos = 0;
                            foreach ($item as $it) {
//                                dd($it->photo_url);
                                if ($it->photo_url != null)
                                    $it->photo_url = URL::to('/') . '/items/' . $it->item_id . '/' . $it->photo_url;

                                if ($language_id == 1) {
                                    $item_component = DB::table('component')
                                        ->join('item_component', 'item_component.component_id', 'component.id')
                                        ->join('item', 'item.id', 'item_component.item_id')
//                                        ->join('component_price_currency', 'component_price_currency.component_id', 'component.id')
//                                        ->join('account_currency', 'account_currency.id', 'component_price_currency.acc_currency_id')
                                        ->where('item.id', $it->item_id)
//                                        ->where('account_currency.currency_id', $currency_id)
                                        ->select('item_component.component_id as component_id', 'component.component_name_en as component_name')->get();

                                } else {
                                    $item_component = DB::table('component')
                                        ->join('item_component', 'item_component.component_id', 'component.id')
                                        ->join('item', 'item.id', 'item_component.item_id')
                                        ->where('item.id', $it->item_id)
                                        ->select('item_component.component_id as component_id', 'component.component_name_ar as component_name')->get();
                                }
                                //$item_component = array('item_component' => $item_component);
                                $it->item_component = $item_component;
                                $item_cart_component = DB::table('component')
                                    ->join('cart_items_component', 'cart_items_component.component_id', 'component.id')
                                    ->join('cart_items', 'cart_items.id', 'cart_items_component.cart_item_id')
                                    ->where('cart_items.id', $it->cart_item_id)
                                    ->where('cart_items.cart_id', $cart_id)
                                    ->select('cart_items_component.component_id')->get();
                                $com_arr = array();
                                foreach ($item_cart_component as $com) {
                                    array_push($com_arr, $com->component_id);
                                }
                                //  $item_cart_component = array('item_cart_component' => $com_arr);
                                $it->item_cart_component = $com_arr;
                                if ($it->offer_id != null) {
                                    $offer = DB::table('offer')
                                        ->join('offer_price_currency', 'offer_price_currency.offer_id', 'offer.id')
                                        ->join('account_currency', 'account_currency.id', 'offer_price_currency.acc_currency_id')
                                        ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                        ->where('offer.id', $it->offer_id)
                                        ->where('account_currency.currency_id', $currency_id)
                                        ->select('offer_price_currency.price')->first();
                                    if ($offer != null) {
                                        $it->price = $offer->price;
                                    } else {
                                        DB::table('cart_items')
                                            ->where('cart_items.cart_id', $cart_id)
                                            ->where('cart_items.id', $it->cart_item_id)
                                            ->update(['offer_id' => null]);
                                    }
                                }
                                $tot_pos += $it->price * $it->count;
                            }
//
//                            $total_value = DB::table('cart_items')
//                                ->join('item', 'item.id', 'cart_items.item_id')
//                                ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
//                                ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
//                                ->where('cart_items.cart_id', $cart_id)
//                                ->where('item_status_id', 1)
//                                ->where('account_currency.currency_id', $currency_id)
//                                ->selectRaw('sum(item_price_currency.price * cart_items.item_count) as tot')->get();

                            if ($language_id == 1)
                                $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_en as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,count(favorites.place_id) as favorites_count';
                            else
                                $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_ar as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,count(favorites.place_id) as favorites_count';

                            $from = '     from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join work_status st on st.id=ac.work_status_id
                                    left join favorites on favorites.place_id= ac.id
                                  ';
                            $where = ' where ac.status_id=1 and ac.account_type_id=2 and  ac.id=' . $item[0]->restaurant_id;
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
                            $res = $res[0];
//                            dd($res);

                            $tax_value = DB::table('tax')
                                ->where('status_id', 1)
                                ->where('currency_id', $currency_id)->first();

                            $tax_cart = 0;
                            if (isset($tax_value->tax_value) && $tax_value->tax_value != null) {
                                $tax_cart = $tax_value->tax_value;
                                $tax_id = $tax_value->id;
//                                $total_value_after = round($total_value[0]->tot + ($total_value[0]->tot * $tax_value->tax_value / 100), 2);
                                $total_value_after = round($tot_pos + ($tot_pos * $tax_value->tax_value / 100), 2);

                            } else {
                                $tax_cart = 0;
                                $tax_id = null;
//                                $total_value_after = $total_value[0]->tot;
                                $total_value_after =round($tot_pos,2) ;
                            }

//                            $ret_data = array('items' => $item, 'total_value_before' => $total_value[0]->tot, 'tax_id' => $tax_id, 'tax_percentage' => $tax_cart, 'total_value_after' => $total_value_after);
                            $ret_data = array('items' => $item, 'total_value_before' => $tot_pos, 'tax_id' => $tax_id, 'tax_percentage' => $tax_cart, 'total_value_after' => $total_value_after, 'restaurant_info' => $res);

                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $ret_data;
                            return $response;
                        } else {
                            $response['msg'] = 'no meals in cart';
                            $response['status'] = false;
                            $response['ret_data'] = array('cart_id' => $cart_id);
                            return $response;
                        }


                    } else {
                        $response['msg'] = 'not found cart for you';
                        $response['status'] = false;
//                        $response['ret_data'] = array('cart_id' => $cart_id);
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

    function show_cart_item(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'token' => 'required|String',
//                'cart_id' => 'required|numeric|gt:0',
                'cart_item_id' => 'required|numeric',
                'language_id' => 'required|numeric',
                'currency_id' => 'required|numeric'

            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('user_id');
                $token = $request->input('token');
//                $cart_id = $request->input('cart_id');
                $item_id = $request->input('cart_item_id');
                $language_id = $request->input('language_id');
                $currency_id = $request->input('currency_id');

                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')

                if ($customer != null) {
                    $cart_exist = cart_model::where('status_id', 2)->where('customer_id', $customer->id)->first();
                    if ($cart_exist != null) {
                        $cart_id = $cart_exist->id;
                        $item = cart_item_model::where('id', $item_id)->where('cart_id', $cart_id)->first();

                        if ($item === null) {
                            // item doesn't exist
                            $response['msg'] = 'The meal is not in the cart';
                            $response['status'] = false;
                            $response['ret_data'] = array('cart_id' => $cart_id);
                            return $response;
                        } else {

                            if ($language_id == 1)
                                $item = DB::table('cart_items')
                                    ->join('item', 'item.id', 'cart_items.item_id')
                                    ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                                    ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                                    ->where('cart_items.id', $item_id)
                                    ->where('item_status_id', 1)
                                    ->where('account_currency.currency_id', $currency_id)
                                    ->select('cart_items.cart_id', 'cart_items.offer_id', 'cart_items.id as cart_item_id', 'cart_items.item_count as count', 'item.item_name_en as item_name', 'item.id as item_id', 'item.photo_url', 'item_price_currency.price')->get();
                            else
                                $item = DB::table('cart_items')
                                    ->join('item', 'item.id', 'cart_items.item_id')
                                    ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                                    ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                                    ->where('cart_items.id', $item_id)
                                    ->where('item_status_id', 1)
                                    ->where('account_currency.currency_id', $currency_id)
                                    ->select('cart_items.cart_id', 'cart_items.offer_id', 'cart_items.id as cart_item_id', 'cart_items.item_count as count', 'item.id as item_id', 'item.item_name_ar as item_name', 'item.photo_url', 'item_price_currency.price')->get();
                            if ($item == null && count($item) == 0) {
                                // item doesn't exist
                                $response['msg'] = 'this restaurant not deal with currency';
                                $response['status'] = false;
                                $response['ret_data'] = array('cart_id' => $cart_id);
                                return $response;
                            } else {
                                if ($item[0]->photo_url != null)
                                    $item[0]->photo_url = URL::to('/') . '/items/' . $item[0]->item_id . '/' . $item[0]->photo_url;

                                if ($item[0]->offer_id != null) {
                                    $offer = DB::table('offer')
                                        ->join('offer_price_currency', 'offer_price_currency.offer_id', 'offer.id')
                                        ->join('account_currency', 'account_currency.id', 'offer_price_currency.acc_currency_id')
                                        ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                        ->where('offer_id', $item[0]->offer_id)
                                        ->where('account_currency.currency_id', $currency_id)
                                        ->select('offer_price_currency.price')->first();
                                    if ($offer != null) {
                                        $item[0]->price = $offer->price;
                                    } else {
                                        DB::table('cart_items')
                                            ->where('cart_items.cart_id', $cart_id)
                                            ->where('cart_items.id', $item_id)
                                            ->update(['offer_id' => null]);
                                    }
                                }
                                $res_data = array();
                                $item_details = array('item_datails' => $item);
                                array_push($res_data, $item_details);
                                if ($language_id == 1) {
                                    $item_component = DB::table('component')
                                        ->join('item_component', 'item_component.component_id', 'component.id')
                                        ->join('item', 'item.id', 'item_component.item_id')
//                                        ->join('component_price_currency', 'component_price_currency.component_id', 'component.id')
//                                        ->join('account_currency', 'account_currency.id', 'component_price_currency.acc_currency_id')
                                        ->where('item.id', $item[0]->item_id)
//                                        ->where('account_currency.currency_id', $currency_id)
                                        ->select('item_component.component_id as component_id', 'component.component_name_en as component_name')->get();

                                } else {
                                    $item_component = DB::table('component')
                                        ->join('item_component', 'item_component.component_id', 'component.id')
                                        ->join('item', 'item.id', 'item_component.item_id')
//                                        ->join('component_price_currency', 'component_price_currency.component_id', 'component.id')
//                                        ->join('account_currency', 'account_currency.id', 'component_price_currency.acc_currency_id')
                                        ->where('item.id', $item[0]->item_id)
//                                        ->where('account_currency.currency_id', $currency_id)
                                        ->select('item_component.component_id as component_id', 'component.component_name_ar as component_name')->get();
                                }
                                $item_component = array('item_component' => $item_component);
                                array_push($res_data, $item_component);
                                $item_cart_component = DB::table('component')
                                    ->join('cart_items_component', 'cart_items_component.component_id', 'component.id')
                                    ->join('cart_items', 'cart_items.id', 'cart_items_component.cart_item_id')
//                                    ->join('component_price_currency', 'component_price_currency.component_id', 'component.id')
//                                    ->join('account_currency', 'account_currency.id', 'component_price_currency.acc_currency_id')
                                    ->where('cart_items.id', $item_id)
                                    ->where('cart_items.cart_id', $cart_id)
//                                    ->where('account_currency.currency_id', $currency_id)
                                    ->select('cart_items_component.component_id')->get();
                                $com_arr = array();
                                foreach ($item_cart_component as $com) {
                                    array_push($com_arr, $com->component_id);
                                }
                                $item_cart_component = array('item_cart_component' => $com_arr);
                                array_push($res_data, $item_cart_component);
                                $item_belongings = DB::table('item_belongings')->where('item_id', $item[0]->item_id)->get();
//                                dd($item_belongings);
                                $belongs = array();
                                if ($item_belongings != null) {
                                    foreach ($item_belongings as $item_belonging) {
                                        if ($language_id == 1) {
                                            $related = DB::table('item')
                                                ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                                                ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                                                ->where('item.id', $item_belonging->related_item_id)
                                                ->where('account_currency.currency_id', $currency_id)
                                                ->select('item.id', 'item.item_name_en as related_name', 'item.photo_url', 'item_price_currency.price')->first();
                                        } else {
                                            $related = DB::table('item')->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                                                ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                                                ->where('item.id', $item_belonging->related_item_id)
                                                ->where('account_currency.currency_id', $currency_id)
                                                ->select('item.id', 'item.item_name_ar as related_name', 'item.photo_url', 'item_price_currency.price')->first();
                                        }
//                                        dd($related);
                                        if ($related != null) {
//                                            foreach ($related as $r) {
//                                        dd($r->photo_url);
//                                                if ($r->photo_url != null)
                                            $related->photo_url = URL::to('/') . '/items/' . $related->id . '/' . $related->photo_url;

//                                            }
                                        }
                                        array_push($belongs, $related);
                                    }
                                }
                                $belongs = array('belongs' => $belongs);
                                array_push($res_data, $belongs);

                            }
//                            dd($res_data);

                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $res_data;
                            return $response;

                        }
                    } else {
                        $response['msg'] = 'error in cart id ';
                        $response['status'] = false;
//                        $response['ret_data'] = array('cart_id' => $cart_id);
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
