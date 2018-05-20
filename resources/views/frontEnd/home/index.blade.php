@extends('frontEnd/layout/baseClient')
@section('title', 'Home')
@section('description', "Trang thông tin Bất động sản nhanh nhất, chính thống. Biệt thự, chung cư, đất nền")
@section('keywords', "Bất động sản, bat dong san, group the life, group, the, life")
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($dsslide as $key => $slide)
                        @if ($slide->hienthi == 1)
                            <li data-target="#carousel-example-generic" data-slide-to="{{ $key  }}" @if($key == 0) {{'class="active"' }} @endif></li>
                        @endif
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($dsslide as $key => $slide)
                        @if ($slide->hienthi == 1)
                            <div class="item @if($key == 0) {{ 'active' }} @endif">
                                <img src="upload/slide/{{ $slide->hinhanh }}" alt="{{ $slide->hinhanh }}" >
                            </div>
                        @endif
                    @endforeach

                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="fa fa-angle-right"></span>
                </a>
            </div>
            <!-- Content Header (Page header) -->

            <div id="tinDauTrang">
                <div class="row">
                    <div class="col-md-8 col-sm-12" id="tinMoi">
                        <div class="block">
                            <div class="block-header">
                                <span class="block-title">Tin mới</span>
                            </div>
                            <div class="block-body">
                                <div class="block-content row nomargin">
                                    <div class="content-img col-sm-4  nomargin nopadding center">
                                        <img id="tinmoi" src="upload/hinhanh/{{ $baivietmoinhat[0]->hinhanh }}" alt="{{ $baivietmoinhat[0]->hinhanh }}" >
                                    </div>
                                    <div class="content-text col-sm-8 nomargin nopadding">
                                        <div class="content-title">
                                            <a href="/post/{{ $baivietmoinhat[0]->id }}">{{ $baivietmoinhat[0]->tenbaiviet }}</a>
                                        </div>
                                        <div class="content-tomtat">
                                            {{ $baivietmoinhat[0]->tomtat }}
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <ul>
                                        @foreach($dsbaighim as $baighim)
                                            <li><i class="fa fa-newspaper-o" aria-hidden="true"></i>@if($baighim->trangthai == 0) <a href="/post/{{ $baighim->baivietid}}">{{$baighim->tenbaighim}}</a>  @else <a href="{{$baighim->url}}">{{ $baighim->tenbaighim }}</a> @endif</li>
                                        @endforeach
                                        @foreach($dsbaiviet as $baiviet)
                                            <li><i class="fa fa-newspaper-o" aria-hidden="true"></i><a href="/post/{{ $baiviet->id }}">{{ $baiviet->tenbaiviet }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4" id="duAnNoiBat">
                        <div class=" block">
                            <div class="block-header">
                                <span class="block-title">Dự án nội bật</span>
                            </div>
                            <div class="block-body" id="slimScrollDiv">
                                <div class="block-content">
                                    <div class="row nomargin nopadding" >
                                        @foreach($dsduan  as $duan)
                                            @if($duan->noibat == 1)
                                                <div class="col-sm-3 col-xm-3 col-md-6 duan-item">
                                                    <div class="duan-item-img">
                                                        <img src="upload/hinhanh/{{ $duan->hinhanh  }}" class="duannoibat"/>
                                                    </div>
                                                    <div class="duan-item-name text-center">
                                                        <a href="/duan/{{ $duan->id }}">{{ $duan->tenthuongmai  }}</a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="duAnTrongTam">
                <div class="row">
                    <div class="col-sm-12 col-md-12 duan-tieude center">
                        <h1 class="tenDuAnTrongTam">{{ $duantrongtam[0]->tenchude }}</h1>
                    </div>
                    <div class="col-sm-12 col-md-12 duan-hinhanh" >
                        <img src="upload/hinhanh/{{ $duantrongtam[0]->hinhanh }}">
                    </div>
                    <div class="col-sm-12 col-md-12 duan-tomtat">

                        <p>{!! $duantrongtam[0]->tomtat !!}</p>
                    </div>
                    <div class="col-sm-12 col-md-12 duan-dshinhanh">
                        @foreach($dshinhanh as $hinhanh)
                        <div class="col-md-4 hinhanh"><img src="upload/hinhanh/{{ $hinhanh->url }}"></div>
                        @endforeach
                    </div>
                    <div class="col-sm-12 col-md-12 duan-xemthem">
                        <div class="center">
                            <a href="/duan/{{ $duantrongtam[0]->id }}" class="btn btn-primary btn-lg">Xem thêm</a>
                        </div>

                    </div>
                </div>
            </div>

            @include('frontEnd/layout/dangKyEmail')
        </div>



    <!-- /.content -->
    </div>
@endsection
@section("js")
    <script>
        //        $("#frm-dangkyemail").submit(function(){
        //            var data = $(this).serialize();
        //            var url = $(this).attr("action");
        //            var method = $(this).attr("method");
        //            $.ajaxSetup({
        //                headers: {
        //                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                }
        //            });
        //            $.ajax({
        //                type: method,
        //                url: url,
        //                data: data,
        //                success: function(data){
        //                    if (mss.status)
        //                    {
        //                        $.notify(mss.message, "success");
        //                        window.location.replace();
        //                    }
        //                    else
        //                    {
        //
        //                    }
        //                },
        //                error: function() {
        //                    console.log('Lỗi khi gọi khi đăng ký email')
        //                }
        //            });
        //            return false;
        //        });

        var mss = '<?php if(isset($mss)) echo $mss ?>';
        if (mss.status) {
            $.notify(mss.message, "success");
        }
        $("#slimScrollDiv").slimScroll({
            height: '350px'
        });
    </script>
@endsection