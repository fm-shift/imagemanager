<?php namespace Selmonal\Imagemanager;

use Illuminate\Database\Eloquent\Model;

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
			"thumb"   => "/assets/images/thumb/" . $this->path
		);
	}
	
}