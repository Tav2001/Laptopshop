@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    <!--Wishlist Area Strat-->
    <div class="wishlist-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="li-product-remove">xóa</th>
                                        <th class="li-product-thumbnail">hình</th>
                                        <th class="cart-product-name">sản phẩm</th>
                                        <th class="li-product-price">giá</th>
                                        <th class="li-product-add-cart">thêm vào giỏ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Session::has('yeuthich'))
                                        @if (count(Session::get('yeuthich')) > 0)
                                            @foreach (Session::get('yeuthich') as $sp)
                                                <tr>
                                                    <td class="li-product-remove"><a class="clickThemYt"
                                                            data-id_yeuthich="{{ $sp['masanpham'] }}" href="#"><i
                                                                class="fa fa-times"></i></a></td>
                                                    <td class="li-product-thumbnail"><a href="#"><img
                                                                src="{{ asset('uploads/sanpham/' . $sp['hinh']) }}"
                                                                style="width: 100px; height: 100px;" alt=""></a>
                                                    </td>
                                                    <td class="li-product-name"><a
                                                            href="#">{{ $sp['tensanpham'] }}</a>
                                                    </td>
                                                    <td class="li-product-price"><span
                                                            class="amount">{{ number_format($sp['giasanpham']) }}</span>
                                                    </td>
                                                    <input type="hidden" class="soLuongGh{{ $sp['masanpham'] }}"
                                                        value="1">
                                                    <td class="li-product-add-cart"><a class="clickThemGh"
                                                            data-id_gh="{{ $sp['masanpham'] }}" href="#">thêm vào
                                                            giỏ</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align: center;color: #8e9093;">Không Có Sản Phẩm Yêu Thích
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td colspan="5" style="text-align: center;color: #8e9093;">Không Có Sản Phẩm Yêu Thích</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Wishlist Area End-->
@endsection
