<?php
namespace AvoRed\Framework\Promotion\Controllers\PromotionCode;

use AvoRed\Framework\Database\Models\PromotionCode;
use AvoRed\Framework\Promotion\Requests\PromotionCodeRequest;

class SaveController
{
    /**
     * Save the specified resource from storage.
     * @param \AvoRed\Framework\Promotion\Requests\PromotionCodeRequest  $request
     * @param \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(PromotionCodeRequest $request, PromotionCode $promotionCode)
    {
        $promotionCode->fill($request->all())->save();
        
        return redirect()->route('admin.promotion.code.table');
    }
}
