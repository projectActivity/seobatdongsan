<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ghim extends Model
{
    protected $table = "Ghim";

    public function BaiViet()
    {
        return $this->hasOne(BaiViet::class, 'baivietid', 'id');
    }
}
