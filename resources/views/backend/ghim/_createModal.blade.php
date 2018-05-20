<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="center">
                <h4 class="modal-title">Thêm mới bài ghim</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="/admin/ghim/store" role="form" method="POST" id="frm-themmoi">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Danh sách bài viết</label>
                            <select name="baiviet" class="form-control" style="width: 100%;">
                                @foreach ($dsbaighim as $baighim)
                                    <option label="{{ $baighim->tenbaiviet }}" value="{{ $baighim->id }}">{{ $baighim->tenbaiviet }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên bài ghim</label> <span class="requireTxt">(*)</span>
                            <input name="tenbaighim" type="text" class="form-control required" placeholder="Tên bài ghim" >
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Liên kết</label> <span class="requireTxt">(*)</span>
                            <input name="url" type="text" class="form-control required" placeholder="Liên kết " required>
                            <div class="note-error">
                                <span class="error mes-note-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline"><input type="checkbox" value="1" name="trangthai" >Trạng thái</label>
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

//    function changeBaiViet(giatri) {
//        $("#tenbaighim").val(giatri);
//    }

    $("#frm-themmoi").submit(function () {
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

            var data = $("#frm-themmoi").serialize();

            $.ajax({
                type: 'POST',
                url: '/admin/ghim/store',
                dataType: 'json',
                data: data,
                success: function (mss) {
                    if(mss.status) {

                        $("#modal-create").modal("hide");
                        $("#modal-create").html();
                        $.notify(mss.message, 'success');
                        reloadAction();
                    } else {
                        $.notify(mss.message, 'error');
                    }
                },
                error: function () {
                    $.notify("Lỗi thao tác", 'error');
                }
            })
        }
        return false;
    })

    var createAction = function () {
        $("#frm-themmoi").submit();
    }


</script>