<?php
namespace App\Traits;

use App\Exceptions\EmptyException;

trait EntityValidationTrait
{
    /**
     * @param string $value
     * @return string
     * @throws EmptyException
     */
    protected function validateEmptyString(string $value): string
    {
        if (empty(trim($value))) {
            throw new EmptyException();
        }
        return $value;
    }
}