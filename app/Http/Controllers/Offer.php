<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Offer_model;
use App\Models\offer_price;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use File;
use Illuminate\Support\Facades\DB;
use Redirect;

class Offer extends Controller
{
    //
    function add_offer(Request $request)
    {
        $item = new item();
        $cur_arr = $item->get_restaurant_currency();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'offerNameEn' => 'required|string|min:3|max:255',
                'offerNameAr' => 'required|string|min:3|max:255|regex:/(^[\s\p{Arabic}])/u',
                'sub_category' => 'required|numeric',
                'items' => 'required|numeric',
//                'offerPrice' => 'required|numeric',
                'offerPhoto' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'date' => 'required|date_format:m/d/Y',
//                'currency' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('add-offer')
                    ->withInput()
                    ->withErrors($validator);
            } else {
//                $currency = $request->input('currency');
                $offerNameEn = $request->input('offerNameEn');
                $offerNameAr = $request->input('offerNameAr');
                $sub_category = $request->input('sub_category');
                $items = $request->input('items');
//                $offerPrice = $request->input('offerPrice');
                $date = $request->input('date');
                $offerPhoto = null;
                if ($request->file('offerPhoto') != null)
                    $offerPhoto = $request->file('offerPhoto')->getClientOriginalName();

                $date = date("Y-m-d H:i:s", strtotime($date));
                $offers_model = new \App\Models\Offer_model();
                $offers = DB::table('offer')->where('created_by', auth::id())->where('approve', 1)
                    ->where('item_id', $items)->whereDate('offer.expiry_date', '>=', Carbon::now())->get();
                if ($offers == null) {
                    $offer_model = new \App\Models\Offer_model();
                    //  $date = $date . ' 00:00:00';
                    $offer_model->offer_name_en = $offerNameEn;
                    $offer_model->offer_name_ar = $offerNameAr;
                    $offer_model->item_id = $items;
//                $offer_model->price = $offerPrice;
//                $offer_model->offer_currency = $currency;
                    if ($offerPhoto != null)
                        $offer_model->offer_image = $offerPhoto;
                    $offer_model->created_by = Auth::id();
                    $offer_model->expiry_date = $date;
                    $offer_model->save();


                    for ($i = 1; $i <= count($cur_arr); $i++) {

                        $ite_price_model = new offer_price();
                        $ite_price_model->offer_id = $offer_model->id;
                        $ite_price_model->price = $request->input('offerPrice' . $cur_arr[$i - 1]->id);
                        $ite_price_model->acc_currency_id = $cur_arr[$i - 1]->id;
                        $ite_price_model->created_by = Auth::id();
                        $ite_price_model->save();
                    }

                    if ($offerPhoto != null) {
                        $file = $request->file('offerPhoto');

                        $filename = $offer_model->id;

                        $folder = public_path() . '/offers/' . $filename . '/';
                        $path = $folder;
                        if (!File::exists($path)) {

                            File::makeDirectory($path, $mode = 0777, true, true);
                            $file = $request->file('offerPhoto');
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
                                $file = $request->file('offerPhoto');
                                $originalFile = $file->getClientOriginalName();
                                $file->move($path, $originalFile);
                            }
                        }
                    }
                    return redirect()->route('show-offers');
                } else {
                    return Redirect::back()->withErrors(['msg' => 'selected meal has already offer']);
                }


            }
        }
//        dd($cur_arr);
        $item_controller = new item();
        $sub_cat_arr = $item_controller->get_restaurant_sub_category();
        $currency = DB::select('select * from currency');
        return view('layout/offer/add-offer', ['sub_cat_arr' => $sub_cat_arr, 'currency' => $currency, 'currency' => $cur_arr]);

    }

    function show_offers()
    {
        if (auth()->user()->cannot('show-offers') && auth()->user()->account_type_id == Account::IS_ADMIN) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $acct_type_id = Auth::user()->account_type_id;

        if ($acct_type_id == Account::IS_RESTAURANT) {
            $offers = Offer_model::where('created_by', auth::id())->whereNull('approve')->get();
        } else {
            $offers = Offer_model::whereNull('approve')->with('restaurant')->get();
        }

        return view('layout/offer/show-offers', ['offers' => $offers, 'acct_type_id' => $acct_type_id]);
    }

    function show_approved_offers()
    {
        if (auth()->user()->cannot('show-approved-offers') && auth()->user()->account_type_id == Account::IS_ADMIN) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $acct_type_id = Auth::user()->account_type_id;
        if ($acct_type_id != Account::IS_ADMIN)
            $offers = Offer_model::where('created_by', auth::id())->where('approve', 1)->get();
        else
            $offers = Offer_model::where('approve', 1)->get();

        return view('layout/offer/show-approved-offers', ['offers' => $offers, 'acct_type_id' => $acct_type_id]);
    }

    function show_rejected_offers()
    {
        if (auth()->user()->cannot('show-rejected-offers') && auth()->user()->account_type_id == Account::IS_ADMIN) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $acct_type_id = Auth::user()->account_type_id;
        if ($acct_type_id != Account::IS_ADMIN)
            $offers = Offer_model::where('created_by', auth::id())->whereNotNull('approve')->where('approve', 0)->get();
        else
            $offers = Offer_model::whereNotNull('approve')->where('approve', 0)->get();

        return view('layout/offer/show-rejected-offers', ['offers' => $offers, 'acct_type_id' => $acct_type_id]);
    }

    function show_offer_details($offer_id)
    {
        $offers_model = new \App\Models\Offer_model();
        $acct_type_id = Session::get('account_type_id');
        $item = new item();
        $cur_arr = $item->get_restaurant_currency();
        $item_controller = new item();
        $sub_cat_arr = $item_controller->get_restaurant_sub_category();
        $offer = DB::table('offer')->where('id', $offer_id)->first();
        $offer->expiry_date = date('m/d/Y', strtotime($offer->expiry_date));
        $item = DB::table('item')->where('id', $offer->item_id)->first();
//        $items = DB::table('item')->where('sub_cat_id', $item->sub_cat_id)->get();
        $currency = DB::select('select * from currency');
        $currency_added = offer_price::select('price', 'acc_currency_id')
            ->where('offer_id', $offer_id)->orderBy('acc_currency_id')->get();

        foreach ($cur_arr as $c) {
            foreach ($currency_added as $r) {
                if ($c->id == $r->acc_currency_id) {
                    $c->price = $r->price;
                }

            }
        }
//dd($sub_cat_arr);

        return view('layout/offer/show-offer-details', ['sub_cat_arr' => $sub_cat_arr, 'offer' => $offer, 'item' => $item, 'acct_type_id' => $acct_type_id, 'currency' => $cur_arr]);
    }

    function show_offer_details_admin($offer_id)
    {
        $acct_type_id = Auth::user()->account_type_id;
        $offer = DB::table('offer')->where('id', $offer_id)->first();
        $offer->expiry_date = date('m/d/Y', strtotime($offer->expiry_date));
        $item = DB::table('item')->where('id', $offer->item_id)->first();
        $sub_cat_arr = DB::table('sub_category')->join('restaurant_sub_category', 'restaurant_sub_category.sub_category_id', 'sub_category.id')->select('sub_category_name', 'restaurant_sub_category.id')->where('restaurant_sub_category.id', $item->sub_cat_id)->get();
        $currency_added = offer_price::select('price', 'acc_currency_id')
            ->where('offer_id', $offer_id)->orderBy('acc_currency_id')->get();
        $query = '
 select  cu.currency_name , acc_cu.id as id
 from account_currency as acc_cu
    join currency as cu  on cu.id=acc_cu.currency_id

 where  acc_cu.account_id =  ' . $item->restaurant_id . ' order by acc_cu.id asc ';
//                DB::enableQueryLog();
        $cur_arr = DB::select($query);
        foreach ($cur_arr as $c) {
            foreach ($currency_added as $r) {
                if ($c->id == $r->acc_currency_id) {
                    $c->price = $r->price;
                }

            }
        }
        return view('layout/offer/show-offer-details-admin', ['sub_cat_arr' => $sub_cat_arr, 'offer' => $offer, 'item' => $item, 'acct_type_id' => $acct_type_id, 'currency' => $cur_arr]);

    }

    function approve_offer(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'offer_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            }
            $offer_id = $request->input('offer_id');

            $offers_model = new \App\Models\Offer_model();
            $offers_model->exists = true;
            $offers_model->id = $offer_id;
            $offers_model->approve = 1;
            $offers_model->approved_date = Carbon::now()->toDateTimeString();
            $offers_model->approved_by = Auth::id();
            $offers_model->save();
            $response['msg'] = 'successfully';
            $response['status'] = true;
            return $response;
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }


    function reject_offer(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'offer_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            }
            $offer_id = $request->input('offer_id');

            $offers_model = new \App\Models\Offer_model();
            $offers_model->exists = true;
            $offers_model->id = $offer_id;
            $offers_model->approve = 0;
            $offers_model->approved_date = Carbon::now()->toDateTimeString();
            $offers_model->approved_by = Auth::id();
            $offers_model->save();
            $response['msg'] = 'successfully';
            $response['status'] = true;
            return $response;
        }

        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }


    function edit_offer(Request $request, $offer_id)
    {
        $item = new item();
        $cur_arr = $item->get_restaurant_currency();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'offerNameEn' => 'required|string|min:3|max:255',
                'offerNameAr' => 'required|string|min:3|max:255|regex:/(^[\s\p{Arabic}])/u',
                'sub_category' => 'required|numeric',
                'items' => 'required|numeric',
//                'offerPrice' => 'required|numeric',
                'offerPhoto' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'date' => 'required|date_format:m/d/Y',
//                'currency' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return redirect('edit-offer/' . $offer_id)
                    ->withInput()
                    ->withErrors($validator);
            } else {

//                $currency = $request->input('currency');
                $offerNameEn = $request->input('offerNameEn');
                $offerNameAr = $request->input('offerNameAr');
                $sub_category = $request->input('sub_category');
                $items = $request->input('items');
//                $offerPrice = $request->input('offerPrice');
                $date = $request->input('date');
                $offerPhoto = null;
//               dd( $request->input());
                if ($request->file('offerPhoto') != null)
                    $offerPhoto = $request->file('offerPhoto')->getClientOriginalName();

                $date = date("Y-m-d H:i:s", strtotime($date));

                if ($request->file('itemPhoto') != null)
                    $itemPhoto = $request->file('itemPhoto')->getClientOriginalName();
                $date = date("Y-m-d H:i:s", strtotime($date));

                $offer_model = new \App\Models\Offer_model();

                $offer_model->exists = true;
                $offer_model->id = $offer_id;
                $offer_model->offer_name_en = $offerNameEn;
                $offer_model->offer_name_ar = $offerNameAr;
                $offer_model->item_id = $items;
//                $offer_model->price = $offerPrice;
//                $offer_model->offer_currency = $currency;
                if ($offerPhoto != null)
                    $offer_model->offer_image = $offerPhoto;

                $offer_model->expiry_date = $date;
                $offer_model->save();

                $whereArray = array('offer_id' => $offer_id);

                $query = DB::table('offer_price_currency');
                foreach ($whereArray as $field => $value) {
                    $query->where($field, $value);
                }
                $query->delete();
                for ($i = 1; $i <= count($cur_arr); $i++) {
                    // dd($cur_arr[$i - 1]->id);
                    $ite_price_model = new offer_price();
                    $ite_price_model->offer_id = $offer_id;
                    $ite_price_model->price = $request->input('offerPrice' . $cur_arr[$i - 1]->id);
                    $ite_price_model->acc_currency_id = $cur_arr[$i - 1]->id;
                    $ite_price_model->created_by = Auth::id();
                    $ite_price_model->save();
                }
                $filename = $offer_id;
                if ($offerPhoto != null) {
                    $file = $request->file('offerPhoto');

                    $filename = $offer_model->id;

                    $folder = public_path() . '/offers/' . $filename . '/';
                    $path = $folder;

                    if (!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true, true);
                        $file = $request->file('offerPhoto');
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
                            $file = $request->file('offerPhoto');
                            $originalFile = $file->getClientOriginalName();
                            $file->move($path, $originalFile);
                        }
                    }
                }

                return redirect('show-offers')->with('status', "update successfully");// go to show categoryController

            }

        }


        $item_controller = new item();
        $sub_cat_arr = $item_controller->get_restaurant_sub_category();
        $offer = DB::table('offer')->where('id', $offer_id)->first();
        $offer->expiry_date = date('m/d/Y', strtotime($offer->expiry_date));
        $item = DB::table('item')->where('id', $offer->item_id)->first();
        $items = DB::table('item')->where('sub_cat_id', $item->sub_cat_id)
            ->where('restaurant_id', Auth::id())->get();
        $currency = DB::select('select * from currency');

        $currency_added = offer_price::select('price', 'acc_currency_id')
            ->where('offer_id', $offer_id)->orderBy('acc_currency_id')->get();

        foreach ($cur_arr as $c) {
            foreach ($currency_added as $r) {
                if ($c->id == $r->acc_currency_id) {
                    $c->price = $r->price;
                }

            }
        }


        return view('layout/offer/edit-offer', ['sub_cat_arr' => $sub_cat_arr, 'offer' => $offer, 'item' => $item, 'items' => $items, 'currency' => $cur_arr]);
    }


    public function delete(Offer_model $offer_model)
    {

        DB::transaction(function () use ($offer_model){
            DB::table('offer_price_currency')->where('offer_id', $offer_model->id)->delete();
            $offer_model->delete();
        });

        return response()->json([
            'status' => 'true',
            'message' => 'Offer has been deleted'
        ]);

    }

}
