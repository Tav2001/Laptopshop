<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- index28:48-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Van Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('user/images/favicon.png') }}">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{ asset('user/css/material-design-iconic-font.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{ asset('user/css/fontawesome-stars.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/meanmenu.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/owl.carousel.min.css') }}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/slick.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/animate.css') }}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/jquery-ui.min.css') }}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/venobox.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/nice-select.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/magnific-popup.css') }}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/helper.css') }}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('user/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}">
    <!-- Modernizr js -->
    <script src="{{ asset('user/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body id="reload-wrapper">
    <style>
        .select-search-category ul.list {
            height: 240px !important;
        }
    </style>
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <header>
            <!-- Begin Header Top Area -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Top Left Area -->
                        <div class="col-lg-3 col-md-4">
                            <div class="header-top-left"></div>
                        </div>
                        <!-- Header Top Left Area End Here -->
                        <!-- Begin Header Top Right Area -->
                        <div class="col-lg-9 col-md-8">
                            <div class="header-top-right">
                                <ul class="ht-menu">
                                    <!-- Begin Setting Area -->
                                    <li>
                                        <div class="{{ Session::has('dangnhap') ? 'ht-setting-trigger' : '' }}">
                                            @if (Session::has('dangnhap'))
                                                <span style="font-size: 15px"><i class="fa fa-user"></i>
                                                    {{ ucfirst(Session::get('dangnhap')['hoten']) }}</span>
                                            @else
                                                <a href="{{ route('danhsachtk') }}"><i class="fa fa-user"></i>
                                                    Đăng Nhập / Đăng Ký</a>
                                            @endif
                                        </div>
                                        @if (Session::has('dangnhap'))
                                            <div class="setting ht-setting">
                                                <ul class="ht-setting-list">
                                                    @if (Session::get('dangnhap')['loainguoidung'] == 2)
                                                        <li><a href="{{ route('tongquan.index') }}">Quản Lý</a></li>
                                                    @endif
                                                    <li><a href="{{ route('thongtintaikhoan') }}">Tài Khoản</a></li>
                                                    <li><a href="{{ route('dangxuat') }}">Đăng Xuất</a></li>
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                    <!-- Setting Area End Here -->
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Top Area End Here -->
            <!-- Begin Header Middle Area -->
            <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Logo Area -->
                        <div class="col-lg-3">
                            <div class="logo pb-sm-30 pb-xs-30">
                                <a href="{{ route('trangchu.index') }}">
                                    <img src="{{ asset('user/images/menu/logo/1.png') }}" alt="" style="width: 120px; height: 120px;">
                                </a>
                            </div>
                        </div>
                        <!-- Header Logo Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                            <!-- Begin Header Middle Searchbox Area -->
                            <form action="{{ route('timkiem') }}" class="hm-searchbox" method="GET">
                                <select name="loaiTimKiem" class="nice-select select-search-category">
                                    <option value="tatca">Tất Cả</option>
                                    <option value="laptop">Laptops</option>
                                    @foreach ($hangsx as $nsx)
                                        <option value="{{ $nsx->mahang }}">- - {{ $nsx->tenhang }}</option>
                                    @endforeach
                                    <option value="phukien">Phụ Kiện</option>
                                    @foreach ($hangsx_pk as $nsx)
                                        <option value="{{ $nsx->mahang }}">- - {{ $nsx->tenhang }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="tukhoa" placeholder="Tìm kiếm sản phẩm ...">
                                <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <!-- Header Middle Searchbox Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="header-middle-right">
                                <ul class="hm-menu">
                                    <!-- Begin Header Middle Wishlist Area -->
                                    <li class="hm-wishlist">
                                        <a href="{{ route('danhsachyeuthich') }}">
                                            <span
                                                class="cart-item-count wishlist-item-count">{{ Session::has('yeuthich') ? count(Session::get('yeuthich')) : '0' }}</span>
                                            <i class="fa fa-heart-o"></i>
                                        </a>
                                    </li>
                                    <!-- Header Middle Wishlist Area End Here -->
                                    <!-- Begin Header Mini Cart Area -->
                                    @php
                                        $tong = 0;
                                        foreach (Cart::content() as $sp) {
                                            $tong += $sp->price * $sp->qty;
                                        }
                                    @endphp
                                    <li class="hm-minicart">
                                        <div class="hm-minicart-trigger">
                                            <span class="item-icon"></span>
                                            <span class="item-text">Giỏ Hàng
                                                <span class="cart-item-count">{{ Cart::content()->count() }}</span>
                                            </span>
                                        </div>
                                        <span></span>
                                        <div class="minicart">
                                            <ul class="minicart-product-list">
                                                @foreach (Cart::content() as $sp)
                                                    <li>
                                                        <a href="{{ route('chitiet', $sp->id) }}"
                                                            class="minicart-product-image">
                                                            <img src="{{ asset('uploads/sanpham/' . $sp->options->image) }}"
                                                                alt="cart products">
                                                        </a>
                                                        <div class="minicart-product-details">
                                                            <h6><a
                                                                    href="{{ route('chitiet', $sp->id) }}">{{ $sp->name }}</a>
                                                            </h6>
                                                            <span>{{ number_format($sp->price) }} x
                                                                {{ $sp->qty }}</span>
                                                        </div>
                                                        <a href="{{ route('xoagh', $sp->rowId) }}">
                                                            <button class="close" title="Xóa">
                                                                <i class="fa fa-close"></i>
                                                            </button>
                                                        </a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                            <p class="minicart-total">Tổng: <span>{{ number_format($tong) }}</span>
                                            </p>
                                            <div class="minicart-button">
                                                <a href="{{ route('danhsachgh') }}"
                                                    class="li-button li-button-fullwidth li-button-dark">
                                                    <span>Xem Giỏ Hàng</span>
                                                </a>
                                                <a href="{{ Session::has('dangnhap') ? route('danhsachtt') : route('danhsachtk') }}"
                                                    class="li-button li-button-fullwidth">
                                                    <span>Thanh Toán</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Header Mini Cart Area End Here -->
                                </ul>
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Middle Area End Here -->
            <!-- Begin Header Bottom Area -->
            <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Header Bottom Menu Area -->
                            <div class="hb-menu">
                                <nav>
                                    <ul>
                                        <li><a href="{{ route('trangchu.index') }}">Trang chủ</a>
                                        </li>
                                        <li class="megamenu-holder"><a
                                                href="{{ route('danhsachsp', 'laptop') }}">Laptop</a>
                                            <ul class="megamenu hb-megamenu">
                                                <li><a href="#">Hãng Sản Xuất</a>
                                                    <ul>
                                                        @foreach ($hangsx as $nsx)
                                                            <li><a
                                                                    href="{{ route('danhsachsp', 'laptop') }}?hangsx={{ $nsx->mahang }}&loc=laptop">{{ $nsx->tenhang }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li><a href="#">Mức Giá</a>
                                                    <ul>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?mucgia=duoi-10&loc=laptop">Dưới
                                                                10 triệu</a></li>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?mucgia=tu-10-15&loc=laptop">10-15
                                                                triệu</a></li>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?mucgia=tu-15-20&loc=laptop">15-20
                                                                triệu</a></li>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?mucgia=tu-20-25&loc=laptop">20-25
                                                                triệu</a></li>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?mucgia=tren-25&loc=laptop">Trên
                                                                25 triệu</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Nhu Cầu Sử Dụng</a>
                                                    <ul>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?nhucau=gaming&loc=laptop">Laptop
                                                                Gaming</a></li>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?nhucau=Sinh Viên&loc=laptop">Laptop
                                                                Sinh Viên – Văn Phòng</a></li>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?nhucau=Doanh Nhân&loc=laptop">Laptop
                                                                Doanh Nhân</a></li>
                                                        <li><a
                                                                href="{{ route('danhsachsp', 'laptop') }}?nhucau=Mỏng Nhẹ&loc=laptop">Laptop
                                                                Mỏng nhẹ</a></li>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('danhsachsp', 'phukien') }}">phụ kiện</a></li>
                                        <li><a href="{{ route('danhsachbaiviet') }}">bài viết</a></li>
                                        <li><a href="{{ route('lienhe') }}">liên hệ</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Header Bottom Menu Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Bottom Area End Here -->
            <!-- Begin Mobile Menu Area -->
            <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                <div class="container">
                    <div class="row">
                        <div class="mobile-menu">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End Here -->
        </header>
        <!-- Header Area End Here -->
        @yield('content')
        <!-- Begin Footer Area -->
        <div class="footer">
            <!-- Begin Footer Static Top Area -->
            <div class="footer-static-top">
                <div class="container">
                    <!-- Begin Footer Shipping Area -->
                    <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                        <div class="row">
                            <!-- Begin Lis Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{ asset('user/images/shipping-icon/1.png') }}"
                                            alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Miễn Phí Vận Chuyển</h2>
                                        <p>Và trả lại miễn phí. Xem thanh toán để biết ngày giao hàng.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Lis Shipping Inner Box Area End Here -->
                            <!-- Begin Lis Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{ asset('user/images/shipping-icon/2.png') }}"
                                            alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Thanh Toán An Toàn</h2>
                                        <p>Thanh toán bằng các phương thức thanh toán an toàn và phổ biến nhất.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Lis Shipping Inner Box Area End Here -->
                            <!-- Begin Lis Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{ asset('user/images/shipping-icon/3.png') }}"
                                            alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Mua Sắm An Toàn</h2>
                                        <p>Bảo vệ bao gồm việc mua hàng từ khi nhấp chuột đến giao hàng.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{ asset('user/images/shipping-icon/4.png') }}"
                                            alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>24/7 Trung Tâm Trợ Giúp</h2>
                                        <p>Có câu hỏi? Gọi cho shop hoặc trò chuyện trực tuyến.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Lis Shipping Inner Box Area End Here -->
                        </div>
                    </div>
                    <!-- Footer Shipping Area End Here -->
                </div>
            </div>
            <!-- Footer Static Top Area End Here -->
            <!-- Begin Footer Static Middle Area -->
            <div class="footer-static-middle">
                <div class="container">
                    <div class="footer-logo-wrap pt-50 pb-35">
                        <div class="row">
                            <!-- Begin Footer Logo Area -->
                            <div class="col-lg-5 col-md-6">
                                <div class="footer-logo">
                                    
                                    <p class="info">
                                        Chuyên cung cấp Laptop Gaming, đồ họa, học tập, văn phòng
                                    </p>
                                </div>
                                <ul class="des">
                                    <li>
                                        <span>Địa Chỉ: </span> Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, TP.Cần Thơ
                                    </li>
                                    <li>
                                        <span>SĐT: </span>
                                        <a href="#">0780 499 599</a>
                                    </li>
                                    <li>
                                        <span>Email: </span>
                                        <a href="mailto://info@yourdomain.com">vanshop@gmail.com</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Footer Logo Area End Here -->
                            <!-- Begin Footer Block Area -->
                            <div class="col-lg-3">
                                <div class="footer-block">
                                    <h3 class="footer-block-title">Hotline Tư Vấn</h3>
                                    <ul>                                
                                        <li>
                                            <p class="info" style="margin-bottom: 0px !important;"><i
                                                    class="fa fa-phone"></i> Chăm Sóc Khách Hàng:</p>
                                        </li>
                                        <li><a class="ml-15" href="#">0941 578 785(Anh Văn)</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Footer Block Area End Here -->
                            <!-- Begin Footer Block Area -->
                            <div class="col-lg-4">
                                <!-- Begin Footer Newsletter Area -->
                                <div class="footer-block">
                                    <h3 class="footer-block-title">Thời Gian Làm Việc</h3>
                                    <ul>
                                        <li>
                                            <p class="info" style="margin-bottom: 0px !important;"><i
                                                    class="fa fa-clock-o"></i>Cửa hàng</p>
                                        </li>
                                        <li><a class="ml-15" href="#">8h30 - 21h00 (Mỗi ngày)</a></li>
                                    </ul>
                                </div>
                                <!-- Footer Newsletter Area End Here -->
                                <div class="footer-block">
                                    <h3 class="footer-block-title">Follow Us</h3>
                                    <ul class="social-link">
                                        <li class="twitter">
                                            <a href="https://twitter.com/" data-toggle="tooltip" target="_blank"
                                                title="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>                                        
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip"
                                                target="_blank" title="Google Plus">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank"
                                                title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="youtube">
                                            <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank"
                                                title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://www.instagram.com/" data-toggle="tooltip"
                                                target="_blank" title="Instagram">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Footer Block Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Static Middle Area End Here -->

        </div>
        <!-- Footer Area End Here -->

        <!-- Begin Quick View | Modal Area -->
        <div class="modal fade modal-wrapper" id="quickModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area row" id="loadQuickModal">
                            <div class="col-lg-5 col-md-6 col-sm-6">
                                <!-- Product Details Left -->
                                <div class="product-details-left">

                                    <div class="product-details-images slider-navigation-1">

                                        @for ($i = 0; $i < 5; $i++)
                                            <div class="lg-image displaySP loadlgimg_{{ $i }}">

                                            </div>
                                        @endfor

                                    </div>
                                    <div class="product-details-thumbs slider-thumbs-1">

                                        @for ($i = 0; $i < 5; $i++)
                                            <div class="sm-image displaySP loadlgimg_{{ $i }}">

                                            </div>
                                        @endfor

                                    </div>
                                </div>
                                <!--// Product Details Left -->
                            </div>

                            <div class="col-lg-7 col-md-6 col-sm-6">
                                <div class="product-details-view-content pt-60">
                                    <div class="product-info">
                                        <h2 id="nameSP"></h2>
                                        <span class="product-details-ref">Thương hiệu: <span id="nameNSX"></span> &nbsp; | &nbsp; SKU: SP<span id="maSP"></span> </span>
                                        <div class="price-box pt-20">
                                            <span class="new-price new-price-2" id="priceSP"></span>
                                            <span class="old-price displaySP" style="text-decoration: line-through;" id="oldPriceSP"></span>
                                        </div>
                                        <div class="product-desc">
                                            <p>
                                                <span id="descSP"></span>
                                            </p>
                                        </div>
                                        <div class="single-add-to-cart">
                                            <form action="#" class="cart-quantity">
                                                <div class="quantity">
                                                    <label>Số Lượng</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" id="qtySP" value="1"
                                                            type="text">
                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i>
                                                        </div>
                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button id="btnAddSP" class="add-to-cart clickThemGh" type="button">Thêm Giỏ Hàng</button>
                                            </form>
                                        </div>
                                        <div class="product-additional-info pt-25">
                                            <a id="wishListSP" class="wishlist-btn clickThemYt" href="#"><i
                                                    class="fa fa-heart-o"></i>Yêu Thích</a>
                                            <div class="product-social-sharing pt-25">
                                                <ul>
                                                    <li class="facebook"><a href="#"><i
                                                                class="fa fa-facebook"></i>Facebook</a></li>
                                                    <li class="twitter"><a href="#"><i
                                                                class="fa fa-twitter"></i>Twitter</a></li>
                                                    <li class="google-plus"><a href="#"><i
                                                                class="fa fa-google-plus"></i>Google +</a></li>
                                                    <li class="instagram"><a href="#"><i
                                                                class="fa fa-instagram"></i>Instagram</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View | Modal Area End Here -->

        <style>
            .displaySP {
                display: none !important;
            }
        </style>
    </div>
    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
    <!-- Body Wrapper End Here -->
    <!-- jQuery-V1.12.4 -->
    <script src="{{ asset('user/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('user/js/vendor/popper.min.js') }}"></script>
    <!-- Bootstrap V4.1.3 Fremwork js -->
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <!-- Ajax Mail js -->
    <script src="{{ asset('user/js/ajax-mail.js') }}"></script>
    <!-- Meanmenu js -->
    <script src="{{ asset('user/js/jquery.meanmenu.min.js') }}"></script>
    <!-- Wow.min js -->
    <script src="{{ asset('user/js/wow.min.js') }}"></script>
    <!-- Slick Carousel js -->
    <script src="{{ asset('user/js/slick.min.js') }}"></script>
    <!-- Owl Carousel-2 js -->
    <script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific popup js -->
    <script src="{{ asset('user/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Isotope js -->
    <script src="{{ asset('user/js/isotope.pkgd.min.js') }}"></script>
    <!-- Imagesloaded js -->
    <script src="{{ asset('user/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Mixitup js -->
    <script src="{{ asset('user/js/jquery.mixitup.min.js') }}"></script>
    <!-- Countdown -->
    <script src="{{ asset('user/js/jquery.countdown.min.js') }}"></script>
    <!-- Counterup -->
    <script src="{{ asset('user/js/jquery.counterup.min.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('user/js/waypoints.min.js') }}"></script>
    <!-- Barrating -->
    <script src="{{ asset('user/js/jquery.barrating.min.js') }}"></script>
    <!-- Jquery-ui -->
    <script src="{{ asset('user/js/jquery-ui.min.js') }}"></script>
    <!-- Venobox -->
    <script src="{{ asset('user/js/venobox.min.js') }}"></script>
    <!-- Nice Select js -->
    <script src="{{ asset('user/js/jquery.nice-select.min.js') }}"></script>
    <!-- ScrollUp js -->
    <script src="{{ asset('user/js/scrollUp.min.js') }}"></script>
    <!-- Main/Activator js -->
    <script src="{{ asset('user/js/main.js') }}"></script>

    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }

        @if ($errors->any())
            @foreach ($errors->all() as $err)
                alert('{{ $err }}');
            @endforeach
        @endif
    </script>
    <script>
        $(document).on('ready', function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').val()
                },
            });
        });
        function formatGia(n) {
            return n.toFixed(0)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        };


        $(document).on('click', '.clickQuick', function(e) {
            e.preventDefault();

            for(var i=0;i<5;i++){
                $('.loadlgimg_'+i).html('');
            }

            $('#oldPriceSP').addClass('displaySP');
            $('#quickModal').modal('show');
            var id = $(this).data('quick_id');
            $.post("{{ url('xem-nhanh') }}", {
                id: id
            }, function(res) {
                $('#nameSP').text(res.sanpham.tensanpham);
                $('#nameNSX').text(res.sanpham.tenhang);
                $('#maSP').text(res.sanpham.masanpham);

                if(res.sanpham.giaban > 0){
                    if(res.sanpham.giakhuyenmai > 0){
                        $('#priceSP').text(formatGia(res.sanpham.giakhuyenmai));
                        $('#oldPriceSP').removeClass('displaySP');
                        $('#oldPriceSP').text(formatGia(res.sanpham.giaban));
                    }else{
                        $('#priceSP').text(formatGia(res.sanpham.giaban));
                    }
                }else{
                    $('#priceSP').text('Liên Hệ');
                }
                $('#qtySP').addClass('acceptSP');
                $('#qtySP').addClass('soLuongGh_'+id);
                $('#btnAddSP').attr('data-id_gh',id);
                $('#wishListSP').attr('data-id_yeuThich',id);
                $('#descSP').text(res.descSP+res.descSPLen);

                $.each(res.hinh, function(key, value) {
                    $('.loadlgimg_'+key).removeClass('displaySP');
                    $('.loadlgimg_' + key).html('<img src="{{ URL::to('/') }}/uploads/sanpham/' + value +  '" alt="product image">')
                });
            });
        });

        $('.clickThemGh').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id_gh');
            var soluong = 0;
            if($('#qtySP').hasClass('acceptSP')){
                soluong = $('.soLuongGh_' + id).val();
            }else{
                soluong = $('.soLuongGh' + id).val();
            }

            $.ajax({
                type: 'post',
                url: '{{ route('themgh') }}',
                data: {
                    id: id,
                    soluong: soluong
                },
                success: function(res) {
                    if (res.status == 200) {
                        alert('Thêm giỏ hàng thành công!');
                        location.reload();
                    } else {
                        alert('Liên hệ 077.xxx.xnxx (Mr.T) để nhận được giá cụ thể nhất!');
                    }
                }
            });
        });

        $('.clickThemYt').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id_yeuthich');

            $.ajax({
                type: 'post',
                url: '{{ route('themyeuthich') }}',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.action == 'add') {
                        alert('Thêm yêu thích thành công!');
                    }
                    location.reload();
                }
            });
        });
    </script>
    @yield('js')
</body>

</html>
