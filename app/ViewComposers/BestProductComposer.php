<?php

namespace App\ViewComposers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class BestProductComposer
{
    public function compose(View $view)
    {
        $bestProductsId = Order::get()->map->products->flatten()->map->pivot->mapToGroups(function ($pivot) {
            return [$pivot->product_id => $pivot->count];
        })->map->sum()->sortDesc()->take(1)->keys()->toArray();

        $bestProduct = Product::whereIn('id', $bestProductsId)->get()[0];
// dd($bestProduct);
        $view->with('bestProduct', $bestProduct);
    }
}
