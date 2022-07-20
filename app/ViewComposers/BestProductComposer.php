<?php

namespace App\ViewComposers;

use App\Models\Order;
use App\Models\Sku;
use Illuminate\View\View;

class BestProductComposer
{
    public function compose(View $view)
    {
        $bestProductsId = Order::get()->map->skus->flatten()->map->pivot->mapToGroups(function ($pivot) {
            return [$pivot->sku_id => $pivot->count];
        })->map->sum()->sortDesc()->take(1)->keys()->toArray();

        $bestProduct = Sku::whereIn('id', $bestProductsId)->get()[0];
        $view->with('bestProduct', $bestProduct);
    }
}
