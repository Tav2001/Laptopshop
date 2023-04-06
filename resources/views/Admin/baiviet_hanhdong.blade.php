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
                            <h4 class="card-title">Nhập thông tin theo mẫu bên dưới</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ml-3 mt-3 mb-3 mr-3">
                <form
                    action="{{ Session::has('baiviet_session') ? route('baiviet.update', Session::get('baiviet_session')) : route('baiviet.store') }}"
                    method="post" enctype="multipart/form-data">
                    @method(Session::has('baiviet_session') ? 'put' : 'post')
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12 pr-2">
                                <div class="form-group form-group-default">
                                    <label style="font-size:12px !important;">Tiêu đề
                                        (*)</label>
                                    <input name="tieude" id="tieude" type="text" class="form-control"
                                        value="{{ Session::has('baiviet_session') ? $baiviet->tieude : '' }}"
                                        required="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label style="font-size:12px !important;">Mô tả</label>
                                    <textarea class="form-control" id="mota" name="mota">{{ Session::has('baiviet_session') ? $baiviet->mota : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label style="font-size:12px !important;">Mô tả ngắn</label>
                                    <textarea class="form-control" id="motangan" name="motangan">{{ Session::has('baiviet_session') ? $baiviet->motangan : '' }}</textarea>
                                </div>
                            </div>
                            @if (Session::has('baiviet_session'))
                                <div class="col-lg-2">
                                    <img width="80px" height="80px" class="img-thumbnail mt-2 mb-2"
                                        src="{{ asset('uploads/baiviet/' . $baiviet->hinh) }}">
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-size:12px !important;">Hình (*)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="hinh"
                                            id="hinh"accept="image/*" {{ Session::has('baiviet_session') ? '' : 'required' }}>
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
                        <button type="submit" name="thaoTac" value="Thêm "
                            class="btn btn-primary submit">Thêm</button>
                    </div>
                </form>
            </div>
            <!-- End Table -->

        </div>
        <!-- End Card -->

    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.config.autoParagraph = false;
        CKEDITOR.replace('mota');
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
    </script>
@stop
