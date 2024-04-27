<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        // This method will render the exception faced on server side which will restrict the user to view whoops screen of laravel exception.
        
        $this->renderable(function (\Throwable $e, $request) {
            if($request->is('api/*')){
            
                $code   =   $e->getCode();
                $msg    =   'Server error, Please try again later';
                if ($this->isHttpException($e)) {
                    $code = $e->getStatusCode() ?? '';
                    if($code == 429){
                        $msg = "Dear Member, We are still processing your previous requests.  Please allow a little bit of time for those to process and try again. Thank You!";
                    }
                }

                if(strpos( $e->getMessage() , 'Unauthenticated') !== false){
                    $code = 401;
                    $msg    =   'Unauthenticated, Please login again';
                }
 
                return response(
                    [
                        'status'                =>  false,
                        'message'               =>  $msg,
                        'data'                  =>  null,
                        'developer_message'     =>  $e->getMessage(),
                        'file'                  =>  $e->getFile(),
                        'line'                  =>  $e->getLine(),
                        'code'                  =>  $code,
                    ]
                );
                
            }
            else{       
                // return $this->returnErrorView($e);                    
            }
        });
              
    }

    // This method will return the error rather than Whooops screen of the laravel
    public function returnErrorView($e){
        
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest(route('admin.login'));
        }
        
        return redirect()->guest(route('login'));
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // dd($request->is('admin'));

        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest(route('admin.login'));
        }

        return redirect()->guest(route('login'));
    }

   
}
