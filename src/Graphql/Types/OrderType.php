<?php
namespace AvoRed\Framework\Graphql\Types;

use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use AvoRed\Framework\Database\Models\Order;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class OrderType extends GraphQLType
{
    /**
     * Attribute for Order Type
     * @var array
     */
    protected $attributes = [
        'name' => 'Order',
        'description' => 'A type'
    ];

    /**
    * Fields for Order Type
    * @return array $fields
    */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Id'
            ],
            'shipping_option' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Shipping Option'
            ],
            'payment_option' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Payment Option'
            ],
            'order_status_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Status Id'
            ],
            'order_status_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Status Name'
            ],
            'shipping_address_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Shipping Address Id'
            ],
            'shipping_address' => [
                'type' => Type::nonNull(GraphQL::type('Address')),
                'description' => 'Order Shipping Address'
            ],
            'customer' => [
                'type' => Type::nonNull(GraphQL::type('Customer')),
                'description' => 'Order Customer'
            ],
            'billing_address_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order Billing Address Id'
            ],
            'billing_address' => [
                'type' => GraphQL::type('Address'),
                'description' => 'Order Billing Address'
            ],
            'track_code' => [
                'type' => Type::string(),
                'description' => 'Order Tracking Code'
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order created at'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Order updated at '
            ],
        ];
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveTaxAmountField(Order $order, $args)
    {
        return $order->taxAmount();
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveBillingAddressField(Order $order, $args)
    {
        return $order->billingAddress;
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveShippingAddressField(Order $order, $args)
    {
        return $order->shippingAddress;
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @param array $args
     * @return string $taxAmount
     */
    protected function resolveOrderStatusNameField(Order $order, $args)
    {
        return $order->orderStatus->name;
    }
}
