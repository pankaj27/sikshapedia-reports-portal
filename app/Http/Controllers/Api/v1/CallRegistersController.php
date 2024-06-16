<?php

namespace App\Http\Controllers\Api\v1;


use Exception;
use Validator;

use LogActivity;
use App\CPU\Helpers;
use App\Models\User;
use Illuminate\Http ;
use App\Models\FollowUp;
use App\Models\CallRegister;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\CallRegisterRequest;
use App\Http\Controllers\Api\BaseController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\CallRegisterRemarksRequest;


class CallRegistersController extends BaseController
{
    /**
    * Call Register List api
    *
    * @return \Illuminate\Http\Response
    */

    public function onLoadCallRegisters(Request $request)
    {
        $data   =   [];

        try{

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                $data = CallRegister::where('agent_id','=',$authorization['data']['id'])->orderBy('id','desc')->get();



                $response = [
                    'success' => true,
                    'code'    => Response::HTTP_OK,
                    'data'    => $data,
                    'message' => 'You have successfully fetch Call Register Information',
                ];

                if(count($data)>0){

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'You have successfully fetch Call Register Information',
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


    public function storeCallRegister(CallRegisterRequest $request)

    {
        $data   =   [];

        try{

           

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                        $request->validate([
                            'organization_name' => 'required|min:5',
                            'contact_person_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
                            'contact_person_mobile' => 'required|numeric|digits:10',
                            'organization_address' => 'required',
                        ]);
                    
                        
                
                        
                
                            $call_register = CallRegister::firstOrNew(array('organization_name' => $request->organization_name,'contact_person_name'=>$request->contact_person_name,'contact_person_mobile'=>$request->contact_person_mobile,'organization_address'=>$request->organization_address));
                            
                
                            $call_register->organization_name =$request->organization_name;
                            $call_register->contact_person_name =$request->contact_person_name;
                            $call_register->contact_person_mobile =$request->contact_person_mobile;
                            $call_register->contact_person_mobile2 =$request->contact_person_mobile2;
                            $call_register->organization_address =$request->organization_address;
                            $call_register->agent_id = $data['data']['id'];

                            $call_register->save();




                        $response = [
                            'success' => true,
                            'code'    => Response::HTTP_OK,
                            'data'    => $call_register,
                            'message' => 'You have successfully created Call Register Information',
                        ];


            
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

    public function storeAddRemarks(CallRegisterRemarksRequest $request){

        $data   =   [];

        try{

           

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                      
                    $call_register = FollowUp::firstOrNew(array('remarks' => $request->remarks,'call_register_id'=>$request->call_reg_id,'visit_status'=>$request->status,'follow_up_date'=>date('Y-m-d', strtotime($request->date))));
                    $call_register->remarks =$request->remarks;
                    $call_register->call_register_id  = $request->call_reg_id;
                    $call_register->visit_status = $request->status;
                    $call_register->agent_id = $authorization['data']['id'];
                    $call_register->follow_up_date = date('Y-m-d', strtotime($request->date));
                    $call_register->save();




                        $response = [
                            'success' => true,
                            'code'    => Response::HTTP_OK,
                            'data'    => $call_register,
                            'message' => 'You have successfully created Follow Up Information',
                        ];


            
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


    public function getDetailsCallRegister(Request $request, $callRegisterId ){

        $data   =   [];

        try{

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                $data = CallRegister::where('agent_id','=',$authorization['data']['id'])->where('id',$callRegisterId)->get();



                
                if(count($data)>0){

                    //get folowups 

                    $followups = FollowUp::where('call_register_id',$callRegisterId)->get();

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => ['call_register'=>$data,'follow_ups'=>$followups],
                        'message' => 'You have successfully fetch Call Register Information',
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
}
