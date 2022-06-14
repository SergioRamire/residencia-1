<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Time implements Rule
{
    protected string $min;
    protected string $max;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $min, string $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $time = strtotime($value);
        $min = strtotime($this->min);
        $max = strtotime($this->max);

        return ($time >= $min) && ($time <= $max);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $min = date('h:i A', strtotime($this->min));
        $max = date('h:i A', strtotime($this->max));
        return "La hora debe estar entre $min y $max";
    }
}
