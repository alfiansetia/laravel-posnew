<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role != 'admin') {
            if ($request->ajax()) {
                return response()->json(['message' => 'Unauthorize!'], 403);
            }
            return redirect()->route('home')->with('error', 'Your role is Unauthorize to do this action!');
        }
        return $next($request);
    }
}
