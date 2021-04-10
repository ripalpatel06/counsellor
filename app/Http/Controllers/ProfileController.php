<?php

namespace App\Http\Controllers;

use App\Denomination;
use App\Profile;
use App\Http\Requests\CreatePersonalInformationRequest;
use App\PersonalInformation;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Translation\Translator;
use DB;


class ProfileController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('hasPersonalInformation', [
            'only' => [
                'index',
            ]
        ]);

        $this->middleware('hasNoPersonalInformation', [
            'only' => [
                'create'
            ]
        ]);
    }

    public function index()
    {
        //Added by Ripal
        $profile = Auth::user('users');
        $id = $profile->id; 
        $gender = DB::table('profile')->where('user_id', $id)->value('gender');

        $getDenomin= DB::table('profile')->where('user_id', $id)->value('denomination_id');
        $getDenomination= DB::table('denomination')->where('id', $getDenomin)->value('name');
       
        return view('profile.index', [
            'profile' => Auth::user('users'),
            'gender' => $gender,
            'denomination' => $getDenomination,
            'controller' => 'profile',
            'action' => 'index'
        ]);
    }

    public function update()
    {
        $denominations = ['' => 'Unspecified'] + Denomination::all()->pluck('name', 'id')->toArray();
        // echo "<pre>"; print_r($denominations); die();
        $profile = Auth::user('users');
        $id = $profile->id; 
        $profiledata = Profile::where('user_id',$id)->get()->toArray();
        
   
        return view('profile.update', [
            'profile' => Auth::user('users'),
            'denominations' => $denominations,
            'profiledata' => $profiledata,
            'controller' => 'profile',
            'action' => 'update'
        ]);
    }

    public function store(CreatePersonalInformationRequest $request)
    {
        //Added by Ripal
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $gender = $request->input('gender');
        $denomination_id = $request->input('denomination');
        $profile = Auth::user('users');
        $id = $profile->id; 

        $profile = array(
            'first_name' => $first_name ,
            'last_name' => $last_name,
            'gender' => $gender,
            'denomination_id' => $denomination_id
        );

        DB::table('profile')->where("id",$id)->update($profile); 
        return redirect()
            ->action('ProfileController@index');
    }
}
