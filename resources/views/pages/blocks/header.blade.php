<header id="header">
    <!--header-->
    <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">

                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> (+84)34 258 2266</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>dinhthanhtuanaz@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ url('') }}"><img src="{{ asset('public/frontend/images/logo.png') }}" alt="logo-e-shopeer" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if(session()->has('customer_id'))
                            <li><a href="{{ url('cap-nhat.html') }}"><i class="fa fa-user"></i> Tài khoản</a></li>
                            @endif

                            {{-- <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li> --}}
                            @if(session()->has('customer_id'))
                            <li><a href="{{ url('thanh-toan.html') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            @endif
                            <li><a href="{{ url('gio-hang.html') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                            @if(session()->has('customer_id'))
                            <li><a href="{{ url('dang-xuat.html') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                            @else
                            <li><a href="{{ url('dang-nhap.html') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            @endif()
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="{{ url('') }}" class="active">Trang chủ</a></li>
                            <li><a href="{{ url('/san-pham.html') }}">Sản phẩm</a></li>
                            <li><a href="{{ url('/bai-viet.html') }}">Bài viết</a></li>
                            <li><a href="{{ url('/gio-hang.html') }}">Giỏ hàng</a></li>
                            <li><a href="{{ url('/lien-he.html') }}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Tìm kiếm sản phẩm" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
