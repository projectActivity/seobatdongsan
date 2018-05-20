<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Cập nhật Banner</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/banner/update" role="form" enctype="multipart/form-data" method="POST" id="frm-capnhat">
                    <div class="col-md-12">
                        <input type="hidden" name="id" value="{{ $banner->id }}">
                        <div class="form-group">
                            <label>Tên banner</label> <span class="requireTxt">(*)</span>
                            <input name="tenbanner" type="text" value="{{ $banner->tenbanner  }}" class="form-control required" placeholder="Tên " required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Vị trí</label> <span class="requireTxt">(*)</span>
                            <input name="vitri" type="number" value="{{ $banner->vitri  }}" class="form-control required" placeholder="Vị trí" required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" value="1" @if($banner->hienthi == 1) {{'checked'}} @endif name="hienthi">Hiện thị</label>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label> <span class="requireTxt">(*)</span>
                            <img class="img-responsive pad" src="upload/hinhanh/{{ $banner->hinhanh }}" alt="{{ $banner->tenbanner }}">
                            <input type="file" name="hinhanh" required>
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
