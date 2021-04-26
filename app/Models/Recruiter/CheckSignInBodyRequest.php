<?php


namespace App\Models\Recruiter;


use Illuminate\Http\Request;

class CheckSignInBodyRequest
{
    public static function check(Request $request)
    {
        try {
            self::checkField($request, 'login');
            self::checkField($request, 'password');

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