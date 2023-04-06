@extends('LayoutAdmin')
@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-end">
                @include('Admin.inc.inc_row')
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->


        <!-- Card -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        <div class="d-flex justify-content-end">
                            <h4 class="card-title">Thông Tin Phiếu</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-auto">
                    @if (!isset($donhang))
                    <button type="button" class="btn btn-primary mr-2 btn-pill themNguoidung" title="Thêm Đối Tác">
                        <i class="fa fa-plus"></i> Thêm Khách Hàng
                    </button>
                    @else
                    <a target="_blank" href="{{ route('donhang.show',$donhang->madonhang) }}" class="btn btn-primary mr-2 btn-pill" title="In Đơn Hàng">
                        <i class="fa fa-print"></i> In Đơn Hàng
                    </a>
                    @endif
                </div>
            </div>
            <form action="{{ Session::has('donhang_session') ? route('donhang.update',Session::get('donhang_session')) : route('donhang.store') }}" method="post">
                @method( Session::has('donhang_session') ? 'put' : 'post')
                @csrf
                <div class="ml-3 mt-3 mb-3 mr-3">
                    <div class="row">
                        <div class="col-md-6 col-lg-9" style="border-right: solid 1px #ccc">
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table" style="text-align: center; vertical-align: middle;">
                                        <thead>
                                            <tr style="font-weight: bold;color: black;">
                                                <th width="1%">STT</th>
                                                <th width="10%">Bảo Hành</th>
                                                <th>Sản phẩm</th>
                                                <th width="10%">Số lượng</th>
                                                <th width="18%">Đơn giá</th>
                                                <th width="18%">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableDonhang">
                                            <tr style="display:none">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @if(isset($chitietdonhang))
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($chitietdonhang as $key => $ct)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td class="td_hideid" data-idtd="{{ $i }}"><input class="form-control cangiua" style="padding-left:11px;padding-right:5px;" type="number" pattern="[0-9]*" step="1" id="baoHanh{{ $i }}" name="baoHanh[]" value="{{ $ct->baohanh }}" min="0" required></td>
                                                        <td>
                                                            <input list="chitietdonhang{{ $i  }}" name="chiTietDonhang[]" class="form-control" required value="SP{{ $ct->masanpham }} | {{ $ct->j_chitietphieu_sp->tensanpham }}">
                                                            <datalist id="chitietdonhang{{ $i  }}" >
                                                                @foreach ($sanpham as $sp)
                                                                    <option value = "SP{{ $sp->masanpham }} | {{ $sp->tensanpham }}">
                                                                @endforeach
                                                            </datalist>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" style="padding-left:11px;padding-right:5px;" type="number" pattern="[0-9]*" step="1" id="soLuong{{ $i }}" name="soLuong[]" value="{{ $ct->soluong }}" min="0" onkeyup="tinhTongTien()" required>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" id="donGia{{ $i }}" name="donGia[]" pattern="[0-9,]*" value="{{ $ct->dongia }}" min="0" onkeyup="tinhTongTien()" required>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" id="thanhTien{{ $i  }}" pattern="[0-9,]*" min="0" value="0" disabled required>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                    <button onclick="themDong()" type="button" class="btn btn-primary"
                                        style="padding: 5px 20px">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button onclick="xoaDong()" type="button" class="btn btn-focus ml-2"
                                        style="padding: 5px 20px">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group form-group-default">
                                <label for="smallSelect">Thông tin khách hàng (*)</label>
                                <input list="khachHang" name="thongTinNguoiDung" class="form-control" value="@isset($donhang)   ND{{ $donhang->manguoidung  }} | {{ $donhang->j_donhangTonguoidung->hoten }} | {{ $donhang->j_donhangTonguoidung->sodienthoai }}  @endisset"
                                    required="">
                                <datalist id="khachHang">
                                    @foreach ($nguoidung as $nd)
                                    <option value="ND{{ $nd->manguoidung }} | {{ $nd->hoten }} | {{ $nd->sodienthoai }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group pt-2 pb-1" id="divThongTinNguoiNhanKhac"
                                style="background-color: rgb(255, 255, 255);border-radius: 3%;">

                                <div class="form-group">
                                    <div class="form-check p-0 mt-1 ml-4" id="div_checkbox">
                                        <label class="form-check-label">
                                            <input class="form-check-input" onchange="hienThiThongTinNguoiNhanKhac()"
                                            name="thongTinNguoiNhanKhac" id="thongTinNguoiNhanKhac" type="checkbox">
                                            <span class="form-check-sign"
                                                style="color: #495057!important;padding-top:3px;">Giao đến địa chỉ
                                                khác?</span>
                                        </label>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mt-2 displaynone" id="divHoTenNguoiNhan">
                                        <label for="smallSelect">Họ tên người nhận (*)</label>
                                        <input class="form-control form-control-light"
                                            title="(Gồm các ký tự là chữ thường hoặc in hoa, có dấu hoặc không dấu, tối đa 50 ký tự)"
                                            name="hoTenNguoiNhan" id="hoTenNguoiNhan" value="@if(isset($donhang)) {{ $donhang->hotennguoinhan }} @endif"
                                            type="text">
                                    </div>
                                    <div class="form-group displaynone" id="divSoDienThoaiNguoiNhan">
                                        <label for="smallSelect">Số điện thoại người nhận (*)</label>
                                        <input class="form-control form-control-light"
                                            title="(Gồm các ký tự là số, có bắt đầu là số 0, tối đa 9 chữ số - không bao gồm ký tự đầu là 0)"
                                            name="soDienThoaiNguoiNhan" id="soDienThoaiNguoiNhan" value="@if(isset($donhang)) {{ $donhang->sodienthoainguoinhan }} @endif"
                                            type="text">
                                    </div>
                                    <div class="form-group displaynone" id="divDiaChiNguoiNhan">
                                        <label for="smallSelect">Địa chỉ người nhận (*)</label>
                                        <input class="form-control form-control-light"
                                            title="(Gồm các ký tự là chữ thường, in hoa, số hoặc các ký tự như ,.-/ và tối đa 255 ký tự)"
                                            name="diaChiNguoiNhan" id="diaChiNguoiNhan" value="@if(isset($donhang)) {{ $donhang->diachinguoinhan }} @endif"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="smallSelect">Hình thức thanh toán (*)</label>
                                <select class="form-control" name="hinhThucThanhToan" required="">
                                    <option @if(isset($donhang)) {{ $donhang->hinhthucthanhtoan == 0 ? 'selected' : '' }} @endif value="0">Tiền mặt</option>
                                    <option @if(isset($donhang)) {{ $donhang->hinhthucthanhtoan == 1 ? 'selected' : '' }} @endif value="1">ATM qua VNPAY</option>
                                </select>
                            </div>
                            <div class="form-group form-group-default">
                                <label for="smallSelect">Tình trạng giao hàng (*)</label>
                                <select class="form-control" name="tinhTrangGiaoHang" required="">
                                    @if(isset($donhang))
                                        <option {{ $donhang->tinhtranggiaohang == 0 ? 'selected' : '' }} value="0">Đã hủy</option>
                                    @endif
                                    <option @if(isset($donhang)) {{ $donhang->tinhtranggiaohang == 1 ? 'selected' : '' }} @endif value="1">Chờ xác nhận</option>
                                    <option @if(isset($donhang)) {{ $donhang->tinhtranggiaohang == 2 ? 'selected' : '' }} @endif value="2">Đang chuẩn bị hàng</option>
                                    <option @if(isset($donhang)) {{ $donhang->tinhtranggiaohang == 3 ? 'selected' : '' }} @endif value="3">Đang giao hàng</option>
                                    <option @if(isset($donhang)) {{ $donhang->tinhtranggiaohang == 4 ? 'selected' : '' }} @endif value="4">Đã giao thành công</option>
                                </select>
                            </div>
                            <div class="form-group form-group-default">
                                <label for="smallSelect">Ghi chú</label>
                                <textarea name="ghiChu" rows="5" class="form-control">{{ $donhang->ghichu ?? '' }}</textarea>
                            </div>
                            <div class="row m-0 pt-0">
                                <div class="form-group col-6 ml-auto canphai p-0" style="padding-right:12px!important">
                                    <h5 style="padding: 10px 0px">Tổng tiền:</h5>
                                </div>
                                <div class="form-group col-6 canphai p-0">
                                    <input style="padding-left:15px" class="form-control canphai" type="text" id="tongTienHien"
                                        pattern="[0-9,]*" value="0" min="0" disabled="false">
                                    <input type="number" min="0" value="{{ $donhang->tongtien ?? 0 }}" hidden="" id="tongTien" name="tongTien"
                                        required="">
                                </div>
                            </div>
                            @if (isset($donhang))
                                <div class="row m-0 pt-0">
                                    <div class="form-group col-6 ml-auto canphai p-0" style="padding-right:12px!important">
                                        <h5 style="padding: 10px 0px">Giảm(<span style="font-size: 9pt;">@if(isset($donhang)) {{ $donhang->magiamgia != null  ? $donhang->j_donhangTogiamgia->magiamgia : 0 }}  @else 0 @endif</span>)</h5>
                                    </div>
                                    <div class="form-group col-6 canphai p-0">
                                        <input style="padding-left:15px" class="form-control canphai" type="text" id="maGiamGia"
                                            name="maGiamGia" pattern="[0-9,]*" value="@if(isset($donhang)) {{ number_format($donhang->magiamgia != null  ? $donhang->j_donhangTogiamgia->sotiengiam : 0 ) }} @else 0 @endif" min="0" required="" disabled="">
                                    </div>
                                </div>
                            @endif
                            <div class="row m-0 pt-0">
                                <div class="form-group col-6 ml-auto canphai p-0" style="padding-right:12px!important">
                                    <h5 style="padding: 10px 0px">Đã thanh toán:</h5>
                                </div>
                                <div class="form-group col-6 canphai p-0">
                                    <input style="padding-left:15px" class="form-control canphai" type="text" id="daThanhToan"
                                        name="daThanhToan" pattern="[0-9,]*" value="@if (isset($donhang)) {{ $donhang->congno == 0 ? $donhang->tongtien : 0 }}   @endif" min="0" required="">
                                </div>
                            </div>
                            <div class="row m-0 pt-0">
                                <div class="form-group col-6 ml-auto canphai p-0" style="padding-right:12px!important">
                                    <h5 style="padding: 10px 0px">Tính vào công nợ:</h5>
                                </div>
                                <div class="form-group col-6 canphai p-0">
                                    <input style="padding-left:15px" class="form-control canphai" type="text" id="congNo"
                                        name="congNo" pattern="[0-9,]*" value="@if (isset($donhang)) {{ $donhang->congno == 0 ? $donhang->tongtien : 0 }}   @endif" min="0" required="" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-action float-right" style="padding:15px">
                        <button type="submit" name="thaoTac" value="thêm phiếu nhập"
                            class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
            <!-- End Table -->
        </div>
        <!-- End Card -->
        @include('Admin.inc.inc_NguoiDung')
    </div>
    <style>
        .displaynone{
            display: none;
        }
    </style>
@endsection
@section('js')

    <script>

        @if (isset($chitietdonhang))
            var stt = {{ $i+1 }};
        @else
            var stt = 1;
        @endif
        function themDong() {
            var tableDonhang = document.getElementById("tableDonhang");
            var dongChiTietDonhang = tableDonhang.insertRow(stt);
            var cotStt = dongChiTietDonhang.insertCell(0);
            var cotBaoHanh = dongChiTietDonhang.insertCell(1);
            var cotSanPham = dongChiTietDonhang.insertCell(2);
            var cotSoLuong = dongChiTietDonhang.insertCell(3);
            var cotDonGia = dongChiTietDonhang.insertCell(4);
            var cotThanhTien = dongChiTietDonhang.insertCell(5);
            cotStt.classList.add('cangiua');

            cotStt.innerHTML = "" + stt + "";
            cotBaoHanh.innerHTML = '<input class="form-control cangiua" style="padding-left:11px;padding-right:5px;" type="number" pattern="[0-9]*" step="1" id="baoHanh' + stt +'" name="baoHanh[]" value="0" min="0" required>';
            cotSanPham.innerHTML = '<input id="inputSanPham'+stt+'" onblur="doDuLieuSanPham('+stt+')" list="chitietdonhang'+stt+'" name="chiTietDonhang[]" class="form-control" required> <datalist id="chitietdonhang'+stt+'" > @foreach ($sanpham as $sp) <option value = "SP{{ $sp->masanpham }} | {{ $sp->tensanpham }}">Tồn kho: {{ $sp->soluong }} | Khách đặt: 0</option> @endforeach </datalist>';
            cotSoLuong.innerHTML =
                '<input class="form-control cangiua" style="padding-left:11px;padding-right:5px;" type="number" pattern="[0-9]*" step="1" id="soLuong' +
                stt + '" name="soLuong[]" value="0" min="0" onkeyup="tinhTongTien()" required>';
            cotDonGia.innerHTML = '<input class="form-control canphai" type="text" id="donGia'+stt+'" name="donGia[]" pattern="[0-9,]*" value="0" min="0" onkeyup="tinhTongTien()" required>';
            cotThanhTien.innerHTML = '<input class="form-control canphai" type="text" id="thanhTien' + stt +
                '" pattern="[0-9,]*" min="0" value="0" disabled required>';
            stt++;
            tinhTongTien();
        }

        function xoaDong() {
            var tableDonhang = document.getElementById("tableDonhang");
            if (tableDonhang.rows.length > 0) {
                stt--;
                tableDonhang.deleteRow(stt);
            }
            tinhTongTien();
        }
        function doDuLieuSanPham(soThuTu) {
            soThuTuCanDoDuLieu=soThuTu;
            danhSachSanPham = {!! $sanpham !!};
            var inputSanPham = document.getElementById("inputSanPham"+soThuTu);
            maSanPham=inputSanPham.value.split(" | ")[0].split("SP")[1];
            danhSachSanPham.forEach(timThongTinSanPham);
        }
        function timThongTinSanPham(thongTinSanPham) {
            if (thongTinSanPham['masanpham']==maSanPham){
                document.getElementById('baoHanh'+soThuTuCanDoDuLieu).value=thongTinSanPham['baohanh'];
                document.getElementById('soLuong'+soThuTuCanDoDuLieu).value=1;

                if(thongTinSanPham['giakhuyenmai']!=0){
                    document.getElementById('donGia'+soThuTuCanDoDuLieu).value=thongTinSanPham['giakhuyenmai'];
                }else{
                    document.getElementById('donGia'+soThuTuCanDoDuLieu).value=thongTinSanPham['giaban'];
                }
                tinhTongTien();
            }
        }
        function tinhTongTien() {
            var soTienGiam = @if(isset($donhang))  '{{ $donhang->magiamgia != null ? $donhang->j_donhangTogiamgia->sotiengiam : 0 }}' @else '0'  @endif;
            var inputTongTien = document.getElementById('tongTienHien');
            var inputCongNo = document.getElementById('congNo');
            var inputDaThanhToan = document.getElementById('daThanhToan');

            var giaTriDaThanhToan = inputDaThanhToan.value.split(","); // format tien ,,, lai thanh so
            var temp = "";
            for (var i = 0; i < giaTriDaThanhToan.length; i++) {
                temp += giaTriDaThanhToan[i];
            }
            inputDaThanhToan.value = temp; // format tien ,,, lai thanh so

            inputTongTien.value = 0;
            inputCongNo.value = 0;

            var tableDonhang = document.getElementById("tableDonhang");
            var demDong = tableDonhang.rows.length;
           for (var i = 1; i < demDong; i++) {

                var inputSoLuong = document.getElementById('soLuong' + i);
                var inputDonGia = document.getElementById('donGia' + i);

                var giaTriDonGia = inputDonGia.value.split(","); // format tien ,,, lai thanh so
                temp = "";
                for (var j = 0; j < giaTriDonGia.length; j++) {
                    temp += giaTriDonGia[j];
                }
                inputDonGia.value = temp; // format tien ,,, lai thanh so

                var inputThanhTien = document.getElementById('thanhTien' + i);
                inputSoLuong.value = parseFloat(inputSoLuong.value);
                inputDonGia.value = parseFloat(inputDonGia.value);
                inputThanhTien.value = parseFloat(inputSoLuong.value * inputDonGia.value);
                inputTongTien.value = parseFloat(inputTongTien.value) + parseFloat(inputSoLuong.value *
                    inputDonGia.value);
                if (isNaN(inputDonGia.value)) inputDonGia.value = 0;
                if (isNaN(inputSoLuong.value)) inputSoLuong.value = 0;
                if (isNaN(inputThanhTien.value)) inputThanhTien.value = 0;
                formatGia(inputDonGia);
                formatGia(inputThanhTien);
            }
            inputCongNo.value = parseFloat(soTienGiam) + parseFloat(inputDaThanhToan.value) - parseFloat(inputTongTien.value);
            tongTien.value = parseFloat(inputTongTien.value);
            if (isNaN(inputTongTien.value)) {
                inputTongTien.value = 0;
                tongTien.value = 0;
            }
            if (isNaN(inputDaThanhToan.value)) inputDaThanhToan.value = 0;
            if (isNaN(inputCongNo.value)) inputCongNo.value = 0;

            formatGia(inputTongTien);
            formatGia(inputDaThanhToan);
            formatGia(inputCongNo);
        };
        function hienThiThongTinNguoiNhanKhac() {
            var thongTinNguoiNhanKhac = document.getElementById('thongTinNguoiNhanKhac');
            var hoTenNguoiNhan = document.getElementById('hoTenNguoiNhan');
            var soDienThoaiNguoiNhan = document.getElementById('soDienThoaiNguoiNhan');
            var diaChiNguoiNhan = document.getElementById('diaChiNguoiNhan');
                if (thongTinNguoiNhanKhac.checked) {
                    $('#div_checkbox').removeClass("ml-4");
                    $('#div_checkbox').addClass("ml-5");
                    $('#divThongTinNguoiNhanKhac').removeClass("pb-1");
                    $('#divThongTinNguoiNhanKhac').css('background-color','buttonface');
                    $('#divThongTinNguoiNhanKhac').css('height','@if(isset($donhang)) 31% @else 33%  @endif');
                    $('#divHoTenNguoiNhan').removeClass("displaynone");
                    $('#divSoDienThoaiNguoiNhan').removeClass("displaynone");
                    $('#divDiaChiNguoiNhan').removeClass("displaynone");
                    $('#divThongTinNguoiNhanKhac').addClass("pb-0");
                } else {
                    $('#divThongTinNguoiNhanKhac').removeClass("pb-0");
                    $('#divHoTenNguoiNhan').addClass("displaynone");
                    $('#divSoDienThoaiNguoiNhan').addClass("displaynone");
                    $('#divThongTinNguoiNhanKhac').css('background-color','#fff');
                    $('#divThongTinNguoiNhanKhac').css('height','auto');
                    $('#divDiaChiNguoiNhan').addClass("displaynone");
                    $('#divThongTinNguoiNhanKhac').addClass("pb-1");

                    $('#div_checkbox').removeClass("ml-5");
                    $('#div_checkbox').addClass("ml-4");
                }
                hoTenNguoiNhan.required = thongTinNguoiNhanKhac.checked;
                soDienThoaiNguoiNhan.required = thongTinNguoiNhanKhac.checked;
                diaChiNguoiNhan.required = thongTinNguoiNhanKhac.checked;
        };
        $(document).ready(function() {
            tinhTongTien();
            $('input').keyup(function() {
                tinhTongTien();
                hienThiThongTinNguoiNhanKhac();
            });
        });
    </script>
@stop
