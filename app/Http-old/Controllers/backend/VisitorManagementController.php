<?php

namespace App\Http\Controllers\backend;

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

class VisitorManagementController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:visitor-list|visitor-create|visitor-edit|visitor-delete', ['only' => ['index']]);
        //  $this->middleware('permission:visitor-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:visitor-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:visitor-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request): View
    {
        //$permission = Permission::get();
        abort_if(!auth()->user()->can('visitor-list'),403);
        
        if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){
            $userRole = auth()->user()->roles->pluck('name')[0];
            $visitors_list = DB::table('visitor_management')->orderBy('id','ASC')->get();

            $total_visit = VisitorManagement::all()->count();
            $positive_visit = VisitorManagement::where('visit_status','Positive')->count();
            $interested_visit = VisitorManagement::where('visit_status','Very Interested')->count();
            $ask_to_visit = VisitorManagement::where('visit_status','Asked to Visit Again')->count();
            $actual_person_not_present = VisitorManagement::where('visit_status','Actual Person absent')->count();
            $completed = VisitorManagement::where('visit_status','Completed')->count();


            //$agentList = User::with('roles')->get();
            $userList = User::where('id', '!=',1)->get();
            return view('backend.visitor-management.list',compact('visitors_list','userRole','userList','total_visit','positive_visit','interested_visit','ask_to_visit','actual_person_not_present','completed'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

        }else{

            

            $userRole = auth()->user()->roles->pluck('name')[0];
            $userList = User::where('id', '!=',1)->get();
            $total_visit = VisitorManagement::where('agent_id',auth()->user()->id)->count();
            $positive_visit = VisitorManagement::where('agent_id',auth()->user()->id)->where('visit_status','Positive')->count();
            $interested_visit = VisitorManagement::where('agent_id',auth()->user()->id)->where('visit_status','Very Interested')->count();
            $ask_to_visit = VisitorManagement::where('agent_id',auth()->user()->id)->where('visit_status','Asked to Visit Again')->count();
            $actual_person_not_present = VisitorManagement::where('agent_id',auth()->user()->id)->where('visit_status','Actual Person absent')->count();
            $completed = VisitorManagement::where('agent_id',auth()->user()->id)->where('visit_status','Completed')->count();

            $visitors_list = DB::table('visitor_management')->where('agent_id','=',auth()->user()->id)->orderBy('id','ASC')->get();
            return view('backend.visitor-management.list',compact('visitors_list','userRole','userList','total_visit','positive_visit','interested_visit','ask_to_visit','actual_person_not_present','completed'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

        }
       
    }

    public function store(Request $request)
    {
        
        

        $validator = Validator::make($request->all(), [
            'organization_name' => 'required',
            'contact_person_name' => 'required',
            'contact_person_designation' => 'required',
            'contact_person_mobile' => 'required|numeric|digits:10',
            'organization_mobile' => 'required|numeric|digits:10',
            'organization_email' => 'required|email|unique:visitor_management',
            'organization_address' => 'required',
            'organization_city' => 'required',
            'organization_state' => 'required',
            'organization_district' => 'required',            
            'next_followup_date' => 'required',
            'organization_pincode' =>'required|numeric|digits:6',
            'remarks' => 'required',
            'agent_id' => 'required',
            'visit_status' => 'required',
             ]);
            if ($validator->fails())
            {
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

        $visitor_management = new VisitorManagement;

        $visitor_management->organization_name =$request->organization_name;
        $visitor_management->contact_person_name =$request->contact_person_name;
        $visitor_management->contact_person_designation =$request->contact_person_designation;
        $visitor_management->contact_person_mobile =$request->contact_person_mobile;
        $visitor_management->organization_mobile =$request->organization_mobile;
        $visitor_management->organization_email =$request->organization_email;
        $visitor_management->organization_address =$request->organization_address;
        $visitor_management->organization_city =$request->organization_city;
        $visitor_management->organization_state =$request->organization_state;
        $visitor_management->organization_district =$request->organization_district;
        $visitor_management->organization_pincode =$request->organization_pincode;
        $visitor_management->next_followup_date =$request->next_followup_date;
        $visitor_management->agent_visiting_date =$request->agent_visiting_date;
        $visitor_management->remarks =$request->remarks;
        $visitor_management->visit_status = $request->visit_status;
        $visitor_management->agent_id = $request->agent_id;
        
        $visitor_management->save();
      
        
        
         return redirect()->route('visitor-management.list')
                        ->with('success','Visitor Information created successfully');
    }

    public function storeAgentData(Request $request){
        
        $validator = Validator::make($request->all(), [
            'organization_name' => 'required',
            'contact_person_name' => 'required',
            'contact_person_designation' => 'required',
            'contact_person_mobile' => 'required|numeric|digits:10',
            'organization_mobile' => 'required|numeric|digits:10',
            'organization_email' => 'required|email|unique:visitor_management',
            'organization_address' => 'required',
            'organization_city' => 'required',
            'organization_state' => 'required',
            'organization_district' => 'required',            
            'next_followup_date' => 'required',
            'organization_pincode' =>'required|numeric|digits:6',          
            'visit_status' => 'required',
             ]);
            if ($validator->fails())
            {
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

        $visitor_management = new VisitorManagement;

        $visitor_management->organization_name =$request->organization_name;
        $visitor_management->contact_person_name =$request->contact_person_name;
        $visitor_management->contact_person_designation =$request->contact_person_designation;
        $visitor_management->contact_person_mobile =$request->contact_person_mobile;
        $visitor_management->organization_mobile =$request->organization_mobile;
        $visitor_management->organization_email =$request->organization_email;
        $visitor_management->organization_address =$request->organization_address;
        $visitor_management->organization_city =$request->organization_city;
        $visitor_management->organization_state =$request->organization_state;
        $visitor_management->organization_district =$request->organization_district;
        $visitor_management->organization_pincode =$request->organization_pincode;
        $visitor_management->next_followup_date =$request->next_followup_date;
        $visitor_management->agent_visiting_date =$request->agent_visiting_date;
        $visitor_management->remarks =$request->remarks;
        $visitor_management->visit_status = $request->visit_status;
        $visitor_management->agent_id = auth()->user()->id;
        
        $visitor_management->save();

        return redirect()->route('visitor-management.list')
                        ->with('success','Visitor Information created successfully');
             
    
    
    }
}
