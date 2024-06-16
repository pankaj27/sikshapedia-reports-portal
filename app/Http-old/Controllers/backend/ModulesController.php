<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Modules;
use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;

use Spatie\Permission\Models\Role;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;

class ModulesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:modules-list|modules-create|modules-edit|modules-delete', ['only' => ['index']]);
         $this->middleware('permission:modules-create', ['only' => ['create','store']]);
         $this->middleware('permission:modules-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:modules-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
        //$permission = Permission::get();
        
        $modules = DB::table('system_modules')->orderBy('id','ASC')->get();
        return view('backend.settings.modules.list',compact('modules'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }



    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'modules_name' => 'required|unique:system_modules,modules_name',
            'modules_url' => 'required',
            'permission_name' => 'required',
            
        ]);
    
        $modules = Modules::create(['modules_name' => $request->input('modules_name'),'modules_url'=>$request->input('modules_url'),'permission_name'=>implode(',',$request->input('permission_name')),'is_active'=>$request->input('module_status')]);

        //update on permision table 
        foreach($request->input('permission_name') as $prmiss){
            //print_r($prmiss);
           // echo "<br>";
            $permiss_name = strtolower($request->input('modules_name'))."-".$prmiss;
            Permission::create(["module_name"=> ucwords($request->input('modules_name')), "name"=> "$permiss_name" , "guard_name"=>"web","created_at"=>now(),"updated_at"=>now() ]);
        }

        //exit;
        
        \LogActivity::addToLog('New System Modules has been created.');
    
        return redirect()->route('system-modules')
                        ->with('success','New System Modules created successfully');
    }

    

    public function edit($id): View
    {
        //echo 1; exit;
        $s_module = Modules::find(decrypt($id));
        $modules = DB::table('system_modules')->orderBy('id','ASC')->get();
       
        
    
        return view('backend.settings.modules.edit',compact('s_module','modules','id'));
    }

    public function update(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'modules_name' => 'required',
            'modules_url' => 'required',
            'permission_name' => 'required',
            
        ]);
    
        $module = Modules::find(decrypt($request->modules_id));
        $module->modules_name = $request->input('modules_name');
        $module->modules_url = $request->input('modules_url');
        $module->is_active = $request->input('module_status');
        $module->permission_name = implode(",",$request->input('permission_name'));
        
        $module->save();
    
        foreach($request->input('permission_name') as $prmiss){
            //print_r($prmiss);
           // echo "<br>";
            $permiss_name = strtolower($request->input('modules_name'))."-".$prmiss;
            Permission::updateOrInsert(["module_name"=> ucwords($request->input('modules_name')), "name"=> "$permiss_name" ]);
        }
    
        return redirect()->route('system-modules')
                        ->with('success','New System Modules updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
       
        //get delete from permission table 
        $get_module_array = DB::table('system_modules')->where('id',decrypt($id))->get();
        
        //delete from role has permission
        $get_permission_list = DB::table('permissions')->where('module_name','=',  ucwords($get_module_array[0]->modules_name))->get();
        
        foreach($get_permission_list as $permision_list){


            

            //delete fro user has roles 

            DB::table('role_has_permissions')->where('permission_id',$permision_list->id)->delete();
            $permission_id = Permission::find($permision_list->id);
            $permission_id->delete();


        }


        
        DB::table("system_modules")->where('id',decrypt($id))->delete();
        return redirect()->route('system-modules')
                ->with('success','New System Modules deleted successfully');
    }
}
