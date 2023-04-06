
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
                            <h4 class="card-title">Danh sách</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <button type="button" class="btn btn-primary mr-2 btn-pill themHang" title="Thêm hãng">
                        <i class="fa fa-plus"></i> Thêm Hãng
                    </button>
                    <button type="button" class="btn btn-primary btn-pill themPhukien" title="Thêm {{ $tieude }}">
                        <i class="fa fa-plus"></i> Thêm {{ $tieude }}
                    </button>
                </div>
            </div>
            <div class="ml-3 mt-3 mb-3 mr-3">
                <table id="myTable" class="table table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Hình</th>
                            <th>Tên</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($sanpham as $sp)
                            @php
                                $hinh = explode('|', $sp->j_hinh->hinh);
                            @endphp
                            <tr>
                                <td>SP{{ $sp->masanpham }}</td>
                                <td><img src="{{ asset('uploads/sanpham/' . $hinh[0]) }}" width="80px" height="80px"
                                        class="img-thumbnail mt-2 mb-2" /></td>
                                <td style="text-align: left;">{{ $sp->tensanpham }}</td>
                                <td>{{ $sp->soluong }}</td>
                                <td class="{{ $sp->giakhuyenmai > 0 ? 'text-info font-weight-bold' : '' }}">{{ number_format($sp->giakhuyenmai > 0 ? $sp->giakhuyenmai : $sp->giaban) }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" title="Cập nhật giá" data-title="suagia"
                                            data-masanpham="{{ $sp->masanpham }}"
                                            class="btn btn-lg btn-link btn-ghost-success clicksanpham"
                                            data-original-title="Cập nhật giá">
                                            <i class="fas fa-money-bill"></i>
                                        </button>
                                        <button type="button" title="Chỉnh sửa" data-title="suasanpham"
                                            data-masanpham="{{ $sp->masanpham }}"
                                            class="btn btn-lg btn-link btn-ghost-primary clicksanpham"
                                            data-original-title="Chỉnh sửa">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" title="Xóa" data-title="xoa"
                                            data-masanpham="{{ $sp->masanpham }}"
                                            class="btn btn-lg btn-link btn-ghost-danger clicksanpham"
                                            data-original-title="Xóa">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- End Table -->


        </div>
        <!-- End Card -->
        {{-- Modal Chinh Gia --}}
        <div class="modal fade" id="chinhGia" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h4 class="modal-title">
                            <span class="fw-mediumbold">
                                Cập nhật giá sản phẩm</span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="submitform_gia">
                        <div class="modal-body">
                            <p class="small" id="noiDungSuaGia" style="font-size:14px !important;">
                                Nhập giá của [<b class="noiDungHienThi"></b>] theo mẫu bên dưới
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label style="font-size:12px !important;">Giá nhập</label>
                                        <input id="giaNhap" type="text" class="form-control displaynone"
                                            pattern="[0-9,]*" disabled="" value="0">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <div class="form-check p-0 mt-1 ml-4">
                                            <label class="form-check-label">
                                                <input class="form-check-input" onchange="hienThiGiaKhuyenMai()"
                                                    name="giaKhuyenMaiCheck" id="giaKhuyenMaiCheck" type="checkbox">
                                                <span class="form-check-sign"
                                                    style="color: #495057!important;padding-top:3px; font-size: 12px">Giá
                                                    khuyến
                                                    mãi</span>
                                            </label>

                                        </div>
                                        <p id="noiDungGiaKhuyenMai" class="m-0 mb-2 displaynone" style="font-size:9px">(Giá
                                            bán
                                            &gt; Giá khuyến mãi &gt; Giá nhập)</p>
                                        <input id="giaKhuyenMai" name="giaKhuyenMai" type="text"
                                            class="form-control displaynone" onkeyup="dinhDangGia(this)" pattern="[0-9,]*">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label style="font-size:12px !important;">Giá bán (*)<p class="m-0"
                                                style="font-size:9px">(Giá
                                                bán &gt; Giá nhập)</p></label>
                                        <input id="giaBan" name="giaBan" type="text" class="form-control"
                                            onkeyup="dinhDangGia(this)" pattern="[0-9,]*" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="thaoTac" value="cập nhật giá"
                                class="btn btn-primary submit">Lưu</button>
                        </div>
                        <input type="hidden" class="hidden_id" value="">
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Them & Sua Phu Kien --}}
        @include('Admin.inc.inc_phuKien')
        {{-- Modal Xoa Phu Kien --}}
        <div class="modal fade" id="xoaPhukien" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h4 class="modal-title">
                            <span class="fw-mediumbold">
                                Bạn có thực sự muốn xóa?</span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="submitform_xoa">
                        <div class="modal-body">
                            <p class="small" style="font-size:14px !important;">
                                Thao tác này sẽ xóa sản phẩm [<b class="noiDungHienThi"></b>]
                                vĩnh viễn và không thể khôi phục lại, nên cân nhắc trước
                                khi xóa
                            </p>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="thaoTac" value="xóa laptop" class="btn btn-danger submit">Đồng
                                ý</button>
                        </div>
                        <input type="hidden" class="hidden_id" value="">
                    </form>
                </div>
            </div>
        </div>
        @include('Admin.inc.inc_HangSanXuat')
    </div>
@endsection
@section('js')

    <script>
        // Kiem Tra Hinh Anh
        $('#hinhSanPham').change(function() {
            var loi = '';
            var hinhSanPham = $('#hinhSanPham')[0].files;
            $('.error').attr("data-browse", hinhSanPham.length + ' tệp');

            if (hinhSanPham.length > 5) {
                loi += 'Tối đa 5 ảnh';
            } else if (hinhSanPham.length == '') {
                loi += 'Chưa có tệp nào được chọn';
            } else if (hinhSanPham.size > 5000000) {
                loi += 'File ảnh không quá 5MB';
            }
            if (loi != '') {
                $('.error').text(loi);
                $('#hiddenloi').val('loi');
                $('#hinhSanPham').addClass('is-invalid');
                return false;
            } else {
                $('#hinhSanPham').removeClass('is-invalid');
                $('#hinhSanPham').addClass('is-valid');
                $('.error').text('Thành công');
                $('#hiddenloi').val('');
            }
        });

        // Click Button Gia & Sua & Xoa
        $(document).on('click', '.clicksanpham', function() {

            $('.submit').attr('disabled', false);
            var masanpham = $(this).data('masanpham');
            var tieude = $(this).data('title');

            if (tieude == 'xoa') {
                $('#xoaPhukien').modal('show');
            } else if (tieude == 'suasanpham') {
                $('#themPhukien').modal('show');
                $('div[name="display"]').show();
                $('#hinhSanPham').attr('required', false);
                $('#hidden_action').val('edit');
            } else {
                $('#chinhGia').modal('show');
            }

            $.ajax({
                type: 'get',
                url: 'phukien/' + masanpham,
                success: function(res) {
                    if (res.status == 200) {

                        if (tieude == 'xoa' || tieude == 'suagia') {
                            $('.hidden_id').val(res.data.masanpham);
                            $('.noiDungHienThi').text(res.data.tensanpham);

                            if (tieude == 'suagia') {
                                $('#giaNhap').val(res.data.gianhap);
                                if (res.data.giakhuyenmai > 0) {
                                    $('#noiDungGiaKhuyenMai').show();
                                    $('#giaKhuyenMai').show();
                                    $('#giaKhuyenMaiCheck').attr('checked',true);
                                    $('#giaKhuyenMai').val(res.data.giakhuyenmai);
                                } else {
                                    $('#noiDungGiaKhuyenMai').hide();
                                    $('#giaKhuyenMai').hide();
                                    $('#giaKhuyenMaiCheck').attr('checked',false);
                                    var gia = (res.data.giaban) * 99 / 100;
                                    $('#giaKhuyenMai').val(gia);
                                }
                                $('#giaBan').val(res.data.giaban);
                                formatGia(document.getElementById('giaNhap'));
                                formatGia(document.getElementById('giaKhuyenMai'));
                                formatGia(document.getElementById('giaBan'));
                            }
                        } else {
                            $('#hidden_id').val(res.data.masanpham);
                            $('#tenSanPham').val(res.data.tensanpham);
                            $('#baoHanh').val(res.data.baohanh);
                            $('#hangSanXuat').val(res.data.mahang);
                            $('#moTa').val(res.data.mota);
                            $('#tenLoaiPhuKien').val(res.phukien.loaiphukien);

                            if(res.quatang != ''){
                                $.each(res.quatang, function(key, values) {
                                    var i = key + 1;
                                    $('#quaTang' + i).val(values);
                                });
                            }

                            $.each(res.hinhanh, function(key, values) {
                                $('#hienanhsp' + key).html(
                                    '<img class="hinhsp" src="uploads/sanpham/' + values +
                                    '">');
                            });
                        }
                    }
                }
            });
        });

        // Submit Form Xoa
        $(document).on('submit', '#submitform_xoa', function(e) {
            e.preventDefault();
            var masanpham = $('.hidden_id').val();

            $.ajax({
                type: 'delete',
                url: 'phukien/' + masanpham,
                beforeSend: function() {
                    $('.submit').attr('disabled', 'disabled');
                    $('.submit').text('Đang Xử Lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('.submit').text('Đồng ý');
                            $('.submit').attr('disabled', false);
                            $('#xoaPhukien').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        alert(res.message);
                        $('.submit').text('Thêm');
                        $('.submit').attr('disabled', false);
                    }
                }
            });
        });
        // Submit Form Gia
        $(document).on('submit', '#submitform_gia', function(e) {
            e.preventDefault();
            var masanpham = $('.hidden_id').val();
            var giaKhuyenMai = $('#giaKhuyenMai').val();
            var giaBan = $('#giaBan').val();
            var checked = '';
            if($('#giaKhuyenMaiCheck').is(':checked')){
                checked = 0;
            }else{
                checked = 1;
            }

            $.ajax({
                type: 'get',
                url: '{{ route('phukien.create') }}',
                data: {
                    masanpham: masanpham,
                    giaKhuyenMai: giaKhuyenMai,
                    giaBan: giaBan,
                    checked: checked,
                },
                beforeSend: function() {
                    $('.submit').attr('disabled', 'disabled');
                    $('.submit').text('Đang Xử Lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('.submit').text('Lưu');
                            $('.submit').attr('disabled', false);
                            $('#chinhGia').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        alert(res.message);
                        $('.submit').text('Lưu');
                        $('.submit').attr('disabled', false);
                    }
                }
            });
        });
    </script>
@stop
