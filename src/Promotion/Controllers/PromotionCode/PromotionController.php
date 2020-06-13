<?php
namespace AvoRed\Framework\Promotion\Controllers;

use AvoRed\Framework\Database\Contracts\PromotionCodeModelInterface;
use AvoRed\Framework\Database\Models\PromotionCode;
use AvoRed\Framework\Promotion\Requests\PromotionCodeRequest;
use AvoRed\Framework\Support\Facades\Tab;

class PromotionController
{
    protected $repository;

    public function __construct()
    {
        $this->repository = app(PromotionCodeModelInterface::class);
    }

    /**
     * Show available promotion list of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        dd('here');
        $promotionCodes = $this->repository->paginate();
        return view('avored::promotion.promotion-code.index')
            ->with('promotionCodes', $promotionCodes);
    }


}
