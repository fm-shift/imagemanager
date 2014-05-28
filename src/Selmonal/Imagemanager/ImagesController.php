<?php namespace Selmonal\Imagemanager;

use Illuminate\Routing\Controller;

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

		$data = $manipulator->run( Input::file("image") );

		try 
		{
			return $this->repository->insert( $data );
		} 

		catch (\Exception $e) 
		{
			return $e->getMessage();
		}
	}
}