<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponseTrait;

class NotFoundException extends Exception
{
    use ApiResponseTrait;

    protected $code = 404;

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {

    }

}
