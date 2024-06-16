<?php

namespace App\Http\Controllers\Api\v1;
use App\CPU\Helpers;
use App\Models\CallRegister;
use Illuminate\Http\Request;

use App\Models\BookAppointment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\BookAppointmentRequest;
use Symfony\Component\HttpFoundation\Response;

class BookAppointmentController extends BaseController
{
    /**
    * Call Register List api
    *
    * @return \Illuminate\Http\Response
    */

    public function getInstituteList(Request $request)
    {
        $data   =   [];

        try{
            

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                $data = CallRegister::where('agent_id','=',$authorization['data']['id'])->orderBy('organization_name','ASC')->get(['id','organization_name','contact_person_name','contact_person_mobile','contact_person_mobile2','organization_address']);
                // $data = DB::table('call_registers')
                // ->select('call_registers.id','call_registers.organization_name','book_appointments.contact_person_name','book_appointments.contact_person_name','book_appointments.contact_person_mobile','book_appointments.contact_person_mobile2','book_appointments.organization_address')
                // ->join('book_appointments','call_registers.id','=','book_appointments.organization_name')
                // ->where(['agent_id' => $authorization['data']['id'], 'otherThing' => 'otherThing'])
                // ->orderBy('organization_name','ASC')
                // ->get();
                if(count($data)>0){

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'You have successfully fetch Institute List',
                    ];
                }else{

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'No institute is available',
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

     /**
    * Call Register List api
    *
    * @return \Illuminate\Http\Response
    */

    public function getDetailsInstituteInformation(Request $request, $instId)
    {
        $data   =   [];

        try{
            

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                $data = CallRegister::where('agent_id','=',$authorization['data']['id'])->where('id','=',$instId)->get();

                if(count($data)>0){

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'You have successfully fetch Institute details',
                    ];
                }else{

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'You do not have access this Institute Details',
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

    /**
    * Call Register List api
    *
    * @return \Illuminate\Http\Response
    */

    public function onLoadBookAppointments(Request $request)
    {
        $data   =   [];

        try{
            

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                $data = BookAppointment::where('agent_id','=',$authorization['data']['id'])->orderBy('id','desc')->get();

                if(count($data)>0){

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'You have successfully fetch Book Appointment Information',
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

    public function storeBookAppointments(BookAppointmentRequest $request)
    {
        $data   =   [];

        try{

            

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                            //check data exist or not 

                            $book_appointment_exist = BookAppointment::where(['organization_name' => $request->institute_id,
                                                    'contact_person_name'=>$request->contact_person_name,
                                                    'contact_person_mobile'=>$request->contact_person_mobile,
                                                    'organization_address'=>$request->organization_address,
                                                    'appointment_date'=> date('Y-m-d',strtotime($request->appointment_date)),
                                                    'appointment_timing'=>$request->appointment_timing,
                                                    'remarks'=>$request->remarks])
                                                    ->first();
                                        if(empty($book_appointment_exist)){
                            
                            
                                            $book_appointment =BookAppointment::firstOrNew(
                                                                    array(
                                                                        'organization_name' => $request->institute_id,
                                                                        'contact_person_name'=>$request->contact_person_name,
                                                                        'contact_person_mobile'=>$request->contact_person_mobile,
                                                                        'organization_address'=>$request->organization_address,
                                                                        'appointment_date'=> date('Y-m-d',strtotime($request->appointment_date)),
                                                                        'appointment_timing'=>$request->appointment_timing,
                                                                        'remarks'=>$request->remarks
                                                                        ));
                                            
                                            
                                            
                                    
                                            $book_appointment->organization_name =$request->institute_id;
                                            $book_appointment->contact_person_name =$request->contact_person_name;
                                            $book_appointment->contact_person_mobile =$request->contact_person_mobile;
                                            $book_appointment->contact_person_mobile2 =$request->contact_person_mobile2;
                                            $book_appointment->organization_address =$request->organization_address;
                                            $book_appointment->appointment_date =date('Y-m-d',strtotime($request->appointment_date));
                                            $book_appointment->appointment_timing =date('H:i:s A',strtotime($request->appointment_timing));
                                            $book_appointment->remarks =$request->remarks;
                                            $book_appointment->agent_id = $authorization['data']['id'];                                           
                                            
                                            $book_appointment->save();

                                            $response = [
                                                'success' => true,
                                                'code'    => Response::HTTP_OK,
                                                'data'    => $book_appointment,
                                                'message' => 'You have successfully created Book Appointment Information',
                                            ];

                        }else{

                            $response = [
                                'success' => false,
                                'code'    => Response::HTTP_OK,
                                'data'    => $book_appointment_exist,
                                'message' => 'This Book Appointment Information is already exist',
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
