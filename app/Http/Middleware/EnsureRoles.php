<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\ACLService;

class EnsureRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userid = $request->segment(2);
        dd((new ACLService())->checkUserPermissions($userid));
        if (!(new ACLService())->checkUserPermissions($userid)) {
            abort(401);
        }
        return $next($request);
    }
}
