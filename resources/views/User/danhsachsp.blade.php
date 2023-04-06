@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    <!-- Begin Lis Content Wraper Area -->
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">
            <div class="row mb-30">
                <div class="col-lg-12">
                    <!-- Begin Lis Banner Area -->
                    <div class="single-banner shop-page-banner">
                        <a href="#">
                            <img src="{{ asset('user/images/banner/bannersp.jpg') }}" alt="Li's Static Banner">
                        </a>
                    </div>
                    <!-- Lis Banner Area End Here -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-{{ $id == 'laptop' ? '9' : '12' }} order-1 order-lg-2">
                    <!-- shop-top-bar start -->
                    <div class="shop-top-bar">
                        <div class="shop-bar-inner">
                            <div class="product-view-mode">
                                <!-- shop-item-filter-list start -->
                                <ul class="nav shop-item-filter-list" role="tablist">
                                    <li class="active" role="presentation"><a aria-selected="true" class="active show"
                                            data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i
                                                class="fa fa-th"></i></a></li>
                                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view"
                                            href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                                <!-- shop-item-filter-list end -->
                            </div>
                            <div class="toolbar-amount">
                                <span>Tổng sản phẩm ({{ count($sanpham) }})</span>
                            </div>
                        </div>
                        <!-- product-select-box start -->
                        <div class="product-select-box">
                            <div class="product-short">
                                <p>Sắp Xếp:</p>
                                @php
                                    $sapXep = isset($_GET['sap-xep']) ? $_GET['sap-xep'] : '';
                                    $sapXepLaptop = isset($_GET['sapxep']) ? $_GET['sapxep'] : '';
                                @endphp
                                @if (isset($_GET['loaiTimKiem']))
                                    <select id="sapxepsp" class="nice-select">
                                        <option {{ $sapXep == 'moinhat' ? 'selected' : '' }}
                                            value="{{ url()->current() }}?loaiTimKiem={{ $_GET['loaiTimKiem'] }}&tukhoa={{ $_GET['tukhoa'] }}&sap-xep=moinhat">
                                            Mới Nhất</option>
                                        <option {{ $sapXep == 'banchay' ? 'selected' : '' }}
                                            value="{{ url()->current() }}?loaiTimKiem={{ $_GET['loaiTimKiem'] }}&tukhoa={{ $_GET['tukhoa'] }}&sap-xep=banchay">
                                            Bán chạy nhất</option>
                                        <option {{ $sapXep == 'uudai' ? 'selected' : '' }}
                                            value="{{ url()->current() }}?loaiTimKiem={{ $_GET['loaiTimKiem'] }}&tukhoa={{ $_GET['tukhoa'] }}&sap-xep=uudai">
                                            Ưu đãi</option>
                                        <option {{ $sapXep == 'giatang' ? 'selected' : '' }}
                                            value="{{ url()->current() }}?loaiTimKiem={{ $_GET['loaiTimKiem'] }}&tukhoa={{ $_GET['tukhoa'] }}&sap-xep=giatang">
                                            Giá tăng dần</option>
                                        <option {{ $sapXep == 'giagiam' ? 'selected' : '' }}
                                            value="{{ url()->current() }}?loaiTimKiem={{ $_GET['loaiTimKiem'] }}&tukhoa={{ $_GET['tukhoa'] }}&sap-xep=giagiam">
                                            Giá giảm dần</option>
                                    </select>
                                @else
                                    @if ($id == 'laptop')

                                        @if (isset($_GET['loc']))
                                            <select id="sapxepsp" class="nice-select">
                                                <option {{ $sapXepLaptop == 'moinhat' ? 'selected' : '' }} value="moinhat">
                                                    Mới
                                                    Nhất</option>
                                                <option {{ $sapXepLaptop == 'banchay' ? 'selected' : '' }} value="banchay">
                                                    Bán
                                                    chạy nhất</option>
                                                <option {{ $sapXepLaptop == 'uudai' ? 'selected' : '' }} value="uudai">
                                                    Ưu
                                                    đãi
                                                </option>
                                                <option {{ $sapXepLaptop == 'giatang' ? 'selected' : '' }} value="giatang">
                                                    Giá
                                                    tăng dần</option>
                                                <option {{ $sapXepLaptop == 'giagiam' ? 'selected' : '' }} value="giagiam">
                                                    Giá
                                                    giảm dần</option>
                                            </select>
                                        @else
                                            <select id="sapxepsp" class="nice-select">
                                                <option {{ $sapXep == 'moinhat' ? 'selected' : '' }}
                                                    value="{{ Request::url() }}?loai=0&sap-xep=moinhat">Mới Nhất
                                                </option>
                                                <option {{ $sapXep == 'banchay' ? 'selected' : '' }}
                                                    value="{{ Request::url() }}?loai=0&sap-xep=banchay">Bán chạy
                                                    nhất</option>
                                                <option {{ $sapXep == 'uudai' ? 'selected' : '' }}
                                                    value="{{ Request::url() }}?loai=0&sap-xep=uudai">Ưu đãi
                                                </option>
                                                <option {{ $sapXep == 'giatang' ? 'selected' : '' }}
                                                    value="{{ Request::url() }}?loai=0&sap-xep=giatang">Giá tăng
                                                    dần</option>
                                                <option {{ $sapXep == 'giagiam' ? 'selected' : '' }}
                                                    value="{{ Request::url() }}?loai=0&sap-xep=giagiam">Giá giảm
                                                    dần</option>
                                            </select>
                                        @endif
                                    @else
                                        <select id="sapxepsp" class="nice-select">
                                            <option {{ $sapXep == 'moinhat' ? 'selected' : '' }}
                                                value="{{ Request::url() }}?loai=1&sap-xep=moinhat">Mới Nhất
                                            </option>
                                            <option {{ $sapXep == 'banchay' ? 'selected' : '' }}
                                                value="{{ Request::url() }}?loai=1&sap-xep=banchay">Bán chạy nhất
                                            </option>
                                            <option {{ $sapXep == 'uudai' ? 'selected' : '' }}
                                                value="{{ Request::url() }}?loai=1&sap-xep=uudai">Ưu đãi</option>
                                            <option {{ $sapXep == 'giatang' ? 'selected' : '' }}
                                                value="{{ Request::url() }}?loai=1&sap-xep=giatang">Giá tăng dần
                                            </option>
                                            <option {{ $sapXep == 'giagiam' ? 'selected' : '' }}
                                                value="{{ Request::url() }}?loai=1&sap-xep=giagiam">Giá giảm dần
                                            </option>
                                        </select>

                                    @endif
                                @endif

                            </div>
                        </div>
                        <!-- product-select-box end -->
                    </div>
                    <!-- shop-top-bar end -->
                    <!-- shop-products-wrapper start -->
                    <div class="shop-products-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                <div class="product-area shop-product-area">
                                    <div class="row">
                                        @foreach ($sanpham as $sp)
                                            @php
                                                $hinh = explode('|', $sp->hinh);
                                            @endphp
                                            <div
                                                class="{{ $id == 'laptop' ? 'col-lg-4' : 'col-lg-3' }} col-md-4 col-sm-6 mt-40">
                                                <!-- single-product-wrap start -->
                                                <div class="single-product-wrap">
                                                    <div class="product-image">
                                                        <a href="{{ route('chitiet', $sp->masanpham) }}">
                                                            <img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}"
                                                                alt="Li's Product Image">
                                                        </a>
                                                        @if (isset($sp->malaptop))
                                                            @php
                                                                if (isset($sp->tinhtrang)) {
                                                                    $tinhtrang = $sp->tinhtrang;
                                                                } else {
                                                                    $tinhtrang = '';
                                                                }
                                                            @endphp
                                                            <span
                                                                class="{{ $tinhtrang == 0 ? 'sticker' : 'sticker-old' }}">
                                                                {{ $tinhtrang == 0 ? 'Mới' : 'Cũ' }}
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
                                                                        data-id_gh="{{ $sp->masanpham }}"
                                                                        href="#">Thêm Giỏ
                                                                        Hàng</a></li>
                                                                <li><a class="links-details clickThemYt" href="#"
                                                                        data-id_yeuThich="{{ $sp->masanpham }}"><i
                                                                            class="fa fa-heart-o"></i></a></li>
                                                                <li><a href="#" data-count="{{ count($hinh) }}"
                                                                        title="quick view"
                                                                        class="quick-view-btn clickQuick"
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
                            <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                                <div class="row">
                                    <div class="col">
                                        @foreach ($sanpham as $sp)
                                            @php
                                                $hinh = explode('|', $sp->hinh);
                                            @endphp
                                            <div class="row product-layout-list">
                                                <div class="col-lg-3 col-md-5 ">
                                                    <div class="product-image">
                                                        <a href="{{ route('chitiet', $sp->masanpham) }}">
                                                            <img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}"
                                                                alt="Li's Product Image">
                                                        </a>
                                                        @if (isset($sp->malaptop))
                                                            @php
                                                                if (isset($sp->tinhtrang)) {
                                                                    $tinhtrang = $sp->tinhtrang;
                                                                } else {
                                                                    $tinhtrang = '';
                                                                }
                                                            @endphp
                                                            <span
                                                                class="{{ $tinhtrang == 0 ? 'sticker' : 'sticker-old' }}">
                                                                {{ $tinhtrang == 0 ? 'Mới' : 'Cũ' }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-7">
                                                    <div class="product_desc">
                                                        <div class="product_desc_info">
                                                            <div class="product-review">
                                                                <h5 class="manufacturer">
                                                                    <a
                                                                        href="product-details.html">{{ isset($sp->malaptop) ? 'Laptop' : 'Phụ Kiện' }}</a>
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
                                                            <p>{!! substr($sp->mota, 0, 42) !!}{{ strlen($sp->mota) > 42 ? '...' : '' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="shop-add-action mb-xs-30">
                                                        <ul class="add-actions-link">
                                                            <input type="hidden" class="soLuongGh{{ $sp->masanpham }}"
                                                                value="1">
                                                            <li class="add-cart"><a class="clickThemGh"
                                                                    data-id_gh="{{ $sp->masanpham }}" href="#">Thêm
                                                                    Vào Giỏ</a></li>
                                                            <li class="wishlist"><a href="#" class="clickThemYt"
                                                                    data-id_yeuThich="{{ $sp->masanpham }}"><i
                                                                        class="fa fa-heart-o"></i>Yêu Thích</a></li>
                                                            <li><a href="#" data-count="{{ count($hinh) }}"
                                                                    title="quick view" class="quick-view-btn clickQuick"
                                                                    data-quick_id="{{ $sp->masanpham }}"><i
                                                                        class="fa fa-eye"></i>Xem Nhanh</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{--  <div class="paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 pt-xs-15">
                                        <p>Hiển Thị 1-12 của 13 sản phẩm</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="pagination-box pt-xs-20 pb-xs-15">
                                            <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i>
                                                    Quay lại</a>
                                            </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>
                                                <a href="#" class="Next"> Tiếp tục <i
                                                        class="fa fa-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>  --}}
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
                <div class="col-lg-3 order-2 order-lg-1" style="display:{{ $id == 'laptop' ? '' : 'none' }};">
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box">
                        <div class="sidebar-title">
                            <h2>Bộ Lọc</h2>
                        </div>
                        <!-- btn-clear-all start -->
                        <a href="{{ route('danhsachsp', 'laptop') }}" class="btn-clear-all mb-sm-30 mb-xs-30">Xóa tất
                            cả</a>
                        <!-- btn-clear-all end -->
                        <form id="locform" action="{{ route('danhsachsp', 'laptop') }}" method="get">
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area">
                                <h5 class="filter-sub-titel">hãng sản xuất</h5>
                                <div class="categori-checkbox">
                                    <ul>
                                        @foreach ($hangsx as $nsx)
                                            @php
                                                $mahang = [];
                                                $hangsx_arr = [];
                                                if (isset($_GET['hangsx'])) {
                                                    $mahang = $_GET['hangsx'];
                                                    $hangsx_arr = explode(',', $mahang);
                                                }

                                            @endphp
                                            <li>
                                                <input class="hangsx" data-locsp="hangsx" type="checkbox"
                                                    {{ in_array($nsx->mahang, $hangsx_arr) ? 'checked' : '' }}
                                                    name="hangsx" value="{{ $nsx->mahang }}"><a
                                                    href="#">{{ $nsx->tenhang }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- filter-sub-area end -->
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area pt-sm-10 pt-xs-10">
                                <h5 class="filter-sub-titel">CPU</h5>
                                <div class="categori-checkbox">

                                    <ul>
                                        @php
                                            $cpu = [];
                                            $cpu_arr = [];
                                            if (isset($_GET['cpu'])) {
                                                $cpu = $_GET['cpu'];
                                                $cpu_arr = explode(',', $cpu);
                                            }
                                            $arrs_cpu = ['core i3', 'core i5', 'core i7', 'ryzen 3', 'ryzen 5', 'ryzen 7'];

                                        @endphp
                                        @foreach ($arrs_cpu as $arr)
                                            <li>
                                                <input class="cpu" type="checkbox"
                                                    {{ in_array($arr, $cpu_arr) ? 'checked' : '' }} data-locsp="cpu"
                                                    name="cpu" value="{{ $arr }}"><a href="#">Intel
                                                    {{ ucfirst($arr) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <!-- filter-sub-area end -->
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area pt-sm-10 pt-xs-10">
                                <h5 class="filter-sub-titel">ram</h5>
                                <div class="size-checkbox">

                                    <ul>
                                        @php
                                            $ram = [];
                                            $ram_arr = [];
                                            if (isset($_GET['ram'])) {
                                                $ram = $_GET['ram'];
                                                $ram_arr = explode(',', $ram);
                                            }
                                            $arrs_ram = ['4', '8', '16'];

                                        @endphp
                                        @foreach ($arrs_ram as $arr)
                                            <li>
                                                <input class="ram" type="checkbox"
                                                    {{ in_array($arr, $ram_arr) ? 'checked' : '' }} data-locsp="ram"
                                                    name="ram" value="{{ $arr }}"><a
                                                    href="#">{{ $arr }} GB</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <!-- filter-sub-area end -->
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                                <h5 class="filter-sub-titel">card đồ họa</h5>
                                <div class="categori-checkbox">
                                    @php
                                        $carddohoa = [];
                                        $carddohoa_arr = [];
                                        if (isset($_GET['carddohoa'])) {
                                            $carddohoa = $_GET['carddohoa'];
                                            $carddohoa_arr = explode(',', $carddohoa);
                                        }
                                        $arrs_carddohoa = ['0', '1', '2'];

                                    @endphp
                                    <ul>
                                        @foreach ($arrs_carddohoa as $arr)
                                            <li>
                                                <input class="carddohoa" type="checkbox"
                                                    {{ in_array($arr, $carddohoa_arr) ? 'checked' : '' }}
                                                    data-locsp="carddohoa" name="carddohoa"
                                                    value="{{ $arr }}"><a href="#">
                                                    @if ($arr == 0)
                                                        Onboard
                                                    @elseif ($arr == 1)
                                                        Nvidia
                                                    @else
                                                        Adm
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    </ul>

                                </div>
                            </div>
                            <!-- filter-sub-area end -->
                            <!-- filter-sub-area start -->
                            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                                <h5 class="filter-sub-titel">ổ cứng</h5>
                                <div class="categori-checkbox">
                                    @php
                                        $ocung = [];
                                        $ocung_arr = [];
                                        if (isset($_GET['ocung'])) {
                                            $ocung = $_GET['ocung'];
                                            $ocung_arr = explode(',', $ocung);
                                        }
                                        $arrs_ocung = ['1', '512', '256', '128'];

                                    @endphp
                                    <ul>
                                        @foreach ($arrs_ocung as $arr)
                                            <li>
                                                <input class="ocung" type="checkbox"
                                                    {{ in_array($arr, $ocung_arr) ? 'checked' : '' }} data-locsp="ocung"
                                                    name="ocung" value="{{ $arr }}"><a href="#">SSD
                                                    {{ $arr }} {{ $arr == 1 ? 'TB' : 'GB' }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- filter-sub-area end -->
                            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                                <h5 class="filter-sub-titel">màn hình</h5>
                                <div class="categori-checkbox">
                                    @php
                                        $manhinh = [];
                                        $manhinh_arr = [];
                                        if (isset($_GET['manhinh'])) {
                                            $manhinh = $_GET['manhinh'];
                                            $manhinh_arr = explode(',', $manhinh);
                                        }
                                        $arrs_manhinh = ['13', '14', '15'];

                                    @endphp
                                    <ul>
                                        @foreach ($arrs_manhinh as $arr)
                                            <li>
                                                <input class="manhinh" type="checkbox"
                                                    {{ in_array($arr, $manhinh_arr) ? 'checked' : '' }}
                                                    data-locsp="manhinh" name="manhinh" value="{{ $arr }}"><a
                                                    href="#">
                                                    {{ $arr == 15 ? 'Trên' : 'Khoảng' }} {{ $arr }} inch</a>
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>
                            </div>
                            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                                <h5 class="filter-sub-titel">tình trạng</h5>
                                <div class="categori-checkbox">
                                    @php
                                        $tinhtrang = [];
                                        $tinhtrang_arr = [];
                                        if (isset($_GET['tinhtrang'])) {
                                            $tinhtrang = $_GET['tinhtrang'];
                                            $tinhtrang_arr = explode(',', $tinhtrang);
                                        }
                                        $arrs_tinhtrang = ['0', '1'];

                                    @endphp
                                    <ul>
                                        @foreach ($arrs_tinhtrang as $arr)
                                            <li>
                                                <input class="tinhtrang" type="checkbox"
                                                    {{ in_array($arr, $tinhtrang_arr) ? 'checked' : '' }}
                                                    data-locsp="tinhtrang" name="tinhtrang"
                                                    value="{{ $arr }}"><a href="#">
                                                    {{ $arr == 0 ? 'Mới' : 'Cũ' }}</a>
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>
                            </div>
                            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                                <h5 class="filter-sub-titel">mức giá</h5>
                                <div class="categori-checkbox">
                                    @php
                                        $mucgia = [];
                                        $mucgia_arr = [];
                                        if (isset($_GET['mucgia'])) {
                                            $mucgia = $_GET['mucgia'];
                                            $mucgia_arr = explode(',', $mucgia);
                                        }
                                        $arrs_mucgia = ['dưới 10', 'từ 10-15', 'từ 15-20', 'Từ 20-25', 'trên 25'];

                                    @endphp
                                    <ul>
                                        @foreach ($arrs_mucgia as $arr)
                                            <li>
                                                <input class="mucgia" type="checkbox"
                                                    {{ in_array(Str::slug($arr), $mucgia_arr) ? 'checked' : '' }}
                                                    data-locsp="mucgia" name="mucgia" value="{{ Str::slug($arr) }}"><a
                                                    href="#">
                                                    {{ ucfirst($arr) }}</a>
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!--sidebar-categores-box end  -->

                </div>
            </div>
        </div>
    </div>
    <!-- Content Wraper Area End Here -->
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.hangsx,.cpu,.ram,.carddohoa,.ocung,.manhinh,.tinhtrang,.mucgia').click(function() {
                var url = [],
                    temp_nsx = [],
                    temp_cpu = [],
                    temp_ram = [],
                    temp_carddohoa = [],
                    temp_ocung = [],
                    temp_manhinh = [],
                    temp_tinhtrang = [],
                    temp_mucgia = [];

                $.each($("[data-locsp='hangsx']:checked"), function() {
                    temp_nsx.push($(this).val());
                });
                temp_nsx.reverse(); // dao nguoc chuoi
                $.each($("[data-locsp='cpu']:checked"), function() {
                    temp_cpu.push($(this).val());
                });
                temp_cpu.reverse();
                $.each($("[data-locsp='ram']:checked"), function() {
                    temp_ram.push($(this).val());
                });
                temp_ram.reverse();
                $.each($("[data-locsp='ocung']:checked"), function() {
                    temp_ocung.push($(this).val());
                });
                temp_ocung.reverse();
                $.each($("[data-locsp='carddohoa']:checked"), function() {
                    temp_carddohoa.push($(this).val());
                });

                $.each($("[data-locsp='manhinh']:checked"), function() {
                    temp_manhinh.push($(this).val());
                });
                temp_manhinh.reverse();
                $.each($("[data-locsp='tinhtrang']:checked"), function() {
                    temp_tinhtrang.push($(this).val());
                });
                temp_tinhtrang.reverse();
                $.each($("[data-locsp='mucgia']:checked"), function() {
                    temp_mucgia.push($(this).val());
                });
                temp_mucgia.reverse();

                if (temp_nsx.length !== 0 || temp_cpu.length !== 0 || temp_ram.length !== 0 ||
                    temp_carddohoa.length !== 0 || temp_manhinh.length !== 0 || temp_tinhtrang.length !==
                    0 || temp_mucgia.length !== 0 || temp_ocung.length !== 0
                ) {
                    url += '?hangsx=' + temp_nsx.toString() + '&cpu=' + temp_cpu.toString() + '&ram=' +
                        temp_ram.toString() + '&ocung=' + temp_ocung.toString() + '&carddohoa=' +
                        temp_carddohoa.toString() + '&manhinh=' +
                        temp_manhinh.toString() + '&tinhtrang=' + temp_tinhtrang.toString() + '&mucgia=' +
                        temp_mucgia.toString() + '&loc=laptop';
                } else {
                    var url = '{{ Request::url() }}';
                    url = url.replace("&hangsx=", "");
                    window.location.href = url.replace("hangsx=&", "");
                    return false;
                }
                window.location.href = url;
            });
            $('#sapxepsp').change(function() {
                @if ($id == 'laptop' && isset($_GET['loc']))
                    var url_cu = document.URL;
                    console.log(document.URL);
                    var url = url_cu.replace("&sapxep=", "") + "&sapxep=" + $(this).val();
                    if (url) {
                        window.location = url;
                    }
                @else
                    var url = $(this).val();
                    console.log(url);
                    if (url) {
                        window.location = url;
                    }
                @endif
                return false;
            });
        });
    </script>
@stop
