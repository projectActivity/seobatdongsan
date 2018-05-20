<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Cập nhật tài liệu</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/tailieu/update" role="form" enctype="multipart/form-data" method="POST" id="frm-capnhat">
                    <input type="hidden" name="id" value="{{ $tailieu->id }}">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tên tài liệu</label> <span class="requireTxt">(*)</span>
                            <input name="tentailieu" value="{{ $tailieu->tentailieu }}" type="text" class="form-control required" placeholder="Tên tài liệu" required>
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
                <button type="button" class="btn btn-primary" onclick="editAction()">Cập nhật</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>

    $("#frm-capnhat").submit(function() {
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
            var dataString = $(this).serialize();
            var action = $("#frm-capnhat").attr("action");
            $.ajax({
                type: "POST",
                url: action,
                data: dataString,
                dataType: "json", //change to your own, else read my note above on enabling the JsonValueProviderFactory in MVC
                success: function(mss) {
                    if(mss.status)
                    {
                        $.notify(mss.message, "success");
                        $("#modal-edit").modal("hide");
                        $("#modal-edit").empty();
                        //-----------------------------------
                        reloadAction();
                    }
                    else
                    {
                        $.notify(mss.message, "error");
                    }
//                    console.log(mss);
                },
                error: function() {
                    $.notify("Lỗi. Cập nhật thất bại", "error");
                }
            });
        }
        return false;
    });

    var editAction = function () {
        $("#frm-capnhat").submit();
    }
</script>
