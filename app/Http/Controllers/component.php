<?php

namespace App\Http\Controllers;

use App\Models\component_price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\components;
use Auth;
use DB;
class component extends Controller
{
    //

    function add_component(Request $request)
    {

        $item_controller = new item();
        $cur_arr = $item_controller->get_restaurant_currency();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'componentNameEn' => 'required|string|min:3|max:255',
                'componentNameAr' => 'required|string|min:2|max:255|regex:/(^[\s\p{Arabic}])/u',
//                'componentPrice' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return redirect('add-component')
                    ->withInput()
                    ->withErrors($validator);

            } else {
//                for ($i = 1; $i <= count($cur_arr); $i++) {
//
//                    $v = $this->validate($request, ['componentPrice' . $cur_arr[$i - 1]->id => 'required|numeric']);
//                    $v1 = $this->validate($request, ['currency' . $cur_arr[$i - 1]->id => 'required|string']);
//
//                }

                $componentNameEn = $request->input('componentNameEn');
                $componentNamear = $request->input('componentNameAr');
//                $componentPrice = $request->input('componentPrice');
                $components_model = new components();
                $components_model->component_name_en = $componentNameEn;
                $components_model->component_name_ar = $componentNamear;
                $components_model->created_by = Auth::id();
                $components_model->save();
//                for ($i = 1; $i <= count($cur_arr); $i++) {
//
//                    $component_price_model = new component_price();
//                    $component_price_model->component_id = $components_model->id;
//                    $component_price_model->price = $request->input('componentPrice' . $cur_arr[$i - 1]->id);
//                    $component_price_model->acc_currency_id = $cur_arr[$i - 1]->id;
//                    $component_price_model->created_by = Auth::id();
//                    $component_price_model->save();
//                }
                return redirect('show-components')->with('status', "Insert successfully");

            }
        }

        return view('layout/component/add-component');

//        return view('layout/component/add-component', ['currency' => $cur_arr]);
    }

    function show_component()
    {
        $components_model = new components();
        $components = $components_model::all()->where('created_by',Auth::id());
        return view('layout/component/show-component', ['components' => $components]);

    }


    function edit_component($component_id, Request $request)
    {
        $item_controller = new item();
        $cur_arr = $item_controller->get_restaurant_currency();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'componentNameEn' => 'required|string|min:3|max:255',
                'componentNameAr' => 'required|string|min:2|max:255|regex:/(^[\s\p{Arabic}])/u',
//                'componentPrice' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            } else {
//                for ($i = 1; $i <= count($cur_arr); $i++) {
//                    $v = $this->validate($request, ['componentPrice' . $cur_arr[$i - 1]->id => 'required|numeric']);
//                    $v1 = $this->validate($request, ['currency' . $cur_arr[$i - 1]->id => 'required|string']);
//
//                }
                $componentNameEn = $request->input('componentNameEn');
                $componentNamear = $request->input('componentNameAr');
//                $componentPrice = $request->input('componentPrice');
                $components_model = new components();
                $components_model->exists = true;
                $components_model->id = $component_id;
                $components_model->component_name_en = $componentNameEn;
                $components_model->component_name_ar = $componentNamear;
                $components_model->created_by = Auth::id();
                $components_model->save();
//                $whereArray = array('component_id' => $component_id);
//                $query = DB::table('component_price_currency');
//                foreach ($whereArray as $field => $value) {
//                    $query->where($field, $value);
//                }
//                $query->delete();
//                for ($i = 1; $i <= count($cur_arr); $i++) {
//                    // dd($cur_arr[$i - 1]->id);
//                    $ite_price_model = new component_price();
//                    $ite_price_model->component_id = $component_id;
////                    $ite_price_model->exists = true;
//                    $ite_price_model->price = $request->input('componentPrice' . $cur_arr[$i - 1]->id);
//                    $ite_price_model->acc_currency_id = $cur_arr[$i - 1]->id;
//                    $ite_price_model->created_by = Auth::id();
//                    $ite_price_model->save();
//                }

                return redirect('show-components')->with('status', "edit successfully");

            }

        }
        $components_model = new components();
        $component = $components_model::find($component_id);
//        $currency = DB::select('select * from currency');
//        $currency_added = component_price::select('price', 'acc_currency_id')
//            ->where('component_id', $component_id)->orderBy('acc_currency_id')->get();
//
//        foreach ($cur_arr as $c) {
//            foreach ($currency_added as $r) {
//                if ($c->id == $r->acc_currency_id) {
//
//                    $c->price = $r->price;
//
//                }
//
//            }
//        }
        return view('layout/component/edit-component', ['component' => $component]);

//        return view('layout/component/edit-component', ['component' => $component, 'currency' => $cur_arr]);

    }
}
