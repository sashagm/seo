<?php

namespace Sashagm\Seo\Providers;

use Sashagm\Seo\Traits\SeoTrait;
use Illuminate\Support\ServiceProvider;
use Sashagm\Seo\Console\Commands\CreateCommand;

class SeoServiceProvider extends ServiceProvider
{

    use SeoTrait;

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        $this->registerMigrate();

        $this->publishFiles();

        $this->registerCommands();

        $this->bootSeo();
    }

    protected function registerMigrate()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function publishFiles()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/seo.php',
            'seo'
        );
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateCommand::class,
            ]);
        }
    }
}
