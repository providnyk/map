<?php

namespace Modules\ProvidnykV1\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ProvidnykV1ServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('ProvidnykV1', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('ProvidnykV1', 'Config/config.php') => config_path('providnykV1.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('ProvidnykV1', 'Config/config.php'), 'providnykV1'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/providnykV1');

        $sourcePath = module_path('ProvidnykV1', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/providnykV1';
        }, \Config::get('view.paths')), [$sourcePath]), 'providnykV1');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/providnykV1');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'providnykV1');
        } else {
            $this->loadTranslationsFrom(module_path('ProvidnykV1', 'Resources/lang'), 'providnykV1');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('ProvidnykV1', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
