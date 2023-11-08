<?php

namespace App\Traits;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($message = null, int $statusCode = 400)
    {
        return response()->json([
            'message' => $message,
            'status' => false
        ], $statusCode);
    }


    public function returnSuccessMessage($message = null, int $statusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'status' => true,
        ], $statusCode);
    }

    public function returnData($data, $message = null, int $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => true,
        ], $statusCode);
    }
}

