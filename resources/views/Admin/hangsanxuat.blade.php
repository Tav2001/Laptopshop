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
                </div>
            </div>
            <div class="ml-3 mt-3 mb-3 mr-3">
                <table id="myTable" class="table table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Loại</th>
                            <th>Số Sản Phẩm Thuộc Hãng</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($sanpham as $sp)
                            <tr>
                                <td>HSX{{ $sp->mahang }}</td>
                                <td>{{ $sp->tenhang }}</td>
                                <td>{{ $sp->loaihang == 0 ? 'Laptop' : 'Phụ Kiện' }}</td>
                                <td>{{ count($sp->j_sanpham) }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" title="Xóa" data-title="xoa"
                                            data-mahang="{{ $sp->mahang }}"
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

        {{-- Modal Xoa Laptop --}}
        <div class="modal fade" id="xoaHang" tabindex="-1" role="dialog">
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
                            <p id="noiDungHienThi" class="small" style="font-size:14px !important;">

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
        // Click Button Gia & Sua & Xoa
        $(document).on('click', '.clicksanpham', function() {

            $('.submit').attr('disabled', false);
            var mahang = $(this).data('mahang');
            $('#xoaHang').modal('show');

            $.ajax({
                type: 'get',
                url: 'hangsanxuat/' + mahang,
                success: function(res) {
                    if (res.status == 200) {
                        if(res.sosanpahm > 0){
                            $('.submit').hide();
                            $('.submit').attr('type','button');
                            $('.hidden_id').val('')
                            $('#noiDungHienThi').html('Hãng sản xuất [<b>'+res.data.tenhang+'</b>] có <b>'+res.sosanpahm+'</b> sản phẩm LAPTOP thuộc hãng này nên không thể tiến hành thao tác xóa');
                        }else{
                            $('.submit').show();
                            $('.submit').attr('type','submit');
                            $('.hidden_id').val(res.data.mahang);
                            $('#noiDungHienThi').html('Thao tác này sẽ xóa hãng sản xuất [<b>'+res.data.tenhang+'</b>] vĩnh viễn và không thể khôi phục lại, nên cân nhắc trước khi xóa');
                        }
                    }
                }
            });
        });
        // Submit Form Xoa
        $(document).on('submit', '#submitform_xoa', function(e) {
            e.preventDefault();
            var mahang = $('.hidden_id').val();

            $.ajax({
                type: 'delete',
                url: 'hangsanxuat/' + mahang,
                beforeSend: function() {
                    $('.submit').attr('disabled', 'disabled');
                    $('.submit').text('Đang Xử Lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('.submit').text('Đồng ý');
                            $('.submit').attr('disabled', false);
                            $('#xoaLaptop').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        alert(res.message);
                        $('.submit').text('Đồng ý');
                        $('.submit').attr('disabled', false);
                    }
                }
            });
        });

    </script>
@stop
