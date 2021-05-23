<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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

            'emp_id' => 'required',

            'password' => 'required',

        ]);
        $fieldType = filter_var($request->emp_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'emp_id';

        if(auth()->attempt(array($fieldType => $input['emp_id'], 'password' => $input['password'])))
            {
                if(Auth::user()->role == 2)
                    return redirect()->route('home');
                else
                    return redirect()->route('admin.dashboard');

            }else{

                return redirect()->route('login')->with('error','emp_id And Password Are Wrong.');

            }
    }
    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}
