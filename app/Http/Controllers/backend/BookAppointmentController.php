<?php

namespace App\Http\Controllers\backend;

use App\Models\BookAppointment;
use App\Models\CallRegister;
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

class BookAppointmentController extends Controller
{
    public function index(Request $request): View
    {
        //$permission = Permission::get();
        abort_if(!auth()->user()->can('visitor-list'),403);
        
        if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){
            $userRole = auth()->user()->roles->pluck('name')[0];
            $visitors_list = DB::table('book_appointments')->orderBy('id','ASC')->get();
            $college_instlist = DB::table('call_registers')->orderBy('organization_name','ASC')->get();

            $total_appointment = BookAppointment::all()->count();
            $appointment_visit = BookAppointment::where('visit_status','Appointment-Visit')->count();
            $appointment_revisit = BookAppointment::where('visit_status','Appointment-Revisit')->count();
            $not_interested = BookAppointment::where('visit_status','Not-Interested')->count();
            
            \LogActivity::addToLog('Successfully access to page Book/Register Appointment ');

            //$agentList = User::with('roles')->get();
            $userList = User::where('id', '!=',1)->get();
            return view('backend.book-appointment.list',compact('visitors_list','college_instlist','userRole','userList','total_appointment','appointment_visit','appointment_revisit','not_interested'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

        }else{

            

            $userRole = auth()->user()->roles->pluck('name')[0];
            $userList = User::where('id', '!=',1)->get();
            $college_instlist = DB::table('call_registers')->where('agent_id',auth()->user()->id)->orderBy('organization_name','ASC')->get();
            $total_appointment = BookAppointment::where('agent_id',auth()->user()->id)->count();
            $appointment_visit = BookAppointment::where('agent_id',auth()->user()->id)->where('visit_status','Appointment-Visit')->count();
            $appointment_revisit = BookAppointment::where('agent_id',auth()->user()->id)->where('visit_status','Appointment-Revisit')->count();
            $not_interested = BookAppointment::where('agent_id',auth()->user()->id)->where('visit_status','Not-Interested')->count();
            
            $visitors_list = DB::table('book_appointments')->where('agent_id','=',auth()->user()->id)->orderBy('id','ASC')->get();
            
            \LogActivity::addToLog('Successfully access to page Book/Register Appointment ');
            
            
            
            return view('backend.book-appointment.list',compact('visitors_list','college_instlist','userRole','userList','total_appointment','appointment_visit','appointment_revisit','not_interested'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

        }
       
    }

    public function store(Request $request)
    {
        
        

        $validator = Validator::make($request->all(), [
            'organization_name' => 'required',
            'contact_person_name' => 'required',
            'contact_person_mobile' => 'required|numeric|digits:10',
            'organization_address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'appointment_date' => 'required',
            'appointment_timing'=>'required',
            'remarks'=>'required',
            'agent_id' => 'required',
            'visit_status' => 'required',
             ]);
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

        $book_appointment = BookAppointment::firstOrNew(
                                array(
                                    'organization_name' => $request->organization_name,
                                    'contact_person_name'=>$request->contact_person_name,
                                    'contact_person_mobile'=>$request->contact_person_mobile,
                                    'organization_address'=>$request->organization_address,
                                    'appointment_date'=> date('Y-m-d',strtotime($request->appointment_date)),
                                    'appointment_timing'=>$request->appointment_timing,
                                    'remarks'=>$request->remarks
                                    ));
        
        
        

        $book_appointment->organization_name =$request->organization_name;
        $book_appointment->contact_person_name =$request->contact_person_name;
        $book_appointment->contact_person_mobile =$request->contact_person_mobile;
        $book_appointment->contact_person_mobile2 =$request->contact_person_mobile2;
        $book_appointment->organization_address =$request->organization_address;
        $book_appointment->appointment_date =date('Y-m-d',strtotime($request->appointment_date));
        $book_appointment->appointment_timing =$request->appointment_timing;
        $book_appointment->remarks =$request->remarks;
       // $book_appointment->visit_status = $request->visit_status;
        
        $book_appointment->agent_id = $request->agent_id;
        
        $book_appointment->save();
      
        \LogActivity::addToLog('Successfully submitted Book/Register appointment .Data inserted-'.json_encode($book_appointment));
        
         return redirect()->route('book-appointment.list')
                        ->with('success','Appointment Booking Information created successfully');
    }

    public function storeAgentData(Request $request){
        
        $validator = Validator::make($request->all(), [
            'organization_name' => 'required',
            'contact_person_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'contact_person_mobile' => 'required|numeric|digits:10',
            'organization_address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            'appointment_date' => 'required',
            'remarks'=>'required',
            
             ]);
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            } 
           

          

        $book_appointment =  BookAppointment::firstOrNew(
                                array(
                                    'organization_name' => $request->organization_name,
                                    'contact_person_name'=>$request->contact_person_name,
                                    'contact_person_mobile'=>$request->contact_person_mobile,
                                    'organization_address'=>$request->organization_address,
                                    'appointment_date'=> date('Y-m-d',strtotime($request->appointment_date)),
                                    'appointment_timing'=>$request->appointment_timing,
                                    'remarks'=>$request->remarks
                                    ));

        $book_appointment->organization_name =$request->organization_name;
        $book_appointment->contact_person_name =$request->contact_person_name;
        $book_appointment->contact_person_mobile =$request->contact_person_mobile;
        $book_appointment->contact_person_mobile2 =$request->contact_person_mobile2;
        $book_appointment->organization_address =$request->organization_address;
        $book_appointment->appointment_date =date('Y-m-d',strtotime($request->appointment_date));
        $book_appointment->appointment_timing =date('H:i:s A',strtotime($request->appointment_timing));
        $book_appointment->remarks =$request->remarks;
         $book_appointment->agent_id = auth()->user()->id;
        
        $book_appointment->save();
        
        \LogActivity::addToLog('Successfully submitted Book/Register appointment .Data inserted-'.json_encode($book_appointment));

        return redirect()->route('book-appointment.list')
                        ->with('success','Appointment booking Information created successfully');
             
    
    
    }


    public function getInstituteDetails(Request $request){

        $college_id = $request->college_id;

        $college_info_details = CallRegister::where('id',$college_id)->first();

        if(isset($college_info_details) && !empty($college_info_details)){
            
            \LogActivity::addToLog('Successfully access institute details .Data inserted-'.json_encode($college_info_details));

            return response()->json(['success'=>1,'data'=>$college_info_details]);

         } else{
             
             \LogActivity::addToLog('Successfully access institute details .Data not available in institute details ');

            return response()->json(['success'=>0,'data'=>$college_info_details]);
            
        }
        
        

    }
}
