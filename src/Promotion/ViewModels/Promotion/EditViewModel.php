<?php

namespace AvoRed\Framework\Promotion\ViewModels\Promotion;

use AvoRed\Framework\Database\Contracts\PromotionCodeModelInterface;
use AvoRed\Framework\Database\Models\PromotionCode;
use AvoRed\Framework\Support\Facades\Tab;
use Spatie\ViewModels\ViewModel;

class EditViewModel extends ViewModel
{
    protected $model;

    public function __construct(PromotionCode $promotionCode)
    {
        $this->model = $promotionCode;
    }

    public function promotionCode()
    {
        return $this->model;
    }

    public function tabs()
    {
        return Tab::get('promotion.promotion-code');
    }

    public function typeOptions()
    {
        return PromotionCode::TYPEOPTIONS;
    }
}
