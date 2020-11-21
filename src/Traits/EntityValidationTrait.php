<?php
namespace App\Traits;

use App\Exceptions\EmptyException;
use App\Exceptions\InvalidPasswordHashException;
use App\Exceptions\TooLongException;

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

    /**
     * @param string $value
     * @param int $max
     * @return string
     * @throws TooLongException
     */
    protected function validateMaxLengthString(string $value, int $max): string
    {
        if (strlen($value) > $max) {
            throw new TooLongException();
        }
        return $value;
    }

    /**
     * @param string $hash
     * @return string
     * @throws InvalidPasswordHashException
     */
    protected function validateBcryptHash(string $hash): string
    {
        if (password_get_info($hash)['algo'] !== PASSWORD_BCRYPT) {
            throw new InvalidPasswordHashException();
        }
        return $hash;
    }
}