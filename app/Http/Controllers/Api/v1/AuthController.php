<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\User\LoginRequest;
use Validator;
use LogActivity;
use App\Models\User;
use Illuminate\Http ;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController;
use Exception;

class AuthController extends BaseController
{
    /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */
    public function onLogin(Request $request): JsonResponse
    {
        $data = [];

        try {
            // Validate the request
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                if ($user->status == 1) {
                    if ($user->hasRole('Superadmin')) {
                        $response = [
                            'success' => false,
                            'code'    => Response::HTTP_UNAUTHORIZED,
                            'data'    => $data,
                            'message' => 'You do not have access to login',
                        ];
                    } else {
                        // Generate token
                        $tokenResult = $user->createToken('SksSalesApp');
                        $token = $tokenResult->accessToken;  // Correct way to retrieve the token
                        //store token to db for Authorization
                        $user->auth_token = $token;
                        $user->save(); //Update token to User Table
                        $data['token'] = $token;
                        $data['user'] = array(
                            "id"=>$user->id,
                            "name"=>$user->name,
                            "email"=>$user->email,
                            "password_hint"=>$user->password_hint,
                            "role"=>$user->roles[0]->name
                        );
                        $response = [
                            'success' => true,
                            'code'    => Response::HTTP_OK,
                            'data'    => $data,
                            'message' => 'Token Generated',
                        ];
                    }
                } else {
                    $response = [
                        'success' => true,
                        'code'    => Response::HTTP_OK,
                        'data'    => $data,
                        'message' => 'Your account has been disabled! Please contact Admin For more information',
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'code'    => Response::HTTP_UNAUTHORIZED,
                    'data'    => $data,
                    'message' => 'Invalid credentials',
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