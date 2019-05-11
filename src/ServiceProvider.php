<?php

namespace Partoo\Widgets;

use Illuminate\Support\Facades\Blade;
use Partoo\Widgets\Console\WidgetMakeCommand;
use Partoo\Widgets\Factories\AsyncWidgetFactory;
use Partoo\Widgets\Factories\WidgetFactory;
use Partoo\Widgets\Misc\LaravelApplicationWrapper;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php', 'laravel-widgets'
        );

        $this->app->bind('Partoo.widget', function () {
            return new WidgetFactory(new LaravelApplicationWrapper());
        });

        $this->app->bind('Partoo.async-widget', function () {
            return new AsyncWidgetFactory(new LaravelApplicationWrapper());
        });

        $this->app->singleton('Partoo.widget-group-collection', function () {
            return new WidgetGroupCollection(new LaravelApplicationWrapper());
        });

        $this->app->singleton('Partoo.widget-namespaces', function () {
            return new NamespacesRepository();
        });

        $this->app->singleton('command.widget.make', function ($app) {
            return new WidgetMakeCommand($app['files']);
        });

        $this->commands('command.widget.make');

        $this->app->alias('Partoo.widget', 'Partoo\Widgets\Factories\WidgetFactory');
        $this->app->alias('Partoo.async-widget', 'Partoo\Widgets\Factories\AsyncWidgetFactory');
        $this->app->alias('Partoo.widget-group-collection', 'Partoo\Widgets\WidgetGroupCollection');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('laravel-widgets.php'),
        ]);

        $routeConfig = [
            'namespace' => 'Partoo\Widgets\Controllers',
            'prefix' => 'Partoo',
            'middleware' => $this->app['config']->get('laravel-widgets.route_middleware', []),
        ];

        if (!$this->app->routesAreCached()) {
            $this->app['router']->group($routeConfig, function ($router) {
                $router->get('load-widget', 'WidgetController@showWidget');
            });
        }

        Blade::directive('widget', function ($expression) {
            return "<?php echo app('Partoo.widget')->run($expression); ?>";
        });

        Blade::directive('asyncWidget', function ($expression) {
            return "<?php echo app('Partoo.async-widget')->run($expression); ?>";
        });

        Blade::directive('widgetGroup', function ($expression) {
            return "<?php echo app('Partoo.widget-group-collection')->group($expression)->display(); ?>";
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Partoo.widget', 'Partoo.async-widget'];
    }
}
