<?php


namespace Core\Models;


use Core\DTOs\AbstractDTOInterface;

interface AbstractModelInterface
{
    public function toDTO(): AbstractDTOInterface;
}
