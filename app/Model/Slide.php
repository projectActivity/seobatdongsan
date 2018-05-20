<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = "Slide";

    protected $dates = ['ngaybatdau', 'ngayketthuc'];

    public function delete()
    {
        if(file_exists('upload/slide/'.$this->hinhanh)){
            @unlink('upload/slide/'.$this->hinhanh);
        }
        parent::delete();
    }
}
