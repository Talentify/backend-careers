<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;

class UnavailableController extends Controller
{
    private static $debug = true;

    /**
     * @description Redirect to a unavailable page
     * @param $msg
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function unavailable(string $msg)
    {
        return view(
            'base.unavailable',
            [
                'debug' => self::debug,
                'msg' => $msg
            ]
        );
    }
}
