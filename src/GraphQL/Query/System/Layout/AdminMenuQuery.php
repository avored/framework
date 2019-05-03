<?php

namespace AvoRed\Framework\GraphQL\Query\System\Layout;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use AvoRed\Framework\Support\Facades\Menu;

class AdminMenuQuery extends Query
{
    protected $attributes = [
        'name' => 'AdminMenuQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('adminMenuType'));
    }

    public function args()
    {
        return [

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $adminMenus = Menu::admin()->all();
    
        return $adminMenus;
    }
}
