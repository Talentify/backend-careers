<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationException extends \Exception
{
    private $constraintViolations;

    public function __construct(
        ConstraintViolationListInterface $constraintViolations,
        $message = "Dados obrigatórios inválidos",
        $code = 400,
        \Throwable $previous = null)
    {
        $this->constraintViolations = $constraintViolations;
        parent::__construct($message, $code, $previous);
    }

    public function constraintViolations(): ConstraintViolationListInterface
    {
        return $this->constraintViolations;
    }

    public function toArray()
    {
        $result = [];
        foreach ($this->constraintViolations as $violation) {
            $result[] = "{$violation->getPropertyPath()}: " . $violation->getMessage();
        }
        return $result;
    }

    public function __toString(): string
    {
        return implode($this->toArray(), "\n");
    }

//    public function getTitle(): string
//    {
//        return 'Invalid document data';
//    }
}
