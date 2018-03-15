<?php
namespace AvoRed\Framework\Repository;

use AvoRed\Framework\Models\Database\Order as OrderModel;
use AvoRed\Framework\Models\Database\OrderProductVariation;
use AvoRed\Framework\Models\Database\OrderStatus;

class Order extends AbstractRepository {

    public function model() {
        return new OrderModel();
    }

    public function statusModel() {
        return new OrderStatus();
    }

    public function productVariationModel() {
        return new OrderProductVariation();
    }

}