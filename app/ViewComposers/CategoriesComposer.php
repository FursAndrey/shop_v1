<?php

namespace App\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoriesComposer
{
    public function compose(View $view)
    {
        $categories = Category::select('name_ru', 'name_en', 'code')->get();
        $view->with('categories', $categories);
    }
}
