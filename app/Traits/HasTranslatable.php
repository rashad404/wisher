<?php

namespace App\Traits;

trait HasTranslatable
{
    public function trans($attribute)
    {
        return $this->getTranslation($attribute, app()->getLocale());
    }
}
