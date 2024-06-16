<?php 
 namespace App\Traits ;
 use Illuminate\Contracts\Validation\Validator;
 use Illuminate\Http\Exceptions\HttpResponseException;
 trait ApiErrorResponse{

    public function failedValidation(Validator $validator){

        throw new HttpResponseException(response()->json([
            'success'=>false,
            'message' => 'Validation error',
            'data' => array('errors'=>$validator->errors())
        ]));
    }

 }