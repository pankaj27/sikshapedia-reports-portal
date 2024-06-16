<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::check())
        {
          
            $users_roles = User::where('id',auth()->user()->id)->with('roles')->get();

           
            $rolename = $users_roles[0]->roles[0]->name;

           
            if($rolename == 'Superadmin'){

                
                return view('backend.superadmin.dashboard.dashboard');
            }

            return view('backend.employee.dashboard.agent-dashboard');
            
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }
}
