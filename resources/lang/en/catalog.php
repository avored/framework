<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AvoRed E commerce Package Catalog Language Representation
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'category' => [
        'title' => 'Category',
        'name' => 'Name',
        'slug' => 'Slug',
        'meta_title' => 'Meta Title',
        'meta_description' => 'Meta Description',
        'index' => [
            'title' => 'Category List',
        ],
        'create' => [
            'title' => 'Category Create',
        ],
        'edit' => [
            'title' => 'Category Edit',
        ],
    ],
    'property' => [
        'title' => 'Property',
        'name' => 'Name',
        'slug' => 'Slug',
        'data_type' => 'Data Type',
        'field_type' => 'Field Type',
        'use_for_all_products' => 'Use for all products',
        'use_for_category_filter' => 'Use for category filter',
        'is_visible_frontend' => 'Is visible in Frontend',
        'sort_order' => 'Sort Order',
        'dropdown_options' => 'Dropdown Options',
        'index' => [
            'title' => 'Property List',
        ],
        'create' => [
            'title' => 'Property Create',
        ],
        'edit' => [
            'title' => 'Property Edit',
        ],
    ],
    'attribute' => [
        'title' => 'Attribute',
        'name' => 'Name',
        'image' => 'Image',
        'upload' => 'Click to upload',
        'slug' => 'Slug',
        'display_as' => 'Display As',
        'dropdown_options' => 'Dropdown Options',
        'index' => [
            'title' => 'Attribute List',
        ],
        'create' => [
            'title' => 'Attribute Create',
        ],
        'edit' => [
            'title' => 'Attribute Edit',
        ],
    ],

    'cart_success_notification' => 'Product added to cart successfully.',
    'promotion_code_success_notification' => 'Promotion code applied to cart successfully.',
    'promotion_code_errot_notification' => 'There is an error. Please check your code or contact administrator.',
    'cart_variable_product_error_notification' => 'There is an error while adding product to cart.',

];
