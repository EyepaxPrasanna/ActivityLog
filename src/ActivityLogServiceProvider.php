<?php

namespace Eyepax;

use Illuminate\Support\ServiceProvider;

class ActivityLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/activity_log.php' => config_path('activity_log.php')
        ]);

        $this->publishes([
            __DIR__ . '/2017_08_10_080036_create_activity_logs_table.php' => database_path('migrations') .
                '/2017_08_10_080036_create_activity_logs_table.php'
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('eyepax-activity-log', function () {
            return new ActivityLog();
        });
    }
}
