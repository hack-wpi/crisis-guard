<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Response;

class CheckRole
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
        $type = DB::table('users')->select('roles')->where('id', $request->input('user_id'))->first();
        if ($type && $type->roles != 'user') {       
            return $next($request);
        } else {
            return Response::json(['msg' => 'User role failed'], 401);
        }
    }
}
