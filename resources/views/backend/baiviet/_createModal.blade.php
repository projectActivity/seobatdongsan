<div class="modal-dialog" role="document" style="width: 1000px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Thêm mới bài viết</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/baiviet/store" role="form" enctype="multipart/form-data" method="POST" id="frm-themmoi">
                    <div class="col-md-12">
                        <input type="hidden" name="idchude" value="{{ $idchude }}">
                        <div class="form-group">
                            <label>Tên bài viết</label> <span class="requireTxt">(*)</span>
                            <input name="tenbaiviet" type="text" class="form-control required" placeholder="Tên bài viết" required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keyword</label> <span class="requireTxt">(*)</span>
                            <input name="keyword" type="text" class="form-control required" placeholder="Keywords" required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label> <span class="requireTxt">(*)</span>
                            <textarea name="description" class="form-control required" row="8" placeholder="Description" required></textarea>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label> <span class="requireTxt">(*)</span>
                            <textarea name="tomtat" class="form-control required" row="8" placeholder="Tóm tắt" required></textarea>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label> <span class="requireTxt">(*)</span>
                            <textarea id="editor1" name="noidung" class="form-control " row="8" placeholder="Nội dung" ></textarea>
                            <div class="note-error">
                                <span class="error mes-note-error" id="errNoiDung"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" value="1"  name="hienthi">Hiện thị</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" value="1"  name="ghim">Ghim</label>
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
                <button type="button" class="btn btn-primary" onclick="createAction()">Thêm mới</button>
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

    $("#frm-themmoi").submit(function() {
        event.preventDefault();
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
        } else {

        }
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

                    $.notify(mss.message, "success");
                    // console.log(mss.noidung);
                    $("#modal-create").modal("hide");
                    $("#modal-create").empty();
                    //-----------------------------------
                    reloadAction();
                },
                error: function() {
                    $.notify("Lỗi. Thêm thất bại", "error");
                }
            });
        }
        return false;
    });

    var createAction = function () {
        $("#frm-themmoi").submit();
    }
</script>
