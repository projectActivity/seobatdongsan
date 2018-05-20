<?php

namespace App\Http\Controllers\Admin;

use App\Model\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Banner;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function Reload()
    {
        $dsbanner = Banner::orderBy('id', 'desc')->get();
        return response(json_encode($dsbanner));
    }

    public function Index()
    {
        $dsbanner_model = Banner::orderBy('id', 'desc')->get();
        $dsbanner = json_encode($dsbanner_model);
        return view('backend/banner/danhsach', compact('dsbanner'));
    }

    public function Create()
    {
        return view('backend/banner/_createModal');
    }

    public function Store(Request $request)
    {
        $mss = new Message(true, "Thêm mới thành công");
        if($request->ajax())
        {
            $banner = new Banner;
            $banner->tenbanner = $request->get('tenbanner');
            $banner->vitri = $request->get('vitri');
            $banner->hienthi = $request->get('hienthi') == 1 ? 1 : 0;
            $banner->lienket = "Trống";
            if($request->hasFile('hinhanh'))
            {
                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    return response(json_encode($mss));
                }
//                $name = str_replace(('.'. $file), "xxx", $file->getClientOriginalName());
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_". changeTitle($name).'.'. $duoi;
                while(file_exists("upload/hinhanh/".$Hinh))
                {
                    $Hinh = str_random(4)."_". $name;
                }
                $file->move("upload/hinhanh", $Hinh);
                $banner->hinhanh = $Hinh;
                $album = DB::table('Album')->insert([
                    'hinhanh' => $Hinh,
                    'mota' => $banner->tenbanner
                ]);
            }
            else
            {
                $banner->hinhanh = "notfoundimg.png";
            }
            try {
                $banner->save();

            } catch (Exception $e) {
                $mss->status = false;
                $mss->message = "Lỗi. Thêm mới thất bại";
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
        $banner = Banner::find($id);
        return view('backend/banner/_editModal', compact('banner'));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, "Cập nhật thành công");
        if($request->ajax())
        {
            $banner = Banner::find($request->get('id'));
            $banner->tenbanner = $request->get('tenbanner');
            $banner->vitri = $request->get('vitri');
            $banner->hienthi = $request->get('hienthi') == 1 ? 1 : 0;
            $banner->lienket = "Trống";
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
                $banner->hinhanh = $Hinh;
                $album = DB::table('Album')->insert([
                    'hinhanh' => $Hinh,
                    'mota' => $banner->tenbanner
                ]);
            }

            try {
                $banner->save();

            } catch (Exception $e) {
                $mss->status = false;
                $mss->message = "Lỗi. Cập nhật thất bại";
            }
        }
        return response(json_encode($mss));
    }

    public function Destroy($id)
    {
        Banner::destroy($id);
        $mss = new Message(true, "Xoá thành công");
        return response(json_encode($mss));
    }
}
