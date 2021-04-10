<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {
     
            $user = Socialite::driver('google')->user();
            echo '<pre>'; print_r($user); 
            $finduser = User::where('social_id', $user->id)->first();
      
            if($finduser){
      
                Auth::login($finduser);
     
                return redirect('/');
      
            }else{
  
                /*$newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    'password' => encrypt('my-google')
                ]);*/
                //Added by Ripal - as per old table for social login 
		       $newUser = User::create([
		            'email' => $user->email,
		            'password' => Hash::make('my-google')
		        ]);

		        Profile::create([
		            'user_id' => $newUser->id,
		            'first_name' => $user->name,
		            'last_name' => $user->name
		        ]);
                Auth::login($newUser);
      
                return redirect('/');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
