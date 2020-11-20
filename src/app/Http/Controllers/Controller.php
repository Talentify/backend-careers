<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\HTTPStatusCodeHelper;

class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    /**
     * @param  string $message
     * @param  array  $data
     * @param  int    $code
     * @return type
     */
    public function returnSuccess(string $message = '', array $data = [], int $code = 200)
    {
        return response()->json(
            [
                            'success' => true,
                            'code' => $code,
                            'message' => $message,
                            'data' => $data
                        ],
            $code
        );
    }

    /**
     * @param \Exception $ex
     * @param array      $displayData
     */
    public function returnException(\Exception $ex, array $displayData = [])
    {

        $code = $this->getHttpCode($ex->getCode());

        return response()->json(
            [
                            'success' => false,
                            'code' => $ex->getCode(),
                            'message' => $ex->getMessage(),
                            'data' => $displayData
                        ],
            $code
        );
    }

    /**
     *
     * @param  string $code
     * @return int
     */
    private function getHttpCode($code)
    {

        if (!is_numeric($code) 
            || !in_array($code, array_keys(HTTPStatusCodeHelper::HTTP_STATUS_CODE))
        ) {
            return 500;
        }

        return $code;
    }

}
