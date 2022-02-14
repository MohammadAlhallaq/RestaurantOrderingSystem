<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function add_sales_worker(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'workerName' => 'required|string|min:3|max:255',
                'workercode' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('add-sales-worker')
                    ->withInput()
                    ->withErrors($validator);
            } else {
                $name = $request->input('workerName');
                $code = $request->input('workercode');

                $sales_worker = new Sales();
                $sales_worker->name = $name;
                $sales_worker->code = $code;
                $sales_worker->save();
                return redirect('show-sales-workers')->with('status', "Insert successfully");// go to show categoryController
            }
        }
        return view('layout.sales.add-sales-worker');
    }


    public function show_sales_worker(){
        $sales_workers = Sales::withCount('restaurant')->get();
        return view('layout.sales.show-sales-workers', compact('sales_workers'));
    }

    public function edit_sales_worker(Request $request, $worker_id = null){

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'workername' => 'required|string|min:3|max:255',
                'workercode' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('add-sales-worker')
                    ->withInput()
                    ->withErrors($validator);
            }else{
                $sales_worker = Sales::find($worker_id);
                $sales_worker->name = $request->workername;
                $sales_worker->code = $request->workercode;
                $sales_worker->save();;
                return redirect('show-sales-workers')->with('status', "edit successfully");// go to show categoryController

            }
        }
        $sales_worker = Sales::find($worker_id);
        return view('layout.sales.edit-sales-worker', compact('sales_worker'));
    }

    public function check_code(Request $request){
        if ($request->isMethod('post')){
            $body['code'] = $request->code;
            $url = 'https://main.allin1uae.com/api/marketing-company';
            $response = Http::get($url, $body);
            if ($response['id'] != 0){
                return response()->json([
                    'result' => 'true'
                ]);
            }
            return response()->json([
                'result' => 'false'
            ]);
        }
    }
}
