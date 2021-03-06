<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Social Networks
    |--------------------------------------------------------------------------
    |
    | Feel free to add additional social networks as needed. You can also add
    | additional key/value pairs to each social network.
    |
    | Note that the published configuration file is merged with the package's
    | default configuration file, meaning you only need to define the
    | key/value pairs that you want to add or override.
    |
    */

    'networks' => [
        'facebook' => [
            'name' => 'Facebook',
            'handle' => env('SOCIAL_FACEBOOK'),
            'url' => 'https://facebook.com/',
            'baseShareUrl' => 'https://www.facebook.com/sharer/sharer.php?u=',
        ],
        'twitter' => [
            'name' => 'Twitter',
            'handle' => env('SOCIAL_TWITTER'),
            'url' => 'https://twitter.com/',
            'baseShareUrl' => 'https://twitter.com/share?url=',
        ],
        'instagram' => [
            'name' => 'Instagram',
            'handle' => env('SOCIAL_INSTAGRAM'),
            'url' => 'https://instagram.com/',
        ],
        'linkedin' => [
            'name' => 'LinkedIn',
            'handle' => env('SOCIAL_LINKEDIN'),
            'url' => 'https://linkedin.com/',
            'baseShareUrl' => 'https://www.linkedin.com/shareArticle?url=',
        ],
        'pinterest' => [
            'name' => 'Pinterest',
            'handle' => env('SOCIAL_PINTEREST'),
            'url' => 'https://pinterest.com/',
            'baseShareUrl' => 'https://pinterest.com/pin/create/button/?url=',
        ],
        'google_plus' => [
            'name' => 'Google Plus',
            'handle' => env('SOCIAL_GOOGLE_PLUS'),
            'url' => 'https://plus.google.com/',
            'baseShareUrl' => 'https://plus.google.com/share?url=',
        ],
        'github' => [
            'name' => 'GitHub',
            'handle' => env('SOCIAL_GITHUB'),
            'url' => 'https://github.com/',
        ],
    ],

];
