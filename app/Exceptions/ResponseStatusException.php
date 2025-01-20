<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class ResponseStatusException extends Exception
{
    public function render(Request $request)
    {
        if( $request->is('api/*') ) {
            return response()->json([
                'errors' => $this->getMessage(),
            ], $this->getCode());
        }

        return abort($this->getCode(), $this->getMessage());
    }
}
