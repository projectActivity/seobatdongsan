<header class="main-header">
    <!-- Logo -->
    <a href="javascript:void(0)" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>TheLife</b> - Group</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>TheLife</b> - Group</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="/admin/dangxuat">
                    <span class="hidden-xs">Chào mừng {{ Auth::User()->name  }}</span>, đăng xuất
                  </a>
                </li>
            </ul>
        </div>
    </nav>
</header>