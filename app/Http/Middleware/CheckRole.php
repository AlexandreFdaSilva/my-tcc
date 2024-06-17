<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckRole {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response {
        $roles = Role::all();
        $requestedRole = $roles->where('name', $role)->first();

        $userRole = $roles->where('id', Auth::user()->role_id)->first();
        $adminRole = $roles->where('name', 'admin')->first();

        $userIsAdmin = $adminRole == $userRole;

        if ($userIsAdmin || $userRole == $requestedRole) {
            return $next($request);
        }

        abort(401, 'Unauthorized action');
    }
}
