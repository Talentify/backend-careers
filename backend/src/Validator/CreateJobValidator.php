<?php

namespace App\Validator;

use App\DBAL\Types\StatusType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateJobValidator 
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function __invoke(array $input)
    {
        $asserts = [
            'title' => [
                new Assert\NotBlank(),
            ],
            'description' => [
                new Assert\NotBlank(),
            ],
            'status' => [
                new Assert\NotBlank(),
                new Assert\Choice(array_keys(StatusType::$choices))
            ],
            'salary' => [
                new Assert\Optional(),
            ],
            'workspace' => [
                new Assert\Optional([
                    new Assert\Collection([
                        'street' => [
                            new Assert\Optional(),
                        ],
                        'number' => [
                            new Assert\Optional(),
                        ],
                        'city' => [
                            new Assert\Optional(),
                        ],
                        'state' => [
                            new Assert\Optional(),
                        ],
                        'postcode' => [
                            new Assert\Optional(),
                        ],        
                    ])                    
                ]),
            ],
        ];

        return $this->validator->validate($input, new Assert\Collection($asserts));
    }
}
