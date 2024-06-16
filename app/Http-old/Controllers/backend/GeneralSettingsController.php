<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Modules;

use DB;
use Illuminate\View\View;

use Spatie\Permission\Models\Role;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;

class GeneralSettingsController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:general-setting-list|general-setting-create|general-setting-edit|general-setting-delete', ['only' => ['index']]);
         $this->middleware('permission:general-setting-create', ['only' => ['create','store']]);
         $this->middleware('permission:general-setting-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:general-setting-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request){

        abort_if(!auth()->user()->can('general-settings-manage'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $general_settings = GeneralSettings::where('id',1)->first();

            $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
            
            $roles = Role::Where('id','!=','0')->orderBy('id','DESC')->get();

            return view('backend.superadmin.master-settings.master-settings',compact('general_settings','roles','permission'));

        }

        abort_if(!auth()->user()->can('general-settings-manage'),403);
    }


    public function roles(Request $request){

        abort_if(!auth()->user()->can('role-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $general_settings = GeneralSettings::where('id',1)->first();
            $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
            $roles = Role::Where('id','!=','0')->orderBy('id','DESC')->get();
            return view('backend.superadmin.master-settings.master-settings',compact('general_settings','roles','permission'));

        }


        abort_if(!auth()->user()->can('role-list'),403);

    }

    public function smtp(Request $request){

        
        abort_if(!auth()->user()->can('role-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $general_settings = GeneralSettings::where('id',1)->first();
            $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
            $roles = Role::Where('id','!=','0')->orderBy('id','DESC')->get();
            return view('backend.superadmin.master-settings.master-settings',compact('general_settings','roles','permission'));

        }


        abort_if(!auth()->user()->can('role-list'),403);
    }

    public function product(Request $request){

        abort_if(!auth()->user()->can('role-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $general_settings = GeneralSettings::where('id',1)->first();
            $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
            $roles = Role::Where('id','!=','0')->orderBy('id','DESC')->get();
            return view('backend.superadmin.master-settings.master-settings',compact('general_settings','roles','permission'));

        }


        abort_if(!auth()->user()->can('role-list'),403);

    }

    public function createProduct(Request $request){

        abort_if(!auth()->user()->can('role-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $general_settings = GeneralSettings::where('id',1)->first();
            $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
            $roles = Role::Where('id','!=','0')->orderBy('id','DESC')->get();
            
            
            
            
            
            
            return view('backend.superadmin.master-settings.master-settings',compact('general_settings','roles','permission'));

        }


        abort_if(!auth()->user()->can('role-list'),403);
    }




    public function storeProduct(Request $request){

        abort_if(!auth()->user()->can('role-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $this->validate($request, [
                'product_title' => 'required',
                'product_one_time_cost' => 'required|numeric'
                
            ]);



            $product = Product::firstOrNew(array('product_name' =>$request->product_title));
            

            $product->product_name =$request->product_title;


            $product->product_features = implode(",",$request->product_features);
            
        
            $product->save();

            $checkdata = DB::table('product_cost')->where(array('product_id'=>$product->id,'product_cost'=>$request->product_one_time_cost,'product_cost_type'=>'ONE-TIME'))->first();

            if(empty($checkdata)){

                DB::table('product_cost')->insert([
                    'product_id' => $product->id,
                    'product_cost' => $request->product_one_time_cost,
                    'product_cost_type'=>'ONE-TIME',
                    'product_discount'=>$request->product_dicount,
                    
                ]);
            }

            $installment_no = $request->installmentno;

            for($i=1;$i<=$installment_no;$i++){

                //check data exist or not 

                if(!empty($_POST["installment_no_$i"]) && !empty($_POST["installment_cost_$i"]) && !empty($_POST["installment_terms_$i"])){


                    $checkdata = DB::table('product_cost')->insert([
                        'product_id' => $product->id,
                        'product_cost' => $_POST["installment_cost_$i"],
                        'product_cost_type'=>'INSTALLMENT',
                        'product_installment_number'=>$_POST["installment_no_$i"],
                        'product_installment_terms' => $_POST["installment_terms_$i"]
                        
                    ]);

                }

                



            }
            
            
            

            return redirect()->route('product-settings')
                        ->with('success','New Product created successfully!');
           

        }


        abort_if(!auth()->user()->can('role-list'),403);

    }


    public function editProduct(Request $request, $id){

        abort_if(!auth()->user()->can('role-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $general_settings = GeneralSettings::where('id',1)->first();
            $permission = Permission::select('module_name')->groupBy('module_name')->orderBy('id','ASC')->get();
            $roles = Role::Where('id','!=','0')->orderBy('id','DESC')->get();
            
            $product = Product::find(decrypt($id));
            
            
            
            
            return view('backend.superadmin.master-settings.master-settings',compact('general_settings','roles','permission','product'));

        }


        abort_if(!auth()->user()->can('role-list'),403);



    }

    public function updateProduct(Request $request){

        abort_if(!auth()->user()->can('role-list'),403);
        
        //exit;
        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

            $this->validate($request, [
                'product_title' => 'required',
                'product_one_time_cost' => 'required|numeric'
                
            ]);



            $product = Product::find(decrypt($request->productid));

            if(empty($product)){

                return redirect()->route('product-settings')
                ->with('error','Product not found');

            }
            

            $product->product_name =$request->product_title;


            $product->product_features = implode(",",$request->product_features);
            
        
            $product->save();

            
            //if(empty($checkdata)){

                

                DB::table('product_cost')
                    ->where('product_id',$product->id)
                    ->where('product_cost_type','ONE-TIME')
                    ->update([
                    'product_cost' => $request->product_one_time_cost,
                    'product_discount'=>$request->product_dicount,
                    
                ]);



           // }

             $installment_no = intval($request->installmentno)+1;
            
             $data_exist = DB::table('product_cost')
                        ->where('product_id',$product->id)
                        ->where('product_cost_type','INSTALLMENT')                        
                        ->first();

                // if(isset($data_exist) && !empty($data_exist)){

                //         $data_exist = DB::table('product_cost')
                //         ->where('product_id',$product->id)
                //         ->where('product_cost_type','INSTALLMENT')
                //         ->delete();

                // }
            
            for($i=1;$i<$installment_no;$i++){
               
                //check data exist or not 

               

                if(!empty($_POST["installment_no_$i"]) && !empty($_POST["installment_cost_$i"]) && !empty($_POST["installment_terms_$i"])){

                    $data_exist = DB::table('product_cost')
                        ->where('product_id',$product->id)
                        ->where('product_cost_type','INSTALLMENT')
                        ->where('product_installment_number',$_POST["installment_no_$i"])
                        ->get();
                       

                    if(count($data_exist)>0){
                            
                                DB::table('product_cost')
                                ->where('product_id',$product->id)
                                ->where('product_cost_type','INSTALLMENT')
                                ->where('product_installment_number',$_POST["installment_no_$i"])
                                ->update([
                                    'product_cost' => $_POST["installment_cost_$i"],
                                    'product_cost_type'=>'INSTALLMENT',
                                    'product_installment_number'=>$_POST["installment_no_$i"],
                                    'product_installment_terms' => $_POST["installment_terms_$i"]
                                
                            ]);

                    }else{

                       

                        DB::table('product_cost')->insert([
                            'product_id' => $product->id,
                            'product_cost' => $_POST["installment_cost_$i"],
                            'product_cost_type'=>'INSTALLMENT',
                            'product_installment_number'=>$_POST["installment_no_$i"],
                            'product_installment_terms' => $_POST["installment_terms_$i"]
                            
                        ]);

                       

                    }
                    

                }

                



            }
            
            
            

            return redirect()->route('product-settings')
                       ->with('success','Product Updated successfully!');
           

        }


        abort_if(!auth()->user()->can('role-list'),403);

    }


    public function destroyProduct(Request $request, $id){

        abort_if(!auth()->user()->can('role-list'),403);

        $superadmin_array = array("Superadmin","Super-Admin","superadmin","SUPERADMIN","super admin","super-admin","SUPER-ADMIN","SUPER ADMIN");
        if(in_array(strtoupper(auth()->user()->roles->first()->name),$superadmin_array)){

        Product::find(decrypt($id))->delete();
        return redirect()->route('product-settings')
        ->with('success','Product deleted successfully!');

        }

        abort_if(!auth()->user()->can('role-list'),403);

    }


    
}
