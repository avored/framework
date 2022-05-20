<?php

namespace AvoRed\Framework\Graphql\Types;

use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    /**
     * Per Page Item
     * @var int
     */
    protected $perPage = 6;

    /**
     * Attribute for Category Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Category',
        'description' => 'A type',
    ];

    /**
     * Fields for Category Type
     * @return array $fields
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Category Id',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Category Name',
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Category Slug',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Category Description',
            ],
            'meta_title' => [
                'type' => Type::string(),
                'description' => 'Category Meta title',
            ],
            'meta_description' => [
                'type' => Type::string(),
                'description' => 'Category Meta Description',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Category created at',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Category updated at',
            ],
            // 'filter' => [
            //     'type' => Type::listOf(GraphQL::type('filter')),
            //     'description' => 'Category Filter'
            // ],
            'products' => [
                'type' => GraphQL::paginate('Product'),
                'description' => 'Category Product',
            ],
            'children' => [
                'type' => Type::listOf(GraphQL::type('Category')),
                'description' => 'Child Category',
            ],
        ];
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Category $category
     * @param array $args
     * @return \Illuminate\Support\Collection $titleCollection
     */
    protected function resolveFilterField($category, $args)
    {
        $categoryFilterRepository = app(CategoryFilterModelInterface::class);

        return $categoryFilterRepository->findByCategoryId($category->id);
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Category $category
     * @param array $args
     * @return \Illuminate\Support\Collection $titleCollection
     */
    protected function resolveChildrenField($category, $args)
    {
        return $category->children;
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Category $category
     * @param array $args
     * @param mixed $content
     * @param ResolveInfo $resolveInfo
     * @return \Illuminate\Support\Collection $categoryProducts
     */
    protected function resolveProductsField($category, $args, $context, ResolveInfo $resolveInfo)
    {
        $args = $resolveInfo->variableValues;
        $page = isset($args['page']) ? $args['page'] : 1;

        return $category->products()->paginate($this->getNoOfPaginateItem(), ['*'], 'page', $page);
    }

    /**
     * Get the Number of Item per page
     * @return int
     */
    protected function getNoOfPaginateItem(): int
    {
        return $this->perPage;
    }
}
