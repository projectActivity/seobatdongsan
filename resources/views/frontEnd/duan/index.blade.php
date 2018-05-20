@extends('frontEnd/layout/baseClient')
@section('title', $duan->tenchude)
@section('description', $duan->description)
@section('keywords', $duan->keyword)
@section('content')
    <div class="content-wrapper" >
        <div class="main-duan">
            <div class="center">
                <img class="devide" src="upload/devider.png">
                <h2 class="nomargin duan-title">{{ $duan->tenchude }}</h2>
                <div class="duan-hinhanh">
                    <img src="upload/hinhanh/{{$duan->hinhanh}}">
                </div>
            </div>
            @foreach($duan->BlockContent as $block)
                @if($block->hienthi == 1)
                <div class="blockcontent row nomargin">
                    <div class="blockcontent-header">
                        <div class="row" style="margin-left: 0px; margin-right: 0px;">
                            <div class="col-sm-12">
                                <h1>{{ $block->LoaiBlock->ten }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 nomargin nopadding ">
                       <div class="body-text" >
                           {!! $block->noidung !!}
                       </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        @include('frontEnd/layout/dangKyEmail')
    </div>

@endsection