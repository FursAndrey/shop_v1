<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\App;

trait dbTranslate {
    protected $defaultLocale = 'ru';

    public function translateThisFieldFromDB($fieldName)
    {
        $locale = App::getLocale() ?? $this->defaultLocale;
        return $fieldName.'_'.$locale;
    }
}