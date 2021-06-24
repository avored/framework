<?php

namespace AvoRed\Framework\Graphql\Mutations\Admin\Catalog\Product;

use AvoRed\Framework\Database\Contracts\AttributeDropdownOptionModelInterface;
use AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Rules\Catalog\Product\CreateVariationCheckRule;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateProductVariation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateProductVariation',
        'description' => 'A mutation'
    ];


    /**
     * Product Repository
     * @var AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;
    /**
     * Product Repository
     * @var AvoRed\Framework\Database\Repository\attributeDropdownOptionRepository
     */
    protected $attributeDropdownOptionRepository;

    /**
     * All Product construct
     * @param \AvoRed\Framework\Database\Contracts\ProductModelInterface $productRepository
     * @param \AvoRed\Framework\Database\Contracts\AttributeDropdownOptionModelInterface $attributeDropdownOptionRepository
     * @param \AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface $attributeProductValueRepository
     * @return void
     */
    public function __construct(
        ProductModelInterface $productRepository,
        AttributeDropdownOptionModelInterface $attributeDropdownOptionRepository,
        AttributeProductValueModelInterface $attributeProductValueRepository
    ) {
        $this->productRepository = $productRepository;
        $this->attributeDropdownOptionRepository = $attributeDropdownOptionRepository;
        $this->attributeProductValueRepository = $attributeProductValueRepository;
    }

    /**
     * Return type for these query
     * @return \GraphQL\Type\Definition\Type
     */
    public function type(): Type
    {
        return GraphQL::type('product');
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;  //Auth::guard('admin_api')->check();
    }

    public function args(): array
    {
        return [
            'product_id' => [
                'name' => 'product_id',
                'type' => Type::nonNull(Type::int()),
                // 'rules' => [new CreateVariationCheckRule]
            ],
            'attribute_id' => [
                'name' => 'attribute_id',
                'type' => Type::nonNull(Type::int()),
            ],
            'attribute_dropdown_option_id' => [
                'name' => 'attribute_dropdown_option_id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    
    protected function rules(array $args = []): array
    {
        return [
            'product_id' => [new CreateVariationCheckRule($args)],
        ];
    }

  

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $product = $this->productRepository->find($args['product_id']);
     
        
        $this->generateProductData($product, [$args['attribute_dropdown_option_id']]);
        
        return $product;
    }
    
    
    /**
     * Generate Product Data based on given variation id.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param array $options
     * @return array $data
     */
    private function generateProductData($product, $options)
    {
        $data = [
            'name' => $product->name,
            'type' => 'VARIATION',
            'qty' => $product->qty,
            'price' => $product->price,
            'cost_price' => $product->cost_price,
            'weight' => $product->weight,
            'height' => $product->height,
            'width' => $product->width,
            'length' => $product->length,
        ];

        foreach ($options as $optionId) {
            $optionModel = $this->attributeDropdownOptionRepository->find($optionId);
            $data['name'] .= ' '.$optionModel->display_text;
        }
        $data['sku'] = Str::slug($data['name']);
        $data['slug'] = Str::slug($data['name']);

        $variation = $this->productRepository->create($data);
        $attributeId = $optionModel->attribute->id;
        $this->saveAttributeProductValue($product, $options, $variation);
    }
    
       /**
     * Store attribute product values into database.
     * @param Product $product
     * @param Collection $attributeOptionIds
     * @param \AvoRed\Framework\Database\Models\Product $variation
     * @return void
     */
    private function saveAttributeProductValue($product, $attributeOptionIds, $variation)
    {
        foreach ($attributeOptionIds as $optionId) {
            $optionModel = $this->attributeDropdownOptionRepository->find($optionId);
            $model = $this->attributeProductValueRepository->findByAttributeProductValues(
                $product->id,
                $optionModel->attribute->id,
                $optionId,
                $variation->id
            );

            if ($model === null) {
                $data = [
                    'product_id' => $product->id,
                    'attribute_id' => $optionModel->attribute->id,
                    'attribute_dropdown_option_id' => $optionId,
                    'variation_id' => $variation->id,
                ];
                $this->attributeProductValueRepository->create($data);
            }
        }
    }
}
