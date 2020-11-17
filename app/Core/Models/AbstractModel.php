<?php


namespace Core\Models;


use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model implements AbstractModelInterface
{
    public const ATT_ID = 'id';
}
