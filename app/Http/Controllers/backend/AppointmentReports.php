<?php

namespace App\Http\Controllers\backend;

use App\Models\CallRegister;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BookAppointment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AppointmentReports extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function getDetailAppointmentReport(Request $request)
    {
        $userrole = $request->userrole;
        $user_name = $request->userid;
        //$daterang = explode("-",$request->daterange);
        //$startDate = date('Y-m-d',strtotime(trim($daterang[0])));

       // $endDate = date('Y-m-d',strtotime(trim($daterang[1])));


        $userdata = BookAppointment::where('agent_id',$user_name)
                   // ->whereBetween('start', array("$startDate", "$endDate"))
                    ->orderBy('id','DESC')->get();


        if(count($userdata)>0){

            $status = 1 ;
            $trr ="";

            $i = 1;

            foreach($userdata as $list){

                $username = User::where('id',$list->agent_id)->first();
                $calloo = CallRegister::where('id',$list->organization_name)->first();

                $trr .='<tr>
                
                <td><span>'.$i.'</span></td>';
                
                $trr .='<td>'.date('d/m/Y',strtotime($list->created_at)).'</span></td>
                <td>
                    <div class="products">
                        <div>'.
                            ucwords($calloo->organization_name);
                            
                            
                               

                            
                            $trr .='
                      </div>
                    </div>        
                </td>';
                $trr .='<td>
                    <div class="products">
                        <div>'.
                        $list->contact_person_name;
                           
                        $trr .='</div>	
                    </div>
                </td>
                <td>
                    <div class="products">
                        <div>
                            '.$list->contact_person_mobile.'
                            
                        </div>	
                    </div>
                </td>
                <td>
                    <div class="products">
                        <div>
                            
                            '.$list->contact_person_mobile2.'
                            
                        </div>	
                    </div>
                </td>

                <td>
                    <div class="products">
                        <div>
                        '.$list->organization_address.'
                            
                        </div>	
                    </div>
                <td class="text-center">';
                    if($list->visit_status == 'Appointment Registered' || $list->visit_status == 'Appointment Booked'){

                        $trr .=' <a href="javascript:void(0)" class="teal-btn-radius my-1">'.$list->visit_status.'</a>';
                    }elseif($list->visit_status == 'Not Registered'){
                      
                        $trr .='<a href="javascript:void(0)" class="red-btn-radius my-1">'.$list->visit_status.'</a>';
                    }else{
                    
                        $trr .='<a href="javascript:void(0)" class="yellow-btn-radius my-1">'.$list->visit_status.'</a>';
                    }
                    $trr .='</td>
                <td>'.$username->name;
                    
                      
                      
                $trr .='</td>
                </tr>';

                $i++;
            }

            

        }else{

            $status = 0;

            $trr .='<tr><td colspan="9" class="text-center">No information available</td></tr>';

        }


        return response()->json(['status'=>$status,'data'=>$trr]);

    }
    public function index()
    {
        abort_if(!auth()->user()->can('appointment reports-list'),403);

        $roles = DB::table('roles')->whereNotIn('name',['Superadmin','Admin'])->get();

        if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){

            return view('backend.superadmin.reports.appointment-reports',compact('roles'));
        }
        return view('backend.reports.appointment-reports',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
