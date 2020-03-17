<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị Website</title>
    <link rel="stylesheet" href="{{ asset('public/backend/libs/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/libs/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/libs/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/tuan-style.css') }}">
    <style>
        pre{
            display: none;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <header class="header" id="header">
            <div class="header-brand"><img src="{{ asset('public/backend/images/logo-haui-size.png') }}" alt="logo">
                <h1>E-Shopper Quản Trị
                </h1>
            </div>
            <div class="dropdown header-account">
                <div class="header-account-name" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                    <h6><i class="fas fa-user"></i><span>
                    admin</span><i class="fas fa-caret-down"></i></h6>
                </div>
                <div class="dropdown-menu header-account-control" aria-labelledby="dropdownMenuLink"
                    x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 50px, 0px);">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user-cog"></i><span>Cập nhật</span></a>
                    <a class="dropdown-item" href="{{ url('admin/logout') }}">
                        <i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span></a></div>
            </div>
        </header>
        <!-- end HEADER-->
        <main class="main" id="main">
            <aside class="sidebar" id="sidebar">
                <nav>
                    <div class="sidebar-header">
                        <div class="sidebar-avt"><img src="{{ asset('public/backend/images/avt.jpg') }}" alt="avatar"></div>
                        <h6>Xin chào admin</h6>
                    </div>
                    <ul class="sidebar-tree list-inline">
                        <li class="treeview"><a href="{{ url('admin/dashboard') }}">
                                <i class="fas fa-chart-line"></i><span>Thống kê dữ liệu</span></a>
                        </li>
                        <li class="treeview"><a href="" class="treeview-not-link"><i
                                    class="fas fa-folder-open"></i><span>Danh mục</span><i
                                    class="fas fa-chevron-right toggle-rotate"></i></a>
                            <ul class="treeview-menu list-inline" style="display: none;">
                                <li><a href="{{ url('admin/categories') }}">Danh sách</a></li>
                                <li><a href="{{ url('admin/categories/create') }}">Thêm</a></li>
                            </ul>
                        </li>
                        <li class="treeview"><a href="" class="treeview-not-link"><i class="fas fa-code-branch"></i></i><span>Thương hiệu</span><i
                            class="fas fa-chevron-right toggle-rotate"></i></a>
                            <ul class="treeview-menu list-inline" style="display: none;">
                                <li><a href="{{ url('/admin/brands') }}">Danh sách</a></li>
                                <li><a href="{{ url('/admin/brands/create') }}">Thêm</a></li>
                            </ul>
                        </li>
                        <li class="treeview"><a href="" class="treeview-not-link"><i
                                    class="fas fa-database"></i><span>Sản phẩm</span><i
                                    class="fas fa-chevron-right toggle-rotate"></i></a>
                            <ul class="treeview-menu list-inline" style="">
                                <li><a href="{{ url('/admin/products') }}">Danh sách</a></li>
                                <li><a href="{{ url('/admin/products/create') }}">Thêm</a></li>
                            </ul>
                        </li>
                        <li class="treeview"><a href="{{ url('/admin/orders') }}"><i
                                    class="fas fa-cart-arrow-down"></i><span>Đơn hàng</span></a>
                        </li>
                        <li class="treeview"><a href="{{ url('/admin/customers') }}"><i
                                    class="fas fa-users"></i><span>Khách hàng</span></a>
                        </li>

                        {{-- <li class="treeview"><a href="" class="treeview-not-link"><i
                                    class="fas fa-user-lock"></i><span>Nhân viên</span><i
                                    class="fas fa-chevron-right toggle-rotate"></i></a>
                            <ul class="treeview-menu list-inline" style="">
                                <li><a href="http://localhost:8080/titiv1/admin/nhan-vien">Danh sách</a></li>
                                <li><a href="http://localhost:8080/titiv1/admin/nhan-vien/them">Thêm</a></li>
                            </ul>
                        </li> --}}
                        <li class="treeview"><a href="{{ url('/admin/settings') }}"><i class="fas fa-cog"></i><span>Cài đặt</span></a>
                </li>
                    </ul>
                </nav>
            </aside>
            <!-- end SIDEBAR-->
            <section class="block-center" id="block-center">
                <div class="inner-center" id="inner-center">
                    @yield('admin_content')
                </div>
            </section>
            <!-- end CONTENT-->
        </main>
        <footer></footer>
    </div>
    <script src="{{ asset('public/backend/libs/jquery/jquery-2.2.4.js') }}"></script>
    <script src="{{ asset('public/backend/libs/jquery/popper.min.js') }}"></script>
    <script src="{{ asset('public/backend/libs/bootstrap/bootstrap.min.js') }}"></script>


    <script src="{{ asset('public/backend/libs/counter/waypoint.js') }}"></script>
    <script src="{{ asset('public/backend/libs/counter/jquery.counterup.min.js') }}"></script>

    <script src="{{ asset('public/backend/libs/piechart-mater/rpie.js') }}"></script>

    <script src="{{ asset('public/backend/script.js') }}"></script>
    <script src={{ asset('public/backend/libs/ckeditor/ckeditor.js') }}></script>
    @yield('areaCKEditor')
    <script>

        //back pre page
      function goBack() {
          console.log("BACK...!");
          window.history.back();
      }
    </script>
</body>
</html>
