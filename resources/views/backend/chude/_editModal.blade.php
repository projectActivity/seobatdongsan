<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <div class="center">
                <h4 class="modal-title">Sửa chủ đề</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="/admin/chude/update" role="form" enctype="multipart/form-data" method="POST" id="frm-capnhat">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
                        <input type="hidden" name="id" value="{{ $chude->id }}">
                        <div class="form-group">
                            <label>Tên chủ đề</label> <span class="requireTxt">(*)</span>
                            <input name="tenchude" type="text" class="form-control required" placeholder="Tên chủ đề" value="{{ $chude->tenchude }}">
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tên thương mại</label> <span class="requireTxt">(*)</span>
                            <input name="tenthuongmai" type="text" class="form-control required" placeholder="Tên thương mại" value="{{ $chude->tenthuongmai }}">
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keyword</label> <span class="requireTxt">(*)</span>
                            <input name="keyword" type="text" value="{{ $chude->keyword }}" class="form-control required" placeholder="Keyword" required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label> <span class="requireTxt">(*)</span>
                            <textarea name="description" class="form-control required" style="height: 150px" placeholder="Description" required>{{ $chude->description }}</textarea>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label> <span class="requireTxt">(*)</span>
                            <textarea name="tomtat" class="form-control required" style="height: 150px" placeholder="Tóm tắt">{{ $chude->tomtat }}</textarea>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        @if ($chude->duan == 1)
                            <div class="form-group">
                                <label class="checkbox-inline"><input type="checkbox" value="1" @if($chude->trongtam == 1) {{'checked'}} @endif  name="trongtam">Trọng tâm</label>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" value="1" @if($chude->noibat == 1) {{'checked'}} @endif name="noibat">Nổi bật</label>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <img class="img-responsive pad" src="upload/hinhanh/{{ $chude->hinhanh }}" alt="{{ $chude->tenchude }}">
                            <input type="file" name="hinhanh">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="center">
                <button type="button" class="btn btn-success" onclick="CapNhatChuDe({{ $chude->id }})">Cập nhật</button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<script>
$("#frm-capnhat").submit(function() {
    event.preventDefault();
    var valid = checkForm("frm-capnhat");
    if (valid) {
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
        } else {
            // regular form, do your own thing if you need it
        }
        $.ajax({
            type: "POST",
            url: action,
            data: dataString,
            dataType: "json", //change to your own, else read my note above on enabling the JsonValueProviderFactory in MVC
            contentType: false,
            processData: false,
            success: function(mss) {

                if (mss.status) {

                    $.notify(mss.message, "success");
                    $("#modal-edit").modal("hide");
                    $("#modal-edit").html();
                    reloadAction();
                } else {
                    $.notify(mss.message, "error");
                }
            },
            error: function() {
                $.notify("Loi. Them that bai", "error");
            }
        });
    }
    return false;
})

var CapNhatChuDe = function(id) {
    $("#frm-capnhat").submit();
}
</script>