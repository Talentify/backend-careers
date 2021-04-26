<?php


namespace App\Models\Job;


class SearchHandler
{
    public static function validate(array $queryString): bool
    {
        $accpetedKeys = [
            'key',
            'company',
            'salary',
            'address',
        ];

        $arrKeys = array_keys($queryString);

        if (in_array($arrKeys[0], $accpetedKeys)) {
            return true;
        }

        throw new \Exception('Invalid serach!');
    }

    public static function extractQueryKey(array $queryString): string
    {
        $arrKeys = array_keys($queryString);

        return $arrKeys[0];
    }
}