<?php


namespace App\Middleware;

use Closure;
use App\Controllers\Session;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (Session::has('login_user'))
            return $next($request);

        return header('Location: ' . route('login'));
    }
}