<?php
namespace AvoRed\Framework\Promotion\Controllers\PromotionCode;

use AvoRed\Framework\Database\Models\PromotionCode;
use AvoRed\Framework\Promotion\ViewModels\PromotionTableViewModel;

class DestroyController
{
    
    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\PromotionCode  $promotionCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(PromotionCode $promotionCode)
    {
        $promotionCode->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::promotion.promotion-code.title')]
            ),
        ]);
    }
}
