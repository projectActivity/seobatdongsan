<div id="dangKyEmail">
    <div class="form-email">
        <div class="title">ĐĂNG KÝ NHẬN THÔNG TIN</div>
        <div class="content">
            <form class="form-horizontal" method="post" action="/dangkyemail" id="frm-dangkyemail">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label">Họ tên</label> <span class="requireTxt">(*)</span>
                    <div>
                        <input type="text" name="hoten" class="form-control"/>
                        <div class="note-error">
                            <span class="error mes-note-error" id="errMatKhau"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label> <span class="requireTxt">(*)</span>
                    <div>
                        <input type="text" name="email" class="form-control"/>
                        <div class="note-error">
                            <span class="error mes-note-error" id="errMatKhau"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Số điện thoại</label> <span class="requireTxt">(*)</span>
                    <div>
                        <input type="text" name="sodienthoai" class="form-control"/>
                        <div class="note-error">
                            <span class="error mes-note-error" id="errMatKhau"></span>
                        </div>
                    </div>
                </div>
                <div class="center">
                    <button class="btn btn-default btn-lg">
                        ĐĂNG KÝ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>