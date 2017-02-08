<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'category/<id:\d+>' => 'category/view',
    ],
];