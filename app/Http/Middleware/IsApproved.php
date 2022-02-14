<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $RouteName = $request->route()->getName();
        if (Auth::user()->account_type_id == Account::IS_RESTAURANT && Auth::user()->approved == null) {
            if ($RouteName == 'general-information-step' || $RouteName == 'owner-details-step' || $RouteName == 'bank-address-step' || $RouteName
                == 'select-package-step') {
                return $next($request);
            } elseif ($RouteName == 'signup_wizard')
                return $next($request);
            return Redirect::route('signup_wizard');
        } else {
            if ($RouteName == 'signup_wizard' || $RouteName == 'general-information-step' || $RouteName == 'owner-details-step' || $RouteName == 'bank-address-step' || $RouteName
                == 'select-package-step') {
                return Redirect::route('profile', Auth::id());
            } else {
                return $next($request);
            }
        }
    }
}
