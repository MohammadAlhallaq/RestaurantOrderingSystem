<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class Tax_Controller extends Controller
{
    //
    function add_tax(Request $request)
    {
        if ($request->isMethod('post')) {
            //  dd($request->input());
            $validator = Validator::make($request->all(), [

                'taxValue' => 'required|numeric',
                'currency' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return redirect('add-tax')
                    ->withInput()
                    ->withErrors($validator);
            } else {

                $taxValue = $request->input('taxValue');
                $currency = $request->input('currency');


                $tax_model = new \App\Models\tax();

//                $whereArray = array('currency_id' => $currency,'status_id'=>1);
//                $query = DB::table('tax');
//                foreach ($whereArray as $field => $value) {
//                    $query->where($field, $value);
//                }
//                $query->delete();
//

                DB::table('tax')
                    ->where('currency_id', $currency)
                    ->where('status_id', 1)
                    ->update(['status_id' => 2]);
                $tax_model = new \App\Models\tax();
                $tax_model->currency_id = $currency;
                $tax_model->status_id = 1;
                $tax_model->tax_value = $taxValue;
                $tax_model->created_by = Auth::id();
                $tax_model->save();
                return redirect()->route('show-tax');

            }
        }

        $currency_arr = DB::select('select * from currency');

        return view('layout/tax/add-tax', ['currency_arr' => $currency_arr]);
    }

    function show_tax()
    {
        $q = 'select c.id, c.tax_value,c.created_at,s.status_name_en,f.currency_name
        from tax c join tax_status s on c.status_id =s.id join currency f on f.id=c.currency_id ';
        $results = DB::select($q);

        return view('layout/tax/show-tax', ['tax' => $results]);
    }
}
