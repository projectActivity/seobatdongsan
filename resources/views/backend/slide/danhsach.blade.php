@extends('backend/layout/base')
@section('css')

@endsection
@section('title', 'Quản lý Slide')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách Slide
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Slide</li>
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
                                <button class="btn btn-primary pull-right margin-10"  onclick="createSlide()"><i class="fa fa-plus"></i> Thêm mới</button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <table id="tblSlide" class="table table-bordered table-striped" style="width:100%;">
                                <thead>
                                <tr>
                                    <th class="width-30">Id</th>
                                    <th>Hình ảnh</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Hiển thị</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="slide-info">
                                {{--@include('backend/baiviet/_listTable')--}}
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-12">
                    <a href="/admin" class="btn btn-info ">Quay lại</a>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-edit"></div>
        <div class="modal fade" id="modal-delete"></div>
        <div class="modal fade" id="modal-create" ></div>
    </div>
@endsection
@section('js')
    <script>
        var dataObj = decodeURIComponent("<?php echo rawurlencode($dsslide); ?>");
        var jsdata = JSON.parse(dataObj);
        $(document).ready(function () {
            loadDataTable(jsdata);
        })


        var createSlide = function(){
            $.ajax({
                type: 'get',
                url: '/admin/slide/create',

                success: function(data){
                    $("#modal-create").html(data);
                    $("#modal-create").modal("show");
                },
                error: function() {
                    console.log('Lỗi khi gọi button thêm bài viết')
                }

            })
        }
        var editSlide = function(id) {
            $.ajax({
                type: 'get',
                url: '/admin/slide/edit/'+id,
                success: function(data) {
                    $("#modal-edit").html(data);
                    $("#modal-edit").modal("show");
                },
                error: function() {
                    console.log('Lỗi')
                }
            })
        }

        function deleteSlide(id) {
            $.confirm({
                'title': 'Xác nhận xóa',
                'message': 'Bạn có chắc chắn muốn xóa?',
                'buttons': {
                    'Đồng ý': {
                        'class': 'btn-confirm-yes btn-info',
                        'action': function () {
                            $.ajax({
                                type: 'GET',
                                url: '/admin/slide/destroy/'+id,
                                dataType: 'json',
                                success: function(mss) {
                                    if(mss.status){
                                        $.notify(mss.message, "success");
                                        $("#modal-delete").modal("hide");
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
                url: '/admin/slide/reload',
                dataType: 'json',
                success: function(mss) {
                    loadDataTable(mss);
                },
                error: function() {
                    $.notify("Lỗi. Không thực hiện được thao tác", "error");
                }
            })
        }

        var loadDataTable = function(item) {
            var table = $('#tblSlide').DataTable({

                "data": item,
                "bDestroy": true,
                "iDisplayLength": 20,
                paging: true,
                "aoColumns": [{
                    "orderable": false,
                    "sClass": "center",
                    "mData": function(data, type, dataToSet) {
                        return '<input class="global_" type="checkbox" name="ids" value="' + data.id + '" />';
                    },
                    "orderable": false,
                },

                    //{
                    //    "class": 'details-control',
                    //    "orderable": false,
                    //    "data": null,
                    //    "defaultContent": ''
                    //},
                    {
                        "mData": function(data, type, dataToSet) {
                            var str = '<img class="attachment-img center" alt="not find" src="/upload/slide/' + data.hinhanh + '" style="width: 50px; height: 50px">';
                            return str;
                        },
                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.ngaybatdau;
                        },
                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.ngayketthuc;
                        },
                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            var str = data.hienthi === 0 ? '<span class=" badge bg-aqua">Không</span>' : '<span class=" badge bg-green">Có</span>';
                            return str;
                        },
                    },
                    {
                        "orderable": false,
                        "sClass": "center",
                        "mData": function(data, type, dataToSet) {
                            var str = '<a href="javascript:void(0)" onclick="editSlide(' + data.id + ')"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>';
                            str += '  <a href="javascript:void(0)" onclick="deleteSlide(' + data.id + ')" style="color: #f56954"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>';

                            return str;
                        },

                    },

                ],
                //"order": [[1, 'asc']],
                "fnDrawCallback": function(oSettings) {

                    //runAllCharts()
                }
            });
        }

    </script>
@endsection
