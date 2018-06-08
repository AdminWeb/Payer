<?php


use AdminWeb\Payer\EnvInterface;

return [
    'driver' => 'pagseguro',
    'env' => EnvInterface::SandBox,
    'client' => [
        'key' => '',
        'secret' => ''
    ]
];