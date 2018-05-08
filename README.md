# Laravel Hobnob

A package for easily creating social and sharing links in Laravel applications.

Here's a few examples of the provided methods and Blade directives:

```
// Create social network links inside Blade files
@socialLinks
@socialLinks('twitter')

// Create social network sharing links inside Blade files
@sharingLinks
@sharingLinks('twitter')

// Get all social networks
SocialNetwork::all();

// Get a social network's handle
SocialNetwork::handles('twitter');
```

## Installation

This package can be installed through Composer:

``` bash
composer require samwrigley/laravel-hobnob
```

In Laravel 5.5 and above this package will auto-register the service provider; you can therefore skip this step.

In Laravel 5.4 however, you must install the service provider by adding the following to your `config/app.php`:

``` php
'providers' => [
    ...
    SamWrigley\Hobnob\HobnobServiceProvider::class,
    ...
];
```

In Laravel 5.5 and above this package will auto-register the facade; you can therefore skip this step.

In Laravel 5.4 however, you must install the facade manually by adding the following to your `config/app.php`:

``` php
'aliases' => [
    ...
    'SocialNetwork' => SamWrigley\Hobnob\Facades\SocialNetworkFacade::class,
    ...
];
```

### Environment file

Depending on which social networks you'd like to use, add your choice of the following keys to your `.example.env` and `.env` files.

Below are the social networks that Laravel Hobnob has by default. You can of course add additional social networks to your `.example.env` and `.env`, as long as they follow the same naming convention, i.e `SOCIAL_<network-name>`.

In your `.env`, make sure to add the corresponding social network handles as the keys. For example: `SOCIAL_TWITTER=samwrigley`.

```
SOCIAL_FACEBOOK=
SOCIAL_TWITTER=
SOCIAL_INSTAGRAM=
SOCIAL_LINKEDIN=
SOCIAL_PINTEREST=
SOCIAL_GOOGLE_PLUS=
SOCIAL_GITHUB=
```

### Configuration File

Optionally, to publish the package's configuration file, run the following artisan command:

``` bash
php artisan vendor:publish --provider="SamWrigley\Hobnob\HobnobServiceProvider"
```

Only publish the configuration file if you need to add additional social networks, or key/value pairs to the social networks. Once published, any updates to the package's configuration file will need to be manually brought across.

Also note that the published configuration file is merged with the package's default configuration file, meaning you only need to define the key/value pairs that you want to add or override.

After running the artisan command, the following configuration file will be published in `config/hobnob.php`:

``` php
return [

    /*
    |--------------------------------------------------------------------------
    | Social Networks
    |--------------------------------------------------------------------------
    */

    'networks' => [
        'facebook' => [
            'name' => 'Facebook',
            'handle' => env('SOCIAL_FACEBOOK'),
            'url' => 'https://facebook.com/',
            'baseShareUrl' => "https://www.facebook.com/sharer/sharer.php?u=",
        ],
        'twitter' => [
            'name' => 'Twitter',
            'handle' => env('SOCIAL_TWITTER'),
            'url' => 'https://twitter.com/',
            'baseShareUrl' => "https://twitter.com/share?url=",
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
            'baseShareUrl' => 'https://www.linkedin.com/shareArticle?mini=true&url=',
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
```

Feel free to add additional social networks as needed. If doing so, remember to add the corresponding key/value pair to your `.example.env` and `.env` as mentioned in the ['Environment File'](#environment-file) section. If no `handle` value is specified for a given social network, then it will not be output when using the `socialLinks` Blade directive.

Also feel free to add additional key/value pairs to the social networks. These will then be available inside the `social-links.blade.php` and `sharing-links.blade.php` Blade partials as specified in the ['Views'](#views) section.

### Views

No one likes having to use someone else's markup, so in order to override the default markup, simply publish the package's views.

To do so, run the following artisan command and choose which files you'd like to publish:

``` bash
php artisan vendor:publish
```

Inside the `resources/views/vendor/hobnob` directory you'll now find the `social-links.blade.php` and `sharing-links.blade.php` Blade partials. You are free to change these files however you wish to create your own custom social and sharing links.

Within the `social-links.blade.php` and `sharing-links.blade.php` Blade partials, the available social networks are accessible via the `$networks` variable.

By default, each item within the `$networks` array contains the following key/value pairs:

| Key | Value |
| --- | --- |
| name | Social network's name |
| handle | Social network's handle |
| url | Social network's URL |
| baseShareUrl | Social network's base sharing URL |

In addition to the key/value pairs mentioned above, inside the `social-links.blade.php` Blade partial, the following key/value pair is also available:

| Key | Value |
| --- | --- |
| profileUrl | Social network's profile URL |

Inside the `sharing-links.blade.php` Blade partial, the following key/value pair is also available:

| Key | Value |
| --- | --- |
| shareUrl | Social network's full sharing URL |

Any additional key/value pairs added to the social networks with the package's configuration file will also be available in both Blade partials.

### Translations

To publish the package's translation file, run the following artisan command and choose the file you'd like to publish:

``` bash
php artisan vendor:publish
```

You can find the published translation file in the `resources/lang/vendor` directory.

Only publish the translation file if you need to change the English translations, or add additional translations (for example, if you're creating your own custom social and sharing links). Once published, any updates to the package's translation file will need to be manually brought across.

## Usage

### Social Links

In order to create social links, simply add the `@socialLinks` Blade directive to any Blade file.

Below are the different options that allow you to specify which networks you'd like to output.

``` php
@socialLinks
@socialLinks('twitter')
@socialLinks(['twitter', 'facebook'])
```

### Sharing Links

In order to create sharing links, simply add the `@sharingLinks` Blade directive to any Blade file.

Again, below are the different options that allow you to specify which networks you'd like to output.

``` php
@sharingLinks
@sharingLinks('twitter')
@sharingLinks(['twitter', 'facebook'])
```

### Facades

You may also access social networks via the `SocialNetwork` facade, as shown below:

``` php
SocialNetwork::all();
SocialNetwork::get('twitter');
SocialNetwork::get(['twitter', 'facebook']);
```

The `get()` method (when passed an array) and the `all()` method will return an `Illuminate\Support\Collection` object, you can therefore call `toArray()` to convert the object to an array. For example:

``` php
SocialNetwork::all()->toArray();
SocialNetwork::get(['twitter', 'facebook'])->toArray();
```

#### Handles

In order to get a given social network's handle, you can call the `handles()` method:

``` php
SocialNetwork::handles();
SocialNetwork::handles('twitter');
SocialNetwork::handles(['twitter', 'facebook']);
```

## Testing

Run the tests with:

``` bash
vendor/bin/phpunit
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
