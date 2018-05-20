@extends('backend/layout/base')
@section('css')
@endsection
@section('title', 'Người dùng')
@section('description','Xin Chào mọi người')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách người dùng
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Người dùng</li>
            </ol>
        </section>
        <section class="content">
            <!-- /.row -->
            <div class="row nomargin nopadding" style="margin:0px; padding: 0px">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row nomargin nopadding">
                                <button class="btn btn-primary pull-right margin-10" onclick="CreateAction()"><i class="fa fa-plus"></i> Thêm mới</button>

                            </div>
                            <table id="tblNguoiDung" class="table table-bordered table-striped" style="width:100%;">
                                <thead>
                                <tr>
                                    <th class="width-30"></th>
                                    <th>Tài khoản</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="nguoiDung-info">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="modal-edit">
        </div>
        <div class="modal fade" id="modal-delete">


        </div>
        <div class="modal fade" id="modal-create">
        </div>
    </div>
@endsection
@section('js')
    <script>

        var dataObj = decodeURIComponent("<?php echo rawurlencode($dsnguoidung); ?>");
        var jsdata = JSON.parse(dataObj);
        $(document).ready(function () {
            loadDataTable(jsdata);
        })

        function CreateAction() {
            $.ajax({
                type: 'GET',
                url: 'admin/nguoidung/create',
                success: function(rs) {
                    $("#modal-create").html(rs);
                    $("#modal-create").modal("show");
                },
                error: function() {
                    $.notify("Lỗi. Không thực hiện được thao tác","error");
                }
            });
        }

        function EditAction(id) {
            $.ajax({
                type: 'GET',
                url: 'admin/nguoidung/edit/'+id,
                success: function(rs) {
                    $("#modal-edit").html(rs);
                    $("#modal-edit").modal("show");
                },
                error: function() {
                    $.notify("Lỗi. Không thực hiện được thao tác","error");
                }
            });
        }

        function DeleteAction(id) {
            $.confirm({
                'title': 'Xác nhận xóa',
                'message': 'Bạn có chắc chắn muốn xóa?',
                'buttons': {
                    'Đồng ý': {
                        'class': 'btn-confirm-yes btn-info',
                        'action': function () {

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: 'POST',
                                url: '/admin/nguoidung/delete',
                                data:{'id':id},
                                dataType: 'json',
                                success: function(mss) {
                                    if(mss.status){
                                        $.notify("Xóa người dùng thành công", "success");
                                        $("#modal-delete").modal("hide");
                                        ReloadAction();
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
        function ReloadAction() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'admin/nguoidung/reload',
                dataType:'json',
                success: function(rs) {
                    loadDataTable(rs);
                },
                error: function() {
                    $.notify("Lỗi. Không thực hiện được thao tác","error");
                }
            });
        }

        var loadDataTable = function(item) {
            var table = $('#tblNguoiDung').DataTable({

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

                        "orderable": false,
                        "mData": function(data, type, dataToSet) {
                            return data.name;
                        },

                    },
                    {
                        "mData": function(data, type, dataToSet) {

                            return data.email;
                        },

                    },

                    {
                        "orderable": false,
                        "sClass": "center",
                        "mData": function(data, type, dataToSet) {
                            var str = '<a href="javascript:void(0)" onclick="EditAction(' + data.id + ')"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a> ';
                            str += '<a href="javascript:void(0)" onclick="DeleteAction(' + data.id + ')" style="color: #f56954"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>';
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