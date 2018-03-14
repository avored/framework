<?php
namespace AvoRed\Framework\Repository;

use AvoRed\Framework\Models\Database\Product as ProductModel;
use AvoRed\Framework\Models\Database\ProductAttributeIntegerValue;
use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Database\Property;

class Product extends AbractRepository {

    public function model() {
        return new ProductModel();
    }

    public function categoryModel() {
        return new Category();
    }

    public function attributeModel() {
        return new Attribute();
    }

    public function integerAttributeModel() {
        return new ProductAttributeIntegerValue();
    }

    public function propertyModel() {
        return new Property();
    }

}