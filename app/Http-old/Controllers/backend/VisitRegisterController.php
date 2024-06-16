<?php

namespace App\Http\Controllers\backend;

use App\Models\VisitRegister;
use App\Models\VisitRegisterFollowups;
use DB;
use App\Models\visitor;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\VisitorManagement;
use Spatie\Permission\Models\Role;
use App\CPU\ImageManager;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class VisitRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        //$permission = Permission::get();
        abort_if(!auth()->user()->can('visitor-list'),403);
        
        if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){
            $userRole = auth()->user()->roles->pluck('name')[0];
            $visitors_list = DB::table('visit_registers')->orderBy('id','ASC')->get();

            $total_visit = VisitorManagement::all()->count();
            $positive_visit = VisitorManagement::where('visit_status','Positive')->count();
            $interested_visit = VisitorManagement::where('visit_status','Very Interested')->count();
            $ask_to_visit = VisitorManagement::where('visit_status','Asked to Visit Again')->count();
            $actual_person_not_present = VisitorManagement::where('visit_status','Actual Person absent')->count();
            $completed = VisitorManagement::where('visit_status','Completed')->count();

            $state_list = DB::table('districts')->distinct()->get(['State']);
            
            $college_instlist = DB::table('call_registers')->orderBy('organization_name','ASC')->get();
            
            \LogActivity::addToLog('Successfully access to page Visit Register Page');


            //$agentList = User::with('roles')->get();
            $userList = User::where('id', '!=',1)->get();
            return view('backend.visit-report.list',compact('state_list','college_instlist','visitors_list','userRole','userList','total_visit','positive_visit','interested_visit','ask_to_visit','actual_person_not_present','completed'))
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
            $state_list = DB::table('districts')->distinct()->get(['State']);
            $college_instlist = DB::table('call_registers')->where('agent_id',auth()->user()->id)->orderBy('organization_name','ASC')->get();
            
             \LogActivity::addToLog('Successfully access to page Visit Register Page');

            $visitors_list = DB::table('visit_registers')->where('agent_id','=',auth()->user()->id)->orderBy('id','ASC')->get();
            return view('backend.visit-report.list',compact('state_list','college_instlist','visitors_list','userRole','userList','total_visit','positive_visit','interested_visit','ask_to_visit','actual_person_not_present','completed'))
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
            'agent_id' => 'required',
            'visit_status' => 'required',
             ]);
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

        $visitor_management = new VisitorManagement;

        $visitor_management->organization_name =$request->organization_name;
        $visitor_management->contact_person_name =$request->contact_person_name;
        $visitor_management->contact_person_mobile =$request->contact_person_mobile;
        $visitor_management->contact_person_mobile2 =$request->contact_person_mobile2;
        $visitor_management->organization_address =$request->organization_address;
        $visitor_management->remarks =$request->remarks;
        $visitor_management->visit_status = $request->visit_status;
        $visitor_management->agent_id = $request->agent_id;
        
        $visitor_management->save();
        
         \LogActivity::addToLog('Successfully submitted visit register. Data inserted-'.json_encode($visitor_management));
      
        
        
         return redirect()->route('call-register.list')
                        ->with('success','Call Register Information created successfully');
    }

    public function storeAgentData(Request $request){
        
        $validator = Validator::make($request->all(), [
            'institute_name' => 'required',
            'contact_person_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'mobile_1' => 'required|numeric|digits:10',
            'institution_email_id' => 'required|email',
            'institution_address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            'city' => 'required|regex:/^[\pL\s]+$/u|min:2',
            'state_id' => 'required',
            'district_id' => 'required',
            'pin' => 'required|numeric|digits:6',
            'visit_date' => 'required',
            'appointment_time' => 'required',
            'special_note' => 'required',            
            'status' => 'required',
             ]);
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

        $visitor_management = VisitRegister::firstOrNew(
                array(
                    'institution_name' => $request->institute_name,
                    'contact_person_name'=>$request->contact_person_name,
                    'mobile_1'=>$request->mobile_1,
                    'institution_address'=>$request->institution_address,
                    'city'=>$request->city,
                    'state'=>$request->state_id,
                    'district'=>$request->district_id,
                    'pin'=>$request->pin,
                    'visit_date'=>date('Y-m-d',strtotime($request->visit_date)),
                    'appointment_time'=>$request->appointment_time,
                    'special_note'=>$request->special_note,
                    'visit_status'=>$request->status,
                    
                    ));

        $visitor_management->institution_name =$request->institute_name;
        $visitor_management->contact_person_name =$request->contact_person_name;
        $visitor_management->mobile_1 =$request->mobile_1;
        $visitor_management->mobile_2 =$request->mobile_2;
        $visitor_management->institution_email_id =$request->institution_email_id;
        $visitor_management->institution_address =$request->institution_address;
        $visitor_management->city = $request->city;
        $visitor_management->state= $request->state_id;
        $visitor_management->district = $request->district_id;
        $visitor_management->pin = $request->pin;
        $visitor_management->visit_date = date('Y-m-d',strtotime($request->visit_date));
        $visitor_management->appointment_time = $request->appointment_time;
        $visitor_management->special_note = $request->special_note;
        $visitor_management->visit_status = $request->status;
        if ($request->file('doc_uplode_path')) {
          
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';
            if (!Storage::disk('public')->exists('doc_images/')) {
                Storage::disk('public')->makeDirectory('doc_images/');
            }
            Storage::disk('public')->put('doc_images/' . $imageName, file_get_contents($request->file('doc_uplode_path')));
            
             $visitor_management->images = $imageName;
        }
       
        $visitor_management->agent_id = auth()->user()->id;
        
        $visitor_management->save();
        
        
        \LogActivity::addToLog('Successfully submitted visit register. Data inserted-'.json_encode($visitor_management));

        return redirect()->route('visit-register.list')
                        ->with('success','Visit Information created successfully');
             
    
    
    }


    public function detailVisitReport(Request $request, $slug){
        //abort_if(!auth()->user()->can('visitor-list'),403);
        $vistor_id = base64_decode($slug);
        $visitors_list = DB::table('visit_registers')->where('agent_id','=',auth()->user()->id)->where('id',$vistor_id)->orderBy('id','ASC')->first();
        if((isset($visitors_list) && !empty($visitors_list))){
            
            \LogActivity::addToLog('Successfully access details visit report page-'.json_encode($visitors_list));
            
             return view('backend.visit-report.details-visit-report',compact('visitors_list'));
            
        }else{
            
            if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){
                
                $visitors_list = DB::table('visit_registers')->where('id',$vistor_id)->orderBy('id','ASC')->first();
                \LogActivity::addToLog('Successfully access details visit report page-'.json_encode($visitors_list));
            
                return view('backend.superadmin.reports.details-visit-report',compact('visitors_list'));
                
            }else if(auth()->user()->roles->pluck('name')[0] == 'Sales Manager'){
                
                $visitors_list = DB::table('visit_registers')->where('id',$vistor_id)->orderBy('id','ASC')->first();
                \LogActivity::addToLog('Successfully access details visit report page-'.json_encode($visitors_list));
            
                return view('backend.reports.details-visit-report',compact('visitors_list'));
            }else{
                
                 abort(403);
            }
            
          
            
        }
        

    }



    public function getDistrictDetails(Request $request){

        $state_name = $request->state_name;
        $district_list = DB::table('districts')->where('State',$state_name)->get();
        if(count($district_list)>0){

            $opt ='<option value="">Select District</option>';
            foreach($district_list as $lidd){
                $opt .= '<option value="'.$lidd->District.'">'.$lidd->District.'</option>' ;
            }

            $status = 1;
        }else{

            $opt ='<option value="">Select District</option>';
            $status = 0;

        }


        return response()->json(['success'=>$status,'data'=>$opt]);



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
           

          

        $call_register = VisitRegisterFollowups::firstOrNew(array('remarks' => $request->remarks,'visit_id'=>$request->visit_id,'status'=>$request->status,'followup_date'=>date('Y-m-d', strtotime($request->date))));
        $call_register->remarks =$request->remarks;
        $call_register->visit_id  = $request->visit_id;
        $call_register->status = $request->status;
        $call_register->agent_id = auth()->user()->id;
        $call_register->followup_date = date('Y-m-d', strtotime($request->date));
        $call_register->save();
        
        \LogActivity::addToLog('successfully Inserted data to Follow up Tables.Data inserted-'.json_encode($call_register));


        //update call register main table 

        $call_register2 = VisitRegister::find($request->visit_id);
        $call_register2->visit_status = $request->status;
        $call_register2->save();
        
         \LogActivity::addToLog('successfully Updated Status on Call Register');

        

        return redirect()->route('visit-register.list')
                        ->with('success','Visit Register Information updated successfully.');
             
    

    }
}
