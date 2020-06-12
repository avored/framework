<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\PromotionCode;

interface PromotionCodeModelInterface extends BaseInterface
{
    
    /**
     * Find PromotionCode Resource into a database.
     * @param string $code
     * @return \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     */
    public function findByCode(string $code) : ?PromotionCode;
}
