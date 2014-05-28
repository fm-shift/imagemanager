<?php namespace Selmonal\Imagemanager;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SIMInstaller extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'SIM:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		// public paths
		$public_paths = array(
			"images",
			"images/original",
			"images/thumbs"
		);

		// create public paths
		foreach($public_paths as $path)
			$this->createDir(public_path() . "/" . $path);
		
		$this->info("Selmonal image manager successfully installed!");
	}


	public function createDir($path)
	{
		if(file_exists($path)) return true;

		mkdir($path);
	}


	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			// array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
