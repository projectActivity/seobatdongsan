<div class="modal-dialog" role="document" style="width: 1000px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Cập nhật BlockContent: {{ $blockcontent->LoaiBlock->ten }}</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/blockcontent/update" role="form" method="POST" id="frm-capnhat">
                    <div class="col-md-12">
                        <input type="hidden" name="id" value="{{ $blockcontent->id  }}">
                        <div class="form-group">
                            <label>Tên BlockContent</label> <span class="requireTxt">(*)</span>
                            <input name="tenblock" type="text" class="form-control required" placeholder="Tên BlockContent" required value="{{ $blockcontent->tenblock }}">
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label> <span class="requireTxt">(*)</span>
                            <textarea name="tomtat" class="form-control required" style="height: 150px" placeholder="Tóm tắt" >{{ $blockcontent->tomtat }}</textarea>
                            <div class="note-error">
                                <span class="error mes-note-error" id="errNoiDung"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label> <span class="requireTxt">(*)</span>
                            <textarea id="editor1" name="noidung" class="form-control required" row="8" placeholder="Nội dung" > {{ $blockcontent->noidung }}</textarea>
                            <div class="note-error">
                                <span class="error mes-note-error" id="errNoiDung"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" value="1" @if($blockcontent->hienthi == 1) {{'checked'}} @endif name="hienthi">Hiện thị</label>
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
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
    $("#frm-capnhat").submit(function() {
        var valueArea = CKEDITOR.instances['editor1'].getData();
        var err=0;
        if (valueArea.length==0)
        {
            $("#errNoiDung").html("Vui lòng nhập thông tin này");
            $("#errNoiDung").css("display","inline");
            err+=1;
        }else {
            $("#errNoiDung").css("display","none");
            $("#editor1").html(valueArea);
        }
        err += checkForm("frm-themmoi")?0:1;
        if (err) {
            return false;
        }
        var data = $(this).serialize();
        var action = $(this).attr('action');
        var method = $(this).attr('method');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'admin/blockcontent/update',
            data: data,
            dataType: "json", //change to your own, else read my note above on enabling the JsonValueProviderFactory in MVC
            success: function(mss) {

                $.notify(mss.message, "success");
                $("#modal-edit").modal("hide");
                $("#modal-edit").empty();
                //-----------------------------------
                reloadAction();
            },
            error: function() {
                $.notify("Lỗi. Cập nhật thất bại", "error");
            }
        });
        return false;
    });

    var editAction = function () {
        $("#frm-capnhat").submit();
    }
</script>
