<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function add_package(Request $request){

        if ($request->isMethod('post')){
            $rules = [
                'title' => 'required|min:4|max:30',
                'allowed_meals' => 'required|numeric',
                'duration' => 'required|numeric',
                'cost' => 'required|numeric',
                'category' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()){
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors()
                ]);
            }else{
                $package = Package::create([
                    'title' => $request->title,
                    'allowed_meals' => $request->allowed_meals,
                    'duration' => $request->duration,
                    'cost' => $request->cost,
                    'category_id' => $request->category,
                    'free_delivery' => $request->free_delivery == "true" ? 1 : 0
                ]);
                if ($package){
                    return response()->json([
                        'result' => 'success',
                        'message'=> 'Package has been added'
                    ]);
                }
            }
        }
        return view('layout.package.add-package');
    }

    public function show_packages(){

        $packages = Package::with('category')->get();
        return view('layout.package.show-packages', compact('packages'));
    }

    public function update_package(Request $request, $id){

        $package = Package::findorfail($id);

        if ($request->isMethod('post')){

            $rules = [
                'title' => 'required|min:4|max:30',
                'allowed_meals' => 'required|numeric',
                'duration' => 'required|numeric',
                'cost' => 'required|numeric',
                'category' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()){
                return response()->json([
                    'result' => 'false',
                    'errors' => $validator->errors()
                ]);
            }else{
                $package = $package->update([
                    'title' => $request->title,
                    'allowed_meals' => $request->allowed_meals,
                    'duration' => $request->duration,
                    'cost' => $request->cost,
                    'free_delivery' => $request->free_delivery == "true" ? 1 : 0,
                    'category_id' => $request->category,
                ]);
                if ($package) {
                    return response()->json([
                        'result' => 'success'
                    ]);
                } else {
                    return response()->json([
                        'result' => 'exception',
                        'message' => 'Something went wrong'
                    ]);
                }
            }
        }

        return view('layout.package.update-package', compact('package'));
    }

    public function delete_package($id){
        $package = Package::where('id', $id)->firstorfail()->delete();
        if ($package) {
            return response()->json([
                'result' => 'success',
                'message' => 'Package has been deleted'
            ]);
        }
    }
}
