<?php

namespace App\Http\Controllers;

use App\Models\item_price;
use Carbon\Carbon;
use URL;
use App\Models\components;
use App\Models\item_belongings;
use App\Models\item_component;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\RestaurantSubCategory;
use Illuminate\Support\Facades\Validator;
use Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;
use DB;
use File;
use Image;
use Storage;
use Illuminate\Filesystem\Filesystem;
use Session;

class item extends Controller
{

    function get_restaurant_sub_category()
    {
        $res_sub_cat_mode = new RestaurantSubCategory();
        $res = $res_sub_cat_mode->get_my_sub_cat(Auth::id());
//        dd($res);
        $sub_cat_arr = array();
        foreach ($res as $sub) {
            $sub_cat_mode = new SubCategory();
            $result = $sub_cat_mode->get_sub_cat_name($sub->sub_category_id);
            $sub->sub_category_name = $result[0]->sub_category_name;
            $sub->sub_category_name_ar = $result[0]->sub_category_name_ar;
            $sub->parent_cat_id = $result[0]->parent_cat_id;
//            array_push($sub_cat_arr, $result[0]);
        }
//        dd($res);
        return $res;
    }

    function get_menus_by_par(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'type_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $type_id = $request->input('type_id');
                $restaurant_id = \Illuminate\Support\Facades\Auth::id();
                $items_model = new \App\Models\item();
//                $items = $items_model::all()->where('restaurant_id', $restaurant_id)->where('sub_cat_id', $cat_id);
                $query = \Illuminate\Support\Facades\DB::table('sub_category')->join('restaurant_sub_category', 'restaurant_sub_category.sub_category_id', 'sub_category.id')->where('restaurant_sub_category.restaurant_id', $restaurant_id)->where('sub_category.parent_cat_id', $type_id)->select('sub_category.sub_category_name', 'sub_category.sub_category_name_ar', 'sub_category.parent_cat_id', 'restaurant_sub_category.id')->get();
//dd($query);
                if (count($query) > 0) {
                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data'] = $query;
                    return $response;

                } else {
                    $response['msg'] = 'no menu under this type';
                    $response['status'] = false;
                    return $response;
                }
            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;

    }

    function get_restaurant_currency()
    {
        $query = '
 select  cu.currency_name , acc_cu.id as id
 from account_currency as acc_cu
    join currency as cu  on cu.id=acc_cu.currency_id

 where  acc_cu.account_id =  ' . Auth::id() . ' order by acc_cu.id asc ';
//                DB::enableQueryLog();
        $res = DB::select($query);
        return $res;
    }

    function add_item(Request $request)
    {
        $cur_arr = $this->get_restaurant_currency();
        if ($request->isMethod('post')) {
            //  dd($request->input());
            $validator = Validator::make($request->all(), [
                'itemNameEn' => 'required|string|min:3|max:255',
                'itemNameAr' => 'required|string|min:3|max:255|regex:/(^[\s\p{Arabic}])/u',
                'sub_category' => 'required|numeric',
                //  'components' => 'required',
                'itemExecTime' => 'required|numeric',
//                'itemPrice' => 'required|numeric',
                'itemPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'mealStatus' => 'required|numeric',
                'mealSize' => 'required|numeric',
//                'hasDiscount' => 'required|numeric',
//                'discountType' => 'numeric|nullable',
//                'itemDiscount' => 'numeric|nullable',
//                'hasDiscount' => 'required|numeric',
                'discountType' => 'numeric|nullable',
                'itemDiscount' => 'numeric|nullable',
                'itemDescriptionAr' => 'required|string|regex:/(^[\s\p{Arabic}])/u',
                'itemDescriptionEn' => 'required|string'
//                'currency' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('add-item')
                    ->withInput()
                    ->withErrors($validator);
            } else {

                for ($i = 1; $i <= count($cur_arr); $i++) {

                    $v = $this->validate($request, ['itemPrice' . $cur_arr[$i - 1]->id => 'required|numeric']);
                    $v1 = $this->validate($request, ['currency' . $cur_arr[$i - 1]->id => 'required|string']);

                }

                $itemDescrEn = $request->input('itemDescriptionEn');
                $itemDescrAr = $request->input('itemDescriptionAr');

                $itemNameEn = $request->input('itemNameEn');
                $itemNameAr = $request->input('itemNameAr');
                $sub_category = $request->input('sub_category');
                $itemExecTime = $request->input('itemExecTime');
                $itemPhoto = $request->file('itemPhoto')->getClientOriginalName();
//                $itemPrice = $request->input('itemPrice');
//                $currency = $request->input('currency');
                $has_discount = 0;
//                if ($has_discount == 1) {
//                    $discount_type_id = $request->input('discountType');
//                    $discount_val = $request->input('discount_val');
//                } else {
                $discount_type_id = null;
                $discount_val = null;
//                }
                $item_status_id = $request->input('mealStatus');
                $item_size_id = $request->input('mealSize');
                $components = $request->input('components');
                $item_model = new \App\Models\item();
                $item_model->item_name_en = $itemNameEn;
                $item_model->item_name_ar = $itemNameAr;
                $item_model->sub_cat_id = $sub_category;
                $item_model->photo_url = $itemPhoto;
                $item_model->execution_time = $itemExecTime;
                $item_model->description_en = $itemDescrEn;
                $item_model->description_ar = $itemDescrAr;
//                $item_model->price = $itemPrice;
//                $item_model->item_currency = $currency;
                $item_model->has_discount = $has_discount;
                $item_model->discount_type_id = $discount_type_id;
                $item_model->discount_val = $discount_val;

                $item_model->item_status_id = $item_status_id;
                $item_model->item_size_id = $item_size_id;
                $item_model->restaurant_id = Auth::id();
                $item_model->created_by = Auth::id();

                $item_model->save();

                for ($i = 1; $i <= count($cur_arr); $i++) {

                    $ite_price_model = new item_price();
                    $ite_price_model->item_id = $item_model->id;
                    $ite_price_model->price = $request->input('itemPrice' . $cur_arr[$i - 1]->id);
                    $ite_price_model->acc_currency_id = $cur_arr[$i - 1]->id;
                    $ite_price_model->created_by = Auth::id();
                    $ite_price_model->save();
                }

                $filename = $item_model->id;
                //  dd(URL::to('/').'/public');
                //   $folder = URL::to('/').'/public/storage/items' . '/' . $filename ;
                // $folder = '/items/' . $filename.'/';
                $folder = public_path() . '/items/' . $filename . '/';
                // $folder = storage_path('/app/items/' . $filename . '/');
                //  dd($folder);
                $path = $folder;
                if (!File::exists($path)) {
                    //   File::makeDirectory($path,0777,true);
                    /*dd('fff');*/
                    File::makeDirectory($path, $mode = 0777, true, true);
                    $file = $request->file('itemPhoto');
                    $originalFile = $file->getClientOriginalName();
//                    dD($originalFile);
                    $file->move($path, $originalFile);
                } else {
                    $FileSystem = new Filesystem();
                    $directory = $folder;

                    if ($FileSystem->exists($directory)) {
                        // Get all files in this directory.
                        $files = $FileSystem->files($directory);
                        // Check if directory is empty.
                        if (!empty($files)) {
                            $FileSystem->delete($files);
                        }
                        $file = $request->file('itemPhoto');
                        $originalFile = $file->getClientOriginalName();
                        $file->move($path, $originalFile);
                    }
                }
                $item_id = $item_model->id;
                if ($components != null && count($components) > 0) {
                    for ($i = 0; $i < count($components); $i++) {
                        $item_component_model = new item_component();
                        $item_component_model->item_id = $item_id;
                        $item_component_model->component_id = $components[$i];
                        $item_component_model->created_by = Auth::id();
                        $item_component_model->save();
                    }
                }
                $items = DB::table('item')->where('restaurant_id', Auth::id())->get();
                $count = $items->count();
                if ($count > 1)
                    //$string = implode(",", $components);
                    return redirect()->route('add-belongings', ['item_id' => $item_id]);
                else
                    return redirect()->route('show-items');

            }
        }

        $sub_cat_arr = $this->get_restaurant_sub_category();
//        dd($sub_cat_arr);
        $discount_type = DB::select('select * from discount_type');
        $item_status = DB::select('select * from item_status');
        $item_size = DB::select('select * from item_size');
        $types = DB::select('select * from parent_sub_category');
        $components = \App\Models\components::all()->where('created_by', Auth::id());
        return view('layout/item/add-item', ['components' => $components, 'sub_cat_arr' => $sub_cat_arr, 'discount_type' => $discount_type, 'item_status' => $item_status, 'item_size' => $item_size, 'currency' => $cur_arr, 'types' => $types]);
    }

    function show_items()
    {
        $items_model = new \App\Models\item();
        $acct_type_id = Session::get('account_type_id');

        $items = $items_model::all()->where('restaurant_id', auth::id());

//        foreach ($items as $item) {
//            $sub_cat_model = new RestaurantSubCategory();
//            $name = $sub_cat_model->get_my_sub_name( auth::id(),$item->sub_cat_id)[0]->sub_category_name;
//            $item['sub_cat_name'] = $name;
//        }
//          dd($items);
        return view('layout/item/show-items', ['items' => $items]);

    }

    function edit_item($item_id, Request $request)
    {
        $cur_arr = $this->get_restaurant_currency();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'itemNameEn' => 'required|string|min:3|max:255',
                'itemNameAr' => 'required|string|min:3|max:255|regex:/(^[\s\p{Arabic}])/u',
                'sub_category' => 'required|numeric',
                // 'components' => 'required',
                'itemExecTime' => 'required|numeric',
//                'itemPrice' => 'required|numeric',
                'itemPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'mealStatus' => 'required|numeric',
                'mealSize' => 'required|numeric',
//                'hasDiscount' => 'required|numeric',
//                'discountType' => 'numeric|nullable',
//                'itemDiscount' => 'numeric|nullable',
                'belongings' => 'nullable',
                'itemDescriptionAr' => 'required|string|regex:/(^[\s\p{Arabic}])/u',
                'itemDescriptionEn' => 'required|string'
//                'currency' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            } else {
                for ($i = 1; $i <= count($cur_arr); $i++) {
                    // dd($cur_arr[$i - 1]->id);
//                    if ($request->input('itemPrice' . $cur_arr[$i - 1]->id) == null && $request->input('currency' . $cur_arr[$i - 1]->id) == null) {
//                        $validator = 'enter valid price for each currency';
//                        return back()
//                            ->withInput()
//                            ->withErrors($validator);
//                    } else {
                    $v = $this->validate($request, ['itemPrice' . $cur_arr[$i - 1]->id => 'required|numeric']);
                    $v1 = $this->validate($request, ['currency' . $cur_arr[$i - 1]->id => 'required|string']);


//                    }
                }
//                dd($request->input());
                $itemDescrEn = $request->input('itemDescriptionEn');
                $itemDescrAr = $request->input('itemDescriptionAr');
                $itemNameEn = $request->input('itemNameEn');
                $itemNameAr = $request->input('itemNameAr');
                $sub_category = $request->input('sub_category');
                $itemExecTime = $request->input('itemExecTime');
                if ($request->file('itemPhoto') != null)
                    $itemPhoto = $request->file('itemPhoto')->getClientOriginalName();
//                $itemPrice = $request->input('itemPrice');

                $has_discount = 0;
                //  dd($has_discount,$request->input('discount_type'),$request->input('itemDiscount'));
//                if ($has_discount == 1) {
//                    $discount_type_id = $request->input('discount_type');
//                    $discount_val = $request->input('itemDiscount');
//                } else {
                $discount_type_id = null;
                $discount_val = null;
//                }
                $item_status_id = $request->input('mealStatus');
                $item_size_id = $request->input('mealSize');
//                $currency = $request->input('currency');
                $filename = $item_id;
                if ($request->file('itemPhoto') != null) {
                    // $folder = storage_path('/app/items/' . $filename . '/');

                    $folder = public_path() . '/items/' . $filename . '/';
                    $path = $folder;
                    if (!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true, true);
                        $file = $request->file('itemPhoto');
                        $originalFile = $file->getClientOriginalName();
                        $file->move($path, $originalFile);
                    } else {
                        $FileSystem = new Filesystem();
                        $directory = $folder;

                        if ($FileSystem->exists($directory)) {
                            // Get all files in this directory.
                            $files = $FileSystem->files($directory);
                            // Check if directory is empty.
                            if (!empty($files)) {
                                $FileSystem->delete($files);
                            }
                            $file = $request->file('itemPhoto');
                            $originalFile = $file->getClientOriginalName();
                            $file->move($path, $originalFile);
                        }
                    }
                }


                $item_model = new \App\Models\item();
                $item_model->exists = true;
                $item_model->id = $item_id;
                $item_model->item_name_en = $itemNameEn;
                $item_model->item_name_ar = $itemNameAr;
                $item_model->sub_cat_id = $sub_category;
                $item_model->execution_time = $itemExecTime;
                $item_model->description_en = $itemDescrEn;
                $item_model->description_ar = $itemDescrAr;

                if ($request->file('itemPhoto') != null)
                    $item_model->photo_url = $itemPhoto;
//                $item_model->price = $itemPrice;
//                $item_model->item_currency = $currency;
                $item_model->has_discount = $has_discount;
                $item_model->discount_type_id = $discount_type_id;
                $item_model->discount_val = $discount_val;

                $item_model->item_status_id = $item_status_id;
                $item_model->item_size_id = $item_size_id;
                $item_model->restaurant_id = Auth::id();
                $item_model->created_by = Auth::id();

                $item_model->save();


                $whereArray = array('item_id' => $item_id);

                $query = DB::table('item_price_currency');
                foreach ($whereArray as $field => $value) {
                    $query->where($field, $value);
                }
                $query->delete();
                for ($i = 1; $i <= count($cur_arr); $i++) {
                    // dd($cur_arr[$i - 1]->id);
                    $ite_price_model = new item_price();
                    $ite_price_model->item_id = $item_id;
//                    $ite_price_model->exists = true;
                    $ite_price_model->price = $request->input('itemPrice' . $cur_arr[$i - 1]->id);
                    $ite_price_model->acc_currency_id = $cur_arr[$i - 1]->id;
                    $ite_price_model->created_by = Auth::id();
                    $ite_price_model->save();
                }

                $whereArray = array('item_id' => $item_id);
                $query = DB::table('item_component');
                foreach ($whereArray as $field => $value) {
                    $query->where($field, $value);
                }
                $query->delete();

                $components = $request->input('components');

                if ($components != null && count($components) > 0) {
                    for ($i = 0; $i < count($components); $i++) {
                        $item_component_model = new item_component();
                        $item_component_model->item_id = $item_id;
                        $item_component_model->component_id = $components[$i];
                        $item_component_model->created_by = Auth::id();
                        $item_component_model->save();
                    }
                }


                $whereArray = array('item_id' => $item_id);

                $query = DB::table('item_belongings');
                foreach ($whereArray as $field => $value) {
                    $query->where($field, $value);
                }
                $query->delete();
                $belongings = $request->input('belongings');
                if ($belongings) {
                    for ($i = 0; $i < count($belongings); $i++) {
                        $item_belongings = new \App\Models\item_belongings();
                        $item_belongings->item_id = $item_id;
                        $item_belongings->related_item_id = $belongings[$i];
                        $item_belongings->created_by = Auth::id();
                        $item_belongings->save();
                    }
                }
                return redirect('show-items')->with('status', "update successfully");// go to show categoryController
            }

        }
        $item_model = new \App\Models\item();
        $item = $item_model::find($item_id);

        $item_components_db = item_component::where('item_id', $item_id)->get('component_id');
        $item_belongs_db = item_belongings::where('item_id', $item_id)->get('related_item_id');
        $item_components = array();
        $item_belongs = array();
        for ($i = 0; $i < count($item_components_db); $i++) {

            array_push($item_components, $item_components_db[$i]->component_id);
        }
        for ($i = 0; $i < count($item_belongs_db); $i++) {

            array_push($item_belongs, $item_belongs_db[$i]->related_item_id);
        }
        $item->item_url = 'items/' . $item_id . '/' . $item->photo_url;
        $sub_cat_arr = $this->get_restaurant_sub_category();
        $types = DB::select('select * from parent_sub_category');
        $discount_type = DB::select('select * from discount_type');
        $item_status = DB::select('select * from item_status');
        $item_size = DB::select('select * from item_size');
        $currency = DB::select('select * from currency');
        $currency_added = item_price::select('price', 'acc_currency_id')
            ->where('item_id', $item_id)->orderBy('acc_currency_id')->get();

        $arr = array();
        foreach ($cur_arr as $c) {
            foreach ($currency_added as $r) {
                if ($c->id == $r->acc_currency_id) {

                    $c->price = $r->price;

                }

            }
        }
        $query = \Illuminate\Support\Facades\DB::table('sub_category')->join('restaurant_sub_category', 'restaurant_sub_category.sub_category_id', 'sub_category.id')->join('parent_sub_category', 'parent_sub_category.id', 'sub_category.parent_cat_id')->where('restaurant_sub_category.id', $item->sub_cat_id)->select('parent_sub_category.id')->get();

//dd($query[0]->id);
//        dd($item);
        return view('layout/item/edit-item', ['item' => $item, 'item_components' => $item_components, 'item_belongs' => $item_belongs, 'sub_cat_arr' => $sub_cat_arr, 'discount_type' => $discount_type, 'item_status' => $item_status, 'item_size' => $item_size, 'currency' => $cur_arr, 'types' => $types, 'types_par' => $query[0]->id, 'my_id' => Auth::id()]);

    }

    function get_items_restaurant_by_menu_id(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'menu_id' => 'required|numeric',
                'restaurant_id' => 'required|numeric',
                'currency_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
                'language_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $menu_id = $request->input('menu_id');
                $source_id = $request->input('source_id');
                $restaurant_id = $request->input('restaurant_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }

                $currency_id = $request->input('currency_id');
                $language_id = $request->input('language_id');
                $resturant = DB::table('account')
                    ->join('item', 'item.restaurant_id', 'account.id')
                    ->where('account.id', $restaurant_id)
                    ->where('account.status_id', 1)->first();
                if ($resturant != null) {
                    $items_count = DB::table('item')
                        ->join('item_price_currency as item_price', 'item_price.item_id', 'item.id')
                        ->join('account_currency', 'item_price.acc_currency_id', 'account_currency.id')
                        ->where('item.restaurant_id', $restaurant_id)
                        ->where('item.item_status_id', 1)
                        ->where('item.sub_cat_id', $menu_id)
                        ->where('account_currency.currency_id', $currency_id)
                        ->select('item.id as item_id', 'item.item_name_en as item_name', 'item.execution_time', 'item.photo_url', 'item_price.price')
                        ->get();
                    if ($language_id == 1) {
                        $items = DB::table('item')
                            ->join('item_price_currency as item_price', 'item_price.item_id', 'item.id')
                            ->join('account_currency', 'item_price.acc_currency_id', 'account_currency.id')
                            ->where('item.restaurant_id', $restaurant_id)
                            ->where('item.item_status_id', 1)
                            ->where('item.sub_cat_id', $menu_id)
                            ->where('account_currency.currency_id', $currency_id)
                            ->select('item.id as item_id', 'item.item_name_en as item_name', 'item.execution_time', 'item.photo_url', 'item_price.price')
                            ->offset($offset)
                            ->limit($limit)
                            ->get();
//                            dd($items);
                    } else {
                        $items = DB::table('item')
                            ->join('item_price_currency as item_price', 'item_price.item_id', 'item.id')
                            ->join('account_currency', 'item_price.acc_currency_id', 'account_currency.id')
                            ->where('item.restaurant_id', $restaurant_id)
                            ->where('item.item_status_id', 1)
                            ->where('item.sub_cat_id', $menu_id)
                            ->where('account_currency.currency_id', $currency_id)
                            ->select('item.id as item_id', 'item.item_name_ar as item_name', 'item.execution_time', 'item.photo_url', 'item_price.price')
                            ->offset($offset)
                            ->limit($limit)
                            ->get();
//                            dd($items);
                    }

                    if ($items != null) {
                        foreach ($items as $item) {
                            $item->photo_url = URL::to('/') . '/items/' . $item->item_id . '/' . $item->photo_url;
                            // $item->photo_url = storage_path('/app/items/' . $item->id . '/') . $item->photo_url;
                        }
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $items;
                        $response['total_row'] = count($items_count);
                        $response['total_page'] = ceil(count($items_count) / $limit);
                        return $response;
                    } else {
                        $response['msg'] = 'restaurant not have items';
                        $response['status'] = false;

                        return $response;
                    }


                } else {
                    $response['msg'] = 'Restaurant account is inactive or not has meals';
                    $response['status'] = false;
                    return $response;
                }


            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }

    function get_item_details(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
//                'source_id' => 'required|numeric',
//                'restaurant_id' => 'required|numeric',
                'item_id' => 'required|numeric',
                'language_id' => 'required|numeric',
                'currency_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
//                $source_id = $request->input('source_id');
                $language_id = $request->input('language_id');
                $currency_id = $request->input('currency_id');
//                $restaurant_id = $request->input('restaurant_id');
                $item_id = $request->input('item_id');
//                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first();
//                if ($customer != null) {
                if ($language_id == 1) {
                    $items = DB::table('item')
                        ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                        ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                        ->where('item.id', $item_id)->where('item_status_id', 1)
                        ->where('account_currency.currency_id', $currency_id)
                        ->select('item.id', 'item.item_name_en as item_name', 'description_en as description', 'photo_url', 'item_price_currency.price')->get();

                } else {
                    $items = DB::table('item')
                        ->join('item_price_currency', 'item_price_currency.item_id', 'item.id')
                        ->join('account_currency', 'account_currency.id', 'item_price_currency.acc_currency_id')
                        ->where('item.id', $item_id)->where('item_status_id', 1)
                        ->where('account_currency.currency_id', $currency_id)
                        ->select('item.id', 'item.item_name_ar as item_name', 'description_ar as description', 'photo_url', 'item_price_currency.price')->get();

                }

                if (count($items) > 0) {
                    if ($items[0]->photo_url != null)
                        $items[0]->photo_url = URL::to('/') . '/items/' . $items[0]->id . '/' . $items[0]->photo_url;
                    $item_offer = DB::table('offer')
                        ->where('item_id', $item_id)
                        ->whereDate('offer.expiry_date', '>=', Carbon::now())
                        ->where('offer.approve', '=', 1)->select('id')->first();
                    if ($item_offer != null) {
                        $items[0]->offer_id = $item_offer->id;
                    } else {
                        $items[0]->offer_id = null;
                    }

                    $ret_data = array();
                    $ret_data = array_add($ret_data, 'item_details', $items[0]);

                    if ($items != null) {
                        //   $items = DB::table('item')->where('restaurant_id', $restaurant_id)->where('item_status_id', 1)->get();

                        $item_components = DB::table('item_component')->where('item_id', $item_id)->get();
//                    dd($item_components);
                        $item_belongings = DB::table('item_belongings')->where('item_id', $item_id)->get();
//                        dd($item_belongings);

                        if ($item_components != null || $item_belongings != null) {

                            $components = array();
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
//                            dd($components);
                            if ($components != null) {
//                               $rs= array_merge($ret_data,$components);
                                $ret_data = array_add($ret_data, "components", $components);

//                                array_add($ret_data, 'components', $components);
//                                $ret_data->components=$components;
//                                dd($ret_data);
//                                array_add($ret_data, 'components', $components);
//                                array_push($ret_data, 'components' => $components);
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
//                                            $belongs = array_add($belongs, $j, $r);
//                                            $j++;
                                        }
                                        $belongs = array_add($belongs, $j, $related[0]);
                                        $j++;
                                    }
//                                    dd($related[0]);

//                                    $j++;
//                                    array_push($belongs, $related);

                                }
                            }
//                        dd($belongs);

                            if ($belongs != null) {
//                                array_add($ret_data, 'belongs', $belongs);
//                                array_push($ret_data, ['belongs' => $belongs]);
                                $ret_data = array_add($ret_data, 'belongs', $belongs);
                            } else {
                                $ret_data = array_add($ret_data, 'belongs', array());

                            }
//                            dd($belongs,$components);
                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $ret_data;
                            return $response;
                        } else {
                            $response['msg'] = 'item not has component';
                            $response['status'] = false;
                            return $response;
                        }
                    }


                } else {
                    $response['msg'] = 'please check item id';
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

    function get_items_by_cat(Request $request)
    {
        $response = default_ret_array();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'cat_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $cat_id = $request->input('cat_id');
                $restaurant_id = \Illuminate\Support\Facades\Auth::id();
                $items_model = new \App\Models\item();
                $items = \Illuminate\Support\Facades\DB::table('item')
                    ->where('item_status_id', 1)
                    ->where('restaurant_id', $restaurant_id)
                    ->where('sub_cat_id', $cat_id)->get();

                if (count($items) > 0) {
                    $response['msg'] = 'successfully';
                    $response['status'] = true;
                    $response['ret_data'] = $items;
                    return $response;

                } else {
                    $response['msg'] = 'no items under this category';
                    $response['status'] = false;
                    return $response;
                }
            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }

    function get_last_items(Request $request)
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

                $query = 'select count(*) as total_row from(
 select  item.item_name_en as item_name, sub_category.sub_category_name,address.address,address.latitude,address.longitude
 from item

     join restaurant_sub_category on restaurant_sub_category.id=item.sub_cat_id
      join sub_category on sub_category.id=restaurant_sub_category.sub_category_id
      join account on account.id=item.restaurant_id
      join address on address.account_id=account.id
      join account_currency on account_currency.account_id=account.id
 where  sub_category.parent_cat_id = 1 and
       item.item_status_id=1
   and account.account_type_id=2
   and account_currency.currency_id=' . $currency_id . '
                           ) t';
//                DB::enableQueryLog();
                $res = DB::select($query);
//                dd($res);
//                dd(DB::getQueryLog());
                if ($res[0]->total_row > 0) {
                    $response['total_row'] = $res[0]->total_row;
                    $response['page_count'] = ceil($res[0]->total_row / $limit);
                    DB::enableQueryLog();
                    if ($language_id == 1)
                        $items = DB::table('item')
                            ->selectRaw("item.id,item.photo_url,item.item_name_en as item_name,sub_category.sub_category_name,address.address,address.latitude,address.longitude")
                            ->join('restaurant_sub_category', 'restaurant_sub_category.id', 'item.sub_cat_id')
                            ->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')
                            ->join('account', 'account.id', 'item.restaurant_id')
                            ->join('address', 'address.account_id', 'account.id')
                            ->join('account_currency', 'account_currency.account_id', 'account.id')
//                            ->where('sub_category.parent_cat_id', 1)
                            ->where('account.account_type_id', 2)
                            ->where('item.item_status_id', 1)
                            ->where('account_currency.currency_id', $currency_id)
                            ->offset($offset)
                            ->limit($limit)
                            ->inRandomOrder()
//                            ->orderBy(DB::raw('RAND()'))
                            ->get();
                    else
                        $items = DB::table('item')
                            ->selectRaw("item.id ,item.photo_url,item.item_name_ar as item_name,sub_category.sub_category_name_ar as sub_category_name,address.address,address.latitude,address.longitude")
                            ->join('restaurant_sub_category', 'restaurant_sub_category.id', 'item.sub_cat_id')
                            ->join('sub_category', 'sub_category.id', 'restaurant_sub_category.sub_category_id')
                            ->join('account', 'account.id', 'item.restaurant_id')
                            ->join('address', 'address.account_id', 'account.id')
                            ->join('account_currency', 'account_currency.account_id', 'account.id')
                            ->where('sub_category.parent_cat_id', 1)
                            ->where('account.account_type_id', 2)
                            ->where('item.item_status_id', 1)
                            ->where('account_currency.currency_id', $currency_id)
                            ->offset($offset)
                            ->limit($limit)
                            ->inRandomOrder()
//                            ->orderBy(DB::raw('RAND()'))
                            ->get();

//                    dd(DB::getQueryLog());

                    if (count($items) > 0) {
                        foreach ($items as $item) {
                            if ($item->photo_url != null)
                                $item->photo_url = URL::to('/') . '/items/' . $item->id . '/' . $item->photo_url;

                            if ($language_id == 1) {
                                $item_component = DB::table('component')
                                    ->join('item_component', 'item_component.component_id', 'component.id')
                                    ->join('item', 'item.id', 'item_component.item_id')
//                                        ->join('component_price_currency', 'component_price_currency.component_id', 'component.id')
//                                        ->join('account_currency', 'account_currency.id', 'component_price_currency.acc_currency_id')
                                    ->where('item.id', $item->id)
//                                        ->where('account_currency.currency_id', $currency_id)
                                    ->select('item_component.component_id as component_id', 'component.component_name_en as component_name')->get();

                            } else {
                                $item_component = DB::table('component')
                                    ->join('item_component', 'item_component.component_id', 'component.id')
                                    ->join('item', 'item.id', 'item_component.item_id')
                                    ->where('item.id', $item->id)
                                    ->select('item_component.component_id as component_id', 'component.component_name_ar as component_name')->get();
                            }
                            $item->item_component = $item_component;
                        }

//                        dd($items);
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $items;


                        return $response;

                    } else {
                        $response['msg'] = 'no items available or There are no priced meals for this currency';
                        $response['status'] = false;
                        return $response;
                    }
                } else {
                    $response['msg'] = 'There are no restaurants that deal with this currency';
                    $response['status'] = false;
                    return $response;
                }


            }

            $response['msg'] = 'pad request  method';
            $response['status'] = false;
            return $response;
        }
    }

    function get_trend(Request $request)
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
                $language_id = $request->input('language_id');
                $limit = $request->input('limit');
                $offset = $request->input('offset');

                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                $currency_id = $request->input('currency_id');
                $time = Carbon::now()->subDays(60);
//dd($time);
                $query = '
SELECT count(order_items.item_id) as total_req, order_items.item_id,item.item_name_en,item.photo_url,sub_category.sub_category_name_ar,account.account_name,address.address,address.latitude,address.longitude
FROM `order_items`
    join orders on  orders.id = order_items.order_id
    join item on item.id=order_items.item_id
    join restaurant_sub_category on restaurant_sub_category.id=item.sub_cat_id
    join sub_category on sub_category.id=restaurant_sub_category.sub_category_id
    join account on account.id=item.restaurant_id
    join address on address.account_id=account.id
    join account_currency on account_currency.account_id=account.id
where account_currency.currency_id = ' . $currency_id . ' and item.item_status_id= 1 and orders.created_at > ' . "'$time'" . '
GROUP BY order_items.item_id,item.item_name_en,item.photo_url,sub_category.sub_category_name_ar,account.account_name,address.address,address.latitude,address.longitude
ORDER BY total_req DESC
';
//                DB::enableQueryLog();
                $res = DB::select($query);
//                dd($res);
//                dd(DB::getQueryLog());
                if (count($res) > 0) {
                    $response['total_row'] = count($res);
                    $response['page_count'] = ceil(count($res) / $limit);
                    if ($language_id == 1) {
                        $query = '
SELECT count(order_items.item_id) as total_req, order_items.item_id  as id,item.item_name_en as item_name,item.photo_url,sub_category.sub_category_name,address.address,address.latitude,address.longitude
FROM `order_items`
join orders on  orders.id = order_items.order_id
join item on item.id=order_items.item_id
 join restaurant_sub_category on restaurant_sub_category.id=item.sub_cat_id
    join sub_category on sub_category.id=restaurant_sub_category.sub_category_id
join account on account.id=item.restaurant_id
join address on address.account_id=account.id
join account_currency on account_currency.account_id=account.id
where account_currency.currency_id =' . $currency_id . ' and item.item_status_id= 1  and orders.created_at > ' . "'$time'" . '
GROUP BY order_items.item_id,item.item_name_en,item.photo_url,sub_category.sub_category_name,account.account_name,address.address,address.latitude,address.longitude
ORDER BY total_req DESC
Limit ' . $offset . ' , ' . $limit;

                        $result = DB::select($query);
//                        dd($result);
                    } else {
                        $query = '
SELECT count(order_items.item_id) as total_req, order_items.item_id  as id,item.item_name_ar as item_name,item.photo_url,sub_category.sub_category_name_ar as  sub_category_name,address.address,address.latitude,address.longitude
FROM `order_items`
join orders on  orders.id = order_items.order_id
join item on item.id=order_items.item_id
 join restaurant_sub_category on restaurant_sub_category.id=item.sub_cat_id
    join sub_category on sub_category.id=restaurant_sub_category.sub_category_id
join account on account.id=item.restaurant_id
join address on address.account_id=account.id
join account_currency on account_currency.account_id=account.id
where account_currency.currency_id =' . $currency_id . ' and item.item_status_id= 1  and orders.created_at > ' . "'$time'" . '
GROUP BY order_items.item_id,item.item_name_ar,item.photo_url,sub_category.sub_category_name_ar,account.account_name,address.address,address.latitude,address.longitude
ORDER BY total_req DESC
Limit ' . $offset . ' , ' . $limit;

                        $result = DB::select($query);
//                    dd($result);
                    }

                    if (count($result) > 0) {
//                        dd($result);
                        foreach ($result as $item) {
                            if ($item->photo_url != null)
                                $item->photo_url = URL::to('/') . '/items/' . $item->id . '/' . $item->photo_url;

                            if ($language_id == 1) {
                                $item_component = DB::table('component')
                                    ->join('item_component', 'item_component.component_id', 'component.id')
                                    ->join('item', 'item.id', 'item_component.item_id')
                                    ->where('item.id', $item->id)
                                    ->select('item_component.component_id as component_id', 'component.component_name_en as component_name')->get();

                            } else {
                                $item_component = DB::table('component')
                                    ->join('item_component', 'item_component.component_id', 'component.id')
                                    ->join('item', 'item.id', 'item_component.item_id')
                                    ->where('item.id', $item->id)
                                    ->select('item_component.component_id as component_id', 'component.component_name_ar as component_name')->get();
                            }
                            $item->item_component = $item_component;
                        }

//                        dd($items);
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $result;


                        return $response;

                    } else {
                        $response['msg'] = 'no items available';
                        $response['status'] = false;
                        return $response;
                    }
                } else {
                    $response['msg'] = 'There are no restaurants that deal with this currency';
                    $response['status'] = false;
                    return $response;
                }

            }
//        }
            $response['msg'] = 'pad request  method';
            $response['status'] = false;
            return $response;
        }
    }

    function get_items_by_filters(Request $request)
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
//                'item_name_en' => 'nullable|string',
                'size' => 'nullable|numeric',

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
//                dd($item_name_en);
                $item_name_en = null;
                $item_name_ar = null;
                $name = null;
                if ($request->input('name') != null) {
                    $name = $request->input('name');
//                    $item_name_ar = null;
                }
//                if ($request->input('item_name_ar') != null) {
//                    $item_name_ar = $request->input('item_name_ar');
////                    $item_name_en = null;
//                }
//                dd($item_name_en);
                $size = $request->input('size');

                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
                $account_currency_id = DB::table('account_currency')->where('currency_id', $currency_id)->select('id')->first();
//                dd($account_currency_id->id);
                if ($size != null || $name != null || $min_price != null || $max_price != null) {
                    $select = 'select item.id As item_id, item.execution_time ,item.photo_url,item_price_currency.price';
                    if ($language_id == 1) {
                        $select .= ' ,item.item_name_en as item_name';
                    } else {
                        $select .= ' ,item.item_name_ar as item_name';
                    }
                    $join = ' join item_price_currency ON item_price_currency.item_id=item.id';
                    $from = 'from item';
                    $where = 'where 1=1  and item.item_status_id= 1 and item_price_currency.acc_currency_id = ' . $account_currency_id->id;
                    if ($name != null) {
                        $where .= ' and ( item.item_name_en like \'%' . $name . '%\'' . ' or item.item_name_ar like\'%' . $name . '%\')';
                    }
//                    if ($item_name_ar != null) {
//                        $where .= ' and item.item_name_ar like \'%' . $item_name_ar . '%\'';
//                    }
                    if ($size != null) {
                        $where .= ' and item.item_size_id =' . $size;
                    }
                    if ($min_price != null && $max_price != null) {
                        $where .= ' and item_price_currency.price >=' . $min_price . ' and item_price_currency.price<=' . $max_price;
                    }
                    $q = $select . ' ' . $from . ' ' . $join . ' ' . $where;
//                    dd($q);
                    $res_count = DB::select($q);
                    if (count($res_count) > 0) {
                        $query = $q . ' LIMIT ' . $offset . ', ' . $limit;
                        $res_count = DB::select($query);
                        if (count($res_count) > 0) {
                            foreach ($res_count as $item) {
                                if ($item->photo_url != null)
                                    $item->photo_url = URL::to('/') . '/items/' . $item->item_id . '/' . $item->photo_url;
                            }
                            $response['msg'] = 'successfully';
                            $response['status'] = true;
                            $response['ret_data'] = $res_count;
                            $response['page_count'] = ceil(count($res_count) / $limit);
                            $response['total_rows'] = count($res_count);
                            return $response;
                        } else {
                            $response['msg'] = 'There is no meal within the applied filters';
                            $response['status'] = false;
                            return $response;
                        }
                    } else {
                        $response['msg'] = 'There are no meals within the applied filters';
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
}
