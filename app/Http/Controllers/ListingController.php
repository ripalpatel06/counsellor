<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateListingRequest;
use App\Listing;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Mapper;
use DB;

class ListingController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('hasListing', [
            'only' => [
                'index',
                'verifyLocation',
                'postVerifyLocation',
                '_generateMap'
            ]
        ]);

        $this->middleware('hasNoListing', [
            'only' => [
                'create'
            ]
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Added by Ripal
        $profile = Auth::user('users');
        $id = $profile->id; 
        $listing = DB::table('listings')->where('id', $id)->get()->toArray();
        //
        //$listing = Auth::user()->listing;
        $this->_generateMap($listing[0]);

        return view('listing.index', [
            'listing' => $listing[0],
            'controller' => 'listing'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('listing.create', [
            'listing' => new Listing(),
            'controller' => 'listing'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update()
    {
        //Added by Ripal
        $profile = Auth::user('users');
        $id = $profile->id; 
        $listing = DB::table('listings')->where('id', $id)->get()->toArray();
        return view('listing.update', [
            //'listing' => Auth::user()->listing,
            'listing' => $listing[0],
            'controller' => 'listing',
            'action' => 'update'
        ]);
    }

    /**
     * @param Requests\CreateListingRequest $request
     */
    public function store(CreateListingRequest $request)
    {

        $location = $request->input('postal_code'); 
        $coordinates = Listing::getCoordinates($location);
        //echo "<pre>"; print_r($coordinates);die();

        if (!$coordinates) {
            return redirect()
                ->action('ListingController@create')
                ->withInput()
                ->with('warning', "We could not find your location based on '{$location}'. Please try again.");
        }

        //$listing = Auth::user()->listing;
        //Added by Ripal
        $profile = Auth::user('users');
        $id = $profile->id; 

        $mylist = DB::table('listings')->where('id', $id)->get()->toArray();
        //$listing = (object)$mylist[0];

        $listing = array(
            'name' => $request->input('name'),
            'postal_code' =>  $request->input('postal_code'),
            'latitude' => $coordinates['latitude'],
            'longitude' => $coordinates['longitude'],
            'location_verified' => false,
            'published' => false
        );
        //echo '<pre>'; print_r($listing); exit;
        // If a listing already exists, update it, else create it.
        if ($mylist) {
             DB::table('listings')->where("id",$id)->update($listing);
            
        } else {
            $data = array_merge(
                $request->all(),
                $coordinates,
                ['id' => Auth::user()->id]
            );

            Listing::create($data);
        }

        return redirect()
            ->action('ListingController@verifyLocation');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verifyLocation()
    {
        //Added by Ripal
        $profile = Auth::user('users');
        $id = $profile->id; 
        $listing = DB::table('listings')->where('id', $id)->get()->toArray();
        //Added by Ripal
        //$listing = Auth::user()->listing;
        $this->_generateMap($listing[0]);
        return view('listing.verify-location', [
            'listing' => $listing[0],
            'controller' => 'listing',
            'action' => 'verifyLocation'
        ]);
    }

    /**
     * @param Requests\VerifyLocationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postVerifyLocation(Requests\VerifyLocationRequest $request)
    {
        //$listing = Auth::user()->listing;
        //Added by Ripal
        $profile = Auth::user('users');
        $id = $profile->id; 
        $mylist = DB::table('listings')->where('id', $id)->get()->toArray();

        //$listing->save();
        $listing = array(
            'location_verified' => true,
            'published' => true
        );
        
        // If a listing already exists, update it, else create it.
        if ($mylist) {
             DB::table('listings')->where("id",$id)->update($listing);
            
        }

        return redirect()
            ->action('ListingController@index');
    }

    /**
     * @param Listing $listing
     */
    protected function _generateMap($listing)
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
