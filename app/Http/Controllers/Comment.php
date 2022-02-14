<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Comment_model;
use App\Notifications\FirebaseNotification;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class Comment extends Controller
{
    //
    function add_comment(Request $request)
    {

        $response = default_ret_array();

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'source_id' => 'required|numeric',
                'destination_id' => 'required|numeric',
                'comment_text' => 'required|string|min:3',
                'token' => 'required|String',
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('source_id');
                $destination_id = $request->input('destination_id');
                $token = $request->input('token');
                $comment_text = $request->input('comment_text');
                if ($comment_text != null) {
                    $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                    if ($customer != null) {
                        $resturant = DB::table('account')->where('id', $destination_id)->where('status_id', 1)->first();
                        if ($resturant != null) {
                            $order = DB::table('orders')->where('customer_id', $customer->id)->where('restaurant_id', $destination_id)->get();
                            if (count($order) > 0) {
                                $comment_model = new Comment_model();
                                $comment_model->source_id = $customer->id;
                                $comment_model->destination_id = $destination_id;
                                $comment_model->comment_text = $comment_text;
                                $comment_model->save();
                                $response['msg'] = 'successfully';
                                $response['status'] = true;

                                if ($comment_model){
                                    NotificationService::NotifyRestaurant('comment', $source_id, $destination_id, "New Comment", "New comment has been made.", "Has made a new comment.");
                                }
                                return $response;
                            } else {
                                $response['msg'] = 'you don\'t have order';
                                $response['status'] = false;
                                return $response;
                            }
                        } else {
                            $response['msg'] = 'Restaurant account  is  inactive';
                            $response['status'] = false;
                            return $response;
                        }
                    } else {
                        $response['msg'] = 'Your account is inactive';
                        $response['status'] = false;
                        return $response;
                    }
                } else {
                    $response['msg'] = 'please write your comment';
                    $response['status'] = false;
                    return $response;
                }
                $response['msg'] = 'error';
                $response['status'] = false;
                return $response;

            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }

    function show_comments()
    {
        $qu = 'select s.username as customer_name , c.id , c.created_at,c.comment_text
        from comments c join customers s on s.id=c.source_id
        where c.is_read=1  and c.destination_id = ' . Auth::id();
        $results = DB::select($qu);

        return view('layout/comment/show-comment', ['comments' => $results]);
    }

    function show_new_comments()
    {
        $qu = 'select s.username as customer_name , c.id , c.created_at,c.comment_text
        from comments c join customers s on s.id=c.source_id
        where c.is_read=0  and c.destination_id = ' . Auth::id();
        $results = DB::select($qu);

        return view('layout/comment/show-new-comment', ['comments' => $results]);
    }

    function approve_comment(Request $request)
    {
        $response = default_ret_array();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric'

            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $id = $request->input('id');

                $comment_model = new Comment_model();
                $comment_model->exists = true;
                $comment_model->id = $id;
                $comment_model->is_read = 1;
                $comment_model->save();

                $response['msg'] = 'successfully';
                $response['status'] = true;
                return $response;


            }
        }
    }

}
