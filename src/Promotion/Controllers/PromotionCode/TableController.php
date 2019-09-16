<?php
namespace AvoRed\Framework\Promotion\Controllers\PromotionCode;

use AvoRed\Framework\Promotion\ViewModels\PromotionTableViewModel;

class TableController
{
    /**
     * Show available promotion list of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return view('avored::promotion.promotion-code.index', new PromotionTableViewModel);
    }
}
