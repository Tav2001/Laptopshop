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
                    <a href="{{ route('donhang.create') }}" class="btn btn-primary mr-2 btn-pill"
                        title="Thêm {{ $tieude }}">
                        <i class="fa fa-plus"></i> Thêm {{ $tieude }}
                    </a>
                </div>
            </div>
            <div class="ml-3 mt-3 mb-3 mr-3">
                <table id="myTable" class="table table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>thời gian</th>
                            <th>Tên khách hàng</th>
                            <th>trạng thái giao</th>
                            <th>trạng thái thanh toán</th>
                            <th>tổng tiền</th>
                            <th>thao tác</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($donhang as $dh)
                            <tr>
                                <td>DH{{ $dh->madonhang  }}</td>
                                <td>{{ Carbon\Carbon::parse($dh->ngaytao)->format('d/m/Y') }}</td>
                                <td>{{ $dh->hotennguoinhan }}</td>
                                <td>
                                    @if ($dh->tinhtranggiaohang == 0)
                                        <button type="submit" class="btn btn-outline-danger"
                                            title="Đổi tình trạng giao hàng" style="width:99%;" name="thaoTac"
                                            value="đổi tình trạng giao hàng">
                                            Đã hủy
                                        </button>
                                    @elseif ($dh->tinhtranggiaohang == 1)
                                            <button type="submit" class="btn btn-outline-warning"
                                                title="Đổi tình trạng giao hàng" style="width:99%;" name="thaoTac"
                                                value="đổi tình trạng giao hàng">
                                                Chờ xác nhận
                                            </button>
                                        @elseif ($dh->tinhtranggiaohang == 2)
                                            <button type="submit" class="btn btn-outline-info"
                                                title="Đổi tình trạng giao hàng" style="width:99%;" name="thaoTac"
                                                value="đổi tình trạng giao hàng">
                                                Đang chuẩn bị hàng
                                            </button>
                                        @elseif ($dh->tinhtranggiaohang == 3)
                                            <button type="submit" class="btn btn-outline-primary"
                                                title="Đổi tình trạng giao hàng" style="width:99%;" name="thaoTac"
                                                value="đổi tình trạng giao hàng">
                                                Đang giao hàng
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-outline-success"
                                                title="Đổi tình trạng giao hàng" style="width:99%;" name="thaoTac"
                                                value="đổi tình trạng giao hàng">
                                                Đã giao thành công
                                            </button>
                                        @endif
                                </td>
                                <td>{{ $dh->congno > 0 ? 'Công nợ' : 'Đã thanh toán' }}</td>
                                <td>{{ number_format($dh->tongtien) }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a target="_blank" href="{{ route('donhang.show', $dh->madonhang ) }}"
                                            title="Pdf" data-title="in" data-madonhang ="{{ $dh->madonhang  }}"
                                            class="btn btn-lg btn-link btn-ghost-success"
                                            data-original-title="Cập nhật giá">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <a href="{{ route('donhang.edit', $dh->madonhang ) }}" title="Chỉnh sửa"
                                            data-madonhang ="{{ $dh->madonhang }}"
                                            class="btn btn-lg btn-link btn-ghost-primary" data-original-title="Chỉnh sửa">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" title="Xóa" data-title="xoa"
                                            data-madonhang ="{{ $dh->madonhang }}"
                                            class="btn btn-lg btn-link btn-ghost-danger clickdonhang"
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
        {{-- Modal Xoa Phieu Nhap --}}
        <div class="modal fade" id="xoaDonhang" tabindex="-1" role="dialog">
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
                                Thao tác này sẽ xóa phiếu nhập [<b class="noiDungHienThi"></b>]
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
    </div>
@endsection
@section('js')

    <script>
        $('.clickdonhang').click(function() {
            var id = $(this).data('madonhang');
            $('#xoaDonhang').modal('show');

            $.ajax({
                type: 'get',
                url: 'donhang/' + id,
                success: function(res) {
                    if (res.status == 200) {
                        $('.hidden_id').val(res.data.madonhang);
                        $('.noiDungHienThi').html('<b>DH' + res.data.madonhang  + '</b>');
                    } else {
                        alert('Không Tìm Thấy Đơn Hàng');
                    }
                }
            })
        });
        $(document).on('submit', '#submitform_xoa', function(e) {
            e.preventDefault();
            var id = $('.hidden_id').val();

            $.ajax({
                type: 'delete',
                url: 'donhang/' + id,
                success: function(res) {
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('#xoaDonhang').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        alert('Không Tìm Thấy Đơn Hàng');
                    }
                }
            })
        });
    </script>
@stop
