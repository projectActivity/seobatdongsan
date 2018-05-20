<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <div class="center">
                <h4 class="modal-title">Xác nhận xóa dữ liệu</h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <h4>Bạn có chắc chắn muốn xóa ?</h4>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="center">
                <button type="button" class="btn btn-success" onclick="RemoveAction({{ $obj->id }})">Xác nhận
                </button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Đóng</button>

            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>


<script>
    var RemoveAction = function(id) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/admin/nguoidung/delete',
            data:{'id':id},
            dataType: 'json',
            success: function(mss) {
                if(mss.status){
                    $.notify("Xóa người dùng thành công", "success");
                    $("#modal-delete").modal("hide");
                    ReloadAction();
                }
                else {
                    $.notify(mss.message, "error");
                }

            },
            error: function() {
                $.notify("Loi. Xoa that bai", "error");
            }
        })
    }
</script>