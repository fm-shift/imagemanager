<?php namespace Selmonal\Imagemanager;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Artisan;

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
		$path = realpath(__DIR__. "/../../views");

		// naming views
		View::addNamespace('SIM', $path);

		App::bind('Selmonal\Imagemanager\ImageRepositoryInterface', 'Selmonal\Imagemanager\EloquentImageRepository');

		// Intervention image manipulator
		App::register("Intervention\Image\ImageServiceProvider");


		$this->package('selmonal/imagemanager');


		$custom_configs = Config::get("sim");

		foreach(Config::get("imagemanager::config") as $key => $config)
		{
			if(array_key_exists($key, $custom_configs))
			{
				Config::set("imagemanager::config." . $key , $custom_configs[$key]);
			}
		}
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
