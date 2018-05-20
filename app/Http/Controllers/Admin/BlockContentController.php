<?php

namespace App\Http\Controllers\Admin;

use App\Model\ChuDe;
use App\Model\HinhAnh;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BlockContent;
use App\Model\Message;
use Mockery\Exception;
use App\Model\LoaiBlock;
use Illuminate\Support\Facades\DB;

class BlockContentController extends Controller
{
    public function Index($idduan)
    {
        $dsblockcontent1 = DB::table('BlockContent')->join('LoaiBlock', 'BlockContent.loaiblockid', '=', 'LoaiBlock.id')
            ->select('BlockContent.*', 'LoaiBlock.ten')
            ->where('chudeid', '=', $idduan)->get();
        $dsblockcontent = json_encode($dsblockcontent1);
        $duan = ChuDe::find($idduan);
        return view('backend/blockcontent/danhsach', compact(['idduan', 'dsblockcontent', 'duan']));
    }

    public function Reload($idduan)
    {
        $dsblockcontent1 = DB::table('BlockContent')->join('LoaiBlock', 'BlockContent.loaiblockid', '=', 'LoaiBlock.id')
            ->select('BlockContent.*', 'LoaiBlock.ten')
            ->where('chudeid', '=', $idduan)->get();
        $dsblockcontent = json_encode($dsblockcontent1);
        return response($dsblockcontent);
    }

    public function Show($id)
    {
        $block = BlockContent::find($id);
        $dshinhanh = HinhAnh::where('blockid', $id)->get();
        return view('backend/blockcontent/_showBlockContent', compact(['block', 'dshinhanh']));
    }

    public function Edit($id)
    {
        $blockcontent = BlockContent::find($id);
        return view('backend/blockcontent/_editModal', compact('blockcontent'));
    }

    public function Update(Request $request)
    {
        $mss = new Message(true, 'Cập nhật thành công');
        try {
        if($request->ajax())
        {
            $blockcontent = BlockContent::find($request->get('id'));
            $blockcontent->tenblock = $request->get('tenblock');
            $blockcontent->tomtat = $request->get('tomtat');
            $blockcontent->noidung = $request->get('noidung');
            $blockcontent->hienthi = $request->get('hienthi') == 1 ? 1 : 0;
            $blockcontent->save();
        }
        }
        catch (Exception $e)
        {
            $mss->status = false;
            $mss->message = "Lỗi. Cập nhật thất bại";
        }
        return response(json_encode($mss));
    }
}
