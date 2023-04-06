@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60 mt-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->
                    <form action="{{ route('dangnhap') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Đăng Nhập</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email*</label>
                                    <input class="mb-0" name="email_dn" required
                                        title="(Gồm các ký tự chữ thường hoặc số, có chứa @, có chứa dấu . sau ký tự @, tối đa 150 ký tự)"
                                        pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" value="{{ old('email_dn') }}"
                                        placeholder="Email">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Mật khẩu*</label>
                                    <input class="mb-0" required name="matkhau_dn"
                                        title="(Gồm các ký tự chữ thường, in hoa hoặc số, có chứa tối thiểu 1 ký tự thường, 1 ký tự in hoa và 1 ký tự số, từ 8-32 ký tự)"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" type="password"
                                        placeholder="Mật khẩu">
                                </div>
                                <div class="col-md-4 mt-10 mb-20 text-left t">
                                    <a href="#"> Quên mật khẩu?</a>
                                </div>
                                <div class="col-md-12">
                                    <button style="float: right;" type="submit" class="register-button mt-0">Đăng Nhập</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form action="{{ route('dangky') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Đăng Ký</h4>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Họ tên*</label>
                                    <input class="mb-0" name="hoten_dk" required value="{{ old('hoten_dk') }}"
                                        pattern="[a-zỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđA-ZỲỌÁẦẢẤỜỄÀẠẰỆẾÝỘẬỐŨỨĨÕÚỮỊỖÌỀỂẨỚẶÒÙỒỢÃỤỦÍỸẮẪỰỈỎỪỶỞÓÉỬỴẲẸÈẼỔẴẺỠƠÔƯĂÊÂĐ ]{3,50}"
                                        title="(Gồm các ký tự là chữ thường hoặc in hoa, có dấu hoặc không dấu, tối đa 50 ký tự)"
                                        type="text" placeholder="Họ tên">
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Số điện thoại*</label>
                                    <input class="mb-0" name="sdt_dk" pattern="^[0]\d{9}$" value="{{ old('sdt_dk') }}"
                                        title="(Gồm các ký tự là số, có bắt đầu là số 0, tối đa 9 chữ số - không bao gồm ký tự đầu là 0)"
                                        type="text" placeholder="Số điện thoại">
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Email*</label>
                                    <input class="mb-0" name="email_dk" required value="{{ old('email_dk') }}"
                                        title="(Gồm các ký tự chữ thường hoặc số, có chứa @, có chứa dấu . sau ký tự @, tối đa 150 ký tự)"
                                        pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email"
                                        placeholder="Email">
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Mật khẩu*</label>
                                    <input class="mb-0" name="matkhau_dk" required
                                        title="(Gồm các ký tự chữ thường, in hoa hoặc số, có chứa tối thiểu 1 ký tự thường, 1 ký tự in hoa và 1 ký tự số, từ 8-32 ký tự)"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" type="password"
                                        placeholder="Mật khẩu">
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Nhập lại mật khẩu*</label>
                                    <input class="mb-0" name="nhaplaimatkhau_dk" required
                                        title="(Gồm các ký tự chữ thường, in hoa hoặc số, có chứa tối thiểu 1 ký tự thường, 1 ký tự in hoa và 1 ký tự số, từ 8-32 ký tự)"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" type="password"
                                        placeholder="Nhập lại mật khẩu">
                                </div>
                                <div class="col-12">
                                    <button type="submit" style="float: right;" class="register-button mt-0">Đăng Ký</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
@endsection
@section('js')
    <script>

    </script>
@stop
