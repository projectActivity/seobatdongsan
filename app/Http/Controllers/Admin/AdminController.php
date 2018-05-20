<?php

namespace App\Http\Controllers\Admin;

use App\Model\ChuDe;
use App\Model\LienHe;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function Index()
    {
        $chude = ChuDe::where('duan', 0)->count();
        $duan = ChuDe::where('duan', 1)->count();
        $lienhe = LienHe::count();
        $nguoidung = User::count();
        $dslienhe = LienHe::orderBy('id', 'desc')->get();
    	return view('backend/index', compact(['chude', 'duan', 'lienhe', 'nguoidung', 'dslienhe']));
    }
}
