<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckStoreOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(getStoreInformation("stop") == "1") {
            return redirect()->route('suspend');
        }
        if(is_null(getStoreInformation('logo',null)) || is_null(getStoreInformation('main_color',null))) {
            return redirect()->route('not_completed');
        }
        if(Auth::check()) {
            if(getStoreIdFormTenancy() != Session::get('TenancyID')) {
                Auth::logoutCurrentDevice();
                return redirect(makeRoute("home"));
            } else {
                if(Auth::user()->suspend == 1) {
                    Auth::logout();
                    return redirect(makeRoute("home"));
                }
            }
        }
        return $next($request);
    }
}
