<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(isUser()){
            auth()->logout();
            session()->flash('danger','These credentials do not match our records.');
            return redirect()->to('login');
        }
        return $next($request);
    }
}
