<?php

namespace App\ViewComposers;

use App\Services\Conversion;
use Illuminate\View\View;

class CurrenciesComposer
{
    public function compose(View $view)
    {
        $curCode = Conversion::getCurCode();
        $view->with('curCode', $curCode);
    }
}
