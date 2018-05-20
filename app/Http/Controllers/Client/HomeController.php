<?php

namespace App\Http\Controllers\Client;

use App\Model\BaiViet;
use App\Model\ChuDe;
use App\Model\Ghim;
use App\Model\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LienHe;
use App\Model\Slide;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function Index()
    {
        $date = date("Y-m-d");
        $dsslide = Slide::where('hienthi', 1)->get();
        foreach($dsslide as $key => $slide)
        {
            if(strtotime($slide->ngayketthuc) < strtotime($date))
            {
                unset($dsslide[$key]);
            }

            if(strtotime($slide->ngaybatdau) > strtotime($date))
            {
                unset($dsslide[$key]);
            }
        }
        $baivietmoinhat = BaiViet::orderBy('id', 'desc')->first()->get();
        $dsbaiviet = BaiViet::where('ghim', '!=', 1)->orderBy('id', 'desc')->take(4)->get();
        $dsbaighim = Ghim::orderBy('id', 'desc')->take(2)->get();
        $dsduan = ChuDe::where('duan', 1)->orderBy('id', 'desc')->take(4)->get();
        $duantrongtam = ChuDe::where('trongtam', 1)->get();
        $dshinhanh = DB::table('HinhAnhBlock')
            ->join('BlockContent', 'HinhAnhBlock.blockid', '=', 'BlockContent.id')
            ->join('ChuDe', 'BlockContent.chudeid', '=', 'ChuDe.id')
            ->where('ChuDe.id', '=', $duantrongtam[0]->id)
            ->select('HinhAnhBlock.*')
            ->orderBy('id', 'desc')
            ->get();
        return view('frontEnd/home/index', compact(['dsslide', 'baivietmoinhat', 'dsbaiviet', 'dsduan', 'duantrongtam', 'dsbaighim', 'dshinhanh']));
    }

    public function Email(Request $request)
    {
        $mss = new Message(true, "Đăng ký thành công");
        $lienhe = new LienHe;

        $lienhe->hoten = $request->input('hoten');
        $lienhe->email = $request->input('email');
        $lienhe->dienthoai = $request->input('sodienthoai');

        try {
        $lienhe->save();
        } catch (Exception $e)
        {
            $mss->status = false;
            $mss->message = "Bạn ";
        }

        return redirect('/home')->with(json_encode($mss));
    }
//    public function Email(Request $request)
//    {
//        $mss = new Message(true, "Đăng ký thành công");
//        $lienhe = new LienHe;
//        if($request->ajax())
//        {
//            $lienhe->hoten = $request->input('hoten');
//            $lienhe->email = $request->input('email');
//            $lienhe->dienthoai = $request->input('sodienthoai');
//
//            try {
//                $lienhe->save();
//            } catch (Exception $e)
//            {
//                $mss->status = false;
//                $mss->message = "Lỗi. Bạn vui lòng kiểm tra lại thông tin";
//            }
//        }
//        return response(json_encode($mss));
//    }
}
