<?php

declare(strict_types=1);

use App\Models\Page;

return [
    'models' => [
        Page::class => [
            'name',
            'slug',
            'content',
            'heroImage',
        ],
    ],

    'modules' => [
        'heroImage' => [
            'title',
            'content',
        ],
    ],

    'touch' => [
        //
    ],
];
