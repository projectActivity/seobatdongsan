<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Cập nhật hình ảnh</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/hinhanh/update" role="form" method="POST" id="frm-capnhat">
                    <input type="hidden" value="{{ $hinhanh->id }}" name="id">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mô tả</label> <span class="requireTxt">(*)</span>
                            <input name="mota" type="text" value="{{ $hinhanh->mota }}" class="form-control required" placeholder="Tên bài viết" required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <img class="img-responsive pad" src="upload/hinhanh/{{ $hinhanh->url }}">
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
            var action = $("#frm-capnhat").attr("action");

//            dataString = new FormData($("#frm-capnhat").get(0));
            dataString = $("#frm-capnhat").serialize();

            $.ajax({
                type: "POST",
                url: action,
                data: dataString,
                dataType: "json", //change to your own, else read my note above on enabling the JsonValueProviderFactory in MVC
                success: function(mss) {
                    if(mss.status)
                    {
                        $.notify(mss.message, "success");
                        // console.log(mss.noidung);
                        $("#modal-edit-hinhanh").modal("hide");
                        $("#modal-edit-hinhanh").html();
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
