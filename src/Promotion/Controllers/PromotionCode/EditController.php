<?php
namespace AvoRed\Framework\Promotion\Controllers\PromotionCode;

use AvoRed\Framework\Database\Models\PromotionCode;
use AvoRed\Framework\Promotion\ViewModels\Promotion\EditViewModel;

class EditController
{
    /**
     * Create/Edit the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\PromotionCode  $promotionCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(PromotionCode $promotionCode)
    {
        return view(
            'avored::promotion.promotion-code.edit',
            new EditViewModel($promotionCode)
        );
    }
}
