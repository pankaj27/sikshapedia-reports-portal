<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result)
    {
        $response = [
            'success'   => $result['success'],
            'data'      => $result['data'],
            'message'   => $result['message']
        ];
        return response()->json($response, $result['code']);
    }
}