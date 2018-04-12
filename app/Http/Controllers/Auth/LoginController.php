<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use URL;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        if ($request->get('returnTo')) {
            \Session::put('url.intended', URL::route('location', [ $request->get('returnTo') ]));
        }

        return view('account.login');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        /** @var User $existing */
        $existing = User::query()->where('email', $user->email)->first();

        if ($existing !== null) {
            if ($existing->hasNotConnectedFacebook()) {
                return redirect()->route('account_connect')->withErrors([ 'login' => "That email is already registered with a password, please login using your password"]);
            }

            \Auth::login($existing);
            return redirect()->intended($this->redirectTo);
        }

        $newUser = User::buildFromFacebook($user);

        \Auth::login($newUser);
        return redirect()->intended($this->redirectTo);
    }
}
