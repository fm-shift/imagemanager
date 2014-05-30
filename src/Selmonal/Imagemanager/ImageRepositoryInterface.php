<?php namespace Selmonal\Imagemanager;

interface ImageRepositoryInterface {

	public function paginate( $limit, array $options = array() );

	public function insert( $data );

}