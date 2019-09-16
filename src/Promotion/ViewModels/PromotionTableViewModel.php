<?php

namespace AvoRed\Framework\Promotion\ViewModels;

use AvoRed\Framework\Database\Contracts\PromotionCodeModelInterface;
use Spatie\ViewModels\ViewModel;

class PromotionTableViewModel extends ViewModel
{
    protected $repository;

    public function __construct()
    {
        $this->repository = app(PromotionCodeModelInterface::class);
    }

    public function promotionCodes()
    {
        return $this->repository->all();
    }
}
