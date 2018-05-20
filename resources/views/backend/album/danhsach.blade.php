@extends('backend/layout/base')
@section('css')
    <style>
        div#view-list-album .col-md-3 img {
            width: 100%;
            height: 140px;
        }
        .col-md-3 {
            margin-top: 25px;
            font-size: 12px;
        }
    </style>
@endsection
@section('title', 'Quản lý Album')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách Album
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Album</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- /.row -->
            <div class="row nomargin nopadding" style="margin:0px; padding: 0px">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row nomargin nopadding">
                                <button class="btn btn-primary pull-right margin-10"  onclick="createAlbum()"><i class="fa fa-plus"></i> Thêm mới</button>
                                <button class="btn btn-primary pull-right margin-10"  onclick="createImport()"><i class="fa fa-plus"></i> Import</button>
                            </div>
                        </div>
                        <div class="box-body" id="view-list-album">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-edit"></div>
        <div class="modal fade" id="modal-view"></div>
        <div class="modal fade" id="modal-create" ></div>
        <div class="modal fade" id="modal-import" ></div>
    </div>
@endsection
@section('js')
    <script>

        var dataObj = decodeURIComponent("<?php echo rawurlencode($dsalbum); ?>");
        var jsdata = JSON.parse(dataObj);
        $(document).ready(function () {
            loadData(jsdata);
        })

        function reloadAction() {
            $.ajax({
                type: "get",
                url: '/admin/album/reload',
                dataType: 'json',
                success: function(mss) {
//                    location.href = location.href;
                    loadData(mss);
                },
                error: function() {
                    $.notify("Lỗi. Không thực hiện được thao tác", "error");
                }
            })
        }

        function drawHtml (data) {
            var str = '<div class="col-md-3">\n' +
                '<span class="mailbox-attachment-icon has-img"><img src="upload/hinhanh/'+ data.hinhanh +'" alt="'+ data.mota +'"></span>\n' +
                '<div class="mailbox-attachment-info">\n' +
                '<p><a href="upload/hinhanh/'+ data.hinhanh +'" class="mailbox-attachment-name">' + data.mota + '</a></p>\n' +
                '<span>\n' +
                '<button onclick="editAlbum(' + data.id +')" class="btn btn-primary" title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></button>\n' +
                '<button onclick="viewAlbum(' + data.id +')" class="btn btn-info" title="Xoá"><i class="fa fa-search-plus" aria-hidden="true"></i></button>\n' +
                '</span>\n' +
                '</div>\n' +
                '</div>';
            return str;
        }

        function loadData(data) {
            var a="";
            $.each(data, function(index, obj) {
                a+=drawHtml(obj);
            })
            $("#view-list-album").html(a);
        }
        var createImport = function(){
            $.ajax({
                type: 'get',
                url: '/admin/album/import',
                success: function(data){
                    $("#modal-import").html(data);
                    $("#modal-import").modal("show");
                },
                error: function(){
                    console.log('Lỗi');
                }
            })
        }

        var createAlbum = function(){
            $.ajax({
                type: 'get',
                url: '/admin/album/create',

                success: function(data){
                    $("#modal-create").html(data);
                    $("#modal-create").modal("show");
                },
                error: function() {
                    console.log('Lỗi khi gọi button thêm bài viết')
                }

            })
        }
        var editAlbum = function(id) {
            $.ajax({
                type: 'get',
                url: '/admin/album/edit/'+id,
                success: function(data) {
                    $("#modal-edit").html(data);
                    $("#modal-edit").modal("show");
                },
                error: function() {
                    console.log('Lỗi')
                }
            })
        }

        var viewAlbum = function (id) {
            $.ajax({
                type: 'get',
                url: '/admin/album/show/'+id,
                success: function (data) {
                    $("#modal-view").html(data);
                    $("#modal-view").modal("show");
                },
                error: function() {
                    console.log('Lỗi')
                }
            })
        }

    </script>
@endsection
