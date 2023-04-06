<div class="modal fade" id="themLaptop" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h4 class="modal-title">
                    <span class="fw-mediumbold">
                        Thêm mẫu laptop mới</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="submitform" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class="small" style="font-size:14px !important;">Nhập thông tin theo mẫu bên dưới</p>
                    <div class="row">
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Tên sản phẩm (*)</label>
                                <input name="tenSanPhamLap" id="tenSanPhamLap" type="text" class="form-control"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Bảo hành (*)</label>
                                <select class="form-control" name="baoHanhLap" id="baoHanhLap" required="">
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
                                <select class="form-control" name="hangSanXuatLap" id="hangSanXuatLap" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    @foreach ($hangnsx_lap as $nsx)
                                        <option value="{{ $nsx->mahang }}">{{ strtoupper($nsx->tenhang) }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">CPU (*)</label>
                                <input name="cpu" id="cpu" type="text" class="form-control"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Ram (GB) (*)</label>
                                <select class="form-control" name="ram" id="ram" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    <option value="4">4 GB</option>
                                    <option value="8">8 GB</option>
                                    <option value="16">16 GB</option>
                                    <option value="32">32 GB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Card đồ họa (*)</label>
                                <select class="form-control" name="cardDoHoa" id="cardDoHoa" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    <option value="0">Onboard</option>
                                    <option value="1">Nvidia</option>
                                    <option value="2">Amd</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Ổ cứng (GB) (*)</label>
                                <select class="form-control" name="oCung" id="oCung" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    <option value="128">128 GB</option>
                                    <option value="256">256 GB</option>
                                    <option value="512">512 GB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Màn hình (10 - 30 inch)
                                    (*)</label>
                                <input type="number" name="manHinh" id="manHinh" class="form-control"
                                    step="0.1" value="" required="">
                            </div>
                        </div>
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Nhu cầu (*)</label>
                                <select class="form-control" name="nhuCau" id="nhuCau" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    <option value="Sinh Viên">Sinh Viên</option>
                                    <option value="Doanh Nhân">Doanh Nhân</option>
                                    <option value="Mỏng Nhẹ">Mỏng Nhẹ</option>
                                    <option value="Gaming">Gaming</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Tình trạng (*)</label>
                                <select class="form-control" name="tinhTrang" id="tinhTrang" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    <option value="0">Mới</option>
                                    <option value="1">Cũ</option>
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
                                    <input type="file" class="custom-file-input" name="hinhSanPhamLap[]"
                                        id="hinhSanPhamLap" multiple="" accept="image/*" required="">
                                    <label data-browse="Chọn tệp"
                                        class="form-control custom-file-label error">Chưa có tệp nào được
                                        chọn</label>
                                    <input type="hidden" class="hiddenloi" value="">
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
                                <textarea name="moTaLap" id="moTaLap" rows="5" class="form-control"></textarea>
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
