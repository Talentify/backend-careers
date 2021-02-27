<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Helper
{
    public static function validatePayload(Request $request)
    {
        if (empty($request->json()->all())) {
            return [
                'success' => false,
                'message' => 'Payload invalid.',
            ];
        }
        return [
            'success' => true,
            'message' => '',
        ];
    }
}
