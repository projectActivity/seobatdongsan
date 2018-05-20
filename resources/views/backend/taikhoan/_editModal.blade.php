<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Cập nhật người dùng - {{$obj->email}}</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/nguoidung/savecreate" role="form" enctype="multipart/form-data" method="POST" id="frm-edit">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
                    <input type = "hidden" name = "id" value = "{{$obj->id}}" />
                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Họ tên</label> <span class="requireTxt">(*)</span>
                            <input name="taiKhoan" id="taiKhoan" value="{{$obj->name}}" type="text" class="form-control required" placeholder="Tài khoản" >
                            <div class="note-error">
                                <span class="error mes-note-error" id="errTaiKhoan"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <div class="center">
                <button type="button" class="btn btn-primary" onclick="SaveEditAction()">Lưu</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>

    function SaveEditAction()
    {
        $("#frm-edit").submit();
    }



    $("#frm-edit").submit(function() {
        event.preventDefault();
        var valid = checkForm("frm-edit");


        var data = $(this).serialize();

        if (!valid) {
            return false;
        } else {

            $.ajax({
                type: "POST",
                url: '/admin/nguoidung/edit',
                data: data,
                dataType: "json",
                success: function(rs) {
                    if(rs.status)
                    {
                        $.notify("Cập nhật người dùng thành công", "success");
                        $("#modal-edit").modal("hide");
                        ReloadAction();
                    }else{
                        $.notify(rs.message, "error");
                    }
                    //reloadAction();
                },
                error: function() {
                    $.notify("Loi. Them that bai", "error");
                }
            });


        }

        return false;


    });
</script>