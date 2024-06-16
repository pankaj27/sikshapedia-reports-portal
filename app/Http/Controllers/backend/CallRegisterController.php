<?php

namespace App\Http\Controllers\backend;

use App\Models\CallRegister;
use App\Models\FollowUp;
use DB;
use App\Models\visitor;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\VisitorManagement;
use Spatie\Permission\Models\Role;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
class CallRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        //$permission = Permission::get();
        abort_if(!auth()->user()->can('visitor-list'),403);
        
        if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){
            \LogActivity::addToLog('Access Call Register Page');
            $userRole = auth()->user()->roles->pluck('name')[0];
            $visitors_list = DB::table('call_registers')->orderBy('id','desc')->get();

            $total_call = CallRegister::all()->count();
            $call_receive = CallRegister::where('visit_status','Call-Receive')->count();
            $call_rejected = CallRegister::where('visit_status','Call-Rejected')->count();
            $call_not_interested = CallRegister::where('visit_status','Call-Not-Picked')->count();
            $appointment_fixed = CallRegister::where('visit_status','Appointment-Fixed')->count();
           


            //$agentList = User::with('roles')->get();
            $userList = User::where('id', '!=',1)->get();
            return view('backend.call-register.list',compact('visitors_list','total_call','userRole','userList','call_receive','call_rejected','call_not_interested','appointment_fixed'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

        }else{
            
             \LogActivity::addToLog('Access Call Register Page');

            

            $userRole = auth()->user()->roles->pluck('name')[0];
            $userList = User::where('id', '!=',1)->get();
            $total_call = CallRegister::where('agent_id',auth()->user()->id)->count();
            $call_receive = CallRegister::where('agent_id',auth()->user()->id)->where('visit_status','Call-Receive')->count();
            $call_rejected = CallRegister::where('agent_id',auth()->user()->id)->where('visit_status','Call-Rejected')->count();
            $call_not_interested = CallRegister::where('agent_id',auth()->user()->id)->where('visit_status','Call-Not-Picked')->count();
            $appointment_fixed = CallRegister::where('agent_id',auth()->user()->id)->where('visit_status','Appointment-Fixed')->count();
            
            $visitors_list = DB::table('call_registers')->where('agent_id','=',auth()->user()->id)->orderBy('id','desc')->get();
            return view('backend.call-register.list',compact('visitors_list','total_call','userRole','userList','call_receive','call_rejected','call_not_interested','appointment_fixed'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

        }
       
    }

    public function store(Request $request)
    {
        
        

        $validator = Validator::make($request->all(), [
            'organization_name' => 'required',
            'contact_person_name' => 'required',
            'contact_person_mobile' => 'required|numeric|digits:10',
            'organization_address' => 'required',
            // 'agent_id' => 'required',
            // 'visit_status' => 'required',
             ]);
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

        $call_register = new CallRegister;

        $call_register->organization_name =$request->organization_name;
        $call_register->contact_person_name =$request->contact_person_name;
        $call_register->contact_person_mobile =$request->contact_person_mobile;
        $call_register->contact_person_mobile2 =$request->contact_person_mobile2;
        $call_register->organization_address =$request->organization_address;
        //$call_register->remarks =$request->remarks;
        //$call_register->visit_status = $request->visit_status;
        //$call_register->agent_id = $request->agent_id;
        
        $call_register->save();
      
        
        
         return redirect()->route('call-register.list')
                        ->with('success','Call Register Information created successfully');
    }

    public function storeAgentData(Request $request){
        
        $validator = Validator::make($request->all(), [
            'organization_name' => 'required|min:5',
            'contact_person_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'contact_person_mobile' => 'required|numeric|digits:10',
            'organization_address' => 'required',
            
             ]);
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

            $call_register = CallRegister::firstOrNew(array('organization_name' => $request->organization_name,'contact_person_name'=>$request->contact_person_name,'contact_person_mobile'=>$request->contact_person_mobile,'organization_address'=>$request->organization_address));
            

            $call_register->organization_name =$request->organization_name;
            $call_register->contact_person_name =$request->contact_person_name;
            $call_register->contact_person_mobile =$request->contact_person_mobile;
            $call_register->contact_person_mobile2 =$request->contact_person_mobile2;
            $call_register->organization_address =$request->organization_address;
            $call_register->agent_id = auth()->user()->id;
        
            $call_register->save();
        
         \LogActivity::addToLog('successfully submitted Call Register.Data inserted-'.json_encode($call_register));

        return redirect()->route('call-register.list')
                        ->with('success','Call Register Information created successfully');
             
    
    
    }


    public function updateStatus(Request $request){

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'status' => 'required',
            'remarks' => 'required',
            
             ]);
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

        $call_register = FollowUp::firstOrNew(array('remarks' => $request->remarks,'call_register_id'=>$request->call_reg_id,'visit_status'=>$request->status,'follow_up_date'=>date('Y-m-d', strtotime($request->date))));
        $call_register->remarks =$request->remarks;
        $call_register->call_register_id  = $request->call_reg_id;
        $call_register->visit_status = $request->status;
        $call_register->agent_id = auth()->user()->id;
        $call_register->follow_up_date = date('Y-m-d', strtotime($request->date));
        $call_register->save();
        
        \LogActivity::addToLog('successfully Inserted data to Follow up Tables.Data inserted-'.json_encode($call_register));


        //update call register main table 

        $call_register2 = CallRegister::find($request->call_reg_id);
        $call_register2->visit_status = $request->status;
        $call_register2->save();
        
         \LogActivity::addToLog('successfully Updated Status on Call Register');

        

        return redirect()->route('call-register.list')
                        ->with('success','Call Register Information updated successfully.');
             
    

    }
}
