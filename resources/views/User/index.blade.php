@extends('LayoutUser')
@section('content')
    <!-- Begin Slider With Banner Area -->
    <div class="slider-with-banner">
        <div class="container">
            <div class="row">
                <!-- Begin Slider Area -->
                <div class="col-lg-8 col-md-8">
                    <div class="slider-area">
                        <div class="slider-active owl-carousel">
                            <!-- Begin Single Slide Area -->
                            @foreach ($sliders as $slider)
                                <div class="single-slide align-center-left  animation-style-01">
                                    <img class="bg-1" src="{{ asset('uploads/slider/' . $slider->hinh) }}">
                                    <div class="slider-progress"></div>
                                    <div class="slider-content">
                                        <h5>{!! $slider->tieude1 !!}</h5>
                                        <h2>{!! $slider->tieude2 !!}</h2>
                                        <h3>{!! $slider->tieude3 !!}</h3>
                                        <div class="default-btn slide-btn">
                                            <a class="links" href="{!! $slider->duongdan !!}">Xem Ngay</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Single Slide Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Slider Area End Here -->
                <!-- Begin Li Banner Area -->
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    <div class="li-banner" style="height: 225.99px;">
                        <a href="#">
                            <img src="https://news.nganluong.vn/wp-content/uploads/mua-hang-tra-gop-0-dong-nguoi-mua-hang-co-thuc-su-duoc-loi1.jpeg"
                                alt="">
                        </a>
                    </div>
                    <div class="li-banner mt-15 mt-sm-30 mt-xs-30" style="height: 234px;">
                        <a href="#">
                            <img src="https://noiphodien123.vn/wp-content/uploads/2022/02/bao-hanh.jpg" alt="">
                        </a>
                    </div>
                </div>
                <!-- Li Banner Area End Here -->
            </div>
        </div>
    </div>
    <!-- Slider With Banner Area End Here -->
    <!-- Begin Product Area -->
    <div class="product-area pt-60 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-2" style="max-width: 8.7% !important;">
                    <span
                        style=" font-size: 14px; line-height: 14px; color: #555; margin-right: 20px; display: inline-block; ">Ưu
                        tiên:</span>
                </div>
                <div class="col-lg-10" style="margin-left: -3%;">
                    <div class="btn-group ml-2">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#li-new-product"><span>Mới Ra Mắt</span></a></li>
                            <li><a data-toggle="tab" href="#li-bestseller-product"><span>Ưu Đãi</span></a></li>
                            <li><a data-toggle="tab" href="#li-featured-product-max"><span>Giá Cao</span></a></li>
                            <li><a data-toggle="tab" href="#li-featured-product-min"><span>Giá Thấp</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($sanpham_moi as $sp)
                                @php
                                    $hinh = explode('|', $sp->j_hinh->hinh);
                                @endphp
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('chitiet', $sp->masanpham) }}">
                                                <img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            @if (isset($sp->malaptop))
                                                <span
                                                    class="{{ $sp->j_laptop->tinhtrang == 0 ? 'sticker' : 'sticker-old' }}">
                                                    {{ $sp->j_laptop->tinhtrang == 0 ? 'Mới' : 'Cũ' }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="#">{{ isset($sp->malaptop) ? 'Laptop' : 'Phụ Kiện' }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <h5 class="manufacturer">
                                                            <a href="#">SP{{ $sp->masanpham }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('chitiet', $sp->masanpham) }}">{{ $sp->tensanpham }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    @if ($sp->giaban > 0)
                                                        @if ($sp->giakhuyenmai > 0)
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giakhuyenmai) }}</span>
                                                            <span class="old-price">{{ number_format($sp->giaban) }}</span>
                                                        @else
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giaban) }}</span>
                                                        @endif
                                                    @else
                                                        <span class="new-price new-price-2">Liên Hệ</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <input type="hidden" class="soLuongGh{{ $sp->masanpham }}"
                                                        value="1">
                                                    <li class="add-cart active"><a class="clickThemGh"
                                                            data-id_gh="{{ $sp->masanpham }}" href="#">Thêm Giỏ
                                                            Hàng</a></li>
                                                    <li><a class="links-details clickThemYt" href="#"
                                                            data-id_yeuThich="{{ $sp->masanpham }}"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" data-count="{{ count($hinh) }}"
                                                            title="quick view" class="quick-view-btn clickQuick"
                                                            data-quick_id="{{ $sp->masanpham }}"><i
                                                                class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($sanpham_moi as $sp)
                                @php
                                    $hinh = explode('|', $sp->j_hinh->hinh);
                                @endphp
                                @if ($sp->giakhuyenmai > 0)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{ route('chitiet', $sp->masanpham) }}">
                                                    <img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                @if (isset($sp->malaptop))
                                                    <span
                                                        class="{{ $sp->j_laptop->tinhtrang == 0 ? 'sticker' : 'sticker-old' }}">
                                                        {{ $sp->j_laptop->tinhtrang == 0 ? 'Mới' : 'Cũ' }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a
                                                                href="#">{{ isset($sp->malaptop) ? 'Laptop' : 'Phụ Kiện' }}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <h5 class="manufacturer">
                                                                <a href="#">SP{{ $sp->masanpham }}</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name"
                                                            href="{{ route('chitiet', $sp->masanpham) }}">{{ $sp->tensanpham }}</a>
                                                    </h4>
                                                    <div class="price-box">
                                                        @if ($sp->giaban > 0)
                                                            @if ($sp->giakhuyenmai > 0)
                                                                <span
                                                                    class="new-price new-price-2">{{ number_format($sp->giakhuyenmai) }}</span>
                                                                <span
                                                                    class="old-price">{{ number_format($sp->giaban) }}</span>
                                                            @else
                                                                <span
                                                                    class="new-price new-price-2">{{ number_format($sp->giaban) }}</span>
                                                            @endif
                                                        @else
                                                            <span class="new-price new-price-2">Liên Hệ</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <input type="hidden" class="soLuongGh{{ $sp->masanpham }}"
                                                            value="1">
                                                        <li class="add-cart active"><a class="clickThemGh"
                                                                data-id_gh="{{ $sp->masanpham }}" href="#">Thêm Giỏ
                                                                Hàng</a></li>
                                                        <li><a class="links-details clickThemYt" href="#"
                                                                data-id_yeuThich="{{ $sp->masanpham }}"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" data-count="{{ count($hinh) }}"
                                                                title="quick view" class="quick-view-btn clickQuick"
                                                                data-quick_id="{{ $sp->masanpham }}"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="li-featured-product-max" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($sanpham_cao as $sp)
                                @php
                                    $hinh = explode('|', $sp->j_hinh->hinh);
                                @endphp
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('chitiet', $sp->masanpham) }}">
                                                <img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            @if (isset($sp->malaptop))
                                                <span
                                                    class="{{ $sp->j_laptop->tinhtrang == 0 ? 'sticker' : 'sticker-old' }}">
                                                    {{ $sp->j_laptop->tinhtrang == 0 ? 'Mới' : 'Cũ' }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="shop-left-sidebar.html">{{ isset($sp->malaptop) ? 'Laptop' : 'Phụ Kiện' }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <h5 class="manufacturer">
                                                            <a href="#">SP{{ $sp->masanpham }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('chitiet', $sp->masanpham) }}">{{ $sp->tensanpham }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    @if ($sp->giaban > 0)
                                                        @if ($sp->giakhuyenmai > 0)
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giakhuyenmai) }}</span>
                                                            <span
                                                                class="old-price">{{ number_format($sp->giaban) }}</span>
                                                        @else
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giaban) }}</span>
                                                        @endif
                                                    @else
                                                        <span class="new-price new-price-2">Liên Hệ</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <input type="hidden" class="soLuongGh{{ $sp->masanpham }}"
                                                        value="1">
                                                    <li class="add-cart active"><a class="clickThemGh"
                                                            data-id_gh="{{ $sp->masanpham }}" href="#">Thêm Giỏ
                                                            Hàng</a></li>
                                                    <li><a class="links-details clickThemYt" href="#"
                                                            data-id_yeuThich="{{ $sp->masanpham }}"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" data-count="{{ count($hinh) }}"
                                                            title="quick view" class="quick-view-btn clickQuick"
                                                            data-quick_id="{{ $sp->masanpham }}"><i
                                                                class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="li-featured-product-min" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($sanpham_thap as $sp)
                                @php
                                    $hinh = explode('|', $sp->j_hinh->hinh);
                                @endphp
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('chitiet', $sp->masanpham) }}">
                                                <img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            @if (isset($sp->malaptop))
                                                <span
                                                    class="{{ $sp->j_laptop->tinhtrang == 0 ? 'sticker' : 'sticker-old' }}">
                                                    {{ $sp->j_laptop->tinhtrang == 0 ? 'Mới' : 'Cũ' }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="shop-left-sidebar.html">{{ isset($sp->malaptop) ? 'Laptop' : 'Phụ Kiện' }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <h5 class="manufacturer">
                                                            <a href="#">SP{{ $sp->masanpham }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('chitiet', $sp->masanpham) }}">{{ $sp->tensanpham }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    @if ($sp->giaban > 0)
                                                        @if ($sp->giakhuyenmai > 0)
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giakhuyenmai) }}</span>
                                                            <span
                                                                class="old-price">{{ number_format($sp->giaban) }}</span>
                                                        @else
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giaban) }}</span>
                                                        @endif
                                                    @else
                                                        <span class="new-price new-price-2">Liên Hệ</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <input type="hidden" class="soLuongGh{{ $sp->masanpham }}"
                                                        value="1">
                                                    <li class="add-cart active"><a class="clickThemGh"
                                                            data-id_gh="{{ $sp->masanpham }}" href="#">Thêm Giỏ
                                                            Hàng</a></li>
                                                    <li><a class="links-details clickThemYt" href="#"
                                                            data-id_yeuThich="{{ $sp->masanpham }}"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" data-count="{{ count($hinh) }}"
                                                            title="quick view" class="quick-view-btn clickQuick"
                                                            data-quick_id="{{ $sp->masanpham }}"><i
                                                                class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Begin Lis Static Banner Area -->
    <div class="li-static-banner li-static-banner-4 text-center pt-20">
        <div class="container">
            <div class="row">
                <!-- Begin Single Banner Area -->
                <div class="col-lg-6">
                    <div class="single-banner pb-sm-30 pb-xs-30">
                        <a href="#">
                            <img src="{{ asset('user/images/banner/2_3.png') }}" alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
                <!-- Single Banner Area End Here -->
                <!-- Begin Single Banner Area -->
                <div class="col-lg-6">
                    <div class="single-banner">
                        <a href="#">
                            <img src="{{ asset('user/images/banner/2_4.png') }}" alt="Li's Static Banner">
                        </a>
                    </div>
                </div>
                <!-- Single Banner Area End Here -->
            </div>
        </div>
    </div>
    <!-- Lis Static Banner Area End Here -->
    <!-- Begin Lis Laptop Product Area -->
    <section class="product-area li-laptop-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Lis Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Laptop</span>
                        </h2>
                        <ul class="li-sub-category-list">
                            <li class="active"><a href="shop-left-sidebar.html">Xem Ngay</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($laptop as $sp)
                                @php
                                    $hinh = explode('|', $sp->j_hinh->hinh);
                                @endphp
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('chitiet', $sp->masanpham) }}">
                                                <img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            @if (isset($sp->malaptop))
                                                <span
                                                    class="{{ $sp->j_laptop->tinhtrang == 0 ? 'sticker' : 'sticker-old' }}">
                                                    {{ $sp->j_laptop->tinhtrang == 0 ? 'Mới' : 'Cũ' }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="shop-left-sidebar.html">{{ isset($sp->malaptop) ? 'Laptop' : 'Phụ Kiện' }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <h5 class="manufacturer">
                                                            <a href="#">SP{{ $sp->masanpham }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('chitiet', $sp->masanpham) }}">{{ $sp->tensanpham }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    @if ($sp->giaban > 0)
                                                        @if ($sp->giakhuyenmai > 0)
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giakhuyenmai) }}</span>
                                                            <span
                                                                class="old-price">{{ number_format($sp->giaban) }}</span>
                                                        @else
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giaban) }}</span>
                                                        @endif
                                                    @else
                                                        <span class="new-price new-price-2">Liên Hệ</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <input type="hidden" class="soLuongGh{{ $sp->masanpham }}"
                                                        value="1">
                                                    <li class="add-cart active"><a class="clickThemGh"
                                                            data-id_gh="{{ $sp->masanpham }}" href="#">Thêm Giỏ
                                                            Hàng</a></li>
                                                    <li><a class="links-details clickThemYt" href="#"
                                                            data-id_yeuThich="{{ $sp->masanpham }}"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" data-count="{{ count($hinh) }}"
                                                            title="quick view" class="quick-view-btn clickQuick"
                                                            data-quick_id="{{ $sp->masanpham }}"><i
                                                                class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Lis Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Lis Laptop Product Area End Here -->
    <!-- Begin Lis TV & Audio Product Area -->
    <section class="product-area li-laptop-product li-tv-audio-product pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Lis Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Phụ Kiện</span>
                        </h2>
                        <ul class="li-sub-category-list">
                            <li class="active"><a href="shop-left-sidebar.html">Xem Ngay</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($phukien as $sp)
                                @php
                                    $hinh = explode('|', $sp->j_hinh->hinh);
                                @endphp
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('chitiet', $sp->masanpham) }}">
                                                <img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            @if (isset($sp->malaptop))
                                                <span
                                                    class="{{ $sp->j_laptop->tinhtrang == 0 ? 'sticker' : 'sticker-old' }}">
                                                    {{ $sp->j_laptop->tinhtrang == 0 ? 'Mới' : 'Cũ' }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a
                                                            href="shop-left-sidebar.html">{{ isset($sp->malaptop) ? 'Laptop' : 'Phụ Kiện' }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <h5 class="manufacturer">
                                                            <a href="#">SP{{ $sp->masanpham }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('chitiet', $sp->masanpham) }}">{{ $sp->tensanpham }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    @if ($sp->giaban > 0)
                                                        @if ($sp->giakhuyenmai > 0)
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giakhuyenmai) }}</span>
                                                            <span
                                                                class="old-price">{{ number_format($sp->giaban) }}</span>
                                                        @else
                                                            <span
                                                                class="new-price new-price-2">{{ number_format($sp->giaban) }}</span>
                                                        @endif
                                                    @else
                                                        <span class="new-price new-price-2">Liên Hệ</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <input type="hidden" class="soLuongGh{{ $sp->masanpham }}"
                                                        value="1">
                                                    <li class="add-cart active"><a class="clickThemGh"
                                                            data-id_gh="{{ $sp->masanpham }}" href="#">Thêm Giỏ
                                                            Hàng</a></li>
                                                    <li><a class="links-details clickThemYt" href="#"
                                                            data-id_yeuThich="{{ $sp->masanpham }}"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" data-count="{{ count($hinh) }}"
                                                            title="quick view" class="quick-view-btn clickQuick"
                                                            data-quick_id="{{ $sp->masanpham }}"><i
                                                                class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Lis Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Lis TV & Audio Product Area End Here -->
    <!-- Begin Lis Static Home Area -->
    <div class="li-static-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Lis Static Home Image Area -->
                    <div class="li-static-home-image"></div>
                    <!-- Lis Static Home Image Area End Here -->
                    <!-- Begin Lis Static Home Content Area -->
                    <div class="li-static-home-content">
                    </div>
                    <!-- Lis Static Home Content Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Lis Static Home Area End Here -->
    <div class="group-featured-product pt-60 pb-40 pb-xs-25">
        <div class="container">
            <div class="row">
               
               
            </div>
        </div>
    </div>
@endsection
