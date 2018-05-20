<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Repository implements RepositoryInterface 
{
	private $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function all()
	{
		return $this->model->all();
	}

	public function create(array $data)
	{
		$data = $this->addTimestamps($data);
		DB::table(''. $this->getNameTable() .'')->insert($data);
		// return $this->model->create($data);
	}

	public function update(array $data, $id)
	{
		DB::table(''. $this->getNameTable() .'')
			->where('id', $id)
			->update($data);
	}

	public function delete($id) 
	{
		return $this->model->destroy($id);
	}

	public function show($id)
	{
		return $this->model->findOrFail($id);
	}

	public function setModel($model)
	{
		$this->model = $model;
		return $this;
	}

	public function with($relations)
	{
		return $this->model->with($relations);
	}

	private function getNameTable()
	{
		return $this->model->getTable();
	}

	private function addTimestamps(array $data)
	{
		$createdDate = Carbon::now();
		return $data += array(
			'created_at' => $createdDate,
			'updated_at' => $createdDate
		);
	}

}