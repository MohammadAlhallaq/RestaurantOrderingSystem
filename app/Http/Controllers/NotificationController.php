<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function show_notifications(){
        if (auth()->user()->cannot('show-notifications') && auth()->user()->account_type_id = Account::IS_ADMIN){
            abort(Response::HTTP_NOT_FOUND);
        }
        return view('layout.notifications.show-notifications');
    }
}
