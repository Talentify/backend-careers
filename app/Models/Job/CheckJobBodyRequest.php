<?php


namespace App\Models\Job;


use Illuminate\Http\Request;

class CheckJobBodyRequest
{
    public static function check(Request $request)
    {
        try {
            self::checkField($request, 'title');
            self::checkField($request, 'description');
            self::checkField($request, 'status');
            self::checkField($request, 'address');
            self::checkField($request, 'salary');

            return true;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private static function checkField(Request $request, string $field): bool
    {
        if (!$request->has($field)) {
            throw new \Exception("The field {$field} is required");
        }

        $isEmptyField = !$request->$field ?? false;
        if ($isEmptyField) {
            throw new \Exception("Invalid field: {$field}");
        }

        return true;
    }

}