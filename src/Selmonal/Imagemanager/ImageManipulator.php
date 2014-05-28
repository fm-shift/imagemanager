<?php namespace Selmonal\Imagemanager;

use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageManipulator {

	public function run( UploadedFile $file )
	{
		$extension = $file->getClientOriginalExtension();

		$filename = date("md") . str_random(6) . "." . $extension;

		$folder = "";
		$dir = public_path() . "/assets/images/original/" . $folder . $filename;
		$thumb_dir = public_path() . "/assets/images/thumb/" . $folder . $filename;

		Image::make( $file->getRealPath() )
					->save($dir)
					->resize(300, 200)
					->save($thumb_dir);

		return $folder . $filename;
	}

}