<?php

namespace App\Infrastructure\Pipeline;

use App\Domain\Model\Job;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Runner
{
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function add(string $class): void
    {
        $this->items->add($class);
    }

    public function run(object $object): Collection
    {
        $errors = new ArrayCollection();

        $this->items->map(
            function (string $class) use ($object, $errors) {
                try {
                    (new $class())($object);
                } catch (\Throwable $throwable) {
                    $errors->add($throwable->getMessage());
                }
            }
        );

        return $errors;
    }
}