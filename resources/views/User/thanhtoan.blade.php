@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    <!--Checkout Area Strat-->
    <div class="checkout-area pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-accordion">
                        <!--Accordion End-->
                        <!--Accordion Start-->
                        @if (!Session::has('giamgia'))
                            <h3>Bạn chưa nhập mã khuyến mãi? <span id="showcoupon"> Click để nhập mã</span></h3>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form action="{{ route('themmgg') }}" method="POST">
                                        @csrf
                                        <p class="checkout-coupon">
                                            <input required id="magiamgia" class="input-text" name="magiamgia"
                                                value="" placeholder="Mã giảm giá" type="text"
                                                pattern="[A-Za-z0-9]{3,50}"
                                                title="(Gồm các ký tự là chữ thường, in hoa hoặc số, không dấu và không khoảng cách, tối đa 50 ký tự)">
                                            <input value="Áp Dụng" type="submit">
                                        </p>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <!--Accordion End-->
                    </div>
                </div>
            </div>
            <form action="{{ route('thanhtoanPost') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="checkbox-form">
                            <h3>thông tin</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Họ Tên <span class="required">*</span></label>
                                        <input name="hoten" required type="text"
                                            title="(Gồm các ký tự là chữ thường hoặc in hoa, có dấu hoặc không dấu, tối đa 50 ký tự)"
                                            pattern="[a-zỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđA-ZỲỌÁẦẢẤỜỄÀẠẰỆẾÝỘẬỐŨỨĨÕÚỮỊỖÌỀỂẨỚẶÒÙỒỢÃỤỦÍỸẮẪỰỈỎỪỶỞÓÉỬỴẲẸÈẼỔẴẺỠƠÔƯĂÊÂĐ ]{3,50}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại <span class="required">*</span></label>
                                        <input name="sodienthoai" required type="text"
                                            title="(Gồm các ký tự là số, có bắt đầu là số 0, tối đa 9 chữ số - không bao gồm ký tự đầu là 0)"
                                            pattern="^[0]\d{9}$">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ <span class="required">*</span></label>
                                        <input name="diachi" required type="text"
                                            title="(Gồm các ký tự là chữ thường, in hoa, số hoặc các ký tự như ,.-/ và tối đa 255 ký tự)"
                                            pattern="[a-zỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđA-ZỲỌÁẦẢẤỜỄÀẠẰỆẾÝỘẬỐŨỨĨÕÚỮỊỖÌỀỂẨỚẶÒÙỒỢÃỤỦÍỸẮẪỰỈỎỪỶỞÓÉỬỴẲẸÈẼỔẴẺỠƠÔƯĂÊÂĐ0-9 -/,.]{3,255}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="country-select clearfix">
                                        <label>Hình thức thanh toán <span class="required">*</span></label>
                                        <select class="nice-select wide" name="hinhthucthanhtoan">
                                            <option value="0">Tiền mặt</option>
                                            <option value="1">ATM qua VNPAY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Giao đến địa chỉ khác?</label>
                                        <input id="ship-box" name="thongTinNguoiNhanKhac" type="checkbox">
                                    </h3>
                                </div>
                                <div id="ship-box-info" class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Họ Tên người nhận <span class="required">*</span></label>
                                            <input name="hotenNguoiNhan" id="hotenNguoiNhan" type="text"
                                                title="(Gồm các ký tự là chữ thường hoặc in hoa, có dấu hoặc không dấu, tối đa 50 ký tự)"
                                                pattern="[a-zỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđA-ZỲỌÁẦẢẤỜỄÀẠẰỆẾÝỘẬỐŨỨĨÕÚỮỊỖÌỀỂẨỚẶÒÙỒỢÃỤỦÍỸẮẪỰỈỎỪỶỞÓÉỬỴẲẸÈẼỔẴẺỠƠÔƯĂÊÂĐ ]{3,50}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Số điện thoại người nhận <span class="required">*</span></label>
                                            <input name="sodienthoaiNguoiNhan" id="sodienthoaiNguoiNhan" type="text"
                                                title="(Gồm các ký tự là số, có bắt đầu là số 0, tối đa 9 chữ số - không bao gồm ký tự đầu là 0)"
                                                pattern="^[0]\d{9}$">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Địa chỉ người nhận <span class="required">*</span></label>
                                            <input name="diachiNguoiNhan" id="diachiNguoiNhan" type="text"
                                                title="(Gồm các ký tự là chữ thường, in hoa, số hoặc các ký tự như ,.-/ và tối đa 255 ký tự)"
                                                pattern="[a-zỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđA-ZỲỌÁẦẢẤỜỄÀẠẰỆẾÝỘẬỐŨỨĨÕÚỮỊỖÌỀỂẨỚẶÒÙỒỢÃỤỦÍỸẮẪỰỈỎỪỶỞÓÉỬỴẲẸÈẼỔẴẺỠƠÔƯĂÊÂĐ0-9 -/,.]{3,255}">
                                        </div>
                                    </div>

                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Ghi chú</label>
                                        <textarea id="checkout-mess" name="ghichu" cols="30" rows="10"
                                            placeholder="VD: Chỉ nhận hàng trong giờ hành chính,..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>ĐƠN HÀNG</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">SẢN PHẨM</th>
                                            <th class="cart-product-total">THÀNH TIỀN</th>
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
                                            <tr class="cart_item">
                                                <td class="cart-product-name pl-20"
                                                    style="text-align: justify !important;font-size: 13.7px;">
                                                    {{ $sp->name }}
                                                    <strong class="product-quantity"> × {{ $sp->qty }}</strong>
                                                    @if (count($sp->options) > 1)
                                                        @foreach ($sp->options->gift as $item)
                                                            <p class="m-0 mt-1"
                                                                style="font-size:10px;line-height:15px;color: #333;">
                                                                <i style="color: #fed700" class="fa fa-gift pr-1"></i>
                                                                {{ $item->tensanpham }} x 1
                                                            </p>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="cart-product-total"><span
                                                        class="amount">{{ number_format($sp->price) }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th class="pl-20" style="text-align: justify !important;">Tổng Cộng</th>
                                            <td><span class="amount">{{ number_format($tong) }}đ</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th class="pl-20" style="text-align: justify !important;">Cần Thanh Toán</th>
                                            <td><strong><span
                                                        class="amount">{{ number_format(Session::has('giamgia') ? $tong - Session::get('giamgia')['sotiengiam'] : $tong) }}đ</span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title">
                                                    <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Thanh toán Tiền mặt
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Sau khi ấn ĐẶT HÀNG trong 24h sẽ có nhân viên liên hệ bạn để xác nhận
                                                        đơn
                                                        và
                                                        giao đến tận nơi. Khi nhận được hàng bạn có thể kiểm tra sản phẩm và
                                                        thanh toán trực tiếp cho nhân viên giao hàng.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-2">
                                                <h5 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse"
                                                        data-target="#collapseTwo" aria-expanded="false"
                                                        aria-controls="collapseTwo">
                                                        Thanh toán ATM qua VNPAY
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Sau khi ấn ĐẶT HÀNG giao diện sẽ xuất hiện MÃ QR và SỐ TIỀN CẦN THANH
                                                        TOÁN.
                                                        Bạn có thể tiến hành quét mã trên App VNPAY và thực hiện thao tác
                                                        chuyển
                                                        tiền hoặc điền thông tin theo biểu mẫu đã xuất hiện trực tiếp trên
                                                        giao
                                                        diện.
                                                        Sau khi thanh toán thành công giao diện sẽ thông báo.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <input value="Đặt Hàng" type="submit" {{ Cart::content()->count() > 0 ? '' : 'disabled' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--Checkout Area End-->
@endsection
