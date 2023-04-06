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
                    <button type="button" class="btn btn-primary mr-2 btn-pill themNguoidung"
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
                            <th>Tên</th>
                            <th style="width: 12% !important;">Loại người dùng</th>
                            <th>sdt</th>
                            <th>địa chỉ</th>
                            <th style="width: 18% !important;">trạng thái</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($nguoidung as $nd)
                            <tr>
                                <td>ND{{ $nd->manguoidung }}</td>
                                <td style="text-align: left;">{{ ucwords($nd->hoten) }}</td>
                                <td style="text-align: left;">
                                    @if ($nd->loainguoidung == 0)
                                        Khách Hàng
                                    @elseif ($nd->loainguoidung == 1)
                                        Đối Tác
                                    @else
                                        Nhân Viên
                                    @endif
                                </td>
                                <td>{{ $nd->sodienthoai }}</td>
                                <td style="text-align: left;" title="{{ $nd->diachi }}">{{ substr($nd->diachi,0,42) }}{{ strlen($nd->diachi) > 42 ? '...' : '' }}</td>
                                <td>
                                    @if ($nd->trangthai == 0)
                                        <button type="button" class="btn btn-outline-success doiTrangThai"
                                            data-manguoidung="{{ $nd->manguoidung }}" title="Đổi trạng thái"
                                            data-original-title="Đổi trạng thái" style="width:99%;">
                                            <i class="fa fa-unlock"></i>&nbsp;&nbsp;Đang hoạt động
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-outline-danger doiTrangThai"
                                            data-manguoidung="{{ $nd->manguoidung }}" title="Đổi trạng thái"
                                            data-original-title="Đổi trạng thái" style="width:99%;">
                                            <i class="fa fa-lock"></i>&nbsp;&nbsp;Đang bị khóa
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- End Table -->
        </div>
        <!-- End Card -->
        {{-- Them Nguoi Dung --}}
        @include('Admin.inc.inc_NguoiDung')
        {{-- Doi Trang Thai --}}
        <div class="modal fade" id="doiTrangThaiNguoiDung" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h4 class="modal-title">
                            <span class="fw-mediumbold" id="tieuDeKhoa"></span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="submitform_trangthai">
                        <div class="modal-body">
                            <p id="noiDungKhoa" class="small" style="font-size:14px !important;"></p>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" id="thaoTac" name="thaoTac" value="đổi trạng thái người dùng"
                                class="btn">Mở khóa</button>
                        </div>
                        <input id="hidden_manguoidung" type="hidden">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>

        // Click Trang Thai
        $('.doiTrangThai').click(function() {
            var manguoidung = $(this).data('manguoidung');
            $('#doiTrangThaiNguoiDung').modal('show');

            $.ajax({
                type: 'get',
                url: 'nguoidung/' + manguoidung,
                success: function(res) {
                    if (res.status == 200) {
                        $('#hidden_manguoidung').val(res.data.manguoidung);
                        if (res.data.trangthai == 0) {
                            $('#tieuDeKhoa').text('Bạn có thực sự muốn khóa?');
                            $('#noiDungKhoa').text('Bạn có chắc muốn khóa [' + res.data.hoten +
                                '], TẤT CẢ ĐƠN HÀNG sẽ chuyển thành ĐÃ HỦY, nên cân nhắc trước khi thực hiện'
                            );
                            $('#thaoTac').removeClass('btn-success');
                            $('#thaoTac').addClass('btn-danger');
                            $('#thaoTac').text('Khóa');

                        } else {
                            $('#tieuDeKhoa').text('Bạn có thực sự muốn mở khóa?');
                            $('#noiDungKhoa').text('Bạn có chắc muốn mở khóa [' + res.data.hoten +
                                ']?');
                            $('#thaoTac').removeClass('btn-danger');
                            $('#thaoTac').addClass('btn-success');
                            $('#thaoTac').text('Mở Khóa');
                        }
                    } else {
                        alert('Không Tìm Thấy Người Dùng');
                    }
                }
            })
        });
        // Submitform Trang Thai
        $(document).on('submit','#submitform_trangthai',function(e){
            e.preventDefault();
            var manguoidung = $('#hidden_manguoidung').val();
            var thaoTac = $('#thaoTac').text();

            $.ajax({
                type:'put',
                url:'nguoidung/' + manguoidung,
                beforeSend: function() {
                    $('#thaoTac').attr('disabled', 'disabled');
                    $('#thaoTac').text('Đang xử lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('#submitform_trangthai')[0].reset();
                        setTimeout(function() {
                            $('#thaoTac').attr('disabled', false);
                            $('#thaoTac').text(thaoTac);
                            $('#doiTrangThaiNguoiDung').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        $('#thaoTac').attr('disabled', false);
                        $('#thaoTac').text(thaoTac);
                    }
                }
            });

        });
    </script>
@stop
