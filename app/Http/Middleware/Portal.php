<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\Models\PortalSettings;

class Portal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $api_key = PortalSettings::where('meta_key','=','api_key')->first()->meta_value;
        if ($api_key == $request->header('x-api-key')) {
            return $next($request);
        }
        return response()->json([
            'success'=>false,
            'message'=>'API key is not valid'
        ],401);
    }
}
