<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Slide;
use App\Model\Message;
use Carbon\Carbon;

class SlideController extends Controller
{
    public function Reload()
    {
        $dsslide = Slide::orderBy('id', 'desc')->get();
        return response(json_encode($dsslide));
    }

    public function Index()
    {
        $dsslide = json_encode(Slide::orderBy('id', 'desc')->get());
        return view('backend/slide/danhsach', compact('dsslide'));
    }

    public function Create()
    {
        return view('backend/slide/_createModal');
    }

    public function Store(Request $request)
    {
        $mss = new Message(true, "Thêm thành công");
        if($request->ajax())
        {
            $slide = new Slide;
            $ngaybatdau = strtotime($request->get('ngaybatdau'));
            $ngayketthuc = strtotime($request->get('ngayketthuc'));
            $slide->ngaybatdau = date('Y-m-d', $ngaybatdau);
            $slide->ngayketthuc = date('Y-m-d', $ngayketthuc);

            $slide->hienthi = $request->get('hienthi') == 1 ? 1 : 0;
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
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_". changeTitle($name).'.'. $duoi;
                while(file_exists("upload/slide/".$Hinh))
                {
                    $Hinh = str_random(4)."_". $name;
                }
                $file->move("upload/slide", $Hinh);
                $slide->hinhanh = $Hinh;
            }
            try {
                $slide->save();
            }
            catch (Exception $e)
            {
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
        $slide = Slide::find($id);
        return view('backend/slide/_editModal', compact('slide'));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, "Cập nhật thành công");
        if($request->ajax())
        {
            $slide = Slide::find($request->get('id'));
            $ngaybatdau = strtotime($request->get('ngaybatdau'));
            $ngayketthuc = strtotime($request->get('ngayketthuc'));
            $slide->ngaybatdau = date('Y-m-d', $ngaybatdau);
            $slide->ngayketthuc = date('Y-m-d', $ngayketthuc);
            $slide->hienthi = $request->get('hienthi') == 1 ? 1 : 0;
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
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_". changeTitle($name).'.'. $duoi;
                while(file_exists("upload/slide/".$Hinh))
                {
                    $Hinh = str_random(4)."_". $name;
                }
                $file->move("upload/slide", $Hinh);
                $slide->delete();
                $slide->hinhanh = $Hinh;
            }
            try {
                $slide->save();
            }
            catch (Exception $e)
            {
                $mss->status = false;
                $mss->message = "Cập nhật thất bại";
            }
        }
        return response(json_encode($mss));
    }

    public function Destroy($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        Slide::destroy($id);
        $mss = new Message(true, 'Xoá thành công');
        return response(json_encode($mss));
    }
}
