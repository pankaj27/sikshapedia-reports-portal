<?php

namespace App\Http\Controllers\Api\v1;

use App\CPU\Helpers ;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\VisitRegisterRequest;
use App\Models\VisitRegister;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class VisitRegisterController extends BaseController
{
    

    public function onLoadVisitRegister(Request $request){

        
        $data   =   [];

        try{
            

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                $data = VisitRegister::where('agent_id','=',$authorization['data']['id'])->orderBy('id','desc')->get();

                if(count($data)>0){

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'You have successfully fetch Visit Register Information',
                    ];
                }else{

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'No information is available',
                    ];

                }
                


            
            }else{


                $response = [
                    'success'   => false,
                    'code'      => Response::HTTP_UNAUTHORIZED,
                    'data'      => $data,
                    'message'   => 'Your existing session token does not authorize you any more',
                ];


            }            

        } catch (\Exception $e) {
            $response = [
                'success'   => false,
                'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
                'data'      => $data,
                'message'   => $e->getMessage(),
            ];
        }

        return $this->sendResponse($response);

    }

    public function storeVisitRegister(VisitRegisterRequest $request){

        $data   =   [];

        try{

            

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                            //check data exist or not 

                            $visitor_management_exist = VisitRegister::where([
                                                    'institution_name' => $request->institute_name,
                                                    'contact_person_name'=>$request->contact_person_name,
                                                    'mobile_1'=>$request->mobile_1,
                                                    'institution_address'=>$request->institution_address,
                                                    'city'=>$request->city,
                                                    'state'=>$request->state_id,
                                                    'district'=>$request->district_id,
                                                    'pin'=>$request->pin
                                                    ])
                                                    ->first();
                                        if(empty($visitor_management_exist)){
                            
                            
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

                                            $response = [
                                                'success' => true,
                                                'code'    => Response::HTTP_OK,
                                                'data'    => $visitor_management,
                                                'message' => 'You have successfully created Visit Register',
                                            ];

                        }else{

                            $response = [
                                'success' => false,
                                'code'    => Response::HTTP_OK,
                                'data'    => $visitor_management_exist,
                                'message' => 'This Visit Register Information is already exist',
                            ];

                        }

                        
                           

            
            }else{


                $response = [
                    'success'   => false,
                    'code'      => Response::HTTP_UNAUTHORIZED,
                    'data'      => $data,
                    'message'   => 'Your existing session token does not authorize you any more',
                ];


            }            

        } catch (\Exception $e) {
            $response = [
                'success'   => false,
                'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
                'data'      => $data,
                'message'   => $e->getMessage(),
            ];
        }

        return $this->sendResponse($response);

    }
}
