<?php

namespace App\Presentation\Twig\Filter;

use App\Domain\Enum\Job\StatusEnum;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class StatusTranslate extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('statusTranslate', [$this, 'translate']),
        ];
    }
    public function translate(int $value)
    {
        return StatusEnum::translate($value);
    }
}