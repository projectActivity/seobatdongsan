<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ChuDe;

class BaiViet extends Model
{
    protected $table = "BaiViet";

    public function ChuDe()
    {
        return $this->belongsTo(ChuDe::class, 'chudeid', 'id');
    }

    public function Ghim()
    {
        return $this->belongsTo(Ghim::class, 'baivietid', 'id');
    }
}
