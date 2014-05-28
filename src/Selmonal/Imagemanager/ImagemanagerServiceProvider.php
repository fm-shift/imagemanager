<?php namespace Selmonal\Imagemanager;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ImagemanagerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{	
		// dd(__DIR__ . "../../views/");
		$path = realpath(__DIR__. "/../../views");

		// naming views
		View::addNamespace('SIM', $path);

		App::bind('Selmonal\Imagemanager\ImageRepositoryInterface', 'Selmonal\Imagemanager\EloquentImageRepository');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
