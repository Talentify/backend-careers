<?php
namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class StatusType extends AbstractEnumType
{
    public const ACTIVE = 'active';
    public const INACTIVE = 'inactive';

    protected static $choices = [
        self::ACTIVE => 'Ativo',
        self::INACTIVE => 'Inativo',
    ];
}