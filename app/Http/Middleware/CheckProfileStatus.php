<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class CheckProfileStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // to be completed...
        if (auth()->check()) {
            $user = auth()->user();

            if ($user->profileStatus == 'personal-info') {
                return redirect()->route('signup');
            } else if ($user->profileStatus == 'upload-picture') {
                return redirect()->route('upload-picture');
            } else if ($user->profileStatus == 'interests') {
                return redirect()->route('interests');
            } else {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}