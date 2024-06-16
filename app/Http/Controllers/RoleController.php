<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {

        abort_if(!auth()->user()->can('role-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){


            $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
            $roles = Role::Where('id','!=','0')->orderBy('id','DESC')->get();
            return view('backend.superadmin.master-settings.settings.roles-settings',compact('roles','permission'));

        }


        abort_if(!auth()->user()->can('role-list'),403);



    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $permission = Permission::get();
        return view('backend.roles.create',compact('permission'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
            
        ]);
    
        $role = Role::create(['name' => $request->name,'status'=>$request->role_status]);

        $permissions = Permission::whereIn('id', $request->permission)->get(['name'])->toArray();
        
        $role->syncPermissions($permissions);

        \LogActivity::addToLog('New Role has been created.');
    
        return redirect()->route('admin.userRoleList')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $role = Role::find($id);
        
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('backend.roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id): View
    {
        $role_id = decrypt($id);
        $role = Role::find($role_id);
        $roles = Role::Where('id','!=','1')->orderBy('id','DESC')->get();
        $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",decrypt($id))
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('backend.roles.edit',compact('role','roles','permission','rolePermissions','role_id'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        echo $request->role_id ;

        
        $role_id = decrypt($request->role_id);
       
        $role = Role::find($role_id);
        $role->name = $request->name;
        $role->status= $request->role_status;
        $role->save();

        $permissions = Permission::whereIn('id', $request->permission)->get(['name'])->toArray();

    
        $role->syncPermissions($permissions); 
    
        return redirect()->route('admin.userRoleList')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $role_id = decrypt($id);
        $role = Role::find($role_id);
        if($role->name=='Superadmin'){
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE DELETED');
        }
        if(auth()->user()->hasRole($role->name)){
            abort(403, 'CAN NOT DELETE SELF ASSIGNED ROLE');
        }
        $role->delete();
        return redirect()->route('admin.userRoleList')
                ->with('success','Role is deleted successfully.');
    }
}
