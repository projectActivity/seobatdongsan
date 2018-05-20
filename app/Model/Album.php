<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = "Album";

    public function delete()
    {
        if(file_exists('upload/hinhanh/'.$this->hinhanh)){
            @unlink('upload/hinhanh/'.$this->hinhanh);
        }
        parent::delete();
    }
}
