<?php

namespace App\Http\Middleware;

use Closure;
use App\Listing;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class EnforceUserHasNoListing
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
        try {
            $userId = Auth::user()->id;
            $listing = Listing::findOrFail($userId);

            if ($listing) {
                return redirect(action('ListingController@index'));
            }
        } catch (ModelNotFoundException $e) {
            return $next($request);

        }
    }
}
