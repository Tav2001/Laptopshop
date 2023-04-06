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
                    <button type="button" class="btn btn-primary mr-2 btn-pill themHang" title="Thêm Hãng">
                        <i class="fa fa-plus"></i> Thêm Hãng
                    </button>
                    <button type="button" class="btn btn-primary mr-2 btn-pill themPhukien" title="Thêm Phụ Kiện">
                        <i class="fa fa-plus"></i> Thêm Phụ Kiện
                    </button>
                    <button type="button" class="btn btn-primary mr-2 btn-pill themLaptop" title="Thêm Laptop">
                        <i class="fa fa-plus"></i> Thêm Laptop
                    </button>
                    <button type="button" class="btn btn-primary mr-2 btn-pill themNguoidung" title="Thêm Đối Tác">
                        <i class="fa fa-plus"></i> Thêm Đối Tác
                    </button>
                </div>
            </div>
            <form action="{{ Session::has('phieunhap_session') ? route('phieunhap.update',Session::get('phieunhap_session')) : route('phieunhap.store') }}" method="post">
                @method( Session::has('phieunhap_session') ? 'put' : 'post')
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
                                                <th>Sản phẩm</th>
                                                <th width="10%">Số lượng</th>
                                                <th width="18%">Đơn giá</th>
                                                <th width="18%">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablePhieuNhap">
                                            <tr style="display:none">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @if(isset($chitietphieunhap))
                                                @foreach ($chitietphieunhap as $key => $ct)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>
                                                        <input list="chitietphieunhap{{ $key+1  }}" name="chiTietPhieuNhap[]" class="form-control" required value="SP{{ $ct->masanpham }} | {{ $ct->j_chitietphieu_sp->tensanpham }}">
                                                        <datalist id="chitietphieunhap{{ $key+1  }}" >
                                                            @foreach ($sanpham as $sp)
                                                                <option value = "SP{{ $sp->masanpham }} | {{ $sp->tensanpham }}">
                                                            @endforeach
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input class="form-control cangiua" style="padding-left:11px;padding-right:5px;" type="number" pattern="[0-9]*" step="1" id="soLuong{{ $key+1 }}" name="soLuong[]" value="{{ $ct->soluong }}" min="0" onkeyup="tinhTongTien()" required>
                                                    </td>
                                                    <td>
                                                        <input class="form-control canphai" type="text" id="donGia{{ $key+1  }}" name="donGia[]" pattern="[0-9,]*" value="{{ $ct->dongia }}" min="0" onkeyup="tinhTongTien()" required>
                                                    </td>
                                                    <td>
                                                        <input class="form-control canphai" type="text" id="thanhTien{{ $key+1  }}" pattern="[0-9,]*" min="0" value="0" disabled required>
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
                                <label for="smallSelect">Nhà cung cấp (*)</label>
                                <input list="nhaCungCap" name="thongTinNguoiDung" class="form-control" value="@isset($phieunhap)   ND{{ $phieunhap->manguoidung  }} | {{ $phieunhap->j_nguoidung->hoten }} | {{ $phieunhap->j_nguoidung->sodienthoai }}  @endisset"
                                    required="">
                                <datalist id="nhaCungCap">
                                    @foreach ($nguoidung as $nd)
                                    <option value="ND{{ $nd->manguoidung }} | {{ $nd->hoten }} | {{ $nd->sodienthoai }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group form-group-default">
                                <label for="smallSelect">Ghi chú</label>
                                <textarea name="ghiChu" rows="5" class="form-control">{{ $phieunhap->ghichu ?? '' }}</textarea>
                            </div>
                            <div class="row m-0 pt-0">
                                <div class="form-group col-6 ml-auto canphai p-0" style="padding-right:12px!important">
                                    <h5 style="padding: 10px 0px">Tổng tiền:</h5>
                                </div>
                                <div class="form-group col-6 canphai p-0">
                                    <input style="padding-left:15px" class="form-control canphai" type="text"
                                        id="tongTienHien" pattern="[0-9,]*" value="{{ $phieunhap->tongtien ?? 0 }}" min="0" disabled="false">
                                    <input type="number" min="0" hidden="" id="tongTien" name="tongTien"
                                        required="">
                                </div>
                            </div>
                            <div class="row m-0 pt-0">
                                <div class="form-group col-6 ml-auto canphai p-0" style="padding-right:12px!important">
                                    <h5 style="padding: 10px 0px">Đã thanh toán:</h5>
                                </div>
                                <div class="form-group col-6 canphai p-0">
                                    <input style="padding-left:15px" class="form-control canphai" type="text"
                                        id="daThanhToan" name="daThanhToan" pattern="[0-9,]*" value="@if (isset($phieunhap))
                                            {{ $phieunhap->congno == 0 ? $phieunhap->tongtien : 0 }}
                                        @endif"
                                        min="0" required="">
                                </div>
                            </div>
                            <div class="row m-0 pt-0">
                                <div class="form-group col-6 ml-auto canphai p-0" style="padding-right:12px!important">
                                    <h5 style="padding: 10px 0px">Tính vào công nợ:</h5>
                                </div>
                                <div class="form-group col-6 canphai p-0">
                                    <input style="padding-left:15px" class="form-control canphai" type="text"
                                        id="congNo" name="congNo" pattern="[0-9,]*" value="{{ $phieunhap->congno ?? 0 }}" min="0"
                                        disabled="">
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
        @include('Admin.inc.inc_HangSanXuat')
        @include('Admin.inc.inc_phuKien')
        @include('Admin.inc.inc_Laptop')
        @include('Admin.inc.inc_NguoiDung')
    </div>
@endsection
@section('js')

    <script>
        @if (isset($chitietphieunhap))
            var stt = {{ count($chitietphieunhap)+1 }};
        @else
            var stt = 1;
        @endif
        function themDong() {
            var tablePhieuNhap = document.getElementById("tablePhieuNhap");
            var dongChiTietPhieuNhap = tablePhieuNhap.insertRow(stt);
            var cotStt = dongChiTietPhieuNhap.insertCell(0);
            var cotSanPham = dongChiTietPhieuNhap.insertCell(1);
            var cotSoLuong = dongChiTietPhieuNhap.insertCell(2);
            var cotDonGia = dongChiTietPhieuNhap.insertCell(3);
            var cotThanhTien = dongChiTietPhieuNhap.insertCell(4);
            cotStt.classList.add('cangiua');

            cotStt.innerHTML = "" + stt + "";
            cotSanPham.innerHTML = '<input list="chitietphieunhap' + stt +
                '" name="chiTietPhieuNhap[]" class="form-control" required> <datalist id="chitietphieunhap' + stt +
                '" > @foreach ($sanpham as $sp) <option value = "SP{{ $sp->masanpham }} | {{ $sp->tensanpham }}">    @endforeach  </datalist>';
            cotSoLuong.innerHTML =
                '<input class="form-control cangiua" style="padding-left:11px;padding-right:5px;" type="number" pattern="[0-9]*" step="1" id="soLuong' +
                stt + '" name="soLuong[]" value="0" min="0" onkeyup="tinhTongTien()" required>';
            cotDonGia.innerHTML = '<input class="form-control canphai" type="text" id="donGia' + stt +
                '" name="donGia[]" pattern="[0-9,]*" value="0" min="0" onkeyup="tinhTongTien()" required>';
            cotThanhTien.innerHTML = '<input class="form-control canphai" type="text" id="thanhTien' + stt +
                '" pattern="[0-9,]*" min="0" value="0" disabled required>';
            stt++;
            tinhTongTien();
        }

        function xoaDong() {
            var tablePhieuNhap = document.getElementById("tablePhieuNhap");
            if (tablePhieuNhap.rows.length > 0) {
                stt--;
                tablePhieuNhap.deleteRow(stt);
            }
            tinhTongTien();
        }

        function tinhTongTien() {
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

            var tablePhieuNhap = document.getElementById("tablePhieuNhap");
            var demDong = tablePhieuNhap.rows.length;
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
            inputCongNo.value = parseFloat(inputDaThanhToan.value) - parseFloat(inputTongTien.value);
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
        $(document).ready(function() {
            tinhTongTien();
            $('input').keyup(function() {
                tinhTongTien();
            });
        });
    </script>
@stop
