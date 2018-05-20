<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Thêm mới người dùng</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/nguoidung/savecreate" role="form" enctype="multipart/form-data" method="POST" id="frm-themmoi">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Họ tên</label> <span class="requireTxt">(*)</span>
                            <input name="taiKhoan" id="taiKhoan" type="text" class="form-control required" placeholder="Tài khoản" >
                            <div class="note-error">
                                <span class="error mes-note-error" id="errTaiKhoan"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label> <span class="requireTxt">(*)</span>
                            <input name="email" id="email" type="text" class="form-control validateEmail" placeholder="Email" >
                            <div class="note-error">
                                <span class="error mes-note-error" id="errEmail"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label> <span class="requireTxt">(*)</span>
                            <input type="password" name="matKhau" id="matKhau" class="form-control required"  placeholder="Mật khẩu" ></input>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label> <span class="requireTxt">(*)</span>
                            <input type="password" name="nhapLaiMatKhau" id="nhapLaiMatKhau" class="form-control required"  placeholder="Mật khẩu" ></textarea>
                            <div class="note-error">
                                <span class="error mes-note-error" id="errMatKhau"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <div class="center">
                <button type="button" class="btn btn-primary" onclick="SaveCreateAction()">Thêm mới</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>

    $("#email").change(function () {
        var name = $("#email").val();
        if(name.length>0)
        {
            checkExist(name);
        }

    });
    function SaveCreateAction()
    {
        $("#frm-themmoi").submit();
    }

    function checkExist(name) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/admin/nguoidung/checkexist',
            data: {'taikhoan': name},
            dataType: "json",
            success: function(rs) {
             if(rs.status)
             {
                 $("#errEmail").html("Email đã tồn tại");
                 $("#errEmail").css("display",'inline');
                 $("#email").val("");
             }else
             {
                 $("#errEmail").css("display",'none');
             }
            },
            error: function() {
                $.notify("Loi. Không thực hiện được thao tác", "error");
            }
        });
    }


    $("#frm-themmoi").submit(function() {
        event.preventDefault();
        var valid = checkForm("frm-themmoi");

        var mk = $("#matKhau").val();
        var remk = $("#nhapLaiMatKhau").val();

        var data = $(this).serialize();
        var url = $(this).attr('action');
        var post = $(this).attr('method');
        if (!valid) {
            return false;
        } else {

            if(mk!=remk)
            {
                $("#errMatKhau").html("Mật khẩu phải giống nhau.");
                $("#errMatKhau").css("display","inline");
                $("#nhapLaiMatKhau").val("");
            }else
            {
                $("#errMatKhau").css("display","none");
                $.ajax({
                    type: "POST",
                    url: '/admin/nguoidung/create',
                    data: data,
                    dataType: "json",
                    success: function(rs) {
                        if(rs.status)
                        {
                            $.notify("Thêm mới người dùng thành công", "success");
                            $("#modal-create").modal("hide");
                            ReloadAction();
                        }else{
                            $.notify("Thêm mới người dùng thất bại", "error");
                        }
                        //reloadAction();
                    },
                    error: function() {
                        $.notify("Loi. Them that bai", "error");
                    }
                });
            }


        }

        return false;


    });
</script>