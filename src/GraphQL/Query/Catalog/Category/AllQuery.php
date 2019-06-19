<?php

namespace AvoRed\Framework\GraphQL\Query\Catalog\Category;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;

class AllQuery extends Query
{
    /**
     * Category Repository for the All Category Query
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository $categoryRepository
     */
    protected $categoryRepository;

    /**
     * All category query attributes
     * @var array $attributes
     */
    protected $attributes = [
        'name' => 'CategoryAllQuery',
        'description' => 'A query'
    ];
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\CategoryRepository $categoryRepository
     */
    public function __construct(
        CategoryModelInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }
   

    /**
     * Type that these query expected as output
     * @var return mixed
     */
    public function type()
    {
        return Type::listOf(GraphQL::type('category_type'));
    }

    /**
     * Argument that can be passed to use this graphql query
     * @var return array
     */
    public function args()
    {
        return [

        ];
    }

    /**
     * Resolve method which return the expected data for this graphql query
     * @param mixed $root
     * @param array $args
     * @param \Rebing\GraphQL\Support\SelectFields $fields
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        return $this->categoryRepository->all();
    }
}
