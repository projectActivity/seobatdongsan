<?php

namespace App\Http\Controllers\Admin;

use App\Model\LienHe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message;


class LienHeController extends Controller
{
    public function Reload()
    {
        $dslienhe = LienHe::orderBy('id', 'desc')->get();
        return response(json_encode($dslienhe));
    }

    public function Index()
    {
        $dslienhe = json_encode(LienHe::orderBy('id', 'desc')->get());
        return view('backend/lienhe/danhsach', compact('dslienhe'));
    }

    public function Destroy($id)
    {
        LienHe::destroy($id);
        $mss = new Message(true, 'Xoá thành công');
        return response(json_encode($mss));
    }
}
