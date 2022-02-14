<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('layout.auth.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:account',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => 'false',
                'errors' => $validator->errors(),
            ]);
        } else {
            $token = sha1(time());

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $account = Account::query()->where('email', $request->email)->first();

            $maildata = [
                'title' => 'Dear ' . $account->account_name,
                'message' => 'Click the button below to reset your password',
                'url' => route('reset.password.get', $token),
            ];
            Mail::to($request->email)->send(new ResetPassword($maildata));
            return response()->json([
                'result' => 'true',
                'message' => 'Please check your email address',
            ]);
        }
    }

    public function showResetPasswordForm($token)
    {
        $updatePassword = DB::table('password_resets')
            ->where([
                'token' => $token
            ])
            ->first();

        if (!$updatePassword) {
            abort(404);
        } else {
            return view('layout.auth.forgetPasswordLink', ['token' => $token]);
        }
    }

    public function submitResetPasswordForm(Request $request)
    {
        $rules = array(
            'email' => 'required|email|exists:account',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'result' => 'false',
                'errors' => $validator->errors(),
            ]);
        } else {
            $updatePassword = DB::table('password_resets')
                ->where([
                    'email' => $request->email,
                    'token' => $request->token
                ])
                ->first();

            if (!$updatePassword) {
                return response()->json([
                    'result' => 'invalid',
                    'message' => 'invalid token or email address',
                ]);
            }

            $account = Account::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

            if ($account) {
                DB::table('password_resets')->where(['email' => $request->email])->delete();

                return response()->json([
                    'result' => 'true',
                    'message' => 'Password has been reset',
                ]);
            }

        }
    }
}
