<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\User;
use redirect;
use Session;
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
    public function showLoginForm()
    {
        $data = array();
        $data['title'] = 'Sign In';
        return view('auth.login', $data);
        
    }
    public function __construct()
    {
        $this->middleware('guest:web',['except'=>['logout','userLogout']]);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!is_null($user))
        {   
            if(!Hash::check($request->password, $user->password))
            {
                session()->flash('errors', 'Your Password is wrong !!');
                return redirect('/login');
            }else{
                if ($user->status == 1)
                {
                    if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
                    {
                        return redirect()->intended(route('home'));
                    }
                }else{
                    // $user->notify(new VerifyRegistration($user));
                    
                    session()->flash('errors', 'You have not confirmed your verification.. Please check and confirm your phone');
                    return redirect('/login');
                }
            }

        }else{
            session()->flash('errors', 'Please Register first !!');
            return redirect('/login');
        }

    }
    
    public function userLogout() 
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
    
}
