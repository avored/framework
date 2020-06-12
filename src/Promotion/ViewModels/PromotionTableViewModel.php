<?php

namespace AvoRed\Framework\Promotion\ViewModels;

use AvoRed\Framework\Database\Contracts\PromotionCodeModelInterface;
use Spatie\ViewModels\ViewModel;

class PromotionTableViewModel extends ViewModel
{
    

    public function promotionCodes()
    {
        return $this->repository->all();
    }
}
