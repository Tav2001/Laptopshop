@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    @php
        $hinh = explode('|', $chitiet->j_hinh->hinh);
    @endphp
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                            @foreach ($hinh as $h)
                                <div class="lg-image">
                                    <a class="popup-img venobox vbox-item" href="{{ asset('uploads/sanpham/' . $h) }}"
                                        data-gall="myGallery">
                                        <img src="{{ asset('uploads/sanpham/' . $h) }}" alt="product image">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="product-details-thumbs slider-thumbs-1">
                            @foreach ($hinh as $h)
                                <div class="sm-image"><img src="{{ asset('uploads/sanpham/' . $h) }}"
                                        alt="product image thumb"></div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h2>{{ $chitiet->tensanpham }}</h2>
                            <span class="product-details-ref">Thương hiệu: {{ $chitiet->j_nsx->tenhang }} &nbsp; | &nbsp;
                                SKU:
                                SP{{ $chitiet->masanpham }}</span>
                            <div class="price-box pt-20">
                                @if ($chitiet->giaban > 0)
                                    @if ($chitiet->giakhuyenmai > 0)
                                        <span
                                            class="new-price new-price-2">{{ number_format($chitiet->giakhuyenmai) }}<sup>đ</sup></span>
                                        <span class="old-price"
                                            style="text-decoration: line-through;">{{ number_format($chitiet->giaban) }}<sup>đ</sup></span>
                                    @else
                                        <span
                                            class="new-price new-price-2">{{ number_format($chitiet->giaban) }}<sup>đ</sup></span>
                                    @endif
                                @else
                                    <span class="new-price new-price-2">Liên Hệ</span>
                                @endif
                            </div>

                            @if ($quatang != null)
                                <div class="product-desc" style="border-bottom: none !important;">
                                    <b>Bạn sẽ nhận được: </b>
                                    @foreach ($quatang as $qua)
                                        @php
                                            $hinhquatang = explode('|', $qua->j_hinh->hinh);
                                        @endphp
                                        <div class="div-gift col-6">
                                            <div class="chil-gift">
                                                <img src="{{ asset('uploads/sanpham/' . $hinhquatang[0]) }}"
                                                    alt="product image gift" width="32px" height="32px">
                                                <span class="chil-gift-qty">x1</span>
                                                <span class="chil-gift-title">{{ $qua->tensanpham }}(Quà tặng)</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="single-add-to-cart" style="display: {{ $chitiet->giaban > 0 ? '' : 'none' }};">
                                <form action="#" class="cart-quantity">
                                    <div class="quantity">
                                        <label>Số lượng</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box soLuongGh{{ $chitiet->masanpham }}"
                                                value="1" type="text">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    <button class="add-to-cart clickThemGh" data-id_gh="{{ $chitiet->masanpham }}"
                                        type="button">Thêm Giỏ Hàng</button>
                                </form>
                            </div>
                            <div class="product-additional-info pt-25">
                                <a class="wishlist-btn clickThemYt" href="#"
                                    data-id_yeuThich="{{ $chitiet->masanpham }}"><i class="fa fa-heart-o"></i>Yêu Thích</a>

                            </div>
                            <div class="block-reassurance">
                                <ul>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-credit-card-alt"></i>
                                            </div>
                                            <p>Thanh toán đơn giản</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <p>Miễn phí giao hàng cho đơn hàng từ 800K</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <p>Đổi trả trong vòng 10 ngày</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    <!-- Begin Product Area -->
    <div class="product-area pt-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#description"><span>Thông Tin</span></a></li>
                            <li><a data-toggle="tab" href="#reviews"><span>Bình Luận</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Lis Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="description" class="tab-pane active show" role="tabpanel">
                    <div class="product-description">
                        @if ($chitiet->malaptop != null)
                            <div class="col-6">
                                <table class="table table-striped">
                                    <tbody>

                                        <tr>
                                            <td>Thương hiệu</td>
                                            <td>{{ $chitiet->j_nsx->tenhang }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bảo hành</td>
                                            <td>{{ $chitiet->baohanh }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"
                                                style="font-weight: bold;text-align: center;text-transform: uppercase">Thông
                                                tin chung</td>
                                        </tr>
                                        <tr>
                                            <td>CPU</td>
                                            <td>{{ ucfirst($chitiet->j_laptop->cpu) }}</td>
                                        </tr>
                                        <tr>
                                            <td>RAM</td>
                                            <td>{{ $chitiet->j_laptop->ram }}GB</td>
                                        </tr>
                                        <tr>
                                            <td>Chip đồ họa</td>
                                            <td>
                                                @if ($chitiet->j_laptop->carddohoa == 0)
                                                    Onboard
                                                @elseif ($chitiet->j_laptop->carddohoa == 1)
                                                    Nvidia
                                                @else
                                                    Amd
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Màn hình</td>
                                            <td>{{ $chitiet->j_laptop->manhinh }}</td>
                                        </tr>
                                        <tr>
                                            <td>Lưu trữ</td>
                                            <td>{{ $chitiet->j_laptop->ocung }}GB</td>
                                        </tr>
                                        <tr>
                                            <td>Nhu cầu</td>
                                            <td>{{ $chitiet->j_laptop->nhucau }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tình trạng</td>
                                            <td>{{ $chitiet->j_laptop->tinhtrang == 0 ? 'Mới' : 'Cũ' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <span>{!! $chitiet->mota !!}</span>
                    </div>
                </div>
                <div id="reviews" class="tab-pane" role="tabpanel">
                    <div class="product-reviews">
                        <div class="product-details-comment-block">

                            <div class="component_rating" style="margin-bottom: 20px;">
                                <h3
                                    style="font-size: 14px;font-weight: normal;line-height: 24px;color: #898989;
                                margin-bottom: 15px;">
                                    Đánh Giá Sao</h3>
                                <div class="component_rating-content"
                                    style="display: flex;align-items: center;border-radius: 5px;border: 1px solid #dedede;">
                                    <div class="rating_item" style="width: 20%;position: relative;">
                                        <span class="fa fa-star"
                                            style="font-size: 100px;color: #FFD119;display: block;margin: 0 auto;text-align: center;"></span>
                                        <b
                                            style="position: absolute;color: white;top: 50%;left: 50%;font-size: 20px;transform: translateX(-50%) translateY(-50%)">{{ number_format($chitiet->sanPhamToDanhGia->avg('sosao'), 1) }}</b>
                                    </div>
                                    <div class="list_rating" style="width: 60%;padding: 20px;">
                                        @foreach ($arrDanhGia as $key => $danhgia)
                                            @php
                                                if (count($chitiet->sanPhamToDanhGia) > 0) {
                                                    $itemAvg = round(($danhgia['soDanhGia'] / count($chitiet->sanPhamToDanhGia)) * 100);
                                                } else {
                                                    $itemAvg = 0;
                                                }
                                            @endphp
                                            <div class="item_rating" style="display: flex;align-items: center;">
                                                <div style="width: 10%;font-size: 14px">
                                                    <span>{{ $key }}</span>
                                                    <span style="margin-left: {{ $key == 1 ? 4 : 2 }}px;color: #FFD119;"
                                                        class="fa fa-star"></span>
                                                </div>
                                                <div style="width: 70%;margin: 0 20px;">
                                                    <span
                                                        style="width: 100%;height: 10px;display: block;border: 1px solid #dedede;border-radius: 5px;">
                                                        <b
                                                            style="width: {{ $itemAvg }}%;background-color: #FFD119;display: block;height: 100%;border-radius: 5px;"></b>
                                                    </span>
                                                </div>
                                                <div style="width: 20%;">
                                                    <a href="">{{ $danhgia['soDanhGia'] }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div style="width: 20%;">
                                        <a href="#" class="rating_action"
                                            style="width: 200px;background: black;padding: 10px;border-radius: 5px;color: white;">Gửi
                                            đánh giá của bạn</a>
                                    </div>
                                </div>
                                <div class="form_rating hide">
                                    <div style="display: flex;margin-top: 15px;align-items: center;">
                                        <p style="margin-bottom: 0;">Chọn đánh giá của bạn</p>

                                        <div style="margin: 0 15px;font-size: 15px;" class='starrr' id='star1'></div>
                                        <span class="list_text"></span>
                                        <form action="{{ route('danhgiasao') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="numberStar" id="numberStar">
                                            <input type="hidden" name="masanpham" value="{{ $chitiet->masanpham }}">
                                            <button type="submit" class="btn-danhgia">Gửi đánh giá</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="comment-author-infos pt-8">
                                <div class="fb-comments" data-href="{{ request()->url() }}" data-width="100%"
                                    data-numposts="5"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Begin Lis Laptop Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <div class="row">
                <!-- Begin Lis Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Sản Phẩm Tương Tự</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($sanphamtuongtu as $sp)
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
    <input type="hidden" id="hidden_star_id">
    <style>
        .starrr {
            display: inline-block; }
            .starrr a {
              font-size: 16px;
              padding: 0 1px;
              cursor: pointer;
              color: #FFD119;
              text-decoration: none; }
        .hide {
            display: none;
        }

        .active {
            display: block;
        }

        .list_star i {
            cursor: pointer;
        }

        .list_text {
            display: inline-block;
            margin-left: -2px;
            position: relative;
            background: #52b858;
            color: #fff;
            padding: 2px 8px;
            box-sizing: border-box;
            font-size: 12px;
            border-radius: 2px;
            display: none;
        }

        .list_text::after {
            right: 100%;
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: rgba(82, 184, 88, 0);
            border-right-color: #52b858;
            border-width: 6px;
            margin-top: -6px;
        }

        .list_star .rating_active {
            color: #FFD119;
        }

        .btn-danhgia {
            width: 107px;
            background: black;
            padding: 4px;
            border-radius: 5px;
            color: white;
            margin-left: 15px;
            cursor: pointer;
        }

        .btn-danhgia:hover {
            background: #FFD119;
            border: 1px solid #FFD119;
        }
    </style>
@endsection
@section('js')
    <script src="{{ asset('user/js/starrr.js') }}"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0"
        nonce="OSaMYvie"></script>
    <script>
        $(function() {

            $('#star1').starrr({
                change: function(e, value) {
                    if (value) {
                        $('.list_text').text('').text(listTextStar[value]).show();
                        $('#numberStar').val(value);
                    }
                }
            });

            $('.rating_action').click(function(e) {
                e.preventDefault();
                if ($('.form_rating').hasClass('hide')) {
                    $('.form_rating').addClass('active').removeClass('hide');
                } else {
                    $('.form_rating').addClass('hide').removeClass('active');
                }
            })
        });
    </script>
@stop
