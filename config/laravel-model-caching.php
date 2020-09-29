<?php

return [
    'cache-prefix' => 'model-cache-',

    'enabled' => env('MODEL_CACHE_ENABLED', true),

    'use-database-keying' => env('MODEL_CACHE_USE_DATABASE_KEYING', false),

    'store' => env('MODEL_CACHE_STORE'),
];
