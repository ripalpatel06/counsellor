<?php

namespace App\Http\Controllers;

use App\Denomination;
use App\Events\ViewPage;
use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Mapper;
use App\Http\Requests;
use App\Http\Requests\SearchListingRequest;

class SearchController extends Controller
{
    const RANGE_RADIUS = 100;
    const RANGE_UNIT = 'kilometers';

    /**
     * Class constructor
     */
    public function __construct()
    {

        $this->middleware('viewThrottle', [
            'only' => [
                'search',
                'show'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('search.index', [
            'denominations' => Denomination::all()->pluck('name', 'id')->toArray(),
            'displayReset' => !empty($request->old())
        ]);
    }

    public function show(Request $request, Listing $listing)
    {
        $this->_generateMap($listing);
        
        Event::dispatch(new ViewPage($listing->user->profile));

        return view('search.listing.details', [
            'listing' => $listing,
            'profile' => $listing->user->profile
        ]);
    }

    /**
     * @param SearchListingRequest $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchListingRequest $request)
    {
        // Keep the search data around so we can re-display the search form
        // with it's values on the search listings page.
        $request->flash();

        /**
         * @todo make this more robust
         */
        $coordinates = Listing::getCoordinates($request->input('location'));
        //echo '<pre>'; print_r($coordinates); exit;
        if (!$coordinates) {
            $request->session()->flash('warning', 'We could not find a location by that name');
            return redirect()
                ->action('SearchController@search');
        }

        /**
         * @todo move to repo?
         */
        $query = Listing::within(
                self::RANGE_RADIUS,
                self::RANGE_UNIT,
                $coordinates['latitude'],
                $coordinates['longitude']
            )
            ->published();

        $gender = $request->input('gender');
        if ($gender) {
            $query->whereHas('user.profile', function ($query) use ($gender) {
                $query->where('gender', '=', $gender);
            });
        }

        $denomination = $request->input('denomination');
        if ($denomination) {
            $query->whereHas('user.profile', function ($query) use ($denomination) {
                $query->where('denomination_id', '=', $denomination);
            });
        }

        $listings = $query->get();
        //echo '<pre>'; print_r($listings); exit;
        if ($listings->count() > 0) {
            // Increment view count for each listing displayed
            Event::dispatch(new ViewPage($listings));

            // Find the average lat/long so we know where to centre the map initially.
            $latitude = ($listings->min('latitude') + $listings->max('latitude')) / 2;
            $longitude = ($listings->min('longitude') + $listings->max('longitude')) / 2;
            
            Mapper::map($latitude, $longitude, [
                'marker' => false,
                'zoom' => 8,
                'cluster' => false
            ]);
            
            $listings->each(function($listing) {
                Mapper::informationWindow($listing->latitude, $listing->longitude, str_replace("'", "\\'", $listing->name));
            });

        }

        return response()
            ->view('search.search', [
                'listings' => $listings,
                'denominations' => Denomination::all()->pluck('name', 'id')->toArray()
            ])
            ->header('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT')
            ->header('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT')
            ->header('Cache-Control', 'private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0')
            ->header('Pragma', 'no-cache');
    }

    /**
     * @param Listing $listing
     */
    protected function _generateMap(Listing $listing)
    {
        $latitude = $listing->latitude;
        $longitude = $listing->longitude;

        Mapper::map($latitude, $longitude, [
            'marker' => false,
            'zoom' => 15,
            'cluster' => false
        ]);

        Mapper::informationWindow($listing->latitude, $listing->longitude, str_replace("'", "\\'", $listing->name));
    }
}
