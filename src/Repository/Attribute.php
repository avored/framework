<?php
namespace AvoRed\Framework\Repository;

use AvoRed\Framework\Models\Database\AttributeDropdownOption;
use AvoRed\Framework\Models\Database\Attribute as AttributeModel;

class Attribute extends AbractRepository {


    public function model() {
        return new AttributeModel();
    }

    public function dropDownOptionModel() {
        return new AttributeDropdownOption();
    }
}