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
                    <button type="button" class="btn btn-primary btn-pill themSlider" title="Thêm {{ $tieude }}">
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
                            <th>Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($sliders as $slider)
                            <tr>
                                <td>SL{{ $slider->maslider }}</td>
                                <td><img src="{{ asset('uploads/slider/' . $slider->hinh) }}" width="80px" height="80px"
                                        class="img-thumbnail mt-2 mb-2" /></td>
                                <td style="text-align: left;">{!! substr($slider->tieude1,0,42) !!}{{ strlen($slider->tieude1) > 42 ? '...' : '' }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" title="Chỉnh sửa" data-title="sua"
                                            data-maslider="{{ $slider->maslider }}"
                                            class="btn btn-lg btn-link btn-ghost-primary clickslider"
                                            data-original-title="Chỉnh sửa">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" title="Xóa" data-title="xoa"
                                            data-maslider="{{ $slider->maslider }}"
                                            class="btn btn-lg btn-link btn-ghost-danger clickslider"
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
        {{-- Modal Them & Sua Slider --}}
        <div class="modal fade" id="themSlider" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        <h4 class="modal-title">
                            <span class="fw-mediumbold">
                                Thêm mẫu slider mới</span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="submitform" enctype="multipart/form-data">
                        <div class="modal-body">
                            <p class="small" style="font-size:14px !important;">Nhập thông tin theo mẫu bên dưới</p>
                            <div class="row">
                                @for ($i = 1; $i < 4; $i++)
                                    <div class="col-md-6 pr-2">
                                        <div class="form-group form-group-default">
                                            <label style="font-size:12px !important;">Tiêu đề {{ $i }}
                                                (*)</label>
                                            <input name="tieude{{ $i }}" id="tieude{{ $i }}"
                                                type="text" class="form-control" value="" required="">
                                        </div>
                                    </div>
                                @endfor
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label style="font-size:12px !important;">Đường dẫn</label>
                                        <input name="duongdan" id="duongdan" type="url" class="form-control"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-lg-2" name="display">

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="font-size:12px !important;">Hình (*)</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="hinh"
                                                id="hinh"accept="image/*" required="">
                                            <label data-browse="Chọn tệp" class="form-control custom-file-label error">Chưa
                                                có tệp nào được
                                                chọn</label>
                                            <input type="hidden" id="hiddenloi" value="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer no-bd">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="thaoTac" value="Thêm laptop"
                                class="btn btn-primary submit">Thêm</button>
                        </div>
                        <input type="hidden" id="hidden_action" value="add">
                        <input type="hidden" id="hidden_id" value="">
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Xoa --}}
        <div class="modal fade" id="xoaSlider" tabindex="-1" role="dialog">
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
                                Thao tác này sẽ xóa slider [<b class="noiDungHienThi"></b>]
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
        // Click Button Them
        $('.themSlider').click(function() {
            $('#themSlider').modal('show');
            $('#submitform')[0].reset();
            $('#hinh').attr('required', true);
            $('div[name="display"]').hide();
            $('.submit').attr('disabled', false);
            $('#hidden_action').val('add');
            $('#hidden_id').val('');
        });
        // Click Button Gia & Sua & Xoa
        $(document).on('click', '.clickslider', function() {

            $('.submit').attr('disabled', false);
            var maslider = $(this).data('maslider');
            var tieude = $(this).data('title');

            if (tieude == 'xoa') {
                $('#xoaSlider').modal('show');
            } else {
                $('#themSlider').modal('show');
                $('div[name="display"]').show();
                $('#hinh').attr('required', false);
                $('#hidden_action').val('edit');
            }

            $.ajax({
                type: 'get',
                url: 'slider/' + maslider,
                success: function(res) {
                    if (res.status == 200) {

                        if (tieude == 'xoa') {
                            $('.hidden_id').val(res.data.maslider);
                            $('.noiDungHienThi').text('SL'+res.data.maslider);
                        } else {
                            $('#hidden_id').val(res.data.maslider);
                            $('#tieude1').val(res.data.tieude1);
                            $('#tieude2').val(res.data.tieude2);
                            $('#tieude3').val(res.data.tieude3);
                            $('#duongdan').val(res.data.duongdan);

                            $('div[name="display"]').html(
                                '<img class="hinhsp" src="uploads/slider/' + res.data.hinh +
                                '">');

                        }
                    }
                }
            });
        });
        // Submit Form Add & Update
        $(document).on('submit', '#submitform', function(e) {
            e.preventDefault();
            var url = '';
            var loi = $('#hiddenloi').val();
            var action = $('#hidden_action').val();

            if (loi == '') {
                var hinh = $('#hinh')[0].files;
                var duongdan = $('#duongdan').val();
                for(var i=1;i < 4;i++){
                    var tieude = $('#tieude'+i).val();
                }


                var data = new FormData(this);
                data.append('tieude', tieude);
                data.append('duongdan', duongdan);
                data.append('hinh', hinh);

                if (action == 'edit') {
                    var id = $('#hidden_id').val();
                    url = 'slider/' + id;
                    data.append('_method', 'PUT');
                } else {
                    url = '{{ route('slider.store') }}';
                    data.append('_method', 'POST');
                }

                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.submit').attr('disabled', 'disabled');
                        $('.submit').text('Đang Xử Lý...');
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            $('#submitform')[0].reset();
                            setTimeout(function() {
                                $('.submit').text('Thêm');
                                $('.submit').attr('disabled', false);
                                $('#themSlider').modal('hide');
                                location.reload();
                            }, 2000);
                        } else {
                            $('.submit').attr('disabled', false);
                            $('.submit').text('Thêm');

                        }
                    }
                });
            }
        });
        // Submit Form Xoa
        $(document).on('submit', '#submitform_xoa', function(e) {
            e.preventDefault();
            var maslider = $('.hidden_id').val();

            $.ajax({
                type: 'delete',
                url: 'slider/' + maslider,
                beforeSend: function() {
                    $('.submit').attr('disabled', 'disabled');
                    $('.submit').text('Đang Xử Lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        setTimeout(function() {
                            $('.submit').text('Đồng ý');
                            $('.submit').attr('disabled', false);
                            $('#xoaSlider').modal('hide');
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
