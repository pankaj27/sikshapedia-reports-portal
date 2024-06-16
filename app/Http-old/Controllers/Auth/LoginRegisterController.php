<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
   
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }
    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
        ->withSuccess('You have successfully registered & logged in!');
    }

    

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
       // print_r($credentials);
        //exit;
        if(Auth::attempt($credentials))
        {
            
            
            
            $request->session()->regenerate();
            
            if(auth()->user()->status == 1){
                \LogActivity::addToLog('Successfully loged in.');
                return redirect()->route('admin.dashboard')
                ->with('success','You have successfully logged in!');
                
            }else{
                
                $request->session()->invalidate();
                $request->session()->regenerateToken();
               
                return redirect()->route('login')
                    ->with('error','Your account has been disabled! Please contact Admin For more information');;
            }
            
            
        }
        \LogActivity::addToLog('Wrong credetials provided');
        
        return back()->with('error','Your provided credentials do not match in our records.');

    } 

   

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        \LogActivity::addToLog('Successfully loged out');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
       
        return redirect()->route('login')
            ->with('success','You have logged out successfully!');;
    }  
}
