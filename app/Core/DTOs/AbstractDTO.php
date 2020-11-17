<?php


namespace Core\DTOs;


use Spatie\DataTransferObject\FlexibleDataTransferObject;

abstract class AbstractDTO extends FlexibleDataTransferObject implements AbstractDTOInterface
{
    public ?string $created_at;
    public ?string $updated_at;
    public ?string $deleted_at;
}
