<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BaiViet;
use App\Model\TaiLieuDuAn;
use App\Model\BlockContent;

class ChuDe extends Model
{
    protected $table = "ChuDe";

    public function BaiViet()
    {
        return $this->hasMany(BaiViet::class, 'chudeid', 'id');
    }

    public function TaiLieuDuAn()
    {
        return $this->hasMany(TaiLieuDuAn::class, 'chudeid', 'id');
    }

    public function BlockContent()
    {
        return $this->hasMany(BlockContent::class, 'chudeid', 'id');
    }
}
