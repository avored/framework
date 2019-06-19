<?php
namespace AvoRed\Framework\GraphQL\Type\System\Layout;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AdminMenuType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AdminMenuType',
        'description' => 'A type'
    ];
    public function fields()
    {
        return [
            'key' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The key of an Admin Menu'
            ],
            'label' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The label of an Admin Menu'
            ],
            'icon' => [
                'type' => Type::string(),
                'description' => 'The Icon of an Admin Menu'
            ],
            'url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The url of an Admin Menu'
            ],
            'subMenus' => [
                'type' => Type::listOf(GraphQL::type('adminMenuType')),
                'description' => 'The url of an Admin Menu'
            ],
           
        ];
    }

    /**
     * @param \Avored\Framework\Menu\MenuItem $adminMenu
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Collection $titleCollection
     */
    protected function resolveUrlField($adminMenu, $args)
    {
        if ($adminMenu->route() === '#') {
            return '#';
        }
        return route($adminMenu->route());
    }

    /**
     * @param \Avored\Framework\Menu\MenuItem $adminMenu
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Collection $titleCollection
     */
    protected function resolveKeyField($adminMenu, $args)
    {
        return $adminMenu->key();
    }

    /**
     * @param \Avored\Framework\Menu\MenuItem $adminMenu
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Collection $titleCollection
     */
    protected function resolveLabelField($adminMenu, $args)
    {
        return $adminMenu->label();
    }

    /**
     * @param \Avored\Framework\Menu\MenuItem $adminMenu
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Collection $titleCollection
     */
    protected function resolveIconField($adminMenu, $args)
    {
        return $adminMenu->icon();
    }

    /**
     * @param \Avored\Framework\Menu\MenuItem $adminMenu
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Collection $titleCollection
     */
    protected function resolveSubMenusField($adminMenu, $args)
    {
        return $adminMenu->subMenu();
    }
}
