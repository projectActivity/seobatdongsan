<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Cập nhật Album</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/album/update" role="form" method="POST" id="frm-capnhat">
                    <input type="hidden" value="{{ $album->id }}" name="id">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <img class="img-responsive pad" src="upload/hinhanh/{{ $album->hinhanh }}" alt="{{ $album->mota }}">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label> <span class="requireTxt">(*)</span>
                            <textarea name="mota" class="form-control required" row="8" placeholder="Nội dung" >{{ $album->mota }}</textarea>
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
                <button type="button" class="btn btn-primary" onclick="editAction()">Cập nhật</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#frm-capnhat").submit(function() {
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: method,
            url: url,
            data: data,
            dataType: 'json',
            success: function(mss) {

                $.notify(mss.message, "success");
                // console.log(mss.noidung);
                $("#modal-edit").modal("hide");
                $("#modal-edit").empty();
                //-----------------------------------
                reloadAction();
            },
            error: function() {
                $.notify("Loi. Them that bai", "error");
            }
        });
        return false;
    });

    var editAction = function() {
        $("#frm-capnhat").submit();
    }
</script>
