<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyPermission
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
        $has_permission = true;

        // Check environment editing
        if ($request->route()->parameter('environment')) {
            if ($request->route()->parameter('environment')->organization_id !== Auth::user()->organization_id) {
                $has_permission = false;
            }
        }

        // Check repository editing
        if ($request->route()->parameter('repository')) {
            if ($request->route()->parameter('repository')->user()->organization_id !== Auth::user()->organization_id) {
                $has_permission = false;
            }
        }

        // Check deployment plan editing
        if ($request->route()->parameter('plan')) {
            if ($request->route()->parameter('plan')->organization_id !== Auth::user()->organization_id) {
                $has_permission = false;
            }
        }

        if (!$has_permission) {
            return redirect()->route('view.deployment-plans')->withErrors("You do not have permission for that action");
        }

        return $next($request);
    }
}
