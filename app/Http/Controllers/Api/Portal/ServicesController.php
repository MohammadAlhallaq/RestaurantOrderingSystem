<?php

namespace App\Http\Controllers\API\Portal;

use Auth;
use Mail;
use Crypt;
use Config;
use Session;
use Validator;
use App\Models\User;
use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\PayUService\Exception;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\Mail\SendCompanyWelcomeNote;


class ServicesController extends Controller
{
    /**
     * PortalController constructor.
     */
    public function __construct()
    {

    }

    function check_email(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'email:rfc|unique:users,email,NULL,id,deleted_at,NULL'
        ]);
        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }

        return response()->json(['success' => $success, 'message' => []]);
    }
    function check_email_phone(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc',
            'mobile' => 'required',
        ]);
        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }
        //check email or phone on main
        $getUserEmail = User::where('email','=',$request->get('email'))->first();
        if(!empty($getUserEmail)){
            return response()->json(['success' => false, 'errors' => ['Email already has been token.']],422);
        }
        $getUserPhone = User::where('mobile','=',$request->get('mobile'))->first();
        if(!empty($getUserPhone)){
            return response()->json(['success' => false, 'errors' => ['Phone already has been token.']],422);
        }
        return response()->json(['success' => $success, 'message' => []]);
    }

    function activate_account($user_id){
        $user = Sentinel::findById($user_id);
        $activation = Activation::create($user);
        if (!Activation::complete($user, $activation->code))
        {
            return ['success' => false, 'message' => 'activation code failed to complete'];
        }
        return ['success' => true, 'message' => []];
    }

    //for admin
    function insert_admin(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'email:rfc|unique:users,email,NULL,id,deleted_at,NULL'
        ]);

        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }
        
        $success = false;
        $new_admin = new User();
        $new_admin->role_id = 1;
        $new_admin->email = $request->email;
        $new_admin->password = $request->password;
        $new_admin->first_name = $request->first_name;
        $new_admin->last_name = $request->last_name;
        $new_admin->main_id = $request->id;

        try{
            $new_admin->save();
            $inserted_id = $new_admin->id;
            $result = $this->activate_account($inserted_id);

            if($result['success']){
                return response()->json(['success' => true, 'message' => []]);
            }
            else{
                return response()->json(['success' => false, 'message' => [$result['message']]]);
            }
                // return response()->json(['success' => true, 'message' => []]);
        }
        catch(\Exception $e){
            
                    return response()->json(['success' => false, 'message' => ['An error occurred']]);
        }
    }
    //for vendor
    function insert_vendor(Request $request)
    {
        $success = true;
        $message_result = [];
        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'email:rfc|unique:users,email,NULL,id,deleted_at,NULL'
        ]);

        if ($validator->fails()) {
            $success = false;
            $messages = $validator->messages();
            foreach ($messages->all('<p>:message</p>') as $index => $message) {
                array_push($message_result, $message);
            }
            return response()->json(['success' => $success, 'message' => $message_result]);
        }

        $success = false;
        $new_admin = new User();
        $new_admin->role_id = (isset($request->role_id)) ? $request->role_id:2;
        $new_admin->email = $request->email;
        $new_admin->password = $request->password;
        $new_admin->first_name = $request->first_name;
        $new_admin->last_name = $request->last_name;
        $new_admin->company_name = (isset($request->company_name)) ? $request->company_name:'';
        $new_admin->mobile = $request->phone;
        $new_admin->address = $request->address;
        $new_admin->main_id = $request->id;
        $new_admin->platform_kind = (isset($request->platform_kind)) ? $request->platform_kind:'facebook';
        $new_admin->platform_id = (isset($request->platform_id)) ? $request->platform_id:'';

        try{
            $new_admin->save();
            $inserted_id = $new_admin->id;

            $details = [
                'id'    => Crypt::encrypt($inserted_id)
            ];
            Mail::to($new_admin->email)->send(new SendCompanyWelcomeNote($details));

            // $link = 'https://services.allin1uae.com/en/company/verification/index?id='.Crypt::encrypt($inserted_id);
            // $get_text_for_email = $this->get_text_for_email($request->lang_id,$link);
            // $subject = $get_text_for_email['subject'];
            // $email_body = $get_text_for_email['message'];
            /*//send email
            $this->send_email([
                'subject'=>$subject,
                'email_body'=>$email_body,
                'to'=>$request->email
            ]);*/

            $result = $this->activate_account($inserted_id);
            if($result['success']){
                return response()->json(['success' => true, 'message' => []]);
            }
            else{
                return response()->json(['success' => false, 'message' => [$result['message']]]);
            }


            return response()->json(['success' => true, 'message' => []]);
        }
        catch(\Exception $e){

            return response()->json(['success' => false, 'message' => ['An error occurred']]);
        }
    }
    //add support
    function add_support(Request $request){
        $create = Support::create($request->all());
        if($create->id){
            return response()->json([
                'success'=>true,
                'errors'=>[],
                'message'=>'Ticket support was added successfully.'
            ]);
        }
        return response()->json([
            'success'=>false,
            'errors'=>[
                'An error Occurs !'
            ]
        ]);
    }

    public function send_email($data){

        Config::set('mail.driver', 'smtp');
        Config::set('mail.host', 'mail.allin1uae.com');
        Config::set('mail.port', '587');
        Config::set('mail.encryption', 'TLS');
        Config::set('mail.username', 'no-reply@allin1uae.com');
        Config::set('mail.password', '8TSa9tvin,E^');

        Mail::send('admin.mail.mailbody',$data, function($message) use ($data){
            $message->from('support@allin1uae.com','ALL IN 1 Uae');
            $message->to($data['to']);
            $message->subject($data['subject']);
        });
    }

    function send_test_email(){
        $link = 'https://services.allin1uae.com/en/company/verification/index?id='.Crypt::encrypt(1);
        $this->send_email([
            'to'=>'amjad.bond90@gmail.com',
            'subject'=>'test',
            'email_body'=>'Hello'
        ]);
    }
    function get_text_for_email($lang_id,$link){

        if($lang_id==1){
            $subject = "Allin1UAE Seller Registration.";
            $message = "Welcome to Allin1UAE family, the only platform that removes all hurdles in the process of buying and selling of goods and services by providing a wider and secured market for legitimate businesses in the UAE. <br><br>";
            $message .="To start Selling on Allin1UAE, please complete your registration by providing required information through the link below.<br><br>";
            $message .="<a href='$link'>complete your registration  </a><br><br>";
            $message .="Please provide your active Bank Account information, you will receive payment and disbursements from Allin1UAE in this account.<br><br>";
            $message .="For further Information or Assistance, please email us on support@allin1uae.com or call 04 527 7000. <br><br>";
            $message .="Sincerely,<br>";
            $message .="The Allin1UAE Support Team.";
            return [
                'subject'=>$subject,
                'message'=>$message
            ];
        }else{
            $subject = "تسجيل البائع في Allin1uae";
            $message ="مرحبًا بك في عائلة Allin1uae  ، المنصة الوحيدة التي تزيل جميع العقبات في عملية شراء وبيع السلع والخدمات من خلال توفير سوق أوسع وآمن للأعمال التجارية المشروعة في دولة الإمارات العربية المتحدة.";
            $message .="<br><br>";
            $message .="لبدء البيع على Allin1uae، يرجى إكمال تسجيلك من خلال توفير المعلومات المطلوبة من خلال الرابط أدناه. ";
            $message .="<br><br>";
            $message .="<a href='$link'>إتمام عملية التسجيل</a>";
            $message .="<br><br>";
            $message .="يرجى تقديم معلومات حسابك المصرفي النشط ، وسوف تتلقى المدفوعات والمصروفات من Allin1uae في هذا الحساب.";
            $message .="<br><br>";
            $message .="لمزيد من المعلومات أو المساعدة ، يرجى مراسلتنا عبر البريد الإلكتروني على support@allin1uae.com أو الاتصال على 04 527 7000.";
            $message .="<br>";
            $message .="مع تحيات،";
            $message .="<br>";
            $message .="فريق دعم  Allin1uae";
            return [
                'subject'=>$subject,
                'message'=>$message
            ];
        }

    }


}