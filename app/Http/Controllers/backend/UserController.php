<?php

namespace App\Http\Controllers\backend;

use DB;
use Hash;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use App\Mail\sendmail;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        //  $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        //  $this->middleware('permission:user-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user()->roles->first()->name);
        //exit;
        abort_if(!auth()->user()->can('user-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $users = User::where('id','!=',1)->with('roles')->get();

            return view('backend.superadmin.users.list',compact('users'));

        }

        //return view('backend.users.list',compact('users'));

        abort_if(!auth()->user()->can('user-list'),403);

        
        
        

        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        abort_if(!auth()->user()->can('user-create'),403);

        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $roles = Role::where('status','=','1')->where('id','!=',1)->get();
            $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
        
        
            //print_r($roles);
            return view('backend.superadmin.users.create',compact('roles','permission'));

        }

        abort_if(!auth()->user()->can('user-create'),403);

        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        abort_if(!auth()->user()->can('user-create'),403);
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['password_hint'] = $request->password;
        $input['status'] = $request->status;
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
        //$mail = Mail::to($request->email)->send(new sendmail("User Credentials","This is test mail"));

        //print_r($mail);

        //exit;
        
        return redirect()->route('users.list')
                        ->with('success','User created successfully');

        }


        abort_if(!auth()->user()->can('user-create'),403);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        abort_if(!auth()->user()->can('user-view'),403);
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){
            $user = User::find($id);
            return view('backend.supersdmin.users.show',compact('user'));
        }

        abort_if(!auth()->user()->can('user-view'),403);
       
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!auth()->user()->can('user-edit'),403);

        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

        $user = User::find(decrypt($id));
        $roles = Role::where('status','=','1')->where('id','!=',1)->get();
        $userRole = $user->roles->pluck('name','name')->all();
        $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
        
        return view('backend.superadmin.users.edit',compact('user','roles','userRole','permission'));

        }


        abort_if(!auth()->user()->can('user-edit'),403);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        abort_if(!auth()->user()->can('user-edit'),403);
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){
        $id = decrypt($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required',
            'status' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($request->password);
            $input['password_hint'] = $request->password;
        }else{
            $input = Arr::except($input,array('password'));    
        }
        $input['status'] = $request->status;
        
       
    
        $user = User::find($id);
        $user->name = $input['name'];
        $user->email = $input['email'];
        if(!empty($input['password'])){
            $user->password = Hash::make($request->password);
            $user->password_hint = $request->password;
        }
        $user->status = $input['status'];
         $user->save();
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.list')
                        ->with('success','User updated successfully');

        }

        abort_if(!auth()->user()->can('user-edit'),403);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        abort_if(!auth()->user()->can('user-delete'),403);

        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

        User::find(decrypt($id))->delete();
        return redirect()->route('users.list')
                        ->with('success','User deleted successfully');

        }

        abort_if(!auth()->user()->can('user-delete'),403);
    }
}
