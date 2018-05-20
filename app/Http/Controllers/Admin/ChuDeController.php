<?php

namespace App\Http\Controllers\Admin;

use App\Model\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\ChuDe;
use App\Model\Message;
use App\Model\LoaiBlock;
use App\Model\BlockContent;

class ChuDeController extends Controller
{
    public function Search(Request $request)
    {
        $tukhoa = $request->get('tukhoa');
        $loai = $request->get('loai');
        $chude = ChuDe::where('id', '>', 0);
        if($loai != -1)
        {
            $chude = $chude->where('duan', $loai);
        }
        if (!empty($tukhoa)) {
            $chude = $chude->where('tenchude', 'like', '%'.$tukhoa.'%');
            # code...
        }
        return response(json_encode($chude->orderBy('id', 'desc')->get()));
    }

    public function Index()
    {
        $dschude6 = ChuDe::orderBy('id', 'desc')->get();
        $dschude = json_encode($dschude6);
        return view('backend/chude/index', compact('dschude'));
    }
    public function Reload()
    {
        $dschude = ChuDe::orderBy('id', 'desc')->get();
        return response(json_encode($dschude));
    }

    public function Create()
    {
        return view("backend/chude/_createModal");
    }
    public function Store(Request $request)
    {
        $mss = new Message(true, 'Thêm mới chủ đề thành công');
        if($request->ajax())
        {
            $tenchude = $request->get('tenchude');
            $tomtat = $request->get('tomtat');
            $duan = $request->get('loai');
            $noibat = $request->get('noibat') == 1 ? 1 : 0;
            $trongtam = $request->get('trongtam') == 1 ? 1 : 0;
            $tenthuongmai = $request->input('tenthuongmai');
            $description = $request->input('description');
            $keyword = $request->input('keyword');

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
                $file->move("upload/hinhanh/", $Hinh);
                $hinhanh = $Hinh;
            }
            else
            {
                $hinhanh = "notfoundimg.png";
            }
            try {
                if ($trongtam == 1 && $duan == 1)
                {
                    DB::table('ChuDe')
                        ->update(['trongtam' => 0]);
                }
                $idchude = DB::table('ChuDe')->insertGetId(
                    [
                        'tenthuongmai' => $tenthuongmai,
                        'tenchude' => $tenchude,
                        'tomtat' => $tomtat,
                        'duan' => $duan,
                        'hinhanh' => $hinhanh,
                        'noibat' => $noibat,
                        'trongtam' => $trongtam,
                        'description' => $description,
                        'keyword' => $keyword
                    ]
                );
                $album = DB::table('Album')->insert([
                    'hinhanh' => $hinhanh,
                    'mota' => $tenchude
                ]);
                if ($duan == 1)
                {
                    $dsloaiblock = LoaiBlock::all();
                    foreach($dsloaiblock as $loaiblock)
                    {
                        $block = new BlockContent;
                        $block->chudeid = $idchude;
                        $block->tenblock = " ";
                        $block->tomtat = " ";
                        $block->noidung = " ";
                        $block->subtitle = changeTitle($loaiblock->ten);
                        $block->loaiblockid = $loaiblock->id;
                        $block->hienthi = 1;
                        $block->save();
                    }
                }

            }
            catch (Exception $e) {
                $mss->status = false;
                $mss->message = "Lỗi. Thêm mới thất bại";
            }

            return response(json_encode($mss));
        }
    }

    public function Edit($id)
    {
        $chude = ChuDe::find($id);
        return view('backend/chude/_editModal', compact('chude'));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, 'Cập nhật chủ đề thành công');
        if($request->ajax())
        {
            $id = $request->get('id');
            $chude = ChuDe::find($id);
            $chude->tenchude = ucwords($request->get('tenchude'), " ");
            $chude->tomtat = $request->get('tomtat');
            $chude->noibat = $request->get('noibat') == 1 ? 1 : 0;
            $chude->trongtam = $request->get('trongtam') == 1 ? 1 : 0;
            $chude->keyword = $request->get('keyword');
            $chude->description = $request->get('description');
            if ($chude->trongtam == 1 && $chude->duan == 1)
            {
                DB::table('ChuDe')
                    ->where('id', '!=', $id)
                    ->update(['trongtam' => 0]);
            }
            $chude->tenthuongmai = ucwords($request->input('tenthuongmai'), " ");

            if($request->hasFile('hinhanh'))
            {
                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    $mss = new Message('Loi', 'Sai dinh dang anh');
                    return response()->json($mss);
                }

                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_". $name;
                while(file_exists("upload/hinhanh/".$Hinh))
                {
                    $Hinh = str_random(4)."_". $name;
                }
//                $album = Album::   Khi cập nhật có sựa thây đổi về hình ảnh thì xoá hình ảnh cũ đi
                $file->move("upload/hinhanh", $Hinh);
                $chude->hinhanh = $Hinh;
                $album = DB::table('Album')->insert([
                    'hinhanh' => $Hinh,
                    'mota' => $chude->tenchude
                ]);
            }

            try {
                $chude->save();
            } catch (Exception $e){
                $mss->status = false;
                $mss->message = "Không lưu được dữ liệu";

            }

            return response(json_encode($mss));
            // return response($request->all());
        }
    }

    public function Destroy($id)
    {
        $chude = Chude::find($id);
        Chude::destroy($id);
        $mss = new Message(true, "Xóa chủ đề thành công" );
        return response(json_encode($mss));
    }
}
