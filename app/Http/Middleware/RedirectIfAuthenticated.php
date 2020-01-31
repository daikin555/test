<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

	public function handle($request, Closure $next, $guard = null) {
		$redirectTo = "/admins/home";

		if ($guard === "admin") {
			$redirectTo = "/admins/home";
		}

		if (Auth::guard($guard)->check()) {
			return redirect('/index');
		}

		return $next($request);
	}
}
