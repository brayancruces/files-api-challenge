<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function render()
    {
        $error = [
            'code' => $this->code,
            'message' => $this->message,
        ];
        return response()->json(['error' => $error], $this->code);
    }
}