<?php namespace Selmonal\Imagemanager;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageManipulator {

	/**
	 * Зураг хуулах хавтас
	 * 
	 * @var string
	 */
	private $folder = "";

	public function __construct()
	{
		$this->basePath = public_path() . Config::get("imagemanager::basePath");

		$this->folder = date("Ymd");
	}

	public function run( UploadedFile $file )
	{	
		$extension = $file->getClientOriginalExtension();

		// Create filename
		$filename = $this->generateImagename( $extension );

		// Create image file path
		$this->image_path = $this->folder . "/" . $filename;

		$sizes = Config::get("imagemanager::sizes");

		foreach($sizes as $key => $size)
		{
			$this->createSizeFolder($key);
			$this->resizeAndSave($file->getRealPath(), $key, $size);
		}

		return array( 
			"path"      => $this->image_path,
			"extension" => $extension
		);
	}

	private function resizeAndSave( $imageRealPath, $size_name, $size ) 
	{
		$path = $this->basePath . $size_name . "/" . $this->image_path;

		$image = Image::make($imageRealPath);

		$ratio = isset($size["ratio"]) ? $size["ratio"] : true;

		$image->resize($size["width"], $size["height"], function( $constraint ) use ($ratio) {

			if($ratio) $constraint->aspectRatio();

		})->save($path);
	}

	/**
	 * Хэмжээтэй хавтаснуудыг үүсээгүй байвал үүсгэнэ.
	 * 
	 * @return void
	 */
	private function createSizeFolder( $size_name )
	{
		$p = $this->basePath . $size_name;

		if( ! File::isDirectory($p)) mkdir($p);

		$p .= "/" . $this->folder;

		if( ! File::isDirectory($p)) mkdir($p);
	}

	/**
	 * Зургын нэрийг үүсгэх
	 * 
	 * @param  string $ext Зургын өргөтгөл
	 * @return string
	 */
	private function generateImagename( $ext )
	{
		return date("dmY") . str_random(6) . "." . $ext;
	}
}