<?php

namespace App\Repositories\Album;

use App\Repositories\EloquentRepository;
use App\Repositories\Album\AlbumRepositoryInterface;

class AlbumEloquentRepository extends EloquentRepository implements AlbumRepositoryInterface
{
	/**
	 * get model
	 * @return string
	 */
	public function getModel()
	{
		return \App\Model\Album::class;
	}

	/**
	 * Get all album
	 * @return mixed
	 */
	public function getAll($id = null, $mota = null, $created_at = null, $updated_at = null)
	{
		$query = $this->_model->select('id', 'hinhanh', 'mota', 'created_at', 'updated_at');
		if ($id) {
			$query->orderBy('id', 'desc');
		}
		if ($mota) {
			$query->orderBy('mota', 'asc');
		}
		if ($created_at) {
			$query->orderBy('created_at', 'desc');
		}
		if ($updated_at) {
			$query->orderBy('updated_at', 'desc');
		}
		return $query->get();
	}
}
