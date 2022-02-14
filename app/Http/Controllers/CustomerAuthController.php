<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    function login(Request $request)
    {

        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );

        $validData = $request->validate($rules);

        try {
            $user = Customer::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $token = $user->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);


        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }

    function register(Request $request)
    {
        $rules = array(
            'username' => 'required|min:3|max:30|unique:customers,username',
            'email' => 'required|email|regex:/^\S*$/u|unique:customers,email',
            'password' => 'required|confirmed|min:3|max:30',
            'phone_number' => 'required|phone:AE',
        );
        $validData = $request->validate($rules);

        $customer = Customer::create([
            'username' => $validData['username'],
            'email' => $validData['email'],
            'phone_number' => $validData['phone_number'],
            'status_id' => 1,
            'password' => Hash::make($validData['password'])
        ]);


        $token = $customer->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }

    public function customer_change_status(Request $request)
    {
        $result = Customer::where('id', $request->customer_id)->first();
        $result->update(['status_id' => $result->status_id == '1' ? '2' : '1']);

        if ($result) {
            return response()->json([
                'result' => 'true',
            ]);
        }
    }


    public function add_address(Request $request)
    {

        $rules = array(
            'main_id' => 'required|numeric',
            'address_main_id' => 'required|numeric',
            'long' => 'required|numeric',
            'lat' => 'required|numeric',
            'address' => 'required|min:3|max:200',
        );
        $request->validate($rules);

        $customer = Customer::where('main_id', $request->main_id)->first();
        if ($customer) {
            $customer->address()->create([
                'address' => $request->address,
                'latitude' => $request->long,
                'longitude' => $request->lat,
                'address_main_id' => $request->address_main_id,
            ]);
            $data = $customer->load('address');
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => ['no user for the specified id']
            ]);
        }
    }
}
