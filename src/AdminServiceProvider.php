<?php

namespace Wdevkit\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Wdevkit\Admin\Commands\AdminCreateCommand;

class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/admin.php' => config_path('admin.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../routes/admin.php' => base_path('routes/admin.php')
            ], 'routes');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/wdevkit_admin'),
            ], 'views');

            $migrationFileName = 'create_admins_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                AdminCreateCommand::class,
            ]);
        }

        $this->registerRoutes();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'wdevkit_admin');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'wdevkit_admin');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Register the admin routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->group(
                file_exists(base_path('routes/admin.php'))
                ? base_path('routes/admin.php')
                : __DIR__ . '/../routes/admin.php'
            );
    }
}
