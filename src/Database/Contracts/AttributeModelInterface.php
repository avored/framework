<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Catalog\Requests\AttributeRequest;

interface AttributeModelInterface extends BaseInterface
{
    /**
     * Save Attribute Dropdown options.
     * @param \AvoRed\Framework\Catalog\Requests\AttributeRequest $request
     * @param \\AvoRed\Framework\Database\Models\Attribute  $attribute
     * @return void
     */
    public function saveAttributeDropdownOptions(AttributeRequest $request, Attribute $attribute);
}
