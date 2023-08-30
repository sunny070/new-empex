<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  ...$guards
   * @return mixed
   */
  public function handle(Request $request, Closure $next, ...$guards)
  {
    $guards = empty($guards) ? [null] : $guards;
    foreach ($guards as $guard) {
      switch ($guard) {
        case 'admin':
          if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->is_approved == 1) {
            $role = Auth::guard($guard)->user()->role_id;

            switch ($role) {
              case '2':
                return redirect('/verifier/dashboard');
                break;

              case '3':
                return redirect('/approver/dashboard');
                break;

              case '4':
                return redirect('/employer/dashboard');
                break;

              case '5':
                return redirect('/district-admin/dashboard');
                break;

              default:
                return redirect('/admin/dashboard');
                break;
            }
          }
          break;
        default:
          if (Auth::guard($guard)->check()) {
            return redirect('/');
          }
          break;
      }
    }
    return $next($request);
  }
}
