<?php

namespace AvoRed\Framework\Product\ViewComposers;

use AvoRed\Framework\Models\Database\Category;
use Illuminate\View\View;

class ProductFieldsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = Category::getCategoryOptions();
        
        $view->with('categoryOptions', $categoryOptions);
    }
}
