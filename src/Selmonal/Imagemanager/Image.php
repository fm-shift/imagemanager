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
	protected $fillable = array( "name", "folder", "extension" );

}