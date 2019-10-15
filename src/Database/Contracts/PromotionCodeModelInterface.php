<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\PromotionCode;

interface PromotionCodeModelInterface
{
    /**
     * Create PromotionCode Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     */
    public function create(array $data) : PromotionCode;

    /**
     * Find PromotionCode Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     */
    public function find(int $id) : PromotionCode;
  
    /**
     * Find PromotionCode Resource into a database.
     * @param string $code
     * @return \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     */
    public function findByCode(string $code) : ?PromotionCode;

    /**
     * Delete PromotionCode Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All PromotionCode from the database.
     * @return \Illuminate\Database\Eloquent\Collection $promotionCodes
     */
    public function all() : Collection;
}
