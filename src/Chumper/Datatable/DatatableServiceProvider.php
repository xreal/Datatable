<?php namespace Chumper\Datatable;

use Illuminate\Support\ServiceProvider;
use View;

class DatatableServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        //$this->package('chumper/datatable');
        $viewPath = __DIR__.'/../../resources/views';
        $this->loadViewsFrom($viewPath, 'datatable');

        $this->publishes([
            $viewPath => base_path('resources/views/vendor/datatable'),
        ]);
    }

    /**
     * Prepare the package resources.
     *
     * @return void
     */
    protected function prepareResources()
    {

        $configPath = __DIR__ . '/../../config/config.php';
        $this->mergeConfigFrom($configPath, 'datatable');
        $this->publishes([
            $configPath => config_path('datatable.php'),
        ]);
    }

    /**
	 * Register the service provider.
	 *
	 * @return void
	 */
    public function register()
    {
        $this->prepareResources();

        $this->app['datatable'] = $this->app->share(function($app)
        {
            return new Datatable;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('datatable');
    }

}
