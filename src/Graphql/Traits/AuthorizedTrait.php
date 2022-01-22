<?php

namespace AvoRed\Framework\Graphql\Traits;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;

trait AuthorizedTrait
{
    /**
     * To check if user has at least customer api token or not?
     * @param [type] $root
     * @param array $args
     * @param [type] $ctx
     * @param ResolveInfo|null $resolveInfo
     * @param Closure|null $getSelectFields
     * @return boolean
     */
    public function authorize($root, array $args, $ctx, ?ResolveInfo $resolveInfo = null, ?Closure $getSelectFields = null): bool
    {
        return Auth::guard('customer')->check();
    }
}
