<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\evaluation_model;
use App\Notifications\FirebaseNotification;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class Evaluation extends Controller
{
    //
    function add_eval(Request $request)
    {
        $response = default_ret_array();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'destination_id' => 'required|numeric',
                'taste_val' => 'nullable|numeric',
                'clean_val' => 'nullable|numeric',
                'delivery_val' => 'nullable|numeric',
                'note' => 'required|String',
                'token' => 'required|String',

                //     'token' => 'required|String'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $source_id = $request->input('user_id');
                $destination_id = $request->input('destination_id');
                $token = $request->input('token');

                $taste_val = null;
                $clean_val = null;
                $delivery_val = null;
                $note = null;
                $taste_val = $request->input('taste_val');
                $clean_val = $request->input('clean_val');
                $delivery_val = $request->input('delivery_val');
                $note = $request->input('note');
                if ($taste_val != null || $clean_val != null || $delivery_val != null) {
                    $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                    if ($customer != null) {
                        $resturant = DB::table('account')->where('id', $destination_id)->where('status_id', 1)->first();
                        if ($resturant != null) {
                            $prev_eval = DB::table('evaluation')->where('customer_id', $customer->id)->where('restaurant_id', $destination_id)->get();
                            if (count($prev_eval) == 0) {
                                $evaluation_model = new evaluation_model();
                                $evaluation_model->customer_id = $customer->id;
                                $evaluation_model->restaurant_id = $destination_id;
                                if ($taste_val != null) {
                                    if ($taste_val > 0 && $taste_val <= 5) {
                                        $evaluation_model->taste_value = $taste_val;
                                    } else {
                                        $taste_val = 3;
                                        $evaluation_model->taste_value = $taste_val;
                                    }
                                }

                                if ($clean_val != null) {
                                    if ($clean_val > 0 && $clean_val <= 5) {
                                        $evaluation_model->clean_value = $clean_val;
                                    } else {
                                        $clean_val = 3;
                                        $evaluation_model->clean_value = $clean_val;
                                    }
                                }

                                if ($delivery_val != null) {
                                    if ($delivery_val > 0 && $delivery_val <= 5) {
                                        $evaluation_model->delivery_value = $delivery_val;
                                    } else {
                                        $delivery_val = 3;
                                        $evaluation_model->delivery_value = $delivery_val;
                                    }
                                }

                                $evaluation_model->note = $note;
                                $evaluation_model->save();
                                if ($evaluation_model){
                                    NotificationService::NotifyRestaurant('evaluation', $source_id, $destination_id, "New evaluation", "New evaluation has been made.", "Has made a new evaluation.");
                                }

                                $response['msg'] = 'successfully';
                                $response['status'] = true;
                                return $response;
                            } else {
                                $evaluation_model = new evaluation_model();
                                $evaluation_model->exists = true;
                                $evaluation_model->id = $prev_eval[0]->id;

                                if ($taste_val != null) {
                                    if ($taste_val > 0 && $taste_val <= 5) {
                                        $evaluation_model->taste_value = $taste_val;
                                    } else {
                                        $taste_val = 3;
                                        $evaluation_model->taste_value = $taste_val;
                                    }
                                }

                                if ($clean_val != null) {
                                    if ($clean_val > 0 && $clean_val <= 5) {
                                        $evaluation_model->clean_value = $clean_val;
                                    } else {
                                        $clean_val = 3;
                                        $evaluation_model->clean_value = $clean_val;
                                    }
                                }

                                if ($delivery_val != null) {
                                    if ($delivery_val > 0 && $delivery_val <= 5) {
                                        $evaluation_model->delivery_value = $delivery_val;
                                    } else {
                                        $delivery_val = 3;
                                        $evaluation_model->delivery_value = $delivery_val;
                                    }
                                }

                                $evaluation_model->note = $note;
                                $evaluation_model->save();
                                $response['msg'] = 'successfully';
                                $response['status'] = true;
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
                    $response['msg'] = 'please add your evaluation';
                    $response['status'] = false;
                    return $response;
                }

            }
        }
        $response['msg'] = 'pad request  method';
        $response['status'] = false;
        return $response;
    }

    function get_eval(Request $request)
    {
        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'restaurant_id' => 'required|numeric',
                 'token' => 'required|String'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {

                $source_id = $request->input('user_id');
                $restaurant_id = $request->input('restaurant_id');
                $token = $request->input('token');

                $customer = DB::table('customers')->where('main_id', $source_id)->where('status_id', 1)->where('verification_link', 'LIKE', '%' . $token . '%')->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
                if ($customer != null) {

////                    if ($request->input('near_flag') != null) {
////                        $near_flag = $request->input('near_flag');
////                    }
//                    $eval = DB::table('evaluation')->select('id,')
//                        ->where('customer_id', $source_id)->where('restaurant_id', $restaurant_id)->first();
//

                    $eval = DB::table("evaluation")
                        ->selectRaw(" evaluation.id,customers.id as customer_id,ceil((evaluation.taste_value + evaluation.clean_value + evaluation.delivery_value)/3) as totla_eval,evaluation.note,evaluation.created_at,customers.username")
                        ->join('customers', 'evaluation.customer_id', '=', 'customers.id')
                        ->where('evaluation.restaurant_id', $restaurant_id)->where('evaluation.customer_id', $customer->id)->get();
                    if ($eval != null) {
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $eval;
                        return $response;


                    } else {
                        $response['msg'] = 'You have not rated this restaurant';
                        $response['status'] = false;
                        return $response;
                    }

                } else {
                    $response['msg'] = 'Your account is inactive';
                    $response['status'] = false;
                    return $response;
                }

            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;

    }

    function get_all_eval(Request $request)
    {

        $response = default_ret_array();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
//                'user_id' => 'required|numeric',
                'restaurant_id' => 'required|numeric',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
//                   'token' => 'required|String'
            ]);
            if ($validator->fails()) {
                $response['msg'] = $validator->errors()->all();
                return $response;
            } else {
                $limit = $request->input('limit');
                $offset = $request->input('offset');
                if ($limit == null) {
                    $limit = 5;
                }
                if ($offset == null) {
                    $offset = 0;
                }
//                $source_id = $request->input('user_id');
                $restaurant_id = $request->input('restaurant_id');
                $token = $request->input('token');
//                $customer = DB::table('customers')->where('id', $source_id)->where('status_id', 1)->first(); //->where('verification_link', 'LIKE', '%' . $token . '%')
//                if ($customer != null) {

//                    if ($request->input('near_flag') != null) {
//                        $near_flag = $request->input('near_flag');
//                    }
                    $rowCount = DB::table('evaluation')->where('restaurant_id', '=', $restaurant_id)
                        ->count();
                    $eval = DB::table("evaluation")
                        ->selectRaw(" evaluation.id,customers.id as customer_id,ceil((evaluation.taste_value + evaluation.clean_value + evaluation.delivery_value)/3) as totla_eval,evaluation.note,evaluation.created_at,customers.username")
                        ->join('customers', 'evaluation.customer_id', '=', 'customers.id')
                        ->where('evaluation.restaurant_id', $restaurant_id)
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
                    if ($eval != null) {
                        $response['msg'] = 'successfully';
                        $response['status'] = true;
                        $response['ret_data'] = $eval;
                        $response['total_page']=ceil($rowCount/$limit);
                        $response['total_row']=$rowCount;
                        return $response;
                    } else {
                        $response['msg'] = 'There is no rating for this restaurant ';
                        $response['status'] = false;
                        return $response;
                    }

//                } else {
//                    $response['msg'] = 'Your account is inactive';
//                    $response['status'] = false;
//                    return $response;
//                }

            }
        }
        $response['msg'] = 'pad request method';
        $response['status'] = false;
        return $response;
    }
}
