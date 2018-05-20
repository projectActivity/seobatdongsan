<?php

namespace App\Repositories\Album;

interface AlbumRepositoryInterface
{
	/**
	 * Get all album sort by id, mota, crated_at, updated_at
	 * @param  $id bool
	 * @param  $mota bool
	 * @param  $created_at bool
	 * @param  $updated_at bool
	 * @return mixed
	 */
	public function getAll($id = null, $mota = null);
}
