<?php namespace Selmonal\Imagemanager;

interface ImageRepositoryInterface {

	public function paginate( $limit, $offset );

	public function insert( $data );

}