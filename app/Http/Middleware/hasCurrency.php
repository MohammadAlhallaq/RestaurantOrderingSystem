<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class hasCurrency
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
        if (Auth::user()->account_type_id == Account::IS_RESTAURANT && count(Auth::user()->currency) == 0 && Auth::user()->approved == 1 && Auth::user()->package_expiration_at != null) {
            if ($RouteName == 'set-currency') {
                return $next($request);
            } else {
                return redirect()->route('set-currency');
            }
        } elseif ($RouteName == 'set-currency') {
            return Auth::user()->account_type_id == Account::IS_RESTAURANT ? redirect()->route('profile', auth()->id()) : redirect()->route('home');
        }
        return $next($request);

    }
}
