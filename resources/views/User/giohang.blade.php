@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">xóa</th>
                                    <th class="li-product-thumbnail">hình</th>
                                    <th class="cart-product-name" style="width: 372px;">tên sản phẩm</th>
                                    <th class="li-product-price">giá</th>
                                    <th class="li-product-quantity">số lượng</th>
                                    <th class="li-product-subtotal">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tong = 0;
                                @endphp
                                @foreach (Cart::content() as $sp)
                                    @php
                                        $tong += $sp->price * $sp->qty;
                                    @endphp
                                    <tr>
                                        <td class="li-product-remove"><a href="{{ route('xoagh', $sp->rowId) }}"><i
                                                    class="fa fa-times"></i></a></td>
                                        <td class="li-product-thumbnail"><a href="{{ route('chitiet', $sp->id) }}"><img
                                                    src="{{ asset('uploads/sanpham/' . $sp->options->image) }}"
                                                    alt="Li's Product Image" style="width: 100px; height: 100px;"></a>
                                        </td>
                                        <td class="li-product-name" style="text-align: left;"><a class="ml-30"
                                                href="{{ route('chitiet', $sp->id) }}">{{ $sp->name }}</a></td>
                                        <td class="li-product-price"><span
                                                class="amount">{{ number_format($sp->price) }}</span></td>
                                        <td class="quantity">
                                            <label>Số Lượng</label>
                                            <div class="col-12">
                                                <input data-rowid="{{ $sp->rowId }}"
                                                    class=" col-3 cart-plus-minus-box changeSoLuong"
                                                    value="{{ $sp->qty }}" type="number"
                                                    oninput="this.value = Math.abs(this.value)">
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span
                                                class="amount">{{ number_format($sp->price * $sp->qty) }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <form action="{{ route('themmgg') }}" method="POST">
                                    @csrf
                                    <div class="coupon">
                                        <input required id="magiamgia" class="input-text" name="magiamgia" value=""
                                            placeholder="Mã giảm giá" type="text" pattern="[A-Za-z0-9]{3,50}"
                                            title="(Gồm các ký tự là chữ thường, in hoa hoặc số, không dấu và không khoảng cách, tối đa 50 ký tự)">
                                        <input class="button" name="submit_magiamgia" value="Áp Dụng" type="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Giỏ Hàng</h2>
                                <ul>
                                    <li>Tổng cộng <span>{{ number_format($tong) }}</span></li>
                                    @if (Session::has('giamgia'))
                                        @php
                                            $tongThanhtoan = $tong - Session::get('giamgia')['sotiengiam'];
                                        @endphp
                                        <li>Giảm giá <span>-{{ number_format(Session::get('giamgia')['sotiengiam']) }}</span></li>
                                    @endif
                                    <li class="text-danger">CẦN THANH TOÁN <span>{{ number_format(isset($tongThanhtoan )? $tongThanhtoan : $tong ) }}</span>
                                    </li>
                                </ul>
                                <a style="float: right;"
                                    href="{{ Session::has('dangnhap') ? route('danhsachtt') : route('danhsachtk') }}">Thanh Toán</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--Shopping Cart Area End-->
@endsection
@section('js')
    <script>
        $('.changeSoLuong').change(function() {
            var soluong = $(this).val();
            var rowid = $(this).data('rowid');

            $.ajax({
                type: 'post',
                url: '{{ route('capnhatgh') }}',
                data: {
                    rowid: rowid,
                    soluong: soluong
                },
                success: function(res) {
                    location.reload();
                }
            })
        });
    </script>
@stop
