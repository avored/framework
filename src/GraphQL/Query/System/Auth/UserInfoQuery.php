<?php

namespace AvoRed\Framework\GraphQL\Query\System\Auth;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Auth;

class UserInfoQuery extends Query
{
    protected $attributes = [
        'name' => 'UserInfoQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::type('adminUserType');
    }

    public function args()
    {
        return [

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        return Auth::guard('admin_api')->user();
    }
}
