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

class Delete extends Mutation
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
        'name' => 'DeleteCategoryMutation',
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
        return Type::string();
    }

   
    /**
     * Argument that can be passed to use this graphql query
     * @var return array
     */
    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
            ]
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
        if ($this->categoryRepository->delete($args['id'])) {
            return "Category Deleted Successfully!";
        }
        
        throw new \Exception("There is an issue while deleting a category please contact administrator!");
    }
}
