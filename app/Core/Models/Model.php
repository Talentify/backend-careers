<?php

declare(strict_types=1);

namespace App\Core\Models;

use BadMethodCallException;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    protected $allowLazyLoad = false;

    /**
     * Fill the model with an array of attributes.
     *
     * Extended to throw a error when trying to mass assign a protected key.
     *
     * @param  array  $attributes
     *
     * @return BaseModel
     *
     * @throws MassAssignmentException
     */
    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $key = $this->removeTableFromKey($key);

            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            } else {
                throw new MassAssignmentException(sprintf(
                    '[%s] is not fillable in [%s] model.',
                    $key, get_class($this)
                ));
            }
        }

        return $this;
    }

    /**
     * Disable Lazy Load feature.
     *
     * @param  string  $method
     *
     * @return mixed
     */
    protected function getRelationshipFromMethod($method)
    {
        if (! $this->allowLazyLoad) {
            throw new BadMethodCallException(sprintf(
                'Trying to lazy load [%s] on [%s] model.',
                $method, get_class($this)
            ));
        }

        return parent::getRelationshipFromMethod($method);
    }
}
