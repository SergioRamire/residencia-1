<?php

namespace App\Http\Traits;

trait WithTrimAndNullEmptyStrings
{
    public function updatedWithTrimAndNullEmptyStrings($name, $value)
    {
        if (is_string($value)) {
            $value = trim($value);
            $value = $value === '' ? null : $value;

            data_set($this, $name, $value);
        }
    }
}
