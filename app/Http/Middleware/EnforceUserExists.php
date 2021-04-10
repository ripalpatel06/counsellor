<?php

namespace App\Http\Middleware;

use App\PersonalInformation;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class EnforceUserExists
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
        $user = Auth::user();

        if ($user) {
            return $next($request);
        }

        return redirect(action('ProfileController@create'));
    }
}
