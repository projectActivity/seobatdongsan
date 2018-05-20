@extends('backend/layout/base')
@section('css')
    <style>
        .mailbox-read-message {
            background: #ecf0f1;
        }
        .mailbox-attachment-info {
            background: #bdc3c7;
        }
        .col-md-3 {
            margin-top: 5px;
        }
        #dsHinhAnh img {
            width: 100%;
            height: 168px;
        }
    </style>

@endsection
@section('title', 'BlockContent')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Loại Block: {{ $block->LoaiBlock->ten  }}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">BlockContent</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="mailbox-read-message">
                                <h3 class="box-title">Chủ đề  </h3>
                                <p>{{ $block->ChuDe->tenchude }}</p>
                            </div>
                        </div>
                        <div class="box-header with-border ">
                            <div class="mailbox-read-message">
                                <h3 class="box-title">Loại Block</h3>
                                <p>{{ $block->LoaiBlock->ten  }}</p>
                            </div>
                        </div>
                        <div class="box-header with-border ">
                            <div class="mailbox-read-message">
                                <h3 class="box-title">Tên Block</h3>
                                <p>{{ $block->tenblock  }}</p>
                            </div>
                        </div>
                        <div class="box-header with-border ">
                            <div class="mailbox-read-message">
                                <h3 class="box-title">Tóm tắt</h3>
                                <p>{{ $block->tomtat  }}</p>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-header with-border">
                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                                <h3 class="box-title">Nội dung</h3>
                                <p>{!! $block->noidung !!}</p>
                            </div>
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-header with-border">
                            <div class="mailbox-read-message">
                                <h3 class="box-title">Danh sách hình ảnh</h3>
                                <p></p>
                                <p><button class="btn btn-primary" onclick="createHinhAnh({{ $block->id }})">Thêm hình ảnh</button></p>
                                <div class="row" id="dsHinhAnh">

                                </div>
                            </div>


                        </div>
                        <!-- /.box-footer -->
                        <div class="box-footer">
                            <a href="/admin/blockcontent/{{ $block->ChuDe->id }}" type="button" class="btn btn-default"><i class="fa fa-chevron-left" aria-hidden="true"></i>  Quay lại</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-edit-hinhanh"></div>
        <div class="modal fade" id="modal-delete-hinhanh"></div>
        <div class="modal fade" id="modal-create-hinhanh" ></div>
    </div>



@endsection
<script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script>
    var id = parseInt('<?php echo $block->id ?>');
    var dataObj = decodeURIComponent("<?php echo rawurlencode($dshinhanh); ?>");
    var jsdata = JSON.parse(dataObj);
    $(document).ready(function () {
        loadHinhAnh(jsdata);
    })

    var editBlockContent = function(id) {
        $.ajax({
            type: 'get',
            url: '/admin/blockcontent/edit/'+id,
            success: function(data) {
                $("#modal-edit-block").html(data);
                $("#modal-edit-block").modal("show");
            },
            error: function() {
                console.log('Lỗi')
            }
        })
    }

    var createHinhAnh = function(id) {
        $.ajax({
            type: 'get',
            url: '/admin/hinhanh/create/'+id,
            success: function(data) {
                $("#modal-create-hinhanh").html(data);
                $("#modal-create-hinhanh").modal("show");
            },
            error: function() {
                console.log('Lỗi')
            }
        })
    }

    var editHinhAnh = function(id) {
        $.ajax({
            type: 'get',
            url: '/admin/hinhanh/edit/'+id,
            success: function(data) {
                $("#modal-edit-hinhanh").html(data);
                $("#modal-edit-hinhanh").modal("show");
            },
            error: function() {
                console.log('Lỗi')
            }
        })
    }

    function deleteHinhAnh(id) {
        $.confirm({
            'title': 'Xác nhận xóa',
            'message': 'Bạn có chắc chắn muốn xóa?',
            'buttons': {
                'Đồng ý': {
                    'class': 'btn-confirm-yes btn-info',
                    'action': function () {
                        $.ajax({
                            type: 'GET',
                            url: '/admin/hinhanh/destroy/'+id,
                            dataType: 'json',
                            success: function(mss) {
                                if(mss.status){
                                    $.notify(mss.message, "success");
                                    $("#modal-delete-hinhanh").modal("hide");
                                    reloadAction();
                                }
                                else {
                                    $.notify(mss.message, "error");
                                }
                            },
                            error: function() {
                                $.notify("Lỗi. không thực hiện được thao tác", "error");
                            }
                        })
                    }
                },
                'Hủy bỏ': {
                    'class': 'btn-danger',
                    'action': function () { }
                }
            }
        });
    }

    function reloadAction() {
        $.ajax({
            type: "get",
            url: '/admin/hinhanh/reload/'+id,
            dataType: 'json',
            success: function(mss) {
                loadHinhAnh(mss);
            },
            error: function() {
                $.notify("Lỗi. Không thực hiện được thao tác", "error");
            }
        })
    }

    function drawHtml(data) {
        var str = '<div class="col-md-3">\n' +
            '<span class="mailbox-attachment-icon has-img"><img src="upload/hinhanh/'+ data.url +'" alt="'+ data.mota +'"></span>\n' +
            '<div class="mailbox-attachment-info">\n' +
            '<p><a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>' + data.mota + '</a></p>\n' +
            '<span>\n' +
            '<button onclick="editHinhAnh(' + data.id +')" class="btn btn-primary" title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></button>\n' +
            '<button onclick="deleteHinhAnh(' + data.id +')" class="btn btn-danger" title="Xoá"><i class="fa fa-trash-o" aria-hidden="true"></i></button>\n' +
            '</span>\n' +
            '</div>\n' +
            '</div>';
        return str;
    }

    function loadHinhAnh(data) {
        var a="";
        $.each(data, function(index, obj) {
            a+=drawHtml(obj);
        })
        $("#dsHinhAnh").html(a);
    }
</script>

