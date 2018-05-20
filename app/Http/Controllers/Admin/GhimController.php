<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BaiViet;
use App\Model\Ghim;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class GhimController extends Controller
{
    public function Reload()
    {
        $dsghim =  DB::table('Ghim')
            ->join('BaiViet', 'Ghim.baivietid', '=', 'BaiViet.id')
            ->select('Ghim.*', 'BaiViet.tenbaiviet')
            ->orderBy('id', 'desc')
            ->get();
        return response(json_encode($dsghim));
    }

    public function Index()
    {
        $dsghim = json_encode(DB::table('Ghim')
            ->join('BaiViet', 'Ghim.baivietid', '=', 'BaiViet.id')
            ->select('Ghim.*', 'BaiViet.tenbaiviet')
            ->orderBy('id', 'desc')
            ->get());
        return view('backend/ghim/danhsach', compact('dsghim'));
    }

    public function Create()
    {
        $dsbaighim = BaiViet::where('ghim', 1)->orderBy('id', 'desc')->get();
        return view('backend/ghim/_createModal', compact('dsbaighim'));
    }

    public function Store(Request $request)
    {
        $mss = new Message(true, 'Thêm thành công');
        $ghim = new Ghim;
        $ghim->baivietid = $request->input('baiviet');
        $ghim->url = $request->input('url');
        $ghim->trangthai = $request->input('trangthai') == 1 ? 1 : 0;
        $ghim->tenbaighim = $request->input('tenbaighim');
//        if (empty($tenbaighim))
//        {
//            $baiviet = BaiViet::find('id', $ghim->baivietid);
//            $ghim->tenbaighim = $baiviet->tenbaiviet;
//        }
        try {
            $ghim->save();
        } catch(Exception $e) {
            $mss->status = false;
            $mss->message = "Lỗi. Thêm thất bại";
        }
        return response(json_encode($mss));
    }

    public function Edit($id)
    {
        $dsbaighim = BaiViet::where('ghim', 1)->orderBy('id', 'desc')->get();
        $ghim = Ghim::find($id);
        return view('backend/ghim/_editModal', compact(['dsbaighim', 'ghim']));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, 'Thêm thành công');
        $ghim = Ghim::find($request->input('id'));
        $ghim->url = $request->input('url');
        $ghim->trangthai = $request->input('trangthai') == 1 ? 1 : 0;
        $ghim->tenbaighim = $request->input('tenbaighim');

        try {
            $ghim->save();
        } catch(Exception $e) {
            $mss->status = false;
            $mss->message = "Lỗi. Thêm thất bại";
        }
        return response(json_encode($mss));
    }

    public function Destroy($id)
    {
        Ghim::destroy($id);
        $mss = new Message(true, 'Xoá thành công');
        return response(json_encode($mss));
    }
}
