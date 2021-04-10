<?php

namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;


// use use RedirectsUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins,AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $redirectAfterLogout = '/';

    protected $_provider = 'google';

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => [
            'getLogout',
            'extendSession'
        ]]);
    }
    public function extendSession()
    {
        return view('auth.extend-session');
    }
    public function getSocialLogin()
    {
       
        return Socialite::driver($this->_provider)->redirect();

    }

    public function handleSocialResponse()
    {
        try {
            Socialite::login($this->_provider, function($user, $details) {

                $existingUser = User::where('email', $details->email)->first();
                if ($existingUser) {
                    return $existingUser;
                } elseif (!$user->exists) {

                    $user->email = $details->email;
                    $user->save();

                    Profile::create([
                        'user_id' => $user->id,
                        'first_name' => $details->raw['given_name'],
                        'last_name' => $details->raw['family_name']
                    ]);
                }

                return $user;
            });
        } catch (ApplicationRejectedException $e) {
            // User rejected application
        } catch (InvalidAuthorizationCodeException $e) {
            // Authorization was attempted with invalid
            // code,likely forgery attempt
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(RegisterAccountRequest $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterAccountRequest $request)
    {
        Auth::login($this->create($request->all()));

        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        ]);

        return $user;
    }
}  