@extends('backend/layout/base')
@section('css')

@endsection
@section('title', 'Quản lý BlockContent')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Chủ đề: <span style="margin-left: 20px">{{ $duan->tenchude }}</span>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">BlockContent</li>
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
                                <div class="pull-left"><h3>Danh sách BlockContent</h3></div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="tblBlockContent" class="table table-bordered table-striped" style="width:100%;">
                                <thead>
                                <tr>
                                    <th class="width-30">STT</th>
                                    <th>Tên </th>
                                    <th>Tóm tắt</th>
                                    <th>Loại block</th>
                                    <th>Hiển thị</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="blockcontent-info">

                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-12">
                    <a href="/admin/chude" class="btn btn-info ">Quay lại</a>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-edit"></div>
    </div>
@endsection
@section('js')
    <script>
        var idduan = '<?php echo $idduan; ?>';
        var dataObj = decodeURIComponent("<?php echo rawurlencode($dsblockcontent); ?>");
        var jsdata = JSON.parse(dataObj);
        $(document).ready(function () {
            loadDataTable(jsdata);
        })

        var editBlockContent = function(id) {
            $.ajax({
                type: 'get',
                url: '/admin/blockcontent/edit/'+id,
                success: function(data) {
                    $("#modal-edit").html(data);
                    $("#modal-edit").modal("show");
                },
                error: function() {
                    console.log('Lỗi')
                }
            })
        }

        function reloadAction() {
            $.ajax({
                type: "get",
                url: '/admin/blockcontent/reload/'+idduan,
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
            var table = $('#tblBlockContent').DataTable({

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
                            return data.tenblock;
                        },
                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.tomtat;
                        },
                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.ten;
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
                            var str = '<a href="/admin/blockcontent/show/' + data.id + '" ><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a> ';
                            str += '<a href="javascript:void(0)" onclick="editBlockContent(' + data.id + ')"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>';
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
