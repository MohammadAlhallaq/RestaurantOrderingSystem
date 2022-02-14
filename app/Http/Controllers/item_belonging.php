<?php

namespace App\Http\Controllers;

use App\Models\components;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class item_belonging extends Controller
{
    //
    function add_belongings($item_id, Request $request)
    {


//        $comonent_arr = explode(',', $comonent_arr);
        $belongings_arr = \Illuminate\Support\Facades\DB::table('item')->where('id', '!=', $item_id)->where('created_by', Auth::id())->get();
        //dd($belongings_arr);
//        $string = implode(",", $comonent_arr);
        return view('layout/belongings/add-belongings', ['belongings_arr' => $belongings_arr, 'item_id' => $item_id]);
    }


    function add_belonging(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->input('action') == 'save') {
                $validator = Validator::make($request->all(), [
                    'belongings' => 'required'
                ]);
                $item_id = $request->input('item_id');
//            $component_arr = $request->input('components');
                if ($validator->fails()) {
                    return redirect()->route('add-belongings', ['item_id' => $item_id])->withInput()->withErrors($validator);
                } else {
                    $belongings = $request->input('belongings');
                    $item_id = $request->input('item_id');

                    for ($i = 0; $i < count($belongings); $i++) {
                        $item_belongings = new \App\Models\item_belongings();
                        $item_belongings->item_id = $item_id;
                        $item_belongings->related_item_id = $belongings[$i];
                        $item_belongings->created_by = Auth::id();
                        $item_belongings->save();
                    }

                    return redirect('show-items');// go to show categoryController

                }
            } else {
                return redirect('show-items');
            }

        }
    }
}
