<?php

namespace App\Http\Traits;

trait WithTrimAndNullEmptyStrings
{
    /* Define este arreglo en el controlador con el nombre de las variables que no se desea limpiar */
    // protected array $cleanStringsExcept;

    public function updatedWithTrimAndNullEmptyStrings($name, $value)
    {
        if (isset($this->cleanStringsExcept)) {
            if (! is_string($value) || in_array($name, $this->cleanStringsExcept)) {
                return;
            }
        } else {
            if (! is_string($value)) {
                return;
            }
        }

        $value = trim($value);
        $value = $value === '' ? null : $value;

        data_set($this, $name, $value);
    }
}
