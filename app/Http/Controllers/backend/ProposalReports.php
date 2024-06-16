<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\User;
use App\Models\Proposals;
use App\Models\CallRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProposalReports extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function getDetailProposalReport(Request $request){

        
        $userrole = $request->userrole;
        $user_name = $request->userid;
        //$daterang = explode("-",$request->daterange);
        //$startDate = date('Y-m-d',strtotime(trim($daterang[0])));

       // $endDate = date('Y-m-d',strtotime(trim($daterang[1])));


        $userdata = Proposals::where('email_sent_by',$user_name)
                   // ->whereBetween('start', array("$startDate", "$endDate"))
                    ->orderBy('id','DESC')->get();


        if(count($userdata)>0){

            $status = 1 ;
            $trr ="";

            $i = 1;

            foreach($userdata as $list){

                $username = User::where('id',$list->email_sent_by)->first();
                $calloo = CallRegister::where('id',$list->institute_id)->first();

                $product_name = Product::where('id',$list->product_id)->first();
                $product_inst = DB::table('product_costs')->where('id',$list->payment_id)->first();
                if($product_inst->product_cost_type == 'INSTALLMENT'){

                    $productinss = $product_inst->product_installment_number ."- INSTALLMENT";

                }else{

                    $productinss = "ONE TIME";
                }
                

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
                        $list->contact_person;
                           
                        $trr .='<br>M: '.$list->mobile_number.'<br>E: '.$list->email_address.'</div>	
                    </div>
                </td>
                <td>
                    <div class="products">
                        <div>
                        '.$list->communicaton_address.'
                            
                        </div>	
                    </div></td>
                <td>
                    <div class="products">
                        <div>
                            <b>
                            '.$product_name->product_name.' ('.$productinss.')
                            </b>  
                        </div>	
                    </div>
                </td>
                <td>
                    <div class="products">
                        <div>
                            <h3>
                            RS.'.$list->product_total_cost.'
                            </h3> 
                            <span class="text-danger">[Cost-'.$list->product_cost.', Dis.- '.$list->product_discount.', GST(18%)- '.(($list->product_cost - $list->product_discount)*.18).', Total- '.$list->product_total_cost.']</span>  
                        </div>	
                    </div>
                </td>

                
                    <td>
                <div class="products">
                        <div>
                        '.$list->proposal_message_body.'
                            
                        </div>	
                    </div></td>
                <td class="text-center">';
                
              
                    $trr .='<a target="_blank" href="'.asset('storage/app/public/proposal/'.$list->proposal_file.'').'" class="yellow-btn-radius my-1">View Proposal Copy</a>';
              
                
                    $trr .='</td>
                <td>'.$username->name;
                    
                      
                      
                $trr .='</td>
                </tr>';

                $i++;
            }

            

        }else{{}

            $status = 0;

            $trr .='<tr><td colspan="10" class="text-center">No information available</td></tr>';

        }


        return response()->json(['status'=>$status,'data'=>$trr]);

     }

    public function index()
    {
        abort_if(!auth()->user()->can('proposal reports-list'),403);

        $roles = DB::table('roles')->whereNotIn('name',['Superadmin','Admin'])->get();

        if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){

            return view('backend.superadmin.reports.proposal-reports',compact('roles'));
        }
        return view('backend.reports.proposal-reports',compact('roles'));
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
