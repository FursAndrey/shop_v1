<?php

namespace App\ViewComposers;

use App\Http\My\Basket;
use Illuminate\View\View;

class OrderComposer
{
    public function compose(View $view)
    {
        $order = (new Basket())->getOrder();
        $view->with('order', $order);
    }
}
