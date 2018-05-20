<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Cập nhật slide</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/slide/update" role="form" enctype="multipart/form-data" method="POST" id="frm-capnhat">
                    <input type="hidden" name="id" value="{{ $slide->id }}"/>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ngày bắt đầu:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" value="{{ $slide->ngaybatdau->format('m/d/Y') }}" name="ngaybatdau" class="form-control pull-right" id="ngaybatdau">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Ngày kết thúc:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" value="{{ $slide->ngayketthuc->format('m/d/Y') }}" name="ngayketthuc" class="form-control pull-right" id="ngayketthuc">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" value="1" @if($slide->hienthi == 1) {{ 'checked' }} @endif name="hienthi">Hiện thị</label>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <img class="img-responsive pad" src="upload/slide/{{ $slide->hinhanh }}">
                            <input type="file" name="hinhanh" accept=".jpg, .jpeg, .png">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <div class="center">
                <button type="button" class="btn btn-primary" onclick="editAction()">Cập nhật</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
    //Date picker Ngày bắt đầu
    $('#ngaybatdau').datepicker({
        autoclose: true
    })

    //Date picket Ngày kết thúc
    $('#ngayketthuc').datepicker({
        autoclose: true
    })

    $("#frm-capnhat").submit(function() {
        event.preventDefault();
        var valid = checkForm("frm-capnhat");
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
            var action = $("#frm-capnhat").attr("action");
            if ($("#frm-capnhat").attr("enctype") == "multipart/form-data") {
                //this only works in some browsers.
                //purpose? to submit files over ajax. because screw iframes.
                //also, we need to call .get(0) on the jQuery element to turn it into a regular DOM element so that FormData can use it.
                dataString = new FormData($("#frm-capnhat").get(0));
                contentType1 = false;
                processData = false;
            }
//            console.log(dataString);

//            dataString.noidung = value;
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
                        $.notify(mss.message, "success");
                        // console.log(mss.noidung);
                        $("#modal-edit").modal("hide");
                        $("#modal-edit").empty();
                        //-----------------------------------
                        reloadAction();
                    }
                    else
                    {
                        $.notify(mss.message, "error");
                    }
                },
                error: function() {
                    $.notify("Lỗi. Thêm thất bại", "error");
                }
            });
        }
        return false;
    });

    var editAction = function () {
        $("#frm-capnhat").submit();
    }
</script>
