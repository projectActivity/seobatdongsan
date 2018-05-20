@extends('frontEnd/layout/baseClient')
@section('css')
    <style>
        .hovereffect {
            width:100%;
            height:100%;
            float:left;
            overflow:hidden;
            position:relative;
            text-align:center;
            cursor:default;
        }

        .hovereffect .overlay {
            width:100%;
            height:100%;
            position:absolute;
            overflow:hidden;
            top:0;
            left:0;
            opacity:0;
            background-color:rgba(44, 62, 80, 0.8);
            -webkit-transition:all .4s ease-in-out;
            transition:all .4s ease-in-out
        }

        .hovereffect img {
            display:block;
            position:relative;
            -webkit-transition:all .4s linear;
            transition:all .4s linear;
        }

        .hovereffect h2 {
            text-transform:uppercase;
            color:#fff;
            text-align:center;
            position:relative;
            font-size:17px;
            background:rgba(44, 62, 80, 0.8);
            -webkit-transform:translatey(-100px);
            -ms-transform:translatey(-100px);
            transform:translatey(-100px);
            -webkit-transition:all .2s ease-in-out;
            transition:all .2s ease-in-out;
            padding:10px;
        }

        .hovereffect a.info {
            text-decoration:none;
            display:inline-block;
            text-transform:uppercase;
            color:#fff;
            border:1px solid #fff;
            background-color:transparent;
            opacity:0;
            filter:alpha(opacity=0);
            -webkit-transition:all .2s ease-in-out;
            transition:all .2s ease-in-out;
            margin:50px 0 0;
            padding:7px 14px;
        }

        .hovereffect a.info:hover {
            box-shadow:0 0 5px #fff;
        }

        .hovereffect:hover img {
            -ms-transform:scale(1.2);
            -webkit-transform:scale(1.2);
            transform:scale(1.2);
        }

        .hovereffect:hover .overlay {
            opacity:1;
            filter:alpha(opacity=100);
            text-align: center;
        }

        .hovereffect:hover h2,.hovereffect:hover a.info {
            opacity:1;
            filter:alpha(opacity=100);
            -ms-transform:translatey(0);
            -webkit-transform:translatey(0);
            transform:translatey(0);
        }

        .hovereffect:hover a.info {
            -webkit-transition-delay:.2s;
            transition-delay:.2s;
        }



    </style>
@endsection
@section('title', "Dự án")
@section('content')
    <div class="content-wrapper" >
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
                                <img src="upload/slide/{{ $slide->hinhanh }}" alt="{{ $slide->hinhanh }}">
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
            <div class="center">
                <img src="upload/devider.png">
                <h2 class="nomargin duan-title">Tất cả các dự án</h2>
            </div>
                @foreach($dsduan as $duan)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding: 5px ">
                        <div class="hovereffect">
                            <img style="height: 100%; width: 100%" class="img-responsive" src="upload/hinhanh/{{ $duan->hinhanh }}" alt="{{ $duan->hinhanh }}">
                            <div class="overlay">
                                <h2>{{ $duan->tenchude }}</h2>
                                <a href="/duan/{{ $duan->id }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach

        </div>
    </div>


@endsection


