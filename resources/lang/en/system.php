<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AvoRed E commerce Package System Language Representation
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'Passwords must be at least eight characters and match the confirmation.',
    'reset' => 'Your password has been reset!',
    'sent' => 'We have e-mailed your password reset link!',
    'token' => 'This password reset token is invalid.',
    'user' => "We can't find a user with that e-mail address.",

    
    'password' => 'Password',
    'email' => 'Email Address',
    'login-card' => 'AvoRed E commerce Admin Login',
    'login' => 'Login',
    'forget-password' => 'Forgot your password?',
    'notification' => [
        'store' => ':attribute Created successfully!',
        'updated' => ':attribute Updated successfully!',
        'delete' => ':attribute delete successfully!',
        'upload' => ':attribute successfully uploaded!',
        'save' => ':attribute save successfully!',
    ],
    'btn' => [
        'save' => 'Save',
        'cancel' => 'Cancel',
        'create' => 'Create'
    ],
    'admin-user' => [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'is_super_admin' => 'Is Administrator?',
        'email' => 'Email Address',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'role_id' => 'Role',
        'language' => 'Language',
        'image_file' => 'Admin User Profile Image',
        'index' => [
            'title' => 'Admin User List'
        ],
        'create' => [
            'title' => 'Admin User Create'
        ],
        'edit' => [
            'title' => 'Admin User Edit'
        ],
    ],
    'language' => [
        'name' => 'Name',
        'code' => 'Code',
        'is_default' => 'Is Default',
        'index' => [
            'title' => 'Language List'
        ],
        'create' => [
            'title' => 'Language Create'
        ],
        'edit' => [
            'title' => 'Language Edit'
        ],
    ],
    'role' => [
        'name' => 'Name',
        'description' => 'Description',
        'index' => [
            'title' => 'Role List'
        ],
        'create' => [
            'title' => 'Role Create'
        ],
        'edit' => [
            'title' => 'Role Edit'
        ],
    ],
    
    'currency' => [
        'name' => 'Name',
        'code' => 'Code',
        'status' => 'Status',
        'conversation_rate' => 'Conversation Rate',
        'symbol' => 'Symbol',
        'title' => 'Currency',
        'index' => [
            'title' => 'Currency List'
        ],
        'create' => [
            'title' => 'Currency Create'
        ],
        'edit' => [
            'title' => 'Currency Edit'
        ],
    ],
    
    'state' => [
        'name' => 'Name',
        'code' => 'Code',
        'country_id' => 'Country',
        'title' => 'State',
        'index' => [
            'title' => 'State List'
        ],
        'create' => [
            'title' => 'State Create'
        ],
        'edit' => [
            'title' => 'State Edit'
        ],
    ],

    'configuration' => [
        'title' => 'Configuration',
        'nav' => [
            'basic_setting' => 'Basic Settings'
        ],
        'basic' => [
            'site_name' => 'Site Name'
        ]
    ],
    'header' => [
        'logout' => 'Logout'
    ],
    'admin_menus' => [
        'admin-user' => 'Staff',
        'catalog' => 'Catalog',
        'category' => 'Category',
        'currency' => 'Currency',
        'cms' => 'CMS',
        'configuration' => 'Configuration',
        'language' => 'Language',
        'order' => 'Order',
        'order-status' => 'Order Status',
        'page' => 'Page',
        'role' => 'Role',
        'system' => 'System',
        'state' => 'State',
    ],
    'permissions' => [
        'dashboard' => 'Dashboard',
        'page' => [
            'title' => 'Page Permissions',
            'list' => 'Page List',
            'create' => 'Create/Store Page',
            'edit' => 'Edit/Update Page',
            'destroy' => 'Destroy Page',
            'show' => 'Show Page'
        ],
        'category' => [
            'title' => 'Category Permissions',
            'list' => 'Category List',
            'create' => 'Create/Store Category',
            'edit' => 'Edit/Update Category',
            'destroy' => 'Destroy Category',
            'show' => 'Show Category'
        ],
        'language' => [
            'title' => 'Language Permissions',
            'list' => 'Language List',
            'create' => 'Create/Store Language',
            'edit' => 'Edit/Update Language',
            'destroy' => 'Destroy Language',
            'show' => 'Show Language'
        ],
        'product' => [
            'title' => 'Product Permissions',
            'list' => 'Product List',
            'create' => 'Create/Store Product',
            'edit' => 'Edit/Update Product',
            'destroy' => 'Destroy Product',
            'show' => 'Show Product'
        ],
        'attribute' => [
            'title' => 'Attribute Permissions',
            'list' => 'Attribute List',
            'create' => 'Create/Store Attribute',
            'edit' => 'Edit/Update Attribute',
            'destroy' => 'Destroy Attribute',
            'show' => 'Show Attribute'
        ],
        'property' => [
            'title' => 'Property Permissions',
            'list' => 'Property List',
            'create' => 'Create/Store Property',
            'edit' => 'Edit/Update Property',
            'destroy' => 'Destroy Property',
            'show' => 'Show Property'
        ],
        'user' => [
            'title' => 'User Permissions',
            'list' => 'User List',
            'create' => 'Create/Store User',
            'edit' => 'Edit/Update User',
            'destroy' => 'Destroy User',
            'show' => 'Show User'
        ],
        'user_group' => [
            'title' => 'User Group Permissions',
            'list' => 'User Group List',
            'create' => 'Create/Store User Group',
            'edit' => 'Edit/Update User Group',
            'destroy' => 'Destroy User Group',
            'show' => 'Show User Group'
        ],
        'admin_user' => [
            'title' => 'Admin User Permissions',
            'list' => 'Admin User List',
            'create' => 'Create/Store Admin User',
            'edit' => 'Edit/Update Admin User',
            'destroy' => 'Destroy Admin User',
            'show' => 'Show Admin User'
        ],
        'role' => [
            'title' => 'Role Permissions',
            'list' => 'Role List',
            'create' => 'Create/Store Role',
            'edit' => 'Edit/Update Role',
            'destroy' => 'Destroy Role',
            'show' => 'Show Role'
        ],
        'configuration' => [
            'title' => 'Configuration Permissions',
            'view' => 'View Configuration',
            'edit' => 'Store/Update Configuration',
        ],
        'site_currency' => [
            'title' => 'Site Currency Permissions',
            'list' => 'Site Currency List',
            'create' => 'Create/Store Site Currency',
            'edit' => 'Edit/Update Site Currency',
            'destroy' => 'Destroy Site Currency',
            'show' => 'Show Site Currency'
        ],
        'country' => [
            'title' => 'Country Permissions',
            'list' => 'Country List',
            'create' => 'Create/Store Country',
            'edit' => 'Edit/Update Country',
            'destroy' => 'Destroy Country',
            'show' => 'Show Country'
        ],
        'state' => [
            'title' => 'State Permissions',
            'list' => 'State List',
            'create' => 'Create/Store State',
            'edit' => 'Edit/Update State',
            'destroy' => 'Destroy State',
            'show' => 'Show State'
        ],
        'theme' => [
            'title' => 'Theme Permissions',
            'list' => 'Theme List Permissions',
            'create' => 'Store/Upload Theme Permissions',
            'activated' => 'Activated Theme Permissions',
            'deactivated' => 'Deactivated Theme Permissions',
        ],
        'module' => [
            'title' => 'Module Permissions',
            'list' => 'Module List Permissions',
            'upload' => 'Module Upload Permissions',
        ],
        'order' => [
            'title' => 'Menu Permissions',
            'list' => 'Order List',
            'view' => 'Order View',
            'sent_invoice_by_mail' => 'Order Sent Invoice By Email',
            'status_change' => 'Change Order Status'
        ],
        'order_status' => [
            'title' => 'Order Status Permissions',
            'list' => 'Order Status List',
            'create' => 'Create/Store Order Status',
            'edit' => 'Edit/Update Order Status',
            'destroy' => 'Destroy Order Status',
            'show' => 'Show Order Status'
        ],
        'menu' => [
            'title' => 'Menu Permissions',
            'front' => 'Front Menu Index',
            'save' => 'Save Front Menu',
        ],
    ],

    'breadcrumb' => [
        'dashboard' => 'Dashboard',
        'configuration' => 'Configuration',
        'category' => [
            'index' => 'Category',
            'edit' => 'Edit Category',
            'create' => 'Create Category',
        ],
        'admin-user' => [
            'index' => 'AdminUser',
            'edit' => 'Edit AdminUser',
            'create' => 'Create AdminUser',
        ],
        'language' => [
            'index' => 'Language',
            'edit' => 'Edit Language',
            'create' => 'Create Language',
        ],
        'page' => [
            'index' => 'Page',
            'edit' => 'Edit Page',
            'create' => 'Create Page',
        ],
        'role' => [
            'index' => 'Role',
            'edit' => 'Edit Role',
            'create' => 'Create Role',
        ],
    ]

];
