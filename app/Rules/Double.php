<?php


namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;

class Double implements Rule
{
    protected $length;
    protected $decimals;

    public function __construct(int $length, int $decimals)
    {
        $this->length = $length;
        $this->decimals = $decimals;
    }

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        $length = $this->length - $this->decimals;
        $re = '/^\d{1,'.$length.'}(\.\d{1,'.$this->decimals.'})?$/s';

        return preg_match($re, $value);
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return "The :attribute must be a double with {$this->length} digits and {$this->decimals} decimal places.";
    }
}
