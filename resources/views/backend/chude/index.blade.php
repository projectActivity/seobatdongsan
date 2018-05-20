@extends('backend/layout/base')
@section('title', 'Home ')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách chủ đề
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Chủ đề</li>
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
                                <button class="btn btn-primary pull-right margin-10" data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i> Thêm mới</button>
                                <button class="btn btn-primary pull-right margin-10" data-toggle="collapse" data-target="#timkiembox"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row nomargin nopadding">
                                <div id="timkiembox" class="collapse">
                                    <div class="row nomargin nopadding">
                                        <div class="col-md-offset-1 col-md-10">
                                            <form action="/admin/chude/search" method="post" role="form" class="form-horizontal" id="frm-searchChuDe">
                                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
                                                <div class="form-group col-md-6">
                                                    <label class="control-label col-md-3">Từ khóa</label>
                                                    <div class="col-md-9">
                                                        <input name="tukhoa" type="text" class="form-control" placeholder="Từ khóa...">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label col-md-3">Loại</label>
                                                    <div class="col-md-9">
                                                        <select name="loai" class="form-control" style="width: 100%;">
                                                            <option selected="selected" value="-1">Tất cả</option>
                                                            <option value="0">Chủ đề</option>
                                                            <option value="1">Dự án</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="center">
                                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                                    <button type="button" class="btn btn-danger" onclick="closeTimKiem()">Đóng</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="tblChuDe" class="table table-bordered table-striped" style="width:100%;">
                                <thead>
                                <tr>
                                    <th class="width-30">#</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên chủ đề</th>
                                    <th>Tên thương mại</th>
                                    <th>Keyword</th>
                                    <th>Thể loại</th>
                                    <th>Tóm tắt</th>
                                    <th>Trọng tâm</th>
                                    <th>Nổi bật</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="chude-info">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-edit">
        </div>
        <div class="modal fade" id="modal-delete">
        </div>
        <div id="modal-create" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="center">
                            <h4 class="modal-title">Thêm mới chủ đề</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="/admin/chude/store" role="form" enctype="multipart/form-data" method="POST" id="frm-themmoi">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Loại</label>
                                        <select name="loai" class="form-control" style="width: 100%;" onchange="ChangeLoaiChuDe(this.value)">
                                            <option selected="selected" value="0">Chủ đề</option>
                                            <option value="1">Dự án</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên chủ đề</label> <span class="requireTxt">(*)</span>
                                        <input name="tenchude" type="text" class="form-control required" placeholder="Tên chủ đề" required>
                                        <div class="note-error">
                                            <span class="error mes-note-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên thương mại</label> <span class="requireTxt">(*)</span>
                                        <input name="tenthuongmai" type="text" class="form-control required" placeholder="Tên thương mại" required>
                                        <div class="note-error">
                                            <span class="error mes-note-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Keyword</label> <span class="requireTxt">(*)</span>
                                        <input name="keyword" type="text" class="form-control required" placeholder="Keyword" required>
                                        <div class="note-error">
                                            <span class="error mes-note-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label> <span class="requireTxt">(*)</span>
                                        <textarea name="description" class="form-control required" style="height: 150px" placeholder="Description" required></textarea>
                                        <div class="note-error">
                                            <span class="error mes-note-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tóm tắt</label> <span class="requireTxt">(*)</span>
                                        <textarea name="tomtat" class="form-control required" style="height: 150px" placeholder="Tóm tắt" required></textarea>
                                        <div class="note-error">
                                            <span class="error mes-note-error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline"><input type="checkbox" value="1" name="trongtam" id="trongtam">Trọng tâm</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline"><input type="checkbox" value="1" name="noibat">Nổi bật</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label> <span class="requireTxt">(*)</span>
                                        <input class="required" type="file" name="hinhanh" required>
                                        <div class="note-error">
                                            <span class="error mes-note-error"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="center">
                            <button type="button" class="btn btn-primary" onclick="createbtnaction()">Thêm mới</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection @section('js')

    <script>

        function ChangeLoaiChuDe(id) {
            if (id == 0) {
                $("#trongtam").attr('disabled', 'disabled');
            } else {
                $("#trongtam").removeAttr('disabled');
            }
        }

        var dataObj = decodeURIComponent("<?php echo rawurlencode($dschude); ?>");


        var js_obj_data = eval(dataObj);
        $(document).ready(function() {
            loadDataTable(js_obj_data);
        })

        var createbtnaction = function() {
            $("#frm-themmoi").submit();
        }

        function reloadAction() {
            $.ajax({
                type: "get",
                url: '/admin/chude/reload',
                dataType: 'json',
                success: function(mss) {
                    loadDataTable(mss);
                },
                error: function() {
                    $.notify("Lỗi. Không thực hiện được thao tác", "error");
                }
            })
        }
        function xoachude(id) {
            $.confirm({
                'title': 'Xác nhận xóa',
                'message': 'Bạn có chắc chắn muốn xóa?',
                'buttons': {
                    'Đồng ý': {
                        'class': 'btn-confirm-yes btn-info',
                        'action': function () {
                            $.ajax({
                                type: 'GET',
                                url: '/admin/chude/destroy/'+id,
                                dataType: 'json',
                                success: function(mss) {
                                    if(mss.status){
                                        $.notify("Xóa bài viết thành công", "success");
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
        var suachude = function(id) {
            $.ajax({
                type: 'GET',
                url: 'admin/chude/edit/' + id,
                data: { 'id': id },
                success: function(rs) {
                    $("#modal-edit").html(rs);
                    $("#modal-edit").modal("show");
                }
            })
        }
        $("#frm-searchChuDe").submit(function() {
            event.preventDefault();

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(rs) {
                        loadDataTable(rs);
                },
                error: function() {
                    $.notify("Lỗi. Không thực hiện được thao tác", 'error');
                }
            })
        })

        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })



        $("#frm-themmoi").submit(function() {
            event.preventDefault();
            var valid = checkForm("frm-themmoi");
            if (!valid) {
                return false;
            } else {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var dataString;

                var contentType1 = false;
                var action = $("#frm-themmoi").attr("action");
                if ($("#frm-themmoi").attr("enctype") == "multipart/form-data") {
                    //this only works in some browsers.
                    //purpose? to submit files over ajax. because screw iframes.
                    //also, we need to call .get(0) on the jQuery element to turn it into a regular DOM element so that FormData can use it.
                    dataString = new FormData($("#frm-themmoi").get(0));
                    contentType1 = false;
                    processData = false;
                }
                $.ajax({
                    type: "POST",
                    url: action,
                    data: dataString,
                    dataType: "json", //change to your own, else read my note above on enabling the JsonValueProviderFactory in MVC
                    contentType: false,
                    processData: false,
                    success: function(mss) {
                        if(mss.status)
                        {
                            $.notify("Thêm mới thành công", "success");
                            $("#modal-create").modal("hide");
                            reloadAction();
                        }else {
                            $.notify(mss.message, "err");
                        }

                        // console.log(mss.noidung);

                    },
                    error: function() {
                        $.notify("Loi. Them that bai", "error");
                    }
                });
            }
            return false;
        });

        var loadDataTable = function(item) {
            var table = $('#tblChuDe').DataTable({

                // "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>" +
                //     "t" +
                //     "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                // "oLanguage": {
                //     "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                // },
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
                        "sClass": "center",
                        "orderable": false,
                        "mData": function(data, type, dataToSet) {

                            var str = '<img class="attachment-img center" alt="' + data.tenchude + '" src="upload/hinhanh/' + data.hinhanh + '" style="width: 50px; height: 50px">';
                            return str;
                        },

                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            var str = '<a href="/admin/baiviet/' + data.id + '">' + data.tenchude + '</a>';
                            return str;
                        },

                    },
                    {
                        "mData": function(data, type, dataToSet) {

                            return data.tenthuongmai;
                        },

                    },
                    {
                        "mData": function(data, type, dataToSet) {

                            return data.keyword;
                        },

                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            var str = data.duan == 0 ? '<span class=" badge bg-aqua">Chủ đề</span>' : '<span class=" badge bg-green">Dự án</span>';
                            return str;
                        },

                    },
                    {
                        "orderable": false,
                        "mData": function(data, type, dataToSet) {

                            return data.tomtat;
                        },

                    },
                    {
                        "orderable": false,
                        "mData": function(data, type, dataToSet) {
                            var str = data.trongtam == 0 ? '<span class=" badge bg-aqua">Không</span>' : '<span class=" badge bg-green">Có</span>';
                            return str;
                        },

                    },
                    {
                        "orderable": false,
                        "mData": function(data, type, dataToSet) {
                            var str = data.noibat == 0 ? '<span class=" badge bg-aqua">Không</span>' : '<span class=" badge bg-green">Có</span>';
                            return str;
                        },

                    },
                    {
                        "orderable": false,
                        "sClass": "center",
                        "mData": function(data, type, dataToSet) {
                            var str = '<a href="javascript:void(0)" onclick="suachude(' + data.id + ')" title="Sửa chủ đề"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a> ';
                            str += '<a href="javascript:void(0)" onclick="xoachude(' + data.id + ')" style="color: #f56954" title="Xoá chủ đề"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>';
                            str += data.duan == 1 ? ('<a href="/admin/blockcontent/' + data.id + '" title="Block Content"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>' + '<a href="/admin/tailieu/' + data.id + '" title="Tài liệu dự án"><i class="fa fa-files-o fa-lg" aria-hidden="true"></i>') : ' ';
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