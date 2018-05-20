@extends('backend/layout/base')
@section('css')
@endsection
@section('title', 'Quản lý liên hệ')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách khách hàng
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Liên hệ</li>
            </ol>
        </section>
        <section class="content">
            <!-- /.row -->
            <div class="row nomargin nopadding" style="margin:0px; padding: 0px">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row nomargin nopadding">

                            </div>
                            <table id="tblLienHe" class="table table-bordered table-striped" style="width:100%;">
                                <thead>
                                <tr>
                                    <th class="width-30"></th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="lienhe-info">
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
        <div class="modal fade" id="modal-delete"></div>
    </div>
@endsection
@section('js')
    <script>

        var dataObj = decodeURIComponent("<?php echo rawurlencode($dslienhe); ?>");
        var jsdata = JSON.parse(dataObj);
        $(document).ready(function () {
            loadDataTable(jsdata);
        })

        function DeleteAction(id) {
            $.confirm({
                'title': 'Xác nhận xóa',
                'message': 'Bạn có chắc chắn muốn xóa?',
                'buttons': {
                    'Đồng ý': {
                        'class': 'btn-confirm-yes btn-info',
                        'action': function () {
                            $.ajax({
                                type: 'GET',
                                url: '/admin/lienhe/destroy/'+id,
                                dataType: 'json',
                                success: function(mss) {
                                    if(mss.status){
                                        $.notify(mss.message, "success");
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

            $.ajax({
                type: 'GET',
                url: 'admin/lienhe/reload',
                dataType: 'json',
                success: function(rs) {
                    loadDataTable(rs);
                },
                error: function() {
                    $.notify("Lỗi. Không thực hiện được thao tác","error");
                }
            });
        }

        var loadDataTable = function(item) {
            var table = $('#tblLienHe').DataTable({

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
                            return data.hoten;
                        },

                    },
                    {
                        "mData": function(data, type, dataToSet) {

                            return data.email;
                        },

                    },
                    {
                        "mData": function(data, type, dataToSet) {

                            return data.dienthoai;
                        },

                    },
                    {
                        "orderable": false,
                        "sClass": "center",
                        "mData": function(data, type, dataToSet) {
                            var str = '<a href="javascript:void(0)" onclick="DeleteAction(' + data.id + ')" style="color: #f56954"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>';
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