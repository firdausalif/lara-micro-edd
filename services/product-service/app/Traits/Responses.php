<?php
namespace App\Traits;
use \Illuminate\Http\Response;

trait Responses {

    protected function success($message, $data = [], $status = 200): Response
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $status = 422): Response
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
