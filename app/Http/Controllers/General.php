<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use URL;
use Carbon\Carbon;

class General extends Controller
{
    //
    function get_countries(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
//            $validator = Validator::make($request->all(), [
//                'source_id' => 'required|numeric',
//            ]);
//            if ($validator->fails()) {
//                $response['msg'] = $validator->errors()->all();
//                return $response;
//            } else {
            //  $source_id = $request->input('source_id');
//                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
//                if ($customer != null) {
            $q = 'select * from country';
            $res = DB::select($q);
            $response['msg'] = 'successfully';
            $response['status'] = true;
            $response['ret_data'] = $res;
            return $response;
//                } else {
//                    $response['msg'] = 'Your account is inactive';
//                    $response['status'] = false;
//                    return $response;
//                }

            //  }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;

    }

    function get_cities(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
//            $validator = Validator::make($request->all(), [
//                'source_id' => 'required|numeric',
//                'country_id' => 'required|numeric'
//            ]);
//            if ($validator->fails()) {
//                $response['msg'] = $validator->errors()->all();
//                return $response;
//            } else {
//                $source_id = $request->input('source_id');
            $country_id = $request->input('country_id');
//                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
//                if ($customer != null) {
            $country = DB::table('country')->where('id', $country_id)->first();
            if ($country != null) {
                $cities = DB::table('city')->where('country_id', $country_id)->get();
                $response['msg'] = 'successfully';
                $response['status'] = true;
                $response['ret_data'] = $cities;
                return $response;
            } else {
                $response['msg'] = 'invalid country id';
                $response['status'] = false;
                return $response;
            }


//                } else {
//                    $response['msg'] = 'Your account is inactive';
//                    $response['status'] = false;
//                    return $response;
//                }
            // }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;

    }

    function get_areas(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
//                'source_id' => 'required|numeric',
                'city_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
//                $source_id = $request->input('source_id');
                $city_id = $request->input('city_id');
//                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
//                if ($customer != null) {
                $city = DB::table('city')->where('id', $city_id)->first();
                if ($city != null) {
                    $areas = DB::table('area')->where('city_id', $city_id)->get();
                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data'] = $areas;
                    return $response;
                } else {
                    $response['msg'] = 'invalid city id';
                    $response['status'] = false;
                    return $response;
                }


//                } else {
//                    $response['msg'] = 'Your account is inactive';
//                    $response['status'] = false;
//                    return $response;
//                }

            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_restaurants_by_area(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
//                'source_id' => 'required|numeric',
                'area_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'order_alpha' => 'nullable|string',
                'language_id' => 'required|numeric',
                'currency_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
//                $source_id = $request->input('source_id');
                $language_id = $request->input('language_id');
                $area_id = $request->input('area_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $order_alpha = $request->input('order_alpha');
                $currency_id = $request->input('currency_id');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                if ($order_alpha == null) {
                    $order_alpha = 'asc';
                }


//                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
//                if ($customer != null) {
                $area = DB::table('area')->where('id', $area_id)->first();
                if ($area != null) {
//                    join category cat on cat.id= ac.resturant_category_id
//                    join address ad on ac.id=ad.account_id
//                                  join account_status st on st.id=ac.status_id
                    $query = 'select *
                                  from    account ac
                                  join address ad on ac.id=ad.account_id
                                 join account_status st on st.id=ac.status_id
                                join account_currency on account_currency.account_id=ac.id
                                 join item on item.restaurant_id=ac.id
                                 where ac.account_type_id =2
                                 and ac.status_id=1
                                 and ad.area_id =' . $area_id . ' and account_currency.currency_id=' . $currency_id . '  GROUP BY ac.id';
//                        dd($query);
                    $count = DB::select($query);
//                    dd(count($count));
//                    join category cat on cat.id= ac.resturant_category_id
                    if ($count != null && count($count) > 0) {
                        if ($language_id == 1)
                            $query = 'select t.* from(
    select ac.id, ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_en as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution
                                  from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join work_status st on st.id=ac.work_status_id
                                  join account_currency on account_currency.account_id=ac.id
                                  left join evaluation on evaluation.restaurant_id= ac.id
                                  join item on item.restaurant_id=ac.id
                                  where ac.account_type_id =2
                                  and ac.status_id=1
                                  and  ad.area_id =' . $area_id . ' and account_currency.currency_id=' . $currency_id . ' GROUP BY ac.id ,ac.account_name ,ac.phone_number,ac.logo_path,status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time' . ' LIMIT ' . $offset . ', ' . $limit . ') t' . '
                                  ORDER by  t.account_name ' . $order_alpha;
                        else
                            $query = 'select t.* from(
    select ac.id, ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_ar as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution
                                  from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join work_status st on st.id=ac.work_status_id
                                  join account_currency on account_currency.account_id=ac.id
                                  left join evaluation on evaluation.restaurant_id= ac.id
                                  join item on item.restaurant_id=ac.id
                                  where ac.account_type_id =2
                                       and ac.status_id=1
                                       and  ad.area_id =' . $area_id . ' and account_currency.currency_id=' . $currency_id . ' GROUP BY ac.id ,ac.account_name ,ac.phone_number,ac.logo_path,status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time' . ' LIMIT ' . $offset . ', ' . $limit . ') t' . '
                                  ORDER by  t.account_name ' . $order_alpha;
//                        dd($query);
                        $res = DB::select($query);
                        foreach ($res as $acc) {
                            if ($acc->logo_path != null)
                                $acc->logo_path = URL::to('/') . '/restaurants/logo/' . $acc->id . '/' . $acc->logo_path;

                            if ($language_id == 1)
                                $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->id)->get();
                            else
                                $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name_ar as sub_category_name ")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->id)->get();

                            $acc->menus = $menu_names->implode('sub_category_name', ', ');

//                                    $acc->logo_path = storage_path('/app/public/restaurants/logo/' . $acc->id . '/') . $acc->logo_path; ->join('item', 'offer.item_id', '=', 'item.id')->where('offer.approve', 1)
                        }

                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $res;
                        $response['page_count'] = ceil(count($count) / $limit);
                        $response['total_rows'] = count($count);
                        return $response;
                    } else {
                        $response['msg'] = 'There are no restaurants in this area or There are no restaurants in this area deal with selected currency';
                        $response['status'] = false;
                        return $response;
                    }

                } else {
                    $response['msg'] = 'invalid area id';
                    $response['status'] = false;
                    return $response;
                }


//                } else {
//                    $response['msg'] = 'Your account is inactive';
//                    $response['status'] = false;
//                    return $response;
//                }

            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }


    function get_restaurants_by_location(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'lat' => 'required|numeric',
                'long' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'order_alpha' => 'nullable|string',
                'currency_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {

                $lat = $request->input('lat');
                $long = $request->input('long');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $currency_id = $request->input('currency_id');
                $order_alpha = $request->input('order_alpha');
                $language_id = $request->input('language_id');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                if ($order_alpha == null) {
                    $order_alpha = 'asc';
                }
                $radius = 400;
                /*
   * using query builder approach, useful when you want to execute direct query
   * replace 6371000 with 6371 for kilometer and 3956 for miles
   */
                //                    ,category.category_name,category.category_name_ar,account_status.status
//                ,account.id as account_id,account.account_name, account.phone_number ,account.logo_path


//                $restaurants = DB::table('account')
//                    ->selectRaw("address.id, address.address, address.latitude, address.longitude
// ,account.id as account_id,account.account_name, account.phone_number ,account.logo_path
// ,category.category_name,category.category_name_ar,account_status.status
//                    ,
//                     ( 6371000 * acos( cos( radians(?) ) *
//                       cos( radians( latitude ) )
//                       * cos( radians( longitude ) - radians(?)
//                       ) + sin( radians(?) ) *
//                       sin( radians( latitude ) ) )
//                     ) AS distance", [$lat, $long, $lat])
//                    ->join('address', 'address.account_id', '=', 'account.id')
//                    ->join('category', 'category.id', '=', 'account.resturant_category_id')
//                    ->join('account_status', 'account_status.id', '=', 'account.status_id')
//                    ->having("distance", "<", $radius)
//                    ->orderBy("distance", 'asc')
//                    ->offset(0)
//                    ->limit(20)
//                    ->get();


                $query = 'select count(*) as total_row from(
               select  address.id,address.address, address.latitude, address.longitude,account.id as account_id,account.account_name, account.phone_number ,
                account.logo_path,
              ( 6371000 * acos( cos( radians(' . $lat . ') ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(' . $long . ')
                       ) + sin( radians(' . $lat . ') ) *
                       sin( radians( latitude ) ) )
                     ) AS distance
                     from account
                     join address on address.account_id=account.id
                     join account_currency on account_currency.account_id=account.id
                     join item on item.restaurant_id=account.id
                 where  account.account_type_id = 2
                 and account.status_id=1
                 and account_currency.currency_id= ' . $currency_id . '
                     ' . ' )t

                    where distance <' . $radius . '
                      ORDER by  t.distance asc';
//                dd($query);
                $res = DB::select($query);

                if ($res[0]->total_row > 0) {
                    if ($language_id == 1)
                        $q = 'select t.* from(
               select  address.id as address_id,address.address, address.latitude, address.longitude,account.id as account_id,account.account_name, account.phone_number ,
                account.logo_path,st.status_name_en as  status,account.opening_time,account.closing_time,
              ( 6371000 * acos( cos( radians(' . $lat . ') ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(' . $long . ')
                       ) + sin( radians(' . $lat . ') ) *
                       sin( radians( latitude ) ) )
                     ) AS distance ,(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution
                     from account
                     join address on address.account_id=account.id
                      join work_status st on st.id=account.work_status_id
                      join account_currency on account_currency.account_id=account.id
                      left join evaluation on evaluation.restaurant_id= account.id
                      join item on item.restaurant_id=account.id
                     where  account.account_type_id =2
                     and account.status_id=1
                      and account_currency.currency_id= ' . $currency_id .
                            ' GROUP BY address_id,address.address, address.latitude, address.longitude, account_id,account.account_name, account.phone_number ,
                account.logo_path,status ,account.opening_time,account.closing_time ,distance' . '
                     limit ' . $offset . ', ' . $limit . ' )t

                     where distance <' . $radius . '
                      ORDER by  t.distance asc';
                    else
                        $q = 'select t.* from(
               select  address.id as address_id,address.address, address.latitude, address.longitude,account.id as account_id,account.account_name, account.phone_number ,
                account.logo_path,st.status_name_ar as  status,account.opening_time,account.closing_time,
              ( 6371000 * acos( cos( radians(' . $lat . ') ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(' . $long . ')
                       ) + sin( radians(' . $lat . ') ) *
                       sin( radians( latitude ) ) )
                     ) AS distance ,(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution
                     from account
                     join address on address.account_id=account.id
                      join work_status st on st.id=account.work_status_id
                      join account_currency on account_currency.account_id=account.id
                      left join evaluation on evaluation.restaurant_id= account.id
                      join item on item.restaurant_id=account.id
                     where  account.account_type_id =2
                     and account.status_id=1
                      and account_currency.currency_id= ' . $currency_id .
                            ' GROUP BY address_id,address.address, address.latitude, address.longitude, account_id,account.account_name, account.phone_number ,
                account.logo_path,status ,account.opening_time,account.closing_time ,distance' . '
                     limit ' . $offset . ', ' . $limit . ' )t

                     where distance <' . $radius . '
                      ORDER by  t.distance asc';
//dd($q);
                    $result = DB::select($q);
//                    dd($result);

                    foreach ($result as $acc) {
                        if ($acc->logo_path != null)
                            $acc->logo_path = URL::to('/') . '/restaurants/logo/' . $acc->account_id . '/' . $acc->logo_path;
//                                    $acc->logo_path = storage_path('/app/public/restaurants/logo/' . $acc->id . '/') . $acc->logo_path;
                        if ($language_id == 1)
                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->account_id)->get();
                        else
                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name_ar as sub_category_name ")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->account_id)->get();

                        $acc->menus = $menu_names->implode('sub_category_name', ', ');
                    }

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data'] = $result;
                    $response['page_count'] = ceil($res[0]->total_row / $limit);
                    $response['total_row'] = $res[0]->total_row;
                    return $response;
                } else {
                    $response['msg'] = 'There are no restaurants in this area or There are no restaurants in this area deal with selected currency';
                    $response['status'] = false;
                    return $response;
                }


            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }


    function get_restaurants_count_by_area(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
//                'source_id' => 'required|numeric',
                'area_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
//                $source_id = $request->input('source_id');
                $area_id = $request->input('area_id');

//                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
//                if ($customer != null) {
                $area = DB::table('area')->where('id', $area_id)->first();
                if ($area != null) {
                    $query = 'select count(*) as rest_count
                                  from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join category cat on cat.id= ac.resturant_category_id
                                  join account_status st on st.id=ac.status_id
                                  where ad.area_id =' . $area_id;;
//                        dd($query);
                    $res = DB::select($query);
                    if ($res != null) {

                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $res;
                        return $response;
                    } else {
                        $response['msg'] = 'There are no restaurants in this area';
                        $response['status'] = false;
                        return $response;
                    }

                } else {
                    $response['msg'] = 'invalid area id';
                    $response['status'] = false;
                    return $response;
                }

//
//                } else {
//                    $response['msg'] = 'Your account is inactive';
//                    $response['status'] = false;
//                    return $response;
//                }

            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_restaurants(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'source_id' => 'required|numeric',
                'area_id' => 'numeric',
                'name' => 'string',
                'min_price' => 'numeric',
                'status' => 'numeric',
                'near_flag' => 'numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {

                $name = null;
                $area_id = null;
                $min_price = null;
                $status = null;
                $near_flag = null;
                $where = ' where 1=1 ';
                $join = '';

                $source_id = $request->input('source_id');

                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
                if ($customer != null) {
                    $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,cat.category_name,cat.category_name_ar,st.status';
                    $from = '     from    account ac
                                  join category cat on cat.id= ac.resturant_category_id
                                  join account_status st on st.id=ac.status_id';

                    if ($request->input('area_id') != null) {
                        $area_id = $request->input('area_id');
                        $join .= ' join address ad on ac.id=ad.account_id';
                        $where .= ' and ad.area_id=' . $area_id;
                    }
                    if ($request->input('name') != null) {
                        $name = $request->input('name');
                        $where .= ' and ac.account_name like \'%' . $name . '%\'';
                    }
                    if ($request->input('min_price') != null) {
                        $min_price = $request->input('min_price');
                        $select .= ' ,it.*';
                        $join .= ' join item it on it.restaurant_id=ac.id';
                        $where .= ' and it.price <' . $min_price;

                    }
                    if ($request->input('status') != null) {
                        $join .= 'join account_status st on st.id=ac.status_id';
                        $status = $request->input('status');
                        $where .= ' and st.id =' . $status;
                    }
//                    if ($request->input('near_flag') != null) {
//                        $near_flag = $request->input('near_flag');
//                    }
                    $area = DB::table('area')->where('id', $area_id)->first();
                    if ($area != null) {
                        $all_query = $select . $from . $join . $where;
//                        dd($all_query);
//                        $query = 'select count(*) as rest_count
//                                  from    account ac
//                                  join address ad on ac.id=ad.account_id
//                                  join category cat on cat.id= ac.resturant_category_id
//
//                                  where ad.area_id =' . $area_id;;
//                        dd($query);
                        $res = DB::select($all_query);
                        if ($res != null) {

                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $res;
                            return $response;
                        } else {
                            $response['msg'] = 'There are no restaurants in this area';
                            $response['status'] = false;
                            return $response;
                        }

                    } else {
                        $response['msg'] = 'invalid area id';
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

    function get_account_types(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                $language_id = $request->input('language_id');
                $accounts_types_count = DB::table('category')->select('*')->get();

                if ($language_id == 1)
                    $accounts_types = DB::table('category')->select('id', 'category_name', 'category_photo')->orderBy('sort_id')->offset($offset)
                        ->limit($limit)->get();
                else
                    $accounts_types = DB::table('category')->select('id', 'category_name_ar as category_name', 'category_photo')->orderBy('sort_id')->offset($offset)
                        ->limit($limit)->get();

                foreach ($accounts_types as $type) {
                    $type->category_photo = URL::to('/') . '/cat_main/' . $type->id . '/' . $type->category_photo;
                }
                $response['msg'] = 'successfully';
                $response['status'] = true;
                $response['ret_data'] = $accounts_types;
                $response['total_rows'] = count($accounts_types_count);
                $response['total_pages'] = ceil(count($accounts_types_count) / $limit);
                return $response;
            }

        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_menu_types(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $language_id = $request->input('language_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                $menus_count = DB::table('sub_category')->join('parent_sub_category', 'parent_sub_category.id', 'sub_category.parent_cat_id')->select('sub_category.id', 'sub_category.sub_category_name', 'sub_category.main_photo', 'parent_sub_category.parent_name')->get();

                if ($language_id == 1)
                    $menus = DB::table('sub_category')->join('parent_sub_category', 'parent_sub_category.id', 'sub_category.parent_cat_id')->select('sub_category.id', 'sub_category.sub_category_name', 'sub_category.main_photo', 'parent_sub_category.parent_name')->offset($offset)
                        ->limit($limit)->get();
                else
                    $menus = DB::table('sub_category')->join('parent_sub_category', 'parent_sub_category.id', 'sub_category.parent_cat_id')->select('sub_category.id', 'sub_category.sub_category_name_ar as sub_category_name', 'sub_category.main_photo', 'parent_sub_category.parent_name_ar as parent_name')
                        ->offset($offset)
                        ->limit($limit)->get();

                foreach ($menus as $menu) {
                    $menu->main_photo = URL::to('/') . '/sub_cat_main/' . $menu->id . '/' . $menu->main_photo;
                }
                $response['msg'] = 'successfully';
                $response['status'] = true;
                $response['ret_data'] = $menus;
                $response['total_rows'] = count($menus_count);
                $response['total_pages'] = ceil(count($menus_count) / $limit);
                return $response;
            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_offers(Request $request)
    {
        $response = default_ret_array();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'currency_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $currency_id = $request->input('currency_id');
                $language_id = $request->input('language_id');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                $resturants = DB::table('account_currency')->select('account_id', 'id')->where('currency_id', $currency_id)->get();
//dd(count($resturants) > 0);
                if (count($resturants) > 0) {
                    $arr_res_account = array();
                    foreach ($resturants as $restura) {
                        array_push($arr_res_account, $restura->account_id);
                    }
                    $arr_res_curr = array();
                    foreach ($resturants as $restura) {
                        array_push($arr_res_curr, $restura->id);
                    }
//                    DB::connection()->enableQueryLog();
                    $offers_count = DB::table('offer')->join('item', 'offer.item_id', '=', 'item.id')
                        ->join('offer_price_currency', 'offer.id', 'offer_price_currency.offer_id')
                        ->join('item_price_currency', 'item.id', 'item_price_currency.item_id')
                        ->select("*")
                        ->where('offer.approve', 1)
                        ->whereDate('offer.expiry_date', '>=', Carbon::now())
                        ->whereIn('offer.created_by', $arr_res_account)
                        ->whereIn('offer_price_currency.acc_currency_id', $arr_res_curr)
                        ->whereIn('item_price_currency.acc_currency_id', $arr_res_curr)
                        ->get();
//                    $queries = DB::getQueryLog();
//                    dd($queries );
                    if (count($offers_count) > 0) {
                        if ($language_id == 1) {
//                            DB::enableQueryLog();
                            $offers = DB::table('offer')->selectRaw("offer.id,offer.offer_name_en as offer_name,offer.offer_image,offer_price_currency.price as offer_price,offer.expiry_date ,item.id as item_id,item.item_name_en as item_name,item_price_currency.price as item_price")
                                ->join('item', 'offer.item_id', '=', 'item.id')
                                ->join('offer_price_currency', 'offer.id', 'offer_price_currency.offer_id')
                                ->join('item_price_currency', 'item.id', 'item_price_currency.item_id')
                                ->where('offer.approve', 1)
                                ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                ->whereIn('offer.created_by', $arr_res_account)
                                ->whereIn('offer_price_currency.acc_currency_id', $arr_res_curr)
                                ->whereIn('item_price_currency.acc_currency_id', $arr_res_curr)
                                ->offset($offset)
                                ->limit($limit)->get();
//                            dd(DB::getQueryLog());
                        } else {
                            $offers = DB::table('offer')
                                ->selectRaw("offer.id,offer_name_ar as offer_name,offer.offer_image,offer_price_currency.price as offer_price,offer.expiry_date,item.id as item_id,item.item_name_ar as item_name,item_price_currency.price as item_price")
                                ->join('item', 'offer.item_id', '=', 'item.id')
                                ->join('offer_price_currency', 'offer.id', 'offer_price_currency.offer_id')
                                ->join('item_price_currency', 'item.id', 'item_price_currency.item_id')
                                ->where('offer.approve', 1)
                                ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                ->whereIn('offer.created_by', $arr_res_account)
                                ->whereIn('offer_price_currency.acc_currency_id', $arr_res_curr)
                                ->whereIn('item_price_currency.acc_currency_id', $arr_res_curr)
                                ->offset($offset)
                                ->limit($limit)->get();
//                            dd($offers);
                        }

                        foreach ($offers as $offer) {
                            $offer->offer_image = URL::to('/') . '/offers/' . $offer->id . '/' . $offer->offer_image;
                        }
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $offers;
                        $response['total_rows'] = count($offers_count);
                        $response['total_page'] = ceil(count($offers_count) / $limit);
                        return $response;
                    } else {
                        $response['msg'] = 'There are no restaurants that deal with this currency and have offers';
                        $response['status'] = false;
                        return $response;
                    }

                } else {
                    $response['msg'] = 'There are no restaurants that deal with this currency';
                    $response['status'] = false;
                    return $response;
                }

            }

        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_restaurant(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'nullable|numeric',
                'token' => 'nullable|String',
                'restaurant_id' => 'required|numeric',
                'language_id' => 'required|numeric',
                'currency_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
//                dd($request->input());
                $source_id = $request->input('user_id');
                $token = $request->input('token');
                $restaurant_id = $request->input('restaurant_id');
                $language_id = $request->input('language_id');
                $currency_id = $request->input('currency_id');
                $restaurant = DB::table('account')->join('item', 'item.restaurant_id', 'account.id')->where('account.id', $restaurant_id)->where('account.status_id', 1)->get();
//                dd($restaurant);
                if ($restaurant != null && count($restaurant) > 0) {
                    $restaurant_curr = DB::table('account as ac')->join('account_currency  as ac_cu', 'ac_cu.account_id', 'ac.id')->where('ac.id', $restaurant_id)->where('ac_cu.currency_id', $currency_id)->where('ac.status_id', 1)->get('ac_cu.*');
//                  dd($restaurant_curr);
                    if ($restaurant_curr != null && count($restaurant_curr) > 0) {
                        if ($language_id == 1)
                            $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_en as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,count(favorites.place_id) as favorites_count';
                        else
                            $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status_name_ar as status,ad.address,ad.latitude,ad.longitude,ac.opening_time,ac.closing_time,count(favorites.place_id) as favorites_count';

                        $from = '     from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join work_status st on st.id=ac.work_status_id
                                  join item on item.restaurant_id=ac.id
                                   left join favorites on favorites.place_id= ac.id
                                  ';
                        $where = ' where ac.status_id=1 and ac.account_type_id=2 and  ac.id=' . $restaurant_id;
                        $query = $select . ' ' . $from . ' ' . $where;
//                        dd($query);
                        $res = DB::select($query);

                        if ($language_id == 1)
                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("restaurant_sub_category.id,sub_category.sub_category_name,restaurant_sub_category.image_path")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $res[0]->restaurant_id)->get();
                        else
                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("restaurant_sub_category.id,sub_category.sub_category_name_ar as sub_category_name ,restaurant_sub_category.image_path")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $res[0]->restaurant_id)->get();

                        $res[0]->menus = $menu_names->implode('sub_category_name', ', ');


                        $minprice = DB::table('item_price_currency')->select('*')->where('created_by', '=', $res[0]->restaurant_id)->where('acc_currency_id', $restaurant_curr[0]->id)->min('price');

                        $maxprice = DB::table('item_price_currency')->select('*')->where('created_by', '=', $res[0]->restaurant_id)->where('acc_currency_id', $restaurant_curr[0]->id)->max('price');

                        $res[0]->minPrice = $minprice;
                        $res[0]->maxPrice = $maxprice;

                        if ($res[0]->logo_path != null)
                            $res[0]->logo_path = URL::to('/') . '/restaurants/logo/' . $res[0]->restaurant_id . '/' . $res[0]->logo_path;

                        $rowCount = DB::table('evaluation')->where('restaurant_id', '=', $restaurant_id)
                            ->count();
//
                        $total_eval = DB::table('evaluation')
                            ->where('restaurant_id', $restaurant_id)
                            ->sum(\DB::raw('IFNULL(taste_value,0) + IFNULL(clean_value,0)  + IFNULL(delivery_value,0) '));

                        if ($total_eval > 0) {
                            $res[0]->evaluation = ceil($total_eval / ($rowCount * 3));
                        } else {
                            $res[0]->evaluation = 3;
                        }
                        if ($source_id != null && $source_id > 0 && $token != null) {
                            $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
//                           dd($customer);
                            if ($customer != null) {
                                $fav = DB::table('favorites')
                                    ->where('place_id', $restaurant_id)->where('customer_id', $customer->id)->first();
//                               dd($fav);
                                if ($fav != null) {
                                    $res[0]->favorite = true;
                                } else {
                                    $res[0]->favorite = false;
                                }
                            } else {
                                $res[0]->favorite = false;
                            }
                        } else {
                            $res[0]->favorite = false;

                        }


                        foreach ($menu_names as $menu) {
                            if ($menu->image_path != null)
                                $menu->image_path = URL::to('/') . '/restaurants/sub_categories/' . $menu->id . '/' . $menu->image_path;
                            else
                                $menu->image_path = URL::to('/') . '/restaurants/sub_categories/bg-logo.png';

                        }
                        //  dd($menu_names);
                        if ($res != null) {

                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $res;
                            $response['menus'] = $menu_names;


                            return $response;
                        } else {
                            $response['msg'] = 'error';
                            $response['status'] = false;
                            return $response;
                        }
                    } else {
                        $response['msg'] = 'This restaurant does not deal with this currency';
                        $response['status'] = false;
                        return $response;
                    }


                } else {
                    $response['msg'] = 'restaurant  is inactive or not has meals';
                    $response['status'] = false;
                    return $response;
                }

            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_same_restaurants(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'restaurant_id' => 'required|numeric',
                'language_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'currency_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $restaurant_id = $request->input('restaurant_id');
                $language_id = $request->input('language_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $currency_id = $request->input('currency_id');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                $restaurant = DB::table('account')->join('item', 'item.restaurant_id', 'account.id')->where('account.id', $restaurant_id)->where('account.status_id', 1)->first();
                if ($restaurant != null) {
                    $menus = DB::table('restaurant_sub_category')->select('sub_category_id')->where('restaurant_id', $restaurant_id)->get();

                    $arrmenu = array();
                    foreach ($menus as $menu) {
                        array_push($arrmenu, $menu->sub_category_id);
                    }
                    $str = implode(',', $arrmenu);
                    $select = 'select ac.id as restaurant_id , ac.account_name ,ac.phone_number,ac.logo_path,st.status,ad.address,ad.latitude,ad.longitude';
                    $from = '     from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join account_status st on st.id=ac.status_id
                                  join restaurant_sub_category on restaurant_sub_category.restaurant_id=ac.id
                                  join account_currency ac_cu on ac_cu.account_id =ac.id
                                  join item on item.restaurant_id =ac.id ';
                    $where = ' where restaurant_sub_category.sub_category_id in (' . $str . ')  and restaurant_sub_category.restaurant_id !=' . $restaurant_id . ' and ac_cu.currency_id =' . $currency_id;
                    $group_by = ' group by restaurant_id ';
                    $query = $select . ' ' . $from . ' ' . $where . ' ' . $group_by;
                    $same_restaurants_count = DB::select($query);
                    if ($same_restaurants_count != null && count($same_restaurants_count) > 0) {
                        $query = $select . ' ' . $from . ' ' . $where . ' ' . $group_by . ' limit ' . $offset . ' ,' . $limit;
                        $same_restaurants = DB::select($query);
                        foreach ($same_restaurants as $res) {
                            if ($language_id == 1)
                                $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $res->restaurant_id)->get();
                            else
                                $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name_ar as sub_category_name ")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $res->restaurant_id)->get();

                            $res->menus = $menu_names->implode('sub_category_name', ', ');

                            if ($res->logo_path != null)
                                $res->logo_path = URL::to('/') . '/restaurants/logo/' . $res->restaurant_id . '/' . $res->logo_path;
                        }

                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $same_restaurants;
                        $response['total_rows'] = count($same_restaurants_count);
                        $response['total_page'] = ceil(count($same_restaurants_count) / $limit);
                        return $response;

                    } else {
                        $response['msg'] = 'There are no similar restaurants';
                        $response['status'] = false;
                        return $response;
                    }


                } else {
                    $response['msg'] = 'account is inactive';
                    $response['status'] = false;
                    return $response;
                }

            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_accounts_by_category(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'category_id' => 'required|numeric',
                'area_id' => 'numeric',
                'lat' => 'numeric',
                'long' => 'numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'order_alpha' => 'nullable|string',
                'currency_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $area_id = $request->input('area_id');
                $category_id = $request->input('category_id');
                $lat = $request->input('lat');
                $long = $request->input('long');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $currency_id = $request->input('currency_id');
                $order_alpha = $request->input('order_alpha');
                $language_id = $request->input('language_id');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                if ($order_alpha == null) {
                    $order_alpha = 'asc';
                }
                if ($long != null && $lat != null) {
                    $radius = 400;
                    $query = 'select t.* from(
               select  address.id,address.address, address.latitude, address.longitude,account.id as account_id,account.account_name, account.phone_number ,
                account.logo_path,
              ( 6371000 * acos( cos( radians(' . $lat . ') ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(' . $long . ')
                       ) + sin( radians(' . $lat . ') ) *
                       sin( radians( latitude ) ) )
                     ) AS distance
                     from account
                     join address on address.account_id=account.id
                     join account_currency on account_currency.account_id=account.id
                     join item on item.restaurant_id = account.id
                 where  account.resturant_category_id = ' . $category_id . '
                 and account.status_id=1
                 and account_currency.currency_id= ' . $currency_id . '
                     ' . '  group by account_id  )t

                    where distance <' . $radius . '
                      ORDER by  t.distance asc';
                    $res = DB::select($query);
//                    dd(count($res));
                    if (count($res) > 0) {
                        $q = 'select t.* from(
               select  address.id,address.address, address.latitude, address.longitude,account.id as account_id,account.account_name, account.phone_number ,
                account.logo_path, account.opening_time, account.closing_time, account_status.status,
              ( 6371000 * acos( cos( radians(' . $lat . ') ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(' . $long . ')
                       ) + sin( radians(' . $lat . ') ) *
                       sin( radians( latitude ) ) )
                     ) AS distance
                     from account
                     join address on address.account_id=account.id
                     join account_status on account_status.id=account.status_id
                      join account_currency on account_currency.account_id=account.id
                       join item on item.restaurant_id = account.id
                     where  account.resturant_category_id =' . $category_id . '
                     and account.status_id=1
                      and account_currency.currency_id= ' . $currency_id . '   group by account_id
                     limit ' . $offset . ', ' . $limit . ')t

                     where distance <' . $radius . '
                      ORDER by  t.distance asc';

                        $result = DB::select($q);

                        foreach ($result as $acc) {
                            if ($acc->logo_path != null)
                                $acc->logo_path = URL::to('/') . '/restaurants/logo/' . $acc->account_id . '/' . $acc->logo_path;
//                                    $acc->logo_path = storage_path('/app/public/restaurants/logo/' . $acc->id . '/') . $acc->logo_path;
                            if ($language_id == 1)
                                $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->account_id)->get();
                            else
                                $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name_ar as sub_category_name ")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->account_id)->get();

                            $acc->menus = $menu_names->implode('sub_category_name', ', ');
                        }

                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $result;
                        $response['page_count'] = ceil(count($res) / $limit);
                        $response['total_rows'] = count($res);
                        return $response;
                    } else {
                        $response['msg'] = 'There are no accounts';
                        $response['status'] = false;
                        return $response;
                    }
                } else {
                    $area = DB::table('area')->where('id', $area_id)->first();
                    if ($area != null) {
//                    join category cat on cat.id= ac.resturant_category_id
//                    join address ad on ac.id=ad.account_id
//                                  join account_status st on st.id=ac.status_id
                        $query = 'select *
                                  from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join account_currency on account_currency.account_id=ac.id
                                  join item on item.restaurant_id = ac.id
                                  where ac.resturant_category_id =' . $category_id . '
                                    and ac.status_id=1
                                       and ad.area_id =' . $area_id . ' and account_currency.currency_id=' . $currency_id;
//                        dd($query);
                        $count = DB::select($query);
//                        dd(count($count));
//                    dd();
//                    join category cat on cat.id= ac.resturant_category_id
                        if ($count != null && count($count) > 0) {
                            $query = 'select t.* from( select ac.id, ac.account_name ,ac.phone_number,ac.logo_path, ac.opening_time, ac.closing_time,st.status,ad.address,ad.latitude,ad.longitude
                                  from    account ac
                                  join address ad on ac.id=ad.account_id
                                  join account_status st on st.id=ac.status_id
                                 join account_currency on account_currency.account_id=ac.id
                                 join item on item.restaurant_id = ac.id
                                  where ac.resturant_category_id =' . $category_id . '
                                       and ac.status_id=1
                                       and  ad.area_id =' . $area_id . ' and account_currency.currency_id=' . $currency_id . ' LIMIT ' . $offset . ', ' . $limit . ') t' . '
                                  ORDER by  t.account_name ' . $order_alpha;
//                        dd($query);
                            $res = DB::select($query);
                            foreach ($res as $acc) {
                                if ($acc->logo_path != null)
                                    $acc->logo_path = URL::to('/') . '/restaurants/logo/' . $acc->id . '/' . $acc->logo_path;

                                if ($language_id == 1)
                                    $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->id)->get();
                                else
                                    $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name_ar as sub_category_name ")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->id)->get();

                                $acc->menus = $menu_names->implode('sub_category_name', ', ');

//                                    $acc->logo_path = storage_path('/app/public/restaurants/logo/' . $acc->id . '/') . $acc->logo_path; ->join('item', 'offer.item_id', '=', 'item.id')->where('offer.approve', 1)
                            }

                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $res;
                            $response['page_count'] = ceil(count($count) / $limit);
                            $response['total_rows'] = count($count);
                            return $response;
                        } else {
                            $response['msg'] = 'There are no accounts';
                            $response['status'] = false;
                            return $response;
                        }

                    } else {
                        $response['msg'] = 'invalid area id';
                        $response['status'] = false;
                        return $response;
                    }
                }


            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_filters(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $language_id = $request->input('language_id');
                $filters = DB::table('filters')->select('id', 'name')->get();
//                dd($filters);
//                dd(json_encode($filters));
//                $filters = DB::table('filters_account')->select('filter_name')->get();

                $arr_filter = array();

//                dd($arr_filter);
                if ($language_id == 2) {
//                    unset($filters[3]);
                    $item_size = DB::table('item_size')->select('id', 'size_name_ar as title')->get();
                    $i = 0;
                    foreach ($filters as $filter) {
                        $filter = array($filter);
//                        dd($filter[0]->name);
                        if ($filter[0]->name == 'size')
                            $filter[0]->values = $item_size;
//                            $filter->option = $item_size;
//                        $filter->setAttribute('option', $item_size);

//                            $var = array($filter->option => $item_size);
                        else
                            $filter[0]->values = '';
//                            $filter->setAttribute('option', '');

//                        $filter->option == '';
                        //                            $var = array($filter->option => array() );
                        $arr_filter = array_add($arr_filter, $i, $filter[0]);

//                        array_add($arr_filter,$i, $filter);
                        $i++;
                    }
//                    dd(json_encode($arr_filter));
                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data'] = $arr_filter;
//                    $response['item_size'] = $item_size;
                    return $response;
                } else {
//                    unset($filters[2]);
                    $item_size = DB::table('item_size')->select('id', 'size_name_en as title')->get();
                    $i = 0;
                    foreach ($filters as $filter) {
                        $filter = array($filter);
//                        dd($filter[0]->name);
                        if ($filter[0]->name == 'size')
                            $filter[0]->values = $item_size;
//                            $filter->option = $item_size;
//                        $filter->setAttribute('option', $item_size);

//                            $var = array($filter->option => $item_size);
                        else
                            $filter[0]->values = '';
//                            $filter->setAttribute('option', '');

//                        $filter->option == '';
                        //                            $var = array($filter->option => array() );
                        $arr_filter = array_add($arr_filter, $i, $filter[0]);

//                        array_add($arr_filter,$i, $filter);
                        $i++;
                    }
                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data'] = $arr_filter;
//                    $response['item_size'] = $item_size;
                    return $response;
                }

            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;

    }


    function get_accounts_by_sub_menu(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'sub_menu_id' => 'required|numeric',
                'currency_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $language_id = $request->input('language_id');
                $sub_menu_id = $request->input('sub_menu_id');
                $currency_id = $request->input('currency_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
//                if ($language_id == 1) {
//                   $account= DB::table('account')
//                       ->join('restaurant_sub_category','restaurant_sub_category.restaurant_id','account.id')
//                       ->join('sub_category','sub_category.id','restaurant_sub_category.sub_category_id')
//                       ->join('address','address.account_id','account.id')
//                       ->join('account_currency','account_currency.account_id','account.id')
//                       ->join('evaluation','evaluation.restaurant_id','account.id')
//                       ->where('restaurant_sub_category.sub_category_id',$sub_menu_id)
//                       ->where('account_currency.currency_id',$currency_id)
//                       ->select('account.account_name','account.opening_time','account.closing_time','account.logo_path','(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution')->get();


                $query = 'select count(*) as total_row from(
               select address.address, address.latitude, address.longitude,account.id as account_id,account.account_name, account.phone_number ,
                account.logo_path
                     from account
                     join address on address.account_id=account.id
                     join account_currency on account_currency.account_id=account.id
                     join restaurant_sub_category on restaurant_sub_category.restaurant_id=account.id
                     join item on item.restaurant_id = account.id
                 where  restaurant_sub_category.sub_category_id =' . $sub_menu_id . '
                 and account.status_id=1
                 and account_currency.currency_id= ' . $currency_id . '
                     ' . 'group by account.id  )t';
//                dd($query);
                $res = DB::select($query);
//                dd($res);
                if ($res[0]->total_row > 0) {
                    //account.resturant_category_id =4
                    $q = 'select t.* from(
               select address.address, address.latitude, address.longitude,account.id as account_id,account.account_name, account.phone_number ,
                account.logo_path,account_status.status,account.opening_time,account.closing_time ,(IF (ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) is NULL , 3 ,ceil(sum(evaluation.taste_value+evaluation.clean_value+evaluation.delivery_value) /(count(evaluation.restaurant_id)*3)) ) ) as evalution
                     from account
                     join address on address.account_id=account.id
                      join account_currency on account_currency.account_id=account.id
                      join account_status on account_status.id=account.status_id
                     join restaurant_sub_category on restaurant_sub_category.restaurant_id=account.id
                    left join evaluation on evaluation.restaurant_id= account.id
                   join item on item.restaurant_id = account.id
                     where
                      account.status_id=1
                       and  restaurant_sub_category.sub_category_id = ' . $sub_menu_id . '
                      and account_currency.currency_id= ' . $currency_id .
                        ' GROUP BY  address.address,address.latitude, address.longitude, account_id,account.account_name, account.phone_number ,
                account.logo_path,account_status.status ,account.opening_time,account.closing_time ' . '
                     limit ' . $offset . ', ' . $limit . ' )t';

                    $result = DB::select($q);
                    foreach ($result as $acc) {
                        if ($acc->logo_path != null)
                            $acc->logo_path = URL::to('/') . '/restaurants/logo/' . $acc->account_id . '/' . $acc->logo_path;
//                                    $acc->logo_path = storage_path('/app/public/restaurants/logo/' . $acc->id . '/') . $acc->logo_path;
                        if ($language_id == 1)
                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->account_id)->get();
                        else
                            $menu_names = DB::table('restaurant_sub_category')->selectRaw("sub_category.sub_category_name_ar as sub_category_name ")->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')->where('restaurant_id', $acc->account_id)->get();

                        $acc->menus = $menu_names->implode('sub_category_name', ', ');
                    }

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data'] = $result;
                    $response['page_count'] = ceil($res[0]->total_row / $limit);
                    $response['total_row'] = $res[0]->total_row;
                    return $response;
//                        dd($result);
                } else {
                    $response['msg'] = 'There are no accounts deal with selected currency or has selected  menu';
                    $response['status'] = false;
                    return $response;
                }
//                } else {
//
//                }


            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_offer_details(Request $request)
    {
        $response = default_ret_array();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'currency_id' => 'required|numeric',
                'offer_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                $currency_id = $request->input('currency_id');
                $offer_id = $request->input('offer_id');
                $language_id = $request->input('language_id');

                $resturants = DB::table('account_currency')->select('account_id', 'id')->where('currency_id', $currency_id)->get();
//
                if (count($resturants) > 0) {
                    $arr_res_account = array();
                    foreach ($resturants as $restura) {
                        array_push($arr_res_account, $restura->account_id);
                    }
                    $arr_res_curr = array();
                    foreach ($resturants as $restura) {
                        array_push($arr_res_curr, $restura->id);
                    }
                    $offers_count = DB::table('offer')->selectRaw("offer.id,offer_name_ar as offer_name,offer.offer_image,offer_price_currency.price as offer_price,offer.expiry_date,item.id as item_id,item.item_name_ar as item_name,item_price_currency.price as item_price")
                        ->join('item', 'offer.item_id', 'item.id')
                        ->join('offer_price_currency', 'offer.id', 'offer_price_currency.offer_id')
                        ->join('item_price_currency', 'item.id', 'item_price_currency.item_id')
                        ->where('offer.approve', 1)
                        ->where('offer.id', $offer_id)
                        ->whereDate('offer.expiry_date', '>=', Carbon::now())
                        ->whereIn('offer.created_by', $arr_res_account)
                        ->whereIn('offer_price_currency.acc_currency_id', $arr_res_curr)
                        ->whereIn('item_price_currency.acc_currency_id', $arr_res_curr)
                        ->get();
//                    dd(count($offers_count) );
                    if (count($offers_count) > 0) {
                        if ($language_id == 1) {
//                            DB::enableQueryLog();
                            $offers = DB::table('offer')
                                ->selectRaw("offer.id,offer.offer_name_en as offer_name,offer.offer_image,offer_price_currency.price as offer_price,offer.expiry_date ,item.id as item_id,item.item_name_en as item_name,item_price_currency.price as item_price,item.description_en as description,item.photo_url")
                                ->join('item', 'offer.item_id', 'item.id')
                                ->join('offer_price_currency', 'offer.id', 'offer_price_currency.offer_id')
                                ->join('item_price_currency', 'item.id', 'item_price_currency.item_id')
                                ->where('offer.approve', 1)
                                ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                ->where('offer.id', $offer_id)
                                ->whereIn('offer.created_by', $arr_res_account)
                                ->whereIn('offer_price_currency.acc_currency_id', $arr_res_curr)
                                ->whereIn('item_price_currency.acc_currency_id', $arr_res_curr)
                                ->get();
//                            dd(DB::getQueryLog());
                        } else {
                            $offers = DB::table('offer')->selectRaw("offer.id,offer_name_ar as offer_name,offer.offer_image,offer_price_currency.price as offer_price,offer.expiry_date,item.id as item_id,item.item_name_ar as item_name,item_price_currency.price as item_price,item.description_ar as description,item.photo_url")
                                ->join('item', 'offer.item_id', 'item.id')
                                ->join('offer_price_currency', 'offer.id', 'offer_price_currency.offer_id')
                                ->join('item_price_currency', 'item.id', 'item_price_currency.item_id')
                                ->where('offer.approve', 1)
                                ->whereDate('offer.expiry_date', '>=', Carbon::now())
                                ->where('offer.id', $offer_id)
                                ->whereIn('offer.created_by', $arr_res_account)
                                ->whereIn('offer_price_currency.acc_currency_id', $arr_res_curr)
                                ->whereIn('item_price_currency.acc_currency_id', $arr_res_curr)
                                ->get();
//                            dd($offers);
                        }

                        foreach ($offers as $offer) {
                            $offer->offer_image = URL::to('/') . '/offers/' . $offer->id . '/' . $offer->offer_image;
                            $offer->photo_url = URL::to('/') . '/items/' . $offer->item_id . '/' . $offer->photo_url;
                        }
//                        $ret_data = array();
//                        array_push($ret_data, ['offer_item_details' => $offers]);

                        $ret_data = array();
                        $ret_data = array_add($ret_data, 'offer_item_details', $offers[0]);


                        if ($offers[0] != null) {
                            //   $items = DB::table('item')->where('restaurant_id', $restaurant_id)->where('item_status_id', 1)->get();

                            $item_components = DB::table('item_component')->where('item_id', $offers[0]->item_id)->get();
//                    dd($item_components);
                            $item_belongings = DB::table('item_belongings')->where('item_id', $offers[0]->item_id)->get();

//                            if ($item_components != null) {

                            $components = array();
                            if ($item_components != null) {
                                $i = 0;
                                foreach ($item_components as $item_component) {
                                    if ($language_id == 1) {
                                        $component = DB::table('component')
//                                        ->join('component_price_currency', 'component_price_currency.component_id', 'component.id')
//                                        ->join('account_currency', 'account_currency.id', 'component_price_currency.acc_currency_id')
                                            ->where('component.id', $item_component->component_id)
//                                        ->where('account_currency.currency_id', $currency_id)
                                            ->select('component.id', 'component_name_en as component_name')->get();
//                                    dd($component[0]);
                                        $components = array_add($components, $i, $component[0]);
                                        $i++;
//                                    array_push($components, $component);
                                    } else {
                                        $component = DB::table('component')
//                                        ->join('component_price_currency', 'component_price_currency.component_id', 'component.id')
//                                        ->join('account_currency', 'account_currency.id', 'component_price_currency.acc_currency_id')
                                            ->where('component.id', $item_component->component_id)
//                                        ->where('account_currency.currency_id', $currency_id)
                                            ->select('component.id', 'component_name_ar as component_name')->get();
//                                    array_push($components, $component);
                                        $components = array_add($components, $i, $component[0]);
                                        $i++;
                                    }

                                }


                            }
                            if ($components != null) {
                                $ret_data = array_add($ret_data, "components", $components);
                            } else {
                                $ret_data = array_add($ret_data, "components", array());
                            }


                            $belongs = array();
                            if ($item_belongings != null) {
                                $j = 0;
                                foreach ($item_belongings as $item_belonging) {
                                    if ($language_id == 1) {
                                        $related = DB::table('item')
                                            ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                                            ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                                            ->where('item.id', $item_belonging->related_item_id)
                                            ->where('item.item_status_id', 1)
                                            ->where('account_currency.currency_id', $currency_id)
                                            ->select('item.id', 'item.item_name_en as related_name', 'item.photo_url', 'item_price_currency.price')->get();
                                    } else {
                                        $related = DB::table('item')->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                                            ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                                            ->where('item.id', $item_belonging->related_item_id)
                                            ->where('item.item_status_id', 1)
                                            ->where('account_currency.currency_id', $currency_id)
                                            ->select('item.id', 'item.item_name_ar as related_name', 'item.photo_url', 'item_price_currency.price')->get();
                                    }

                                    if (count($related) > 0) {
                                        foreach ($related as $r) {
//                                        dd($r->photo_url);
                                            if ($r->photo_url != null)
                                                $r->photo_url = URL::to('/') . '/items/' . $r->id . '/' . $r->photo_url;
                                            if ($language_id == 1) {
                                                $item_component = DB::table('component')
                                                    ->join('item_component', 'item_component.component_id', 'component.id')
                                                    ->join('item', 'item.id', 'item_component.item_id')
//                                        ->join('component_price_currency', 'component_price_currency.component_id', 'component.id')
//                                        ->join('account_currency', 'account_currency.id', 'component_price_currency.acc_currency_id')
                                                    ->where('item.id', $r->id)
//                                        ->where('account_currency.currency_id', $currency_id)
                                                    ->select('item_component.component_id as component_id', 'component.component_name_en as component_name')->get();

                                            } else {
                                                $item_component = DB::table('component')
                                                    ->join('item_component', 'item_component.component_id', 'component.id')
                                                    ->join('item', 'item.id', 'item_component.item_id')
                                                    ->where('item.id', $r->id)
                                                    ->select('item_component.component_id as component_id', 'component.component_name_ar as component_name')->get();
                                            }
                                            $r->item_component = $item_component;
                                        }
                                        $belongs = array_add($belongs, $j, $related[0]);
                                        $j++;
                                    }
                                }
                            }
//                        dd($belongs);

                            if ($belongs != null) {

                                $ret_data = array_add($ret_data, 'belongs', $belongs);
                            } else {
                                $ret_data = array_add($ret_data, 'belongs', array());

                            }
//                            $belongs = array();
//                            if ($item_belongings != null) {
//                                $j = 0;
//                                foreach ($item_belongings as $item_belonging) {
//                                    if ($language_id == 1) {
//                                        $related = DB::table('item')
//                                            ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
//                                            ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
//                                            ->where('item.id', $item_belonging->related_item_id)
//                                            ->where('account_currency.currency_id', $currency_id)
//                                            ->select('item.id', 'item.item_name_en as related_name', 'item.photo_url', 'item_price_currency.price')->get();
//                                    } else {
//                                        $related = DB::table('item')
//                                            ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
//                                            ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
//                                            ->where('item.id', $item_belonging->related_item_id)
//                                            ->where('account_currency.currency_id', $currency_id)
//                                            ->select('item.id', 'item.item_name_ar as related_name', 'item.photo_url', 'item_price_currency.price')->get();
//                                    }
//                                    if (count($related) > 0) {
//                                        foreach ($related as $r) {
////                                        dd($r->photo_url);
//                                            if ($r->photo_url != null)
//                                                $r->photo_url = URL::to('/') . '/items/' . $r->id . '/' . $r->photo_url;
//
//                                        }
//                                    }
////                                    array_push($belongs, $related);
//                                    $belongs = array_add($belongs, $j, $related[0]);
//                                    $j++;
//                                }
//                            }
////                        dd($belongs);
//
//                            if ($belongs != null) {
////                                array_add($ret_data, 'belongs', $belongs);
//                                array_push($ret_data, ['belongs' => $belongs]);
//                            } else {
//                                array_push($ret_data, ['belongs' => array()]);
//                            }
//                            dd($belongs,$components);
                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $ret_data;
                            return $response;
//                            } else {
//                                $response['msg'] = 'item not has component';
//                                $response['status'] = false;
//                                return $response;
//                            }
                        }
//                        $response['msg'] = 'successfully';
//                        $response['status'] = true;
//                        $response['ret_data'] = $offers;
//                        $response['total_rows'] = count($offers_count);
//                        $response['total_page'] = ceil(count($offers_count) / $limit);
//                        return $response;
                    } else {
                        $response['msg'] = 'error in active offer id';
                        $response['status'] = false;
                        return $response;
                    }

                } else {
                    $response['msg'] = 'There are no restaurants that deal with this currency';
                    $response['status'] = false;
                    return $response;
                }

            }

        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }

    function get_account_filters(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $language_id = $request->input('language_id');
                $filters = DB::table('filters_account')->select('id', 'filter_name')->get();
                $arr_filter = array();
                $arr_value_filter = array();
                $rate_arr = array(['id' => 1, 'title' => '1'], ['id' => 2, 'title' => '2'], ['id' => 3, 'title' => '3'], ['id' => 4, 'title' => '4'], ['id' => 5, 'title' => '5']);

                if ($language_id == 2) {

                    $work_status = DB::table('work_status')->select('id', 'status_name_ar as title')->get();
                    $i = 0;
                    $j = 0;
                    foreach ($filters as $filter) {
                        $filter = array($filter);
                        if ($filter[0]->filter_name == 'work_status') {
                            $filter[0]->values = $work_status;
                            $arr_value_filter = array_add($arr_value_filter, $j, $filter[0]);
                            $j++;
                        } elseif ($filter[0]->filter_name == 'rate_value') {
                            $filter[0]->values = $rate_arr;
                            $arr_value_filter = array_add($arr_value_filter, $j, $filter[0]);
                            $j++;
                        } else {
                            $filter[0]->values = '';
                            $arr_filter = array_add($arr_filter, $i, $filter[0]);
                            $i++;
                        }

                    }

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data']['with_value'] = $arr_value_filter;
                    $response['ret_data']['without_value'] = $arr_filter;
                    return $response;
                } else {

                    $work_status = DB::table('work_status')->select('id', 'status_name_en as title')->get();
                    $i = 0;
                    $j = 0;
                    foreach ($filters as $filter) {
                        $filter = array($filter);
                        if ($filter[0]->filter_name == 'work_status') {
                            $filter[0]->values = $work_status;
                            $arr_value_filter = array_add($arr_value_filter, $j, $filter[0]);
                            $j++;
                        } elseif ($filter[0]->filter_name == 'rate_value') {
                            $filter[0]->values = $rate_arr;
                            $arr_value_filter = array_add($arr_value_filter, $j, $filter[0]);
                            $j++;
                        } else {
                            $filter[0]->values = '';
                            $arr_filter = array_add($arr_filter, $i, $filter[0]);
                            $i++;
                        }

                    }

                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data']['with_value'] = $arr_value_filter;
                    $response['ret_data']['without_value'] = $arr_filter;
//                    $response['item_size'] = $item_size;
                    return $response;
                }

            }
            $response['msg'] = 'pad request method';
            $response['status'] = false;
            return $response;
        }
    }

    function get_tax_by_currency(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'currency_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $currency_id = $request->input('currency_id');
                $tax_value = DB::table('tax')
                    ->where('status_id', 1)
                    ->where('currency_id', $currency_id)->first();
                $response['msg'] = 'successfully';
                $response['status'] = true;
                $response['ret_data'] = $tax_value;

                return $response;


            }
            $response['msg'] = 'pad request method';
            $response['status'] = false;
            return $response;
        }
    }


    function search_request(Request $request)
    {

        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'language_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'currency_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $language_id = $request->input('language_id');
                $currency_id = $request->input('currency_id');
                $name = $request->input('name');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }

                if ($language_id == 1)
                    $select = 'select ac.id As account_id, ac.account_name ,work_status.status_name_en as status,ac.phone_number,ac.opening_time,ac.closing_time,ad.address,ad.latitude,ad.longitude,ac.logo_path';

                else
                    $select = 'select ac.id As account_id, ac.account_name ,work_status.status_name_ar as status,ac.phone_number,ac.opening_time,ac.closing_time,ad.address,ad.latitude,ad.longitude,ac.logo_path';

                $group_by = ' ';
                $from = 'from account as ac';
                $join = 'join account_currency ac_cu on ac_cu.account_id=ac.id
                    join address ad on ad.account_id=ac.id
                    join work_status on work_status.id=ac.work_status_id
                    join item on item.restaurant_id = ac.id
                    join item_price_currency ON item_price_currency.item_id=item.id
                    ';
                $where = 'where 1=1 and ac.account_type_id=2 and ac.status_id=1 and ac_cu.currency_id = ' . $currency_id . ' and item_price_currency.acc_currency_id =' . $currency_id;
                if ($name != null) {

                    $where .= ' and( item.item_name_en like \'%' . $name . '%\'' . ' or item.item_name_ar like\'%' . $name . '%\')';

                }
                if ($name != null) {
                    $where .= ' or ( ac.account_name like \'%' . $name . '%\')';
                }
                $group_by = ' group by account_id';
                \Illuminate\Support\Facades\DB::enableQueryLog();
                $q = $select . ' ' . $from . ' ' . $join . ' ' . $where . ' ' . $group_by;
                $res_count = DB::select($q);

//                dd(DB::getQueryLog());
                if (count($res_count) > 0) {
                    $query = $q . ' LIMIT ' . $offset . ', ' . $limit;
                    $res_count = \Illuminate\Support\Facades\DB::select($query);

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
            }
            $response['msg'] = 'pad request method';
            $response['status'] = false;
            return $response;
        }
    }
}
