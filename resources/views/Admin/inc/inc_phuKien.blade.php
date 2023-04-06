{{-- Modal Them & Sua Phu Kien --}}
<div class="modal fade" id="themPhukien" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h4 class="modal-title">
                    <span class="fw-mediumbold">
                        Thêm mẫu phụ kiện mới</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="submitFormPhuKien" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class="small" style="font-size:14px !important;">Nhập thông tin theo mẫu bên dưới</p>
                    <div class="row">
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Tên sản phẩm (*)</label>
                                <input name="tenSanPham" id="tenSanPham" type="text" class="form-control"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Bảo hành (*)</label>
                                <select class="form-control" name="baoHanh" id="baoHanh" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    @for ($i = 1; $i <= 48; $i++)
                                        <option value="{{ $i }}">{{ $i }} Tháng</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Hãng sản xuất (*)</label>
                                <select class="form-control" name="hangSanXuat" id="hangSanXuat" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    @foreach ($hangnsx as $nsx)
                                        <option value="{{ $nsx->mahang }}">{{ strtoupper($nsx->tenhang) }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Tên loại phụ kiện (*)</label>
                                <select class="form-control" id="tenLoaiPhuKien" name="tenLoaiPhuKien" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    <option value="Phím">Phím</option>
                                    <option value="Chuột">Chuột</option>
                                    <option value="Tai nghe">Tai nghe</option>
                                    <option value="Usb">Usb</option>
                                </select>
                            </div>
                        </div>
                        @for ($i = 0; $i <= 5; $i++)
                            <div class="col-lg-2" name="display" id="hienanhsp{{ $i }}">

                            </div>
                        @endfor
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style="font-size:12px !important;">Hình sản phẩm (tối đa 5
                                    hình) (*)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="hinhSanPham[]"
                                        id="hinhSanPham" multiple="" accept="image/*" required="">
                                    <label data-browse="Chọn tệp" class="form-control custom-file-label error">Chưa có
                                        tệp nào được
                                        chọn</label>
                                    <input type="hidden" id="hiddenloi" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Quà tặng (tối đa 5
                                    phụ kiện)</label>
                                <select class="form-control quaTang" id="quaTang1" name="quaTang[]">
                                    <option value="">Chọn sản phẩm 1</option>
                                    @foreach ($phukien as $pk)
                                        <option value="{{ $pk->masanpham }}">
                                            [SP{{ $pk->masanpham }}] - {{ ucwords($pk->tensanpham) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @for ($i = 2; $i <= 5; $i++)
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <select class="form-control quaTang" id="quaTang{{ $i }}"
                                        name="quaTang[]">
                                        <option value="">Chọn sản phẩm {{ $i }}</option>
                                        @foreach ($phukien as $pk)
                                            <option value="{{ $pk->masanpham }}">
                                                [SP{{ $pk->masanpham }}] - {{ ucwords($pk->tensanpham) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endfor
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
                    <button type="submit" name="thaoTac" value="Thêm laptop"
                        class="btn btn-primary submit">Thêm</button>
                </div>
                <input type="hidden" id="hidden_action" value="add">
                <input type="hidden" id="hidden_id" value="">
            </form>
        </div>
    </div>
</div>

@include('Admin.inc.inc_js')
