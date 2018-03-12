<?php
namespace AvoRed\Framework\Repository;

use AvoRed\Framework\Models\Database\Category as CategoryModel;

class Category extends AbractRepository {



    public function model() {
        return new CategoryModel();
    }
}