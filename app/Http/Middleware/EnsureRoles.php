<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\ACLService;
use Auth;
use View;

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
        $userid = Auth::user()->id;
        if (!(new ACLService())->checkUserPermissions($userid)) {
            abort(401);
        }
        $userMenu = (new ACLService())->getUserMenu($userid);
        View::share('sidebar', $userMenu);
        return $next($request);
    }
}
