<?php namespace Selmonal\Imagemanager;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class ImagesController extends Controller {

	private $repository;

	private $manipulator = null;

	public function __construct(ImageRepositoryInterface $repository, ImageManipulator $manipulator)
	{
		$this->repository  = $repository;
		$this->manipulator = $manipulator;
	}

	/**
	 * Get all images from repository
	 * 
	 * @return Response
	 */
	public function index()
	{
		return $this->repository->paginate( 8, Input::all() );
	}

	/**
	 * Store new image in repository
	 * 
	 * @return [type] [description]
	 */
	public function store()
	{
		try 
		{			
			$data = $this->manipulator->run( Input::file("file-image") );

			$data["caption"] = Input::get("caption");

			$image = $this->repository->insert( $data );

			return $image->forResponse();
		} 

		catch (\Exception $e) 
		{
			return $e;
		}
	}
}