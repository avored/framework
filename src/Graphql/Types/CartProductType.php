<?php
namespace AvoRed\Framework\Graphql\Types;

use AvoRed\Framework\Cart\CartProduct;
use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CartProductType extends GraphQLType
{

    /**
     * Attribute for CartProduct Type
     * @var array
     */
    protected $attributes = [
        'name' => 'CartProduct',
        'description' => 'A type'
    ];

     /**
     * Fields for Cart Product Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Cart Product Id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Cart Product Name'
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Cart Product Slug'
            ],
            'image' => [
                'type' => Type::string(),
                'description' => 'Cart Product Image'
            ],
            'qty' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'Cart Product qty'
            ],
            'price' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'Cart Product Price'
            ],
            'tax_amount' => [
                'type' => Type::float(),
                'description' => 'Cart Product Tax Amount'
            ],
        ];
    }

    /**
     * @param \AvoRed\Framework\Cart\CartProduct $cartProduct
     * @param array $args
     * @return string $id
     */
    protected function resolveIdField(CartProduct $cartProduct, $args)
    {
        return $cartProduct->id();
    }
    
    /**
     * @param \AvoRed\Framework\Cart\CartProduct $cartProduct
     * @param array $args
     * @return string $name
     */
    protected function resolveNameField(CartProduct $cartProduct, $args)
    {
        return $cartProduct->name();
    }

    /**
     * @param \AvoRed\Framework\Cart\CartProduct $cartProduct
     * @param array $args
     * @return string $slug
     */
    protected function resolveSlugField(CartProduct $cartProduct, $args)
    {
        return $cartProduct->slug();
    }

    /**
     * @param \AvoRed\Framework\Cart\CartProduct $cartProduct
     * @param array $args
     * @return string $price
     */
    protected function resolvePriceField(CartProduct $cartProduct, $args)
    {
        return $cartProduct->price();
    }

    /**
     * @param \AvoRed\Framework\Cart\CartProduct $cartProduct
     * @param array $args
     * @return string $image
     */
    protected function resolveImageField(CartProduct $cartProduct, $args)
    {
        return $cartProduct->image();
    }

    /**
     * @param \AvoRed\Framework\Cart\CartProduct $cartProduct
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveTaxAmountField(CartProduct $cartProduct, $args)
    {
        return $cartProduct->taxAmount();
    }
}
