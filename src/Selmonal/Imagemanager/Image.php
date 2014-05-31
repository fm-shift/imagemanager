<?php namespace Selmonal\Imagemanager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Image extends Model {

	/**
	 * Database table name
	 * 
	 * @var string
	 */
	protected $table = "images";

	/**
	 * The fillable fields
	 * 
	 * @var array
	 */
	protected $fillable = array( "caption", "path", "extension" );

	/**
	 * For response data
	 * 
	 * @return array
	 */
	public function forResponse()
	{
		return array(

			"path"    => $this->path,
			"thumb"   => Config::get("imagemanager::config.basePath") . "thumb/" . $this->path
		);
	}
	
}