<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Thêm mới tài liệu</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/tailieu/store" role="form" enctype="multipart/form-data" method="POST" id="frm-themmoi">
                    <input type="hidden" value="{{ $idduan }}" name="idduan">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tên tài liệu</label> <span class="requireTxt">(*)</span>
                            <input name="tentailieu" type="text" class="form-control required" placeholder="Tên tài liệu" required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tài liệu</label> <span class="requireTxt">(*)</span>
                            <input class="required" type="file" name="tailieu" required>
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
                processData: false,
                contentType: false,
                success: function(mss) {
                    if(mss.status)
                    {
                        $.notify(mss.message, "success");
                        // console.log(mss.noidung);
                        $("#modal-create").modal("hide");
                        $("#modal-create").empty();
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
