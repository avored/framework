<?php

namespace AvoRed\Framework\Graphql\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    /**
     * Per Page Item
     * @var int
     */
    protected $perPage = 10;

    /**
     * Attribute for Product Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Product',
        'description' => 'A type',
    ];

    /**
     * Fields for Product Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Id',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Name',
            ],
            'main_image_url' => [
                'type' => Type::string(),
                'description' => 'Product Main Image Url',
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Slug',
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Product Type',
            ],
            'sku' => [
                'type' => Type::string(),
                'description' => 'Product SKU',
            ],
            'barcode' => [
                'type' => Type::string(),
                'description' => 'Product Barcode',
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'Product Price',
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'Product Status',
            ],
            'in_stock' => [
                'type' => Type::int(),
                'description' => 'Product in stock',
            ],
            'track_stock' => [
                'type' => Type::int(),
                'description' => 'Product track stock',
            ],
            'is_taxable' => [
                'type' => Type::int(),
                'description' => 'Product is taxable',
            ],
            'cost_price' => [
                'type' => Type::float(),
                'description' => 'Product cost price',
            ],
            'qty' => [
                'type' => Type::float(),
                'description' => 'Product Qty',
            ],
            'weight' => [
                'type' => Type::float(),
                'description' => 'Product Weight',
            ],
            'height' => [
                'type' => Type::float(),
                'description' => 'Product Height',
            ],
            'width' => [
                'type' => Type::float(),
                'description' => 'Product Width',
            ],
            'length' => [
                'type' => Type::float(),
                'description' => 'Product Length',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Product Description',
            ],
            'meta_title' => [
                'type' => Type::string(),
                'description' => 'Product Meta title',
            ],
            'meta_description' => [
                'type' => Type::string(),
                'description' => 'Product Meta Description',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Product created at',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Product updated at',
            ],
        ];
    }

    /**
     * @param mixed $product
     * @param array $args
     * @return string
     */
    protected function resolveMainImageUrlField($product, $args)
    {
        $document = $product->document()->first();

        if (is_null($document)) {
            $color = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);

            return 'https://place-hold.it/250/' . $color . '&text=' . str_replace(' ', '-', $product->slug);
        }

        return asset('storage/' . $document->path);
    }
}
