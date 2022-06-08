<?php

namespace App\ViewComposers;

use App\Models\Product;
use Illuminate\View\View;

class BannerComposer
{
    public function compose(View $view)
    {
        $banner = Product::getRandomProduct();
        $view->with('banner', $banner);
    }
}
