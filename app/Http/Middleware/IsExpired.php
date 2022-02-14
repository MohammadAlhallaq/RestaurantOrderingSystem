<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IsExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $RouteName = $request->route()->getName();
        if (Auth::user()->account_type_id == Account::IS_RESTAURANT
            && Auth::user()->approved == 1
            && Carbon::now()->toDateTimeString() > Auth::user()->package_expiration_at && count(Auth::user()->currency) != 0){
            $account = Auth::user();
            $account->status_id = 2;
            $account->work_status_id = 2;
            $account->Save();
            if ($RouteName == 'renew-subscription'){
                return $next($request);
            }
            else{
                return Redirect::route('renew-subscription');
            }
        }else{
            if ($RouteName == 'renew-subscription'){
                return Redirect::route('profile', Auth::id());
            }
        }
        return $next($request);
    }
}
