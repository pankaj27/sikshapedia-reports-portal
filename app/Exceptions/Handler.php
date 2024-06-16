<?php

namespace App\Exceptions;
use Exception;
use Throwable;
use App\Traits\RestTrait;
use Illuminate\Http\Request;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{

    use RestTrait;
    use RestExceptionHandlerTrait;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */

     public function register(): void
    {
        

        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Url is not found.'
                ], 404);
            }
        });


        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            

            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Method Not Allowed'
                ], 405);
            }
        });

        $this->renderable(function (ModelNotFoundException $e, $request) {
            

            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 405);
            }
        });
    
    
    
    }

    

    // public function render($request, Throwable $e)
    // {
    //     if(!$this->isApiCall($request)) {
    //         $retval = parent::render($request, $e);
    //     } else {
    //         $retval = $this->getJsonResponseForException($request, $e);
    //     }

    //     return $retval;
    // }
    

    // public function render($request, Throwable $exception){
        
    //     if ($request->wantsJson()) {   //add Accept: application/json in request
    //         return $this->handleApiException($request, $exception);
    //     } else {
    //         $retval = parent::render($request, $exception);
    //     }
    
    //     return $retval;
    // }

    // protected function handleApiException($request, Exception $exception)
    // {
    // //$exception = $this->prepareException($exception);

    // if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
    //     $exception = $exception->getResponse();
    // }

    // if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
    //     $exception = $this->unauthenticated($request, $exception);
    // }

    // if ($exception instanceof \Illuminate\Validation\ValidationException) {
    //     $exception = $this->convertValidationExceptionToResponse($exception, $request);
    // }

    //     return $this->customApiResponse($exception);
    // }

    // private function customApiResponse($exception)
    //     {
    //         if (method_exists($exception, 'getStatusCode')) {
    //             $statusCode = $exception->getStatusCode();
    //         } else {
    //             $statusCode = 500;
    //         }

    //         $response = [];

    //         switch ($statusCode) {
    //             case 401:
    //                 $response['message'] = 'Unauthorized';
    //                 break;
    //             case 403:
    //                 $response['message'] = 'Forbidden';
    //                 break;
    //             case 404:
    //                 $response['message'] = 'Not Found';
    //                 break;
    //             case 405:
    //                 $response['message'] = 'Method Not Allowed';
    //                 break;
    //             case 422:
    //                 $response['message'] = $exception->original['message'];
    //                 $response['errors'] = $exception->original['errors'];
    //                 break;
    //             default:
    //                 $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
    //                 break;
    //         }

    //         if (config('app.debug')) {
    //             $response['trace'] = $exception->getTrace();
    //             $response['code'] = $exception->getCode();
    //         }

    //         $response['status'] = $statusCode;

    //         return response()->json($response, $statusCode);
    // }
}
