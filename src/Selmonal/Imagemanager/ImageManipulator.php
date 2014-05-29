<?php namespace Selmonal\Imagemanager;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageManipulator {

	/**
	 * Зураг хуулах хавтас
	 * 
	 * @var string
	 */
	private $folder = "";

	/**
	 * Суурь хавтас
	 * 
	 * @var string
	 */
	private $basePath = "/assets/images/";

	/**
	 * Төрөлүүд
	 * 
	 * @var array
	 */
	private $sizes = array(

		"small" => array(
			"width"  => "80",
			"height" => "70"
		),
		"thumb" => array(
			"width"  => 300,
			"height" => 200,			
		),
		"original" => array(
			"width"  => 600,
			"height" => false,
			"ratio"  => true,
		)
	);

	public function __construct()
	{
		$this->basePath = public_path() . $this->basePath;

		$this->folder = date("Ymd");
	}

	public function run( UploadedFile $file )
	{	
		$extension = $file->getClientOriginalExtension();

		// Create filename
		$filename = $this->generateImagename( $extension );

		// Create image file path
		$this->image_path = $this->folder . "/" . $filename;


		foreach($this->sizes as $key => $size)
		{
			$this->resizeAndSave($file->getRealPath(), $key, $size);
		}

		return array( 
			"path"      => $this->image_path,
			"extension" => $extension
		);
	}

	private function resizeAndSave( $imageRealPath, $size_name, $size ) 
	{
		$folder_path = $this->basePath . $size_name . "/" . $this->folder;

		// Folder uusgeh
		if( ! File::isDirectory($folder_path)) 
			mkdir($folder_path);

		$path = $this->basePath . $size_name . "/" . $this->image_path;

		$image = Image::make($imageRealPath);

		$ratio = isset($size["ratio"]) ? $size["ratio"] : true;

		$image->resize($size["width"], $size["height"], function( $constraint ) {

			$constraint->aspectRatio();

		})->save($path);
	}

	private function generateImagename( $ext )
	{
		return date("dmY") . str_random(6) . "." . $ext;
	}
}