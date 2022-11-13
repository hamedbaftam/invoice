<?php

namespace App\utils;

class ApiResponse
{

    public function __construct(public $data, public $message = null)
    {
        return $this;
    }

    public function success($httpStatus = 200)
    {
        return response()->json([
            'apiVersion' => '0.1',
            "success" => true,
            "result" => $this->data ?? null,
            "error" => null,
            "message" => $this->message,
        ], $httpStatus);
    }

    public function error($httpStatus = 400)
    {
        return response()->json([
            'apiVersion' => '0.1',
            "success" => false,
            "result" => $this->data ?? null,
            "error" => $this->data,
            "message" => $this->message,
        ], $httpStatus);
    }
}
