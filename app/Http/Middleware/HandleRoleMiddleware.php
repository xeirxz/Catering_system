<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleRoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user()->role !== $role) {
            // Store the intended URL
            session()->put('url.intended', $request->url());

            // Redirect to the intended dashboard based on the user's role
            return redirect($this->getRedirectUrl($request->user()->role));
        }

        return $next($request);
    }

    // Define the redirect logic based on the user's role
    private function getRedirectUrl($role)
    {
        switch ($role) {
            case 'admin':
                return 'admin/dashboard';
            case 'staff':
                return 'staff/dashboard';
            case 'customer':
                return 'customer/dashboard';
            default:
                return '/';
        }
    }
}
