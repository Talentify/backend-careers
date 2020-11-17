<?php


namespace Domain\Jobs\Models;


interface AddressInterface
{
    public const ATT_STREET = 'street';
    public const ATT_CITY = 'city';
    public const ATT_STATE = 'state';
    public const ATT_STATE_FULL = 'state_full';
    public const ATT_ZIP_CODE = 'zip_code';
}
