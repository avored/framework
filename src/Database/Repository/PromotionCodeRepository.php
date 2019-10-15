<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\PromotionCode;
use AvoRed\Framework\Database\Contracts\PromotionCodeModelInterface;

class PromotionCodeRepository implements PromotionCodeModelInterface
{
    /**
     * Create PromotionCode Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     */
    public function create(array $data): PromotionCode
    {
        return PromotionCode::create($data);
    }

    /**
     * Find PromotionCode Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     */
    public function find(int $id): PromotionCode
    {
        return PromotionCode::find($id);
    }

      /**
     * Find PromotionCode Resource into a database.
     * @param string $code
     * @return \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     */
    public function findByCode(string $code) : ?PromotionCode
    {
        return PromotionCode::whereCode($code)->status(1)->activeFrom()->activeTill()->first();
    }

    /**
     * Delete PromotionCode Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return PromotionCode::destroy($id);
    }

    /**
     * Get all the promotionCodes from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $promotionCodes
     */
    public function all() : Collection
    {
        return PromotionCode::all();
    }
}
