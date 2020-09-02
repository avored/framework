<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AvoRed E commerce Package Order Language Representation
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'order-status' => [
        'name' => 'Name',
        'title' => 'Order Status',
        'is_default' => 'Is Default',
        'index' => [
            'title' => 'Order Status List',
        ],
        'create' => [
            'title' => 'Order Status Create',
        ],
        'edit' => [
            'title' => 'Order Status Edit',
        ],
    ],
    'order' => [
        'index' => [
            'title' => 'Order',
            'action' => 'Action',
            'download_invoice' => 'Download Invoice',
            'change_status' => 'Change Status',
            'order_status' => 'Order Status',
            'email_invoice' => 'Email Invoice',
            'download_shipping_label' => 'Download Shipping Label',
            'show' => 'Show',
            'add_tracking' => 'Add Tracking Code',
            'track_code' => 'Track Code',
            
        ],
        'show' => [
            'title' => 'Order Show',
            'info' => 'Order Information',
            'product_info' => 'Product Information',
            'id' => 'Order Id',
            'payment_option' => 'Payment Option',
            'shipping_option' => 'Shipping Option',
            'created_at' => 'Created At',
        ],
        'invoice' => [
            'name' => 'Name',
            'qty' => 'Qty',
            'price' => 'Price',
            'tax_amount' => 'Tax Amount',
            'line_total' => 'Line Total',
            'total' => 'Total',
            'payment_method' => 'Payment Method',
            'invoice' => 'Invoice',
            'created_at' => 'Created',
        ],
    ],

];
