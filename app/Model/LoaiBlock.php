<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BlockContent;

class LoaiBlock extends Model
{
    protected $table = "LoaiBlock";

    public function BlockContent()
    {
        return $this->hasMany(BlockContent::class, 'loaiblockid', 'id');
    }
}
