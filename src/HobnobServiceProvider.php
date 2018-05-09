<?php

namespace SamWrigley\Hobnob;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HobnobServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConfig();
        $this->bootViews();
        $this->bootTranslations();
        $this->bootCollectionMacros();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->registerConfigMerge();
        $this->registerBladeDirectives();
    }

    /**
     * Boot configuration files.
     *
     * @return void
     */
    private function bootConfig()
    {
        $this->publishes([
            __DIR__.'/config/hobnob.php' => config_path('hobnob.php'),
        ], 'hobnob-config');
    }

    /**
     * Boot views.
     *
     * @return void
     */
    private function bootViews()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'hobnob');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/hobnob'),
        ], 'hobnob-views');
    }

    /**
     * Boot translations.
     *
     * @return void
     */
    private function bootTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'hobnob');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/hobnob'),
        ], 'hobnob-translations');
    }

    /**
     * Boot collection macros.
     *
     * @return void
     */
    private function bootCollectionMacros()
    {
        /*
         * Reject key/value pairs in an associative
         * array where the value is `empty`.
         */
        Collection::macro('rejectEmptyAssocValues', function () {
            return $this->map(function ($array) {
                return collect($array)
                    ->reject(function ($value) {
                        return empty($value);
                    })
                    ->toArray();
            });
        });

        /*
         * Filter associative arrays to only those that
         * contain all then given keys.
         */
        Collection::macro('filterByAssocKeys', function (array $keys) {
            return $this->filter(function ($network) use ($keys) {
                return array_has($network, $keys);
            });
        });

        /*
         * Filter associative arrays by given keys.
         */
        Collection::macro('filterByKeys', function (array $items) {
            return $this->when(! empty($items), function ($query) use ($items) {
                return $query->filter(function ($value, $key) use ($items) {
                    return in_array($key, $items);
                });
            });
        });
    }

    /**
     * Register service container bindings.
     *
     * @return void
     */
    private function registerBindings()
    {
        $this->app->singleton(SocialNetwork::class);
    }

    /**
     * Register configuration file merge.
     *
     * @return void
     */
    private function registerConfigMerge()
    {
        $this->mergeConfigFrom(__DIR__.'/config/hobnob.php', 'hobnob');
    }

    /**
     * Register blade directives.
     *
     * @return void
     */
    private function registerBladeDirectives()
    {
        /*
         * Render sharing links.
         *
         * @example @sharingLinks
         * @example @sharingLinks('facebook')
         * @example @sharingLinks(['facebook', twitter'])
         */
        Blade::directive('sharingLinks', function ($networks) {
            return "<?php echo app('SamWrigley\Hobnob\LinkGenerator')->sharingLinks($networks); ?>";
        });

        /*
         * Render social links.
         *
         * @example @socialLinks
         * @example @socialLinks('facebook')
         * @example @socialLinks(['facebook', twitter'])
         */
        Blade::directive('socialLinks', function ($networks) {
            return "<?php echo app('SamWrigley\Hobnob\LinkGenerator')->socialLinks($networks); ?>";
        });
    }
}
