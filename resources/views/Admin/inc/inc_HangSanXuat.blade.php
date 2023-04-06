{{--  Modal Them Hang San Xuat  --}}
<div class="modal fade" id="themHangSanXuat" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h4 class="modal-title">
                    <span class="fw-mediumbold">
                        Thêm hãng sản xuất mới</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="submitformHang">
                <div class="modal-body">
                    <p class="small" style="font-size:14px !important;">Nhập thông tin theo mẫu bên dưới</p>
                    <div class="row">
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Tên hãng (*)</label>
                                <input name="tenHang" id="tenHang" type="text" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Loại hãng (*)</label>
                                <select class="form-control" name="loaiHang" id="loaiHang" required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    <option value="0">Laptop</option>
                                    <option value="1">Phụ kiện</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                    <button type="submit" name="thaoTac" value="thêm hãng sản xuất"
                        class="btn btn-primary submit_hang">Thêm</button>
                </div>
                <input type="hidden" id="hidden_action_hang" value="add">
                <input type="hidden" id="hidden_id_hang" value="">
            </form>
        </div>
    </div>
</div>
@include('Admin.inc.inc_js')

