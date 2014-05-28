<?php namespace Selmonal\Imagemanager;

use Illuminate\Support\Facades\App;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class ImagesController extends Controller {

	private $repository;

	public function __construct(ImageRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Get all images from repository
	 * 
	 * @return Response
	 */
	public function index()
	{
		return $repository->paginate( 10, Input::get("page") );
	}

	/**
	 * Store new image in repository
	 * 
	 * @return [type] [description]
	 */
	public function store()
	{
		$manipulator = App::make("Selmonal\Imagemanager\ImageManipulator");

		if( ! Input::hasFile("file-image")) return "No image uploaded!";
		
		$data = $manipulator->run( Input::file("file-image") );

		$data["caption"] = Input::get("caption");

		try 
		{
			$image = $this->repository->insert( $data );


			return $image->forResponse();
		} 

		catch (\Exception $e) 
		{
			return $e->getMessage();
		}
	}
}