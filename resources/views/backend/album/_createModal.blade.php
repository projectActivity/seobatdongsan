<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Thêm mới Album</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/album/store" role="form" enctype="multipart/form-data" method="POST" id="frm-themmoi">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Url</label> <span class="requireTxt">(*)</span>
                            <input name="duongdan" type="text" class="form-control required" placeholder="Đường dẫn" required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label> <span class="requireTxt">(*)</span>
                            <textarea name="mota" class="form-control required" row="8" placeholder="Nội dung" ></textarea>
                            <div class="note-error">
                                <span class="error mes-note-error" id="errNoiDung"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <div class="center">
                <button type="button" class="btn btn-primary" onclick="createAction()">Thêm mới</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>

    $("#frm-themmoi").submit(function() {
        event.preventDefault();
        var valid = checkForm("frm-themmoi");
        if (!valid) {
            return false;
        }
        var data = $(this).serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/album/store',
            data: data,
            dataType:'json',
            success: function(mss) {
                if(mss.status)
                {

                    $("#modal-create").modal("hide");
                    $("#modal-create").empty();
                    //-----------------------------------
                    $.notify(mss.message,'success');
                    reloadAction();
                }
                else
                {
                    $.notify(mss.message, "error");
                }
            },
            error: function() {
                $.notify("Lỗi. Thêm thất bại o client", "error");
            }
        });
        return false;
    });

    var createAction = function () {
        $("#frm-themmoi").submit();
    }
</script>
