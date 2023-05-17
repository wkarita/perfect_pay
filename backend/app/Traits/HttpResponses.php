<?php

namespace App\Traits;

trait HttpResponses {
    protected function error($data, string $message = null, $code){
        return response()->json([
            'status' => 'Error has occurred...',
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
