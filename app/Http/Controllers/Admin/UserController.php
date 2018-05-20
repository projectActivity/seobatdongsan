<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Message;
use Mockery\Exception;


class UserController extends Controller
{
    public function Index()
    {
        $id = Auth::User()->id;
        $dsnguoidung = User::where('id', '!=', $id)->orderBy('id', 'desc')->get();
        return view('backend/taikhoan/index', compact('dsnguoidung'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function Reload()
    {
        $id = Auth::User()->id;
        $dsnguoidung = User::where('id', '!=', $id)->orderby("id","desc")->get();
        return response(json_encode($dsnguoidung));
    }
    public function Create()
    {
        return view('backend/taikhoan/_createModal');
    }

    public function Edit($id)
    {
        $obj = User::find($id);
        return view('backend/taikhoan/_editModal',compact('obj'));
    }

    public function SaveEdit(Request $request)
    {
        $rs = new Message(true);
        try{
            $id= $request->get('id');
            $obj = User::find($id);
            $obj->name=$request->get("taiKhoan");
            $obj->save();
        }catch (Exception $e)
        {
            $rs->status=false;
            $rs->message="Không lưu được người dùng";
        }
        return response(json_encode($rs));
    }
    public function Delete($id)
    {
        $obj=User::find($id);
        return view('backend/taikhoan/_deleteModal',compact('obj'));
    }
    public function Remove(Request $request)
    {
        $rs = new Message(true);
        try{
            if (Auth::User()->id != $request->id)
            {
                User::destroy($request->id);
            } else {
                $rs->status = false;
                $rs->message = "Bạn không thể xoá.";
            }
        }catch (Exception $e)
        {
            $rs->status=false;
            $rs->message="Không xóa được người dùng";
        }
        return response(json_encode($rs));
    }
    public function SaveCreate(Request $request)
    {
        $rs = new Message(true);
        try{
            $ngdung = new User;
            $ngdung->name = $request->get("taiKhoan");
            $ngdung->email = $request->get("email");
            $ngdung->password = bcrypt($request->get("matKhau"));
            $ngdung->save();
        }catch (Exception $e)
        {
            $rs->status=false;
            $rs->message="Không lưu được người dùng";
        }

        return response(json_encode($rs));
    }

    public function CheckExist(Request $request)
    {
        $rs= new Message(false);
        $name = $request->taikhoan;
        $taiKhoan = User::where('email','=',$name)->latest()->take(1)->get();
        if (count($taiKhoan)>0) {
            $rs->status=true;
        }
        return response(json_encode($rs));
    }

    public function Login()
    {
        if(Auth::check())
        {
            return redirect('/admin');
        }
        return view('backend/taikhoan/dangnhap');
    }

    public function Sigin(Request $request)
    {
        // Tạo file PhanQuyenMiddleware trong Middleware
        // Thêm 'adminLogin' => \App\Http\Middleware\PhanQuyenMiddleware::class,
        // vào Kernel.php
        // Chỉnh route Route::group(['middleware' => 'adminLogin'], function() {
        // Mật khẩu được tự động mã hoá bcryp
        $email = $request->input('email');
        $password = $request->input('matkhau');
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect('/admin');
        }
        $thongbao = "Bạn nhập sai email hoặc mật khẩu";
        return redirect()->back()->withInput();
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        return redirect('/admin/dangnhap');
    }
}
