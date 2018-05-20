<?php

namespace App\Http\Controllers\Admin;

use App\Model\BaiViet;
use App\Model\ChuDe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function Reload($id)
    {
        $dsbaiviet = BaiViet::where('chudeid', '=', $id)->orderBy('id', 'desc')->get();
        return response(json_encode($dsbaiviet));
    }

    public function Index($idchude)
    {
        $chude = ChuDe::find($idchude);
        $dsbaiviet1 = BaiViet::where('chudeid', '=', $idchude)->orderBy('created_at', 'desc')->get();
        $dsbaiviet = json_encode($dsbaiviet1);
        return view('backend/baiviet/danhsach', compact(['dsbaiviet', 'idchude', 'chude']));
    }

    public function Create($idchude)
    {
        return view('backend/baiviet/_createModal', compact('idchude'));
    }

    public function Store(Request $request)
    {
        $mss = new Message(true, "Thêm mới bài viết thành công");
        if($request->ajax())
        {
            $baiviet = new BaiViet;
            $baiviet->tenbaiviet = $request->get('tenbaiviet');
            $baiviet->tomtat = $request->get('tomtat');
            $baiviet->noidung = $request->get('noidung');
            $baiviet->hienthi = $request->get('hienthi') == 1 ? 1 : 0;
            $baiviet->slug = changeTitle($request->input('tenbaiviet'));
            $baiviet->keyword = $request->input('keyword');
            $baiviet->description = $request->input('description');
            $baiviet->chudeid = $request->get('idchude');
            $baiviet->ghim = $request->input('ghim') == 1 ? 1 : 0;

            if($request->hasFile('hinhanh'))
            {

                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    return response(json_encode($mss));
                }
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_". changeTitle($name).'.'. $duoi;
                while(file_exists("upload/hinhanh/".$Hinh))
                {
                    $Hinh = str_random(4)."_". $name;
                }
                $file->move("upload/hinhanh", $Hinh);
                $baiviet->hinhanh = $Hinh;
                $album = DB::table('Album')->insert([
                    'hinhanh' => $Hinh,
                    'mota' => $baiviet->tenbaiviet
                ]);
            }
            else
            {
                $baiviet->hinhanh = "notfoundimg.png";
            }
            try {
                $baiviet->save();

            } catch (Exception $e) {
                $mss->status = false;
                $mss->message = "Lỗi. Thêm mới thất bại";
            }

            return response(json_encode($mss));
        }
    }

    public function Edit($id)
    {
        $baiviet = BaiViet::find($id);
        return view('backend/baiviet/_editModal', compact('baiviet'));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, "Cập nhật bài viết thành công");
        if($request->ajax())
        {
            $baiviet = BaiViet::find($request->get('id'));
            $baiviet->tenbaiviet = $request->get('tenbaiviet');
            $baiviet->tomtat = $request->get('tomtat');
            $baiviet->noidung = $request->get('noidung');
            $baiviet->hienthi = $request->get('hienthi') == 1 ? 1 : 0;
            $baiviet->keyword = $request->input('keyword');
            $baiviet->description = $request->input('description');
            $baiviet->slug = changeTitle($request->input('tenbaiviet'));
            $baiviet->ghim = $request->input('ghim') == 1 ? 1 : 0;

            if($request->hasFile('hinhanh'))
            {

                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    return response(json_encode($mss));
                }
                //$file = '.'. $file;
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_". changeTitle($name);
                while(file_exists("upload/hinhanh/".$Hinh))
                {
                    $Hinh = str_random(4)."_". $name;
                }
                $file->move("upload/hinhanh", $Hinh);
                $baiviet->hinhanh = $Hinh;
                $album = DB::table('Album')->insert([
                    'hinhanh' => $Hinh,
                    'mota' => $baiviet->tenbaiviet
                ]);
            }
            try {
                $baiviet->save();
            } catch (Exception $e) {
                $mss->status = false;
                $mss->message = "Lỗi. Cập nhật thất bại";
            }

            return response(json_encode($mss));
        }
    }

    public function Destroy($id)
    {
        //$baiviet = BaiViet::find($id);
        BaiViet::destroy($id);
        $mss = new Message(true, 'Xoá thành công');
        return response(json_encode($mss));
    }
}
