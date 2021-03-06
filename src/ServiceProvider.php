<?php

namespace Tjventurini\LaravelTestingHelpers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupConfig();

        $this->bindServices();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupMigrations();

        $this->setupCommands();

        $this->setupResources();
    }

    /**
     * Setup configuration in register method.
     *
     * @return void
     */
    private function setupConfig()
    {
        $this->publishes([
            __DIR__ . '/config' => config_path(),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config/package-blueprint.php', 'package-blueprint');
    }

    /**
     * Setup migrations in boot method.
     *
     * @return void
     */
    private function setupMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Setup commands in boot method.
     *
     * @return void
     */
    private function setupCommands(): void
    {
        if ($this->app->runningInConsole()) {
            // $this->commands([
            // ]);
        }
    }

    /**
     * Setup resources in boot method.
     *
     * @return void
     */
    private function setupResources()
    {
        // $this->loadViewsFrom(__DIR__ . '/../resources/views', 'marqant-pay');
    }

    /**
     * Method to setup service bindings and stuff to be used in facades of this package.
     *
     * @return void
     */
    private function bindServices()
    {
        // $this->app->singleton('package-blueprint-service', function ($app) {
        //     return new FooService();
        // });
    }
}
