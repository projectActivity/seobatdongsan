<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BaiViet;
use App\Model\ChuDe;
class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $dsbaiviet = BaiViet::orderBy('id', 'desc')->get();
        $baiViet =  BaiViet::find($id);
        $dsBVChuDe = BaiViet::where('chudeid', $baiViet->chudeid)->get();
        return view('frontEnd/baiviet/index',compact(['baiViet', 'dsBVChuDe', 'dsbaiviet']));
    }
}
