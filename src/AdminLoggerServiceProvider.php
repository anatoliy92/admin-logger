<?php

namespace Avl\AdminLogger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AdminLoggerServiceProvider extends ServiceProvider
{

    protected $observers = [];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
			// dd((\Request::is(config('adminlogger.url'))));
      $this->publishes([
          __DIR__ . '/../config/adminlogger.php' => config_path('adminlogger.php'),
      ]);

      $this->loadViewsFrom(__DIR__ . '/../resources/views', 'adminlogger');

      $this->loadRoutesFrom(__DIR__ . '/routes.php');

      if (count($this->observers) > 0) {
        if ((\Request::getHost() === config('adminlogger.host')) && (\Request::is(config('adminlogger.url')))) {
          foreach ($this->observers as $model => $observer) {
            if (class_exists($model) && class_exists($observer)) {
              $model::observe($observer);
            }
          }
        }
      }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // объединение настроек с опубликованной версией
        $this->mergeConfigFrom(__DIR__.'/../config/adminlogger.php', 'adminlogger');

        // migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->observers = config('adminlogger.observers') ?? [];

        $this->loadHelpers();

    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
