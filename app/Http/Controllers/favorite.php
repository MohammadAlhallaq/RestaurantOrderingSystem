<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;
use URL;

class favorite extends Controller
{
    //
    function add_to_favorite(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'place_id' => 'required|numeric',
                'token' => 'required|String'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {

                $source_id = $request->input('user_id');
                $place_id = $request->input('place_id');
                $token = $request->input('token');
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {
                    $acc_fav = DB::table('favorites')->where('customer_id', $customer->id)->where('place_id', $place_id)->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                    if ($acc_fav == null) {
                        $favorite_model = new \App\Models\favorite();
                        $favorite_model->customer_id = $customer->id;
                        $favorite_model->place_id = $place_id;
//                    $favorite_model->created_at = Carbon::now()->toDateTimeString();
                        $favorite_model->save();

                        $response['msg'] = 'added successfully';
                        $response['status'] = true;

                        return $response;
                    } else {
                        $response['msg'] = 'added before';
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

    function get_favorites(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'token' => 'required|String',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'language_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {

                $source_id = $request->input('user_id');
                $language_id = $request->input('language_id');
                $token = $request->input('token');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {

//                    and account.status_id=1
                    $query = 'select count(*) as total_row from(
               select address.address, address.latitude, address.longitude,account.id as account_id,account.account_name, account.phone_number ,
                account.logo_path
                     from account
                     join address on address.account_id=account.id
                     join favorites on favorites.place_id=account.id
                    where  favorites.customer_id =' . $customer->id . '

                 ' . ' )t';
                    $res = DB::select($query);
                    if ($res[0]->total_row > 0) {

                        $q = 'select t.* from(
               select address.address, address.latitude, address.longitude,account.id ,account.account_name, account.phone_number ,
                account.logo_path,account_status.status,account.opening_time,account.closing_time ,(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution
                     from account
                     join address on address.account_id=account.id
                     join account_status on account_status.id=account.status_id
                    join favorites on favorites.place_id=account.id
                  left join evaluation on evaluation.restaurant_id= account.id
                      where  favorites.customer_id =' . $customer->id . '
                     and account.status_id=1
                    GROUP BY  address.address ,address.latitude, address.longitude, account.id ,account.account_name, account.phone_number ,
                account.logo_path,account_status.status ,account.opening_time,account.closing_time ' . '
                     limit ' . $offset . ', ' . $limit . ' )t';

                        $result = DB::select($q);
                        $result = DB::select($q);
                        foreach ($result as $acc) {
                            if ($acc->logo_path != null)
                                $acc->logo_path = URL::to('/') . '/restaurants/logo/' . $acc->id . '/' . $acc->logo_path;
//                                    $acc->logo_path = storage_path('/app/public/restaurants/logo/' . $acc->id . '/') . $acc->logo_path;
                            if ($language_id == 1)
                                $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->id)->get();
                            else
                                $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name_ar as sub_category_name ")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->id)->get();

                            $acc->menus = $menu_names->implode('sub_category_name', ', ');
                        }

                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $result;
                        $response['page_count'] = ceil($res[0]->total_row / $limit);
                        $response['total_row'] = $res[0]->total_row;
                        return $response;

                    } else {
                        $response['msg'] = 'There is no favorite restaurant';
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

    function delete_from_favorits(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'place_id' => 'required|numeric',
                'token' => 'required|String'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {

                $source_id = $request->input('user_id');
                $place_id = $request->input('place_id');
                $token = $request->input('token');
                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {
                    DB::table('favorites')->where('customer_id', $customer->id)->where('place_id', $place_id)->delete();
                    $response['msg'] = 'removed successfully';
                    $response['status'] = true;
                    return $response;
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
}
