@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    <!-- Begin Contact Main Page Area -->
    <div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
        <div class="container mb-60">
            <!-- <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d501725.33821395703!2d106.41502371269013!3d10.755341097169092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529292e8d3dd1%3A0xf15f5aad773c112b!2zSOG7kyBDaMOtIE1pbmgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1663984555218!5m2!1svi!2s"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe> -->
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title">Thông tin liên hệ</h3>
                        <p class="contact-page-message mb-25">
                            Để được trực tiếp giải đáp mọi thắc mắc về sản phẩm mà shop cung cấp, quý khách vui lòng liên hệ Chăn sóc khách hàng
                            của VanShop
                        </p>
                        <div class="single-contact-block">
                            <h4><i class="fa fa-fax"></i> Địa Chỉ</h4>
                            <p>Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, TP.Cần Thơ</p>
                        </div>
                        <div class="single-contact-block">
                            <h4><i class="fa fa-phone"></i> Điện Thoại</h4>
                            <p>Mobile: 0941578785</p>
                            <p>Hotline: 0780 499 599</p>
                        </div>
                        <div class="single-contact-block last-child">
                            <h4><i class="fa fa-envelope-o"></i> Email</h4>
                            <p>vanshop@gmail.com</p>
                            <p>cskh@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                    <div class="contact-form-content pt-sm-55 pt-xs-55">
                        <h3 class="contact-page-title">Liên Hệ</h3>
                        <div class="contact-form">
                            <form action="{{ route('lienhe') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Họ & Tên <span class="required">*</span></label>
                                    <input type="text" name="hoten" id="hoten" required placeholder="Họ & Tên">
                                </div>
                                <div class="form-group">
                                    <label>Điện Thoại <span class="required">*</span></label>
                                    <input type="text" pattern="^[0]\d{9}$"
                                        title="(Gồm các ký tự là số, có bắt đầu là số 0, tối đa 9 chữ số - không bao gồm ký tự đầu là 0)"
                                        name="sdt" id="sdt" required placeholder="Điện Thoại">
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="email" id="email" required placeholder="Email">
                                </div>
                                <div class="form-group mb-30">
                                    <label>Nội Dung <span class="required">*</span></label>
                                    <textarea name="noidung" id="noidung" placeholder="Xin vui lòng mô tả chi tiết ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" value="submit" id="submit" class="li-btn-3" name="guilienhe">Gửi
                                        </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Main Page Area End Here -->
@endsection
