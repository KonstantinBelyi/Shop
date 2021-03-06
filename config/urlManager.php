<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'category/<id:\d+>/page/<page:\d+>' => 'category/view',
        'category/<id:\d+>' => 'category/view',
        'product/<id:\d+>' => 'product/view',
        'search' => 'category/search',
        'order' => 'cart/order',
        'signup' => 'site/signup',
        'signin' => 'site/login',
        'logout' => 'site/logout',
    ],
];