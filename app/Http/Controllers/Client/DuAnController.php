<?php

namespace App\Http\Controllers\Client;

use App\Model\HinhAnh;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ChuDe;
use App\Model\Slide;

class DuAnController extends Controller
{
    public function Home()
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
        $dsduan = ChuDe::where('duan', 1)->get();
        return view('frontEnd/duan/home', compact(['dsslide', 'dsduan']));
    }


    public function Index($id)
    {
        $duan = ChuDe::find($id);
        return view('frontEnd/duan/index',compact('duan'));
    }


}
