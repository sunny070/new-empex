<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class VisitorMiddleware
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
        $ip = hash('sha512', $request->ip());
        // dd('ip',$request->ip());
        if (Visitor::where('visit_date', today())->where('hash_ip', $ip)->count() < 1) {
            Visitor::create([
                'visit_date' => today(),
                'hash_ip' => $ip,
                'ip' => $request->ip(),
            ]);
        }
        return $next($request);
    }
}
