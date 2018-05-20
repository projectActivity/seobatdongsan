<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="backend/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::User()->name  }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Thanh điều hướng</li>
            <li class="active">
                <a href="/admin">
                    <i class="fa fa-dashboard"></i> <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="/admin/album">
                    <i class="fa fa-files-o"></i><span>Album</span>
                </a>
            </li>
            <li>
                <a href="/admin/banner">
                    <i class="fa fa-th"></i> <span>Banner</span>
                </a>
            </li>
            <li>
                <a href="/admin/chude">
                    <i class="fa fa-laptop"></i><span>Chủ đề</span>
                </a>
            </li>
            <li>
                <a href="/admin/ghim">
                    <i class="fa fa-thumb-tack" aria-hidden="true"></i><span>Ghim bài</span>
                </a>
            </li>
            <li>
                <a href="/admin/lienhe">
                    <i class="fa fa-envelope"></i> <span>Đăng ký Email</span>
                </a>
            </li>
            <li>
                <a href="/admin/slide">
                    <i class="fa fa-picture-o" aria-hidden="true"></i> <span>Slide</span>
                </a>
            </li>
            <li>
                <a href="/admin/nguoidung">
                    <i class="fa fa-user"></i> <span>Người dùng</span>
                </a>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>