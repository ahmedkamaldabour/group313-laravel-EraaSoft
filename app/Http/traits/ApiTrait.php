<?php

namespace App\Http\traits;

trait ApiTrait
{
    public function apiResponse($code = 200, $message = null, $errors = null, $data = null)
    {
        $array = [
            'status'  => $code,
            'message' => $message,
        ];
        if (is_null($data) && !is_null($errors)) {
            $array['errors'] = $errors;
        } elseif (!is_null($data) && is_null($errors)) {
            $array['data'] = $data;
        } else {
            $array['data'] = $data;
            $array['errors'] = $errors;
        }

        return response()->json($array, 200);
    }
}
