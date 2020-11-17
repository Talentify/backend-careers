<?php


namespace Domain\Jobs\Models;


interface JobInterface
{
    public const ATT_ADDRESS_ID = 'address_id';
    public const ATT_TITLE = 'title';
    public const ATT_SLUG = 'slug';
    public const ATT_DESCRIPTION = 'description';
    public const ATT_STATUS = 'status';
    public const ATT_SALARY = 'salary';
    public const ATT_USER_ID = 'user_id';

    /**Enquanto não temos enum no php usamos isso*/
    public const STATUS = [
        self::STATUS_OPEN => 'OPEN',
        self::STATUS_CLOSED => 'CLOSED',
        self::STATUS_INACTIVE => 'INACTIVE',
    ];
    public const STATUS_OPEN = 1;
    public const STATUS_CLOSED = 2;
    public const STATUS_INACTIVE = 3;
}
