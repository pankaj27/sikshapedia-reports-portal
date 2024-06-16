<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use App\CPU\Helpers ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\BaseController;
use Symfony\Component\HttpFoundation\Response;


class ConfigController extends BaseController
{
    
    public function getStateList(Request $request){

       

        $data   =   [];

        try{

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {

                $data =  DB::table('districts')->orderBy('State','ASC')->get()->unique('State');               

                if(count($data)>0){

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'You have successfully fetch State List Information',
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

    public function getDistrictList(Request $request, $stateName){

       

        $data   =   [];

        try{

            //authorized For access using Token
            $authorization = Helpers::get_user_by_token($request);

            if ($authorization['success'] == 1) {
                //$stateName = DB::table('districts')->where('id', $stateId)->first();
                $data =  DB::table('districts')->where('State',$stateName)->orderBy('District','ASC')->get();               

                if(count($data)>0){

                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'You have successfully fetch State List Information',
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

    public function getVisitRegisterStatus(Request $request){

        $data = array(
            'Positive Meeting','Very Interested','Interested But Not Sure','Asked to Visit Again','Not Interested','Next Follow up',
            'Long Time Ph not Received',
            'Appointment Booked',
            'Visited',
            'Re-Visit'
        );
        $response = [
            'success' => true,
            'code'    => Response::HTTP_OK,
            'data'    => $data,
            'message' => 'Visit Register Status information fetch successfully',
        ];


        return $this->sendResponse($response);




    }

    public function getCallRegisterFollowUpStatus(Request $request){

        $data = array(
            'Appointment Registered',
            'Positive Meeting',
            'Very Interested',
            'Appointment Registered',
            'Asked to Visit Again',
            'Not Interested',
            'Next Followup',
            'Long time Ph. not Received',
            'Appointment Booked',
            'Visited',
            'Re-Visit'
        );
        $response = [
            'success' => true,
            'code'    => Response::HTTP_OK,
            'data'    => $data,
            'message' => 'Call Register Followup Status List Fetch Successfully',
        ];


        return $this->sendResponse($response);




    }

}

