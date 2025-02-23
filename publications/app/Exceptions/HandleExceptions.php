<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandleExceptions extends Exception
{
    public function report(): void
    {
        
    }

    public function render(Request $request, NotFoundHttpException $notFoundHttpException ): Response|bool 
    {
    if ($request->is('api/*')) {
 
        return response("Resource not found", 404);
    }
 
    return false;
}
}
