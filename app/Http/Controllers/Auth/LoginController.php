<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'emailOrMobile' => 'required',
            'password' => 'required',
        ]);
        $emailOrMobile = trim($input['emailOrMobile']);
        $password = trim($input['password']);
        //remember credentials
        Cookie::queue('emailOrMobile', $emailOrMobile, time() + (86400));
        Cookie::queue('password', $password, time() + (86400));
        $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        $user = User::with(['reporter' => function($query){
           $query->where('status', '=', 'active');}])->where($fieldType, $emailOrMobile)->first();
        //check user roll & login this panel
        $guard = 'web';
        if($user) {
            if ($user->role_id == 'reporter' && $user->reporter) {
                $guard = 'reporter';
            } else {
                $guard = 'web';
            }

            if ($user->activation != '1') {
                $url = route('userAccountVerify') . '?' . $fieldType . '=' . $emailOrMobile;
                return redirect($url)->with('error', $user->name . ' your account is not activated. Please verify ' . $fieldType . ', verification code has been sent to your ' . $fieldType . '.');
            }
            if ($user->status != 'active') {
                Auth::logout();
                return back()->with('error', $user->name . ' your account is deactive. Please contact with administrator.');
            }
            if (Auth::guard($guard)->attempt(array($fieldType => $emailOrMobile, 'password' => $password))) {

                Toastr::success('Logged in success.');
                $user = Auth::guard($guard)->user();
                if ($user->role_id == 'reporter') {
                    return redirect()->intended(route('reporter.dashboard'));
                } else {
                    if(Session::has('redirectLink')){
                        return redirect(Session::get('redirectLink'));
                    }
                    return redirect()->intended(route('user.dashboard'));
                }
                return redirect()->intended(route('home'));
            }
        }
        return back()->withInput()->with('error', $fieldType . ' or password is invalid.');
    }

    public function logout() {
        Auth::logout();
        Toastr::success('Just Logged Out!');
        return redirect('/');
    }
}
