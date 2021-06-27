<?php

namespace AvoRed\Framework\Rules\Catalog\Product;

use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class CreateVariationCheckRule implements Rule
{
    /**
     * Product Repository for the Product Controller.
     * @var \AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;


    /**
     * Create a new rule instance.
     * @param array $args
     * @return void
     */
    public function __construct(array $args)
    {
        $this->args = $args;
        $this->productRepository = app(ProductModelInterface::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $product =  $this->productRepository->find($this->args['product_id']);
        $validate = false;
        $attributes = Arr::get($this->args, 'single_variation_attributes', []);

        foreach ($attributes as $attribute) {
            if (
                !($product->attributeProductValues->pluck('attribute_id')->contains($attribute['attribute_id']) &&
                $product->attributeProductValues->pluck('attribute_dropdown_option_id')->contains($attribute['attribute_dropdown_option_id']))
            ) {
                $validate = true;
            }
        }

        return $validate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Product with the attribute and option already exist in the store';
    }
}
