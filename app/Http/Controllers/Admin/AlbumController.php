<?php

namespace App\Http\Controllers\Admin;

use App\Model\ChuDe;
use App\Model\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Album;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class AlbumController extends Controller
{
    public function Reload()
    {
        $dsalbum = Album::orderBy('id', 'desc')->get();
        return response(json_encode($dsalbum));
    }

    public function Index()
    {
        $dsalbum = json_encode(Album::orderBy('id', 'desc')->get());
        return view('backend/album/danhsach', compact('dsalbum'));
    }

    public function Import()
    {
        return view('backend/album/_importModal');
    }

    public function Save(Request $request)
    {
        $mss = new Message(true, "Thêm thành công");
        if($request->ajax())
        {
            $album = new Album;
            $mota = $request->input('mota');
            if($request->hasFile('duongdan'))
            {
                $file = $request->file('duongdan');
                $duoi = $file->getClientOriginalExtension();
                $name = chop($file->getClientOriginalName(),('.'.$duoi));
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    $mss->status = false;
                    $mss->message = "Sai định dạng ảnh";
                    return response(json_encode($mss));
                }
                $name = str_random(4). changeTitle($name).'.'. $duoi;
                try {
                    $album->mota = $mota;
                    $album->hinhanh = $name;
                    $album->save();
                    $file->move('upload/hinhanh/', $name);
                }
                catch (Exception $e)
                {
                    $mss->status = false;
                    $mss->message = "Thêm thất bại";
                    $album->delete();
                }
            }
            return response(json_encode($mss));
        }
    }

    public function Create()
    {
        return view('backend/album/_createModal');
    }

    public function Store(Request $request)
    {
        $mss = new Message(true, 'Thêm mới thành công');

            $url = $request->get('duongdan');
            $mota = $request->get('mota');
            $extension = pathinfo($url, PATHINFO_EXTENSION);

            $filename = str_random(4).'-'.str_slug($mota).'.'. $extension;

            $file = file_get_contents($url);
            $save = file_put_contents('upload/hinhanh/'.$filename, $file);
            if($save){
                try {
                    $album = DB::table('Album')->insert([
                        'hinhanh' => $filename,
                        'mota' => $mota
                    ]);
                    //var_dump('file downloaded to images folder and saved to database as well.......');
                } catch (Exception $e) {
                    //delete if no db things........

                    $mss->status = false;
                    $mss->message = "Lỗi. Thêm thất bại";
                }
            }
//        return response(json_encode($mss));
        return response(json_encode($mss));
    }

    public function Show($id)
    {
        $album = Album::findOrFail($id);
        return view('backend/album/_viewModal', compact('album'));
    }

    public function Edit($id)
    {
        $album = Album::findOrFail($id);
        return view('backend/album/_editModal', compact('album'));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, 'Cập nhật thành công');
        if ($request->ajax())
        {
            $album = Album::find($request->get('id'));
            $album->mota = $request->get('mota');
            try {
            $album->save();
            }
            catch (Exception $e)
            {
                $mss->status = false;
                $mss->message = "Lỗi. Cập nhật thất bại";
            }
        }
        return response(json_encode($mss));
    }

//    public function Destroy($id)
//    {
//        // Xoá hình ảnh
//        $album = Album::find($id);
//        $album->delete();
//        // Xoá dữ liệu
//        Album::destroy($id);
//        $mss = new Message(true, 'Xoá thành công');
//        return response(json_encode($mss));
//    }
}
