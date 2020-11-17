<?php

namespace Domain\Jobs\Models;

use Core\DTOs\AbstractDTOInterface;
use Core\Models\AbstractModel;
use Domain\Jobs\DTOs\AddressDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * @property string $city
 * @property string $state
 * @property string $state_full
 * @property string $street
 * @property string $zip_code
 */
class Address extends AbstractModel implements AddressInterface
{
    use HasFactory;

    protected $table = 'adresses';

    protected $keyType = 'string';

    protected $fillable = [
        self::ATT_CITY,
        self::ATT_STATE,
        self::ATT_STATE_FULL,
        self::ATT_STREET,
        self::ATT_ZIP_CODE
    ];

    protected $casts = [
        self::ATT_CITY => 'string',
        self::ATT_STATE => 'string',
        self::ATT_STATE_FULL => 'string',
        self::ATT_STREET => 'string',
        self::ATT_ZIP_CODE => 'string'
    ];


    public function toDTO(): AbstractDTOInterface
    {
        return new AddressDTO(
            $this->street ?? '',
            $this->city ?? '',
            $this->state ?? '',
            $this->state_full ?? '',
            $this->zip_code ?? '',
            $this->id ?? '',
        );
    }
}
