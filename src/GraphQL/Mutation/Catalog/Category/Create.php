<?php

namespace AvoRed\Framework\GraphQL\Mutation\Catalog\Category;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\Client;
use Zend\Diactoros\ServerRequest;
use function GuzzleHttp\json_decode;
use Rebing\GraphQL\Support\Facades\GraphQL;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;

class Create extends Mutation
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
        'name' => 'CreateCategoryMutation',
        'description' => 'A mutation'
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
        return GraphQL::type('category_type');
    }

   
    /**
     * Argument that can be passed to use this graphql query
     * @var return array
     */
    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
            ],
            'slug' => [
                'name' => 'slug',
                'type' => Type::nonNull(Type::string()),
            ],
            'meta_title' => [
                'name' => 'meta_title',
                'type' => Type::string(),
            ],
            'meta_description' => [
                'name' => 'meta_description',
                'type' => Type::string(),
            ],
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
        $category = $this->categoryRepository->create($args);
        
        return $category;
    }
}
