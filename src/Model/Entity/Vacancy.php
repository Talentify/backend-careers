<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vacancy Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property string|null $workplace
 * @property float|null $salary
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 */
class Vacancy extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'description' => true,
        'status' => true,
        'workplace' => true,
        'salary' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
