<?php

return [

    'items_per_page' => env('ITEMS_PER_PAGE', 20), // pagination

    'image_variations' => [
        'small' => [
            'width' => 100,
            'height' => 100
        ],
        'medium' => [
            'width' => 200,
            'height' => 200
        ],
        'large' => [
            'width' => 500,
            'height' => 500
        ]
    ]

];
