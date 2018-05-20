<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message;
use App\Model\HinhAnh;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

class HinhAnhController extends Controller
{
    public function Reload($idblock)
    {
        $dshinhanh = HinhAnh::where('blockid', $idblock)
            ->orderBy('id', 'desc')
            ->get();
        return response(json_encode($dshinhanh));
    }

//    public function Index($idblock)
//    {
//        $dshinhanh = HinhAnh::where('blockid', $idblock)->get();
//        return view();
//    }

    public function Create($idblock)
    {
        return view('backend/hinhanh/_createModal', compact('idblock'));
    }

    public function Store(Request $request)
    {
        $mss = new Message(true, "Thêm thành công");
        if($request->ajax())
        {
            $hinhanh = new HinhAnh;
            $hinhanh->mota = $request->get('mota');
            $hinhanh->blockid = $request->get('id');
            if($request->hasFile('hinhanh'))
            {
                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    $mss->status = false;
                    $mss->message = "Sai định dạng ảnh";
                    return response(json_encode($mss));
                }
                $hinhanh->url = $file->getClientOriginalName();
            }
            try {
                $hinhanh->save();
            }
            catch (Exception $e)
            {
                $mss->status = false;
                $mss->message = "Lỗi. Thêm thất bại";
            }
        }
        return response(json_encode($mss));
    }

    public function Show($id)
    {
        //
    }

    public function Edit($id)
    {
        $hinhanh = HinhAnh::find($id);
        return view('backend/hinhanh/_editModal', compact('hinhanh'));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, "Cập nhật thành công");
        if($request->ajax())
        {
            $hinhanh = HinhAnh::find($request->get('id'));
            $hinhanh->mota = $request->get('mota');
            try {
                $hinhanh->save();
            }
            catch (Exception $e)
            {
                $mss->status = false;
                $mss->message = "Lỗi. Cập nhật thất bại";
            }
        }
        return response(json_encode($mss));
    }

    public function Destroy($id)
    {
        HinhAnh::destroy($id);
        $mss = new Message(true, "Xoá thành công");
        return response(json_encode($mss));
    }
}
