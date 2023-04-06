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
                    <button type="button" class="btn btn-primary mr-2 btn-pill themMaGiamGia"
                        title="Thêm {{ $tieude }}">
                        <i class="fa fa-plus"></i> Thêm {{ $tieude }}
                    </button>
                </div>
            </div>
            <div class="ml-3 mt-3 mb-3 mr-3">
                <table id="myTable" class="table table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>ngày bắt đầu</th>
                            <th>ngày bắt kết thúc</th>
                            <th>mô tả</th>
                            <th>số đơn đã áp dụng</th>
                            <th>trạng thái</th>
                            <th>số tiền giảm</th>
                            <th>thao tác</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($giamgia as $gg)
                            <tr>
                                <td>{{ $gg->magiamgia }}</td>
                                <td>{{ Carbon\Carbon::parse($gg->ngaybatdau)->format('d/m/Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($gg->ngayketthuc)->format('d/m/Y') }}</td>
                                <td>{{ $gg->mota }}</td>
                                <td>{{ count($gg->j_phieuxuat) }}</td>
                                <td>
                                    @if ($gg->ngayketthuc >= $ngaygiohientai)
                                        <button type="button" data-idgiamgia="{{ $gg->idgiamgia }}" data-title="sua"
                                            class="btn btn-outline-success clickgiamgia" style="width:99%;">Còn hạn</button>
                                    @else
                                        <button type="button" data-idgiamgia="{{ $gg->idgiamgia }}" data-title="sua"
                                            class="btn btn-outline-danger clickgiamgia" style="width:99%;">Hết hạn</button>
                                    @endif
                                </td>
                                <td>{{ number_format($gg->sotiengiam) }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" title="Xóa" data-title="xoa"
                                            data-idgiamgia="{{ $gg->idgiamgia }}"
                                            class="btn btn-lg btn-link btn-ghost-danger clickgiamgia"
                                            data-original-title="Xóa">
                                            <i class="fa fa-times"></i>
                                        </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- End Table -->
        </div>
        <!-- End Card -->
        {{-- Them Ma Giam Gia --}}
        <div class="modal fade" id="themMaGiamGia" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h4 class="modal-title">
                            <span class="fw-mediumbold">
                                Thêm mã giảm giá mới</span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="submitform_add">
                        <div class="modal-body">
                            <p class="small" style="font-size:14px !important;">Nhập thông tin theo mẫu bên dưới</p>
                            <div class="row">
                                <div class="col-md-6 pr-2">
                                    <div class="form-group form-group-default">
                                        <label style="font-size:12px !important;">Mã giảm giá (*)</label>
                                        <input name="maGiamGia" id="maGiamGia" pattern="[A-Za-z0-9]{3,50}" type="text"
                                            class="form-control"
                                            title="(Gồm các ký tự là chữ thường, in hoa hoặc số, không dấu và không khoảng cách, tối đa 50 ký tự)"
                                            value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-2">
                                    <div class="form-group form-group-default">
                                        <label style="font-size:12px !important;">Số tiền giảm (*)</label>
                                        <input id="soTienGiam" name="soTienGiam" type="text" class="form-control"
                                            onkeyup="dinhDangGia(this)" pattern="[0-9,]*" required="">
                                    </div>
                                </div>
                                <div class="col-md-12" id="div_trangthai">
                                    <div class="form-group form-group-default">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="trangthaicheck">
                                            <label class="custom-control-label txt_trangthai" for="trangthaicheck"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-2" id="div_batdau">
                                    <div class="form-group form-group-default">
                                        <label style="font-size:12px !important;">Ngày bắt đầu (*)</label>
                                        <input type="date" class="form-control" id="ngayBatDau"
                                            onblur="chinhNgay(this, 'ngayKetThuc')" name="ngayBatDau"
                                            value="{{ $ngaygiohientai }}" min="{{ $ngaygiohientai }}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-2" id="div_ketthuc">
                                    <div class="form-group form-group-default">
                                        <label style="font-size:12px !important;">Ngày kết thúc (*)</label>
                                        <input type="date" class="form-control" id="ngayKetThuc" name="ngayKetThuc"
                                            value="{{ $ngaygiohientai }}" min="{{ $ngaygiohientai }}" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label style="font-size:12px !important;">Mô tả</label>
                                        <textarea name="moTa" id="moTa" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="thaoTac" value="thêm mã giảm giá"
                                class="btn btn-primary submit">Lưu</button>
                        </div>
                        <input type="hidden" id="hidden_action" value="add">
                        <input type="hidden" class="hidden_id">
                    </form>
                </div>
            </div>
        </div>
        {{-- Xoa Ma Giam Gia --}}
        <div class="modal fade" id="xoaMaGiamGia" tabindex="-1" role="dialog">
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
                            <p id="noiDungXoa" class="small" style="font-size:14px !important;"></p>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button id="nutXoa" type="submit" name="thaoTac" value="xóa mã giảm giá"
                                class="btn btn-danger submit">Đồng
                                ý</button>
                        </div>
                        <input type="hidden" class="hidden_id">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        $('#trangthaicheck').click(function() {
            if ($(this).is(':checked')) {
                $('#div_batdau').hide();
                $('#div_ketthuc').hide();
                $('#ngayBatDau').attr('required', false);
                $('#ngayKetThuc').attr('required', false);
            } else {
                $('#div_batdau').show();
                $('#div_ketthuc').show();
                $('#ngayBatDau').attr('required', true);
                $('#ngayKetThuc').attr('required', true);
            }
        });
        function chinhNgay(inputNgayBatDau, idNgayKetThuc) {
            var inputNgayKetThuc = document.getElementById(idNgayKetThuc);
            inputNgayKetThuc.value = inputNgayBatDau.value;
            inputNgayKetThuc.min = inputNgayBatDau.value;
        };
        // Click Button Them
        $('.themMaGiamGia').click(function() {
            $('#themMaGiamGia').modal('show');
            $('#submitform_add')[0].reset();
            $('.submit').attr('disabled', false);
            $('.submit').text('Lưu');

            $('#div_trangthai').hide();
            $('#hidden_action').val('add');
            $('.hidden_id').val('');
        });
        // Submit Form Them & Sua
        $(document).on('submit', '#submitform_add', function(e) {
            e.preventDefault();
            var url = '';
            var action = '';
            var checked = '';

            var maGiamGia = $('#maGiamGia').val();
            var soTienGiam = $('#soTienGiam').val();
            var ngayBatDau = $('#ngayBatDau').val();
            var ngayKetThuc = $('#ngayKetThuc').val();
            var moTa = $('#moTa').val();

            if ($('#trangthaicheck').is(':checked')) {
                checked = 0;
            } else {
                checked = 1;
            }

            if ($('#hidden_action').val() == 'edit') {
                var id = $('.hidden_id').val();
                url = 'magiamgia/' + id;
                action = 'put';
            } else {
                url = '{{ route('magiamgia.store') }}';
                action = 'post';
            }

            $.ajax({
                type: action,
                url: url,
                data: {
                    checked: checked,
                    maGiamGia: maGiamGia,
                    soTienGiam: soTienGiam,
                    ngayBatDau: ngayBatDau,
                    ngayKetThuc: ngayKetThuc,
                    moTa: moTa,
                },
                beforeSend: function() {
                    $('.submit').attr('disabled', 'disabled');
                    $('.submit').text('Đang Xử Lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('#submitform_add')[0].reset();
                        setTimeout(function() {
                            $('.submit').text('Lưu');
                            $('.submit').attr('disabled', false);
                            $('#themMaGiamGia').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        $('.submit').attr('disabled', false);
                        $('.submit').text('Lưu');

                    }
                }
            });
        });
        // Hien Thi Thong Tin Sua & Xoa
        $('.clickgiamgia').click(function() {
            var tieude = $(this).data('title');
            var magiamgia = $(this).data('idgiamgia');

            $.ajax({
                type: 'get',
                url: 'magiamgia/' + magiamgia,
                success: function(res) {
                    $('.hidden_id').val(magiamgia);
                    if (tieude == 'xoa') {
                        $('#xoaMaGiamGia').modal('show');
                        if (res.sophieuxuat > 0) {
                            $('#noiDungXoa').html('Mã giảm giá <b>' + res.data.magiamgia +
                                '</b> đã được áp dụng cho <b>' + res.sophieuxuat +
                                '</b> ĐƠN HÀNG nên không thể tiến hành thao tác xóa');
                            $('#nutXoa').hide();
                            $('#nutXoa').attr('type', 'button');
                        } else {
                            $('#noiDungXoa').html('Thao tác này sẽ xóa mã giảm giá <b>' + res.data
                                .magiamgia +
                                '</b> vĩnh viễn và không thể khôi phục lại, nên cân nhắc trước khi xóa'
                            );
                            $('#nutXoa').show();
                            $('#nutXoa').attr('type', 'submit');
                        }
                    } else {
                        $('#themMaGiamGia').modal('show');
                        $('#hidden_action').val('edit');
                        $('#div_trangthai').show();

                        $('#maGiamGia').val(res.data.magiamgia);
                        $('#soTienGiam').val(res.data.sotiengiam);
                        formatGia(document.getElementById('soTienGiam'));

                        $('#moTa').val(res.data.mota);

                        if (res.trangthai == 0) {
                            $('.txt_trangthai').text('Còn Hạn');
                            $('#trangthaicheck').attr('checked', false);

                            $('#div_batdau').show();
                            $('#div_ketthuc').show();
                            $('#ngayBatDau').attr('required', true);
                            $('#ngayKetThuc').attr('required', true);

                            $('#ngayBatDau').val(res.data.ngaybatdau);
                            $('#ngayKetThuc').val(res.data.ngayketthuc);
                            $('#ngayBatDau').attr('min', res.data.ngaybatdau);
                            $('#ngayKetThuc').attr('min', res.data.ngayketthuc);
                        } else {
                            $('.txt_trangthai').text('Hết Hạn');
                            $('#trangthaicheck').attr('checked', true);

                            $('#div_batdau').hide();
                            $('#div_ketthuc').hide();
                            $('#ngayBatDau').attr('required', false);
                            $('#ngayKetThuc').attr('required', false);

                            var date = new Date().toISOString().slice(0, 10);
                            $('#ngayBatDau').val(date);
                            $('#ngayKetThuc').val(date);
                            $('#ngayBatDau').attr('min', date);
                            $('#ngayKetThuc').attr('min', date);

                        }
                    }
                }
            });
        });
        // Submit Form Xoa
        $(document).on('submit','#submitform_xoa',function(e){
            e.preventDefault();
            var magiamgia = $('.hidden_id').val();

            $.ajax({
                type:'delete',
                url:'magiamgia/' + magiamgia,
                beforeSend: function() {
                    $('#nutXoa').attr('disabled', 'disabled');
                    $('#nutXoa').text('Đang Xử Lý...');
                },
                success:function(res){
                    if(res.status == 200){
                        setTimeout(function() {
                            $('#nutXoa').text('Đồng ý');
                            $('#nutXoa').attr('disabled', false);
                            $('#xoaMaGiamGia').modal('hide');
                            location.reload();
                        }, 2000);
                    }else{
                        alert('Không Tìm Thấy Mã Giảm Giá');
                        $('#nutXoa').text('Đồng ý');
                        $('#nutXoa').attr('disabled', false);
                    }
                }
            })
        })
    </script>
@stop
