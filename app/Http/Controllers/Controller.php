<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @function onResponse
     *
     * @summary for success response
     */
    public function onSuccess($message, $data = [], $code = 200, $opts = [])
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'pagination' => $opts['pagination'] ?? null,
        ], $code);
    }

    /**
     * @function onBadResponse
     *
     * @summary for failed response
     */
    public function onFailed($message, $data = [], $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
            'pagination' => null,
        ], $code);
    }
}
