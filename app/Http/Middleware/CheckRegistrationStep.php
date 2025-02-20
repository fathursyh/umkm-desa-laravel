<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRegistrationStep
{
    public function handle(Request $request, Closure $next, $step)
    {
        switch ($step) {
            case 2:
                if (!session()->has('auth_data')) {
                    return redirect()->route('register.step1');
                }
                break;
            case 3:
                if (!session()->has('registration_data')) {
                    return redirect()->route('register.step2');
                }
                break;
            case 4:
                if (!session()->has('product_data')) {
                    return redirect()->route('register.step3');
                }
                break;
        }

        return $next($request);
    }
}
