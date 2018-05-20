@extends('frontEnd/layout/baseClient')
@section('description', $baiViet->description)
@section('keywords', $baiViet->keyword)
@section('title', 'Chi tiết bài viết')
@section('content')
    <div class="content-wrapper" >
        <div class="container">
            <div class="row mainbox">
                <div class="col-sm-9">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="baiviet-title">{{$baiViet->tenbaiviet}}</div>

                            <div class="baiviet-time">{{$baiViet->created_at}}</div>
                            <div class="baiviet-chude">
                                <span>Chủ đề </span><a href="">{{$baiViet->chude->tenchude}}</a>
                            </div>

                            <div class="baiviet-content">
                                {!!$baiViet->noidung!!}
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="container-common">
                        <div class="fb-page" data-href="https://www.facebook.com/duanhothanoi/?modal=admin_todo_tour" data-width="260" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/duanhothanoi/?modal=admin_todo_tour" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/duanhothanoi/?modal=admin_todo_tour">Bất Động Sản The Life Group</a>
                            </blockquote>
                        </div>
                    </div>

                    <div class="container-common">
                        <div id="ctl27_HeaderContainer" class="box-header">
                            <div class="name_tit" align="center">
                                <div style="color: White;">
                                    BÀI VIẾT CÙNG CHỦ ĐỀ</div>
                            </div>
                        </div>
                        <div class="bor_box">
                            <div class="list">
                                <div class="list-item">
                                    <ul>
                                        @foreach($dsBVChuDe as $bv)
                                        <li><i class="fa fa-newspaper-o" aria-hidden="true"></i><a href="/post/{{ $bv->id }}">{{ $bv->tenbaiviet  }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div style="padding-left: 20px;padding-right: 5px; padding-top: 5px; border-top: 1px solid #ccc; margin-top: 10px; text-align: right;">

                                <a href="/chu-de-trong-chu-de-ve-thong-tin-thi-truong" class="linktoall " style="font-weight: bold;"  > Xem thêm</a>

                            </div>
                        </div>
                        <div id="ctl27_FooterContainer">
                        </div>
                    </div>

                    <div class="container-common">
                        <div id="ctl27_HeaderContainer" class="box-header">
                            <div class="name_tit" align="center">
                                <div style="color: White;">
                                    BÀI VIẾT MỚI</div>
                            </div>
                        </div>
                        <div class="bor_box">
                            <div class="list">
                                <div class="list-item">
                                    <ul>
                                        @foreach($dsbaiviet as $key => $baiviet)
                                            @if($key < 5)
                                                <li><i class="fa fa-newspaper-o" aria-hidden="true"></i><a href="">{{ $baiviet->tenbaiviet }}</a>
                                                </li>
                                            @else
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div style="padding-left: 20px;padding-right: 5px; padding-top: 5px; border-top: 1px solid #ccc; margin-top: 10px; text-align: right;">

                                <a href="/chu-de-trong-chu-de-ve-thong-tin-thi-truong" class="linktoall " style="font-weight: bold;"  > Xem thêm</a>

                            </div>
                        </div>
                        <div id="ctl27_FooterContainer">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

@endsection