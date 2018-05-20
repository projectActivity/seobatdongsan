<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaiLieuDuAn extends Model
{
    protected $table = "TaiLieuDuAn";

    protected $dates = ['updated_at'];

    public function delete()
    {
        if(file_exists('upload/tailieu/'.$this->url)){
            @unlink('upload/tailieu/'.$this->url);
        }
        parent::delete();
    }
}
