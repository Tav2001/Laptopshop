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
                    <a href="{{ route('baiviet.create') }}" class="btn btn-primary btn-pill" title="Thêm {{ $tieude }}">
                        <i class="fa fa-plus"></i> Thêm {{ $tieude }}
                    </a>
                </div>
            </div>
            <div class="ml-3 mt-3 mb-3 mr-3">
                <table id="myTable" class="table table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Hình</th>
                            <th>Tên</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($baiviet as $bv)
                            <tr>
                                <td>BV{{ $bv->mabaiviet }}</td>
                                <td><img src="{{ asset('uploads/baiviet/' . $bv->hinh) }}" width="80px" height="80px"
                                        class="img-thumbnail mt-2 mb-2" /></td>
                                <td style="text-align: left;">
                                    {!! substr($bv->tieude, 0, 42) !!}{{ strlen($bv->tieude) > 42 ? '...' : '' }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('baiviet.edit',$bv->mabaiviet) }}" title="Chỉnh sửa" data-title="sua"
                                            data-mabaiviet="{{ $bv->mabaiviet }}"
                                            class="btn btn-lg btn-link btn-ghost-primary" data-original-title="Chỉnh sửa">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" title="Xóa" data-title="xoa"
                                            data-mabaiviet="{{ $bv->mabaiviet }}"
                                            class="btn btn-lg btn-link btn-ghost-danger clickbaiviet"
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
        {{-- Modal Xoa --}}
        <div class="modal fade" id="xoaBaiviet" tabindex="-1" role="dialog">
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
                                Thao tác này sẽ xóa bài viết [<b class="noiDungHienThi"></b>]
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
        // Kiem Tra Hinh Anh
        $('#hinh').change(function() {
            var loi = '';
            var hinh = $('#hinh')[0].files;
            $('.error').attr("data-browse", hinh.length + ' tệp');

            if (hinh.length == '') {
                loi += 'Chưa có tệp nào được chọn';
            } else if (hinh.size > 5000000) {
                loi += 'File ảnh không quá 5MB';
            }
            if (loi != '') {
                $('.error').text(loi);
                $('#hiddenloi').val('loi');
                $('#hinh').addClass('is-invalid');
                return false;
            } else {
                $('#hinh').removeClass('is-invalid');
                $('#hinh').addClass('is-valid');
                $('.error').text('Thành công');
                $('#hiddenloi').val('');
            }
        });

        // Click Button Xoa
        $(document).on('click', '.clickbaiviet', function() {

            $('.submit').attr('disabled', false);
            var mabaiviet = $(this).data('mabaiviet');
            var tieude = $(this).data('title');
            $('#xoaBaiviet').modal('show');

            $.ajax({
                type: 'get',
                url: 'baiviet/' + mabaiviet,
                success: function(res) {
                    if (res.status == 200) {

                        $('.hidden_id').val(res.data.mabaiviet);
                        $('.noiDungHienThi').text('BV' + res.data.mabaiviet);

                    }
                }
            });
        });
        // Submit Form Xoa
        $(document).on('submit', '#submitform_xoa', function(e) {
            e.preventDefault();
            var mabaiviet = $('.hidden_id').val();

            $.ajax({
                type: 'delete',
                url: 'baiviet/' + mabaiviet,
                beforeSend: function() {
                    $('.submit').attr('disabled', 'disabled');
                    $('.submit').text('Đang Xử Lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('.submit').text('Đồng ý');
                            $('.submit').attr('disabled', false);
                            $('#xoaBaiviet').modal('hide');
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
