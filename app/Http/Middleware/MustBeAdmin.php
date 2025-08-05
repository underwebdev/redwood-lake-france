<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustBeAdmin
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
        $user = $request->user();

        if ($user && $user->permission == '1') {
            // Allow limited admin access for specific user and specific routes
            if ($user && $user->email === 'fishlist@redwoodlake.co.uk') {
                $allowedRoutes = [
                    'admin/catch-reports',
                    'admin/stock',
                    'admin/stock/{id}',
                    'admin/stocking-diary'
                ];

                if (in_array($request->path(), $allowedRoutes)) {
                    return $next($request);
                } else {
                    return redirect('/admin/stock');
                }
            } else {
                return $next($request);

            }

            
        }



        if ($user && $user->permission == '2') {

            return redirect('/my-account');
        }

        return redirect('/login');
    }
}
