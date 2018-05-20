<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Http\Controllers\Controller;
use App\TaiLieuDuAn;
use App\Model\Message;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

class TaiLieuController extends Controller
{
    public function Reload($idduan)
    {
        $dstailieu = json_encode(TaiLieuDuAn::where('chudeid', $idduan)->orderBy('id', 'desc')->get());
        return response($dstailieu);
    }

    public function Index($idduan)
    {
        $dstailieu = json_encode(TaiLieuDuAn::where('chudeid', $idduan)->orderBy('id', 'desc')->get());
        return view('backend/tailieu/danhsach', compact('dstailieu', 'idduan'));
    }

    public function Create($idduan)
    {
        return view('backend/tailieu/_createModal', compact('idduan'));
    }

    public function Store(Request $request)
    {
        $mss = new Message(true, 'Thêm mới thành công');
        if ($request->hasFile('tailieu'))
        {
            $tentailieu = $request->input('tentailieu');
            $file = $request->file('tailieu');
            $extension = $request->tailieu->extension();
            $url = str_random(4). changeTitle($tentailieu).'.'. $extension;

            try {
                $tailieu = new TaiLieuDuAn;
                $tailieu->chudeid = $request->input('idduan');
                $tailieu->tentailieu = $tentailieu;
                $tailieu->url = $url;
                $tailieu->save();
                $file->move('upload/tailieu', $tailieu->url);
            } catch (Exception $e) {
                $mss->status = false;
                $mss->message = "Thêm thất bại";
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
        $tailieu = TaiLieuDuAn::find($id);
        return view('backend/tailieu/_editModal', compact('tailieu'));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, 'Cập nhật thành công');

        $id = $request->input('id');
        $tentailieu = $request->input('tentailieu');
        $url = str_random(4). changeTitle($tentailieu);

        try {
            $tailieu = TaiLieuDuAn::find($id);
            $tailieu->tentailieu = $tentailieu;
            $e = $tailieu->url;
            $extension = substr($e, strpos($e, '.' ));
            $tailieu->url = $url . $extension;
            // Đổi tên file Old ---> New
            Storage::move(('upload/tailieu/'.$e), ('upload/tailieu/'.$tailieu->url));
            $tailieu->save();

        } catch (Exception $e) {
            $mss->status = false;
            $mss->message = "Cập nhật thất bại";
        }
        return response(json_encode($mss));
    }

    public function Destroy($id)
    {
        $tailieu = TaiLieuDuAn::find($id);
        $tailieu->delete();
        TaiLieuDuAn::destroy($id);
        $mss = new Message(true, 'Xoá thành công');
        return response(json_encode($mss));
    }
}
