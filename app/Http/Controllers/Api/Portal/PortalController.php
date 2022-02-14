<?php

namespace App\Http\Controllers\Api\Portal;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Customer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use App\Models\PortalSettings;


class PortalController extends Controller
{
    /**
     * PortalController constructor.
     */
    public function __construct()
    {

    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        //variable
        $success = false;
        $message = "User is not exist";
        $is_vendor = 0;
        $token = "";
        //parameters
        $main_id = $request->get('main_id');
        if(empty($main_id)){
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Invalid id'
                ]
            );
        }
        //check for admin and vendor
        $admin_details = $this->get_user_details($main_id);
        if ($admin_details) {
            //check user status
            //if($admin_details->status!=1){
            if(1!=1){
             $message = "User has banned";
             $success = false;
            //}elseif (!$admin_details->getActivation->completed || empty($admin_details->getActivation->code)){
            }elseif (1!=1){
                $success = false;
                $message = "User is not active.";
            }else{
                $success = true;
            }
            //check if vendor
            if($admin_details->account_type_id==2){
                $is_vendor = 1;
            }
            //set access token
            if($success) {
                $get_access_token = $this->generate_access_token();
                if (empty($admin_details->login_token)) {
                    $admin_details->login_token = $get_access_token;
                    $admin_details->save();
                    $token = $get_access_token;
                } else {
                    $token = $admin_details->login_token;
                }
            }else{
                //remove token
                $admin_details->login_token = NULL;
                $admin_details->save();
            }
        }
        //response
        if ($success) {
            return response()->json([
                'message' => 'User was logged successfully.',
                'success' => $success,
                'is_vendor' => $is_vendor,
                'token'=>$token
            ]);
        }
        return response()->json([
            'message' => $message,
            'success' => $success,
            'is_vendor' => $is_vendor,
            'token'=>''
        ]);
    }

    /**
     * @param $main_id
     * @return bool
     */
    function get_user_details($main_id)
    {
        $success = false;
        $get_email = Account::where('main_id', $main_id)
            ->first();
        if ($get_email) {
            $success = $get_email;
        }
        return $success;

    }
    /**
     * @return string
     */
    function generate_access_token(){
        $token = openssl_random_pseudo_bytes(32) . time();
        $token = bin2hex($token);
        return $token;
    }
    /**
     * @param Request $request
     * @return mixed
     */
    function set_login(Request $request){
        $has_account = false;
        $token = $request->get('token');
        //logout
        Auth::logout();
        if(empty($token)){
            return response()->json(['success'=>false,'message'=>'unauthorized'],401);
        }
        //check user
        $admin_details = Account::where('login_token',$token)->first();
        if(!empty($admin_details)){
            $has_account = true;
            Auth::login($admin_details);
            return redirect(url('home'));

        }
        //if token is not valid
        if(!$has_account){
            return response()->json(['success'=>false,'message'=>'unauthorized'],401);
        }

    }

    function logout(Request $request){

        $token = $request->get('token');
        if(empty($token)){
            return response()->json(['success'=>false,'message'=>'unauthorized'],401);
        }
        //get main id
        $theOtherKey    = PortalSettings::where('meta_key','cipher_key')->first();
        if(empty($theOtherKey)){
            $theOtherKey = "";
        }else{
            $theOtherKey = $theOtherKey->meta_value;
        }
        $newEncrypter   = new \Illuminate\Encryption\Encrypter ($theOtherKey,'AES-256-CBC');
        $main_id      = $newEncrypter->decrypt($token);

        //unset token
        //check is user
        $vendor_details = Account::where('main_id',$main_id)->first();
        if(!empty($vendor_details)){
            $vendor_details->login_token = NULL;
            $vendor_details->save();
        }
        //logout
        Auth::logout();
        header("Location: https://main.allin1uae.com/logout");
    }
    public function change_password(Request $request){
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'main_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => false, 'message' => $message_result],409);
        }
        $user = User::where('main_id',$request->get('main_id'))->first();
        if(empty($user)){
            return response()->json(['success'=>false,'message'=>['<p>User is not exist</p>']],409);
        }
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return response()->json(['success' => true, 'message' =>['<p>Password was changed successfully.</p>'] ]);
    }
    function update_user_info(Request $request){
        $main_id = $request->get('main_id');
        $columns = $request->get('columns');
        Customer::where('main_id','=',$main_id)->update($columns);
        return response()->json(['success' => true, 'message' =>['<p>Update was changed successfully.</p>'] ]);
    }

    public static function check_token($request){
        if(empty($request->header('Authorization'))){
            return false;
        }
        if(!empty($request->header('Authorization'))){
            $explode = explode('Bearer',$request->header('Authorization'));
            if(!isset($explode[1])){
                return false;
            }
            $user = User::where('verification_link',ltrim($explode[1]))->first();
            if(empty($user)){
                return false;
            }
            return $user;
        }
        return true;
    }
}
