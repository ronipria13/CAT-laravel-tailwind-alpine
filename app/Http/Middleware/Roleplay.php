<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Managements\Roleplay as RoleplayModel;
use Illuminate\Support\Facades\Route;
use App\Models\Managements\Permissions;

class Roleplay
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
        $hasAccessRole = RoleplayModel::ThisUserHasRole(session()->get('current_role'));
        $currentActions = Route::currentRouteAction();
        $is_ajax = $request->ajax();
        $permission = Permissions::checkAccess($currentActions, $is_ajax);
        if(!$hasAccessRole){
            $code = 403;
            return response()->view('app.error.page', [
                "title" => "You don't have permission to access this page",
                "message" => "your role is not allowed to access this page",
                "code" => $code
            ] ,$code);
        }
        if(!$permission) {
            $code = 404;
            return response()->view('app.error.page', [
                "title" => "Sorry we couldn't find this page.",
                "message" => "But dont worry, you can find plenty of other things on our homepage.",
                "code" => $code
            ] ,$code);
        }
        
        return $next($request);
    }
}
