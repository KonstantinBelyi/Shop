<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'category/<id:\d+>/page/<page:\d+>' => 'category/view',
        'category/<id:\d+>' => 'category/view',
        'product/<id:\d+>' => 'product/view',
    ],
];