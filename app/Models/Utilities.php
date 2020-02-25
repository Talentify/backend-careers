<?php

namespace App\Models;

/**
 * Class Utilities
 * @package App
 */
class Utilities
{
    /**
     * @description Format to a American money format
     * @param string|null $value
     * @return float|null
     */
    public static function formatValueUs(?string $value)
    {
        if (empty($value)) {
            return null;
        } else {
            return floatval(str_replace([','], [''], $value));
        }
    }

    /**
     * @description Format to a Brazilian money format
     * @param string|null $value
     * @return string|null
     */
    public static function formatValueBr(?string $value)
    {
        if (empty($value)) {
            return null;
        } else {
            return number_format($value, 2, ',', '.');
        }
    }

    /**
     * @description Format to a Brazilian date format
     * @param string $value
     * @return false|string
     */
    public static function formatDateToBr(string $value)
    {
        return date('d/m/Y', strtotime($value));
    }

    /**
     * @description Clean string
     * @param string|null $param
     * @return string|null
     */
    public static function cleanString(?string $param)
    {
        if (empty($param)) {
            return null;
        } else {
            return addslashes(trim($param));
        }
    }
}
