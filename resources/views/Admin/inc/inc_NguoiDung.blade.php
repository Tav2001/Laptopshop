{{-- Them Nguoi Dung --}}
<div class="modal fade" id="themNguoiDung" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h4 class="modal-title">
                    <span class="fw-mediumbold">
                        Thêm người dùng mới</span>
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
                                <label style="font-size:12px !important;">Họ tên (*)</label>
                                <input class="form-control"
                                    title="(Gồm các ký tự là chữ thường hoặc in hoa, có dấu hoặc không dấu, tối đa 50 ký tự)"
                                    name="hoTen" id="hoTen" value="" required="" type="text">
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Số điện thoại (*)</label>
                                <input class="form-control" required=""
                                    title="(Gồm các ký tự là số, có bắt đầu là số 0, tối đa 9 chữ số - không bao gồm ký tự đầu là 0)"
                                    name="soDienThoai" id="soDienThoai" value="" pattern="^[0]\d{9}$"
                                    type="text">
                            </div>
                        </div>
                        <div class="col-md-6 pr-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Địa chỉ (*)</label>
                                <input class="form-control" required=""
                                    title="(Gồm các ký tự là chữ thường, in hoa, số hoặc các ký tự như ,.-/ và tối đa 255 ký tự)"
                                    name="diaChi" id="diaChi" value="" type="text">
                            </div>
                        </div>
                        <div class="col-md-6 pl-2">
                            <div class="form-group form-group-default">
                                <label style="font-size:12px !important;">Loại người dùng (*)</label>
                                <select class="form-control" id="loaiNguoiDung" name="loaiNguoiDung"
                                    required="">
                                    <option value="" selected="" hidden="">Chọn ...</option>
                                    <option value="0">Khách hàng</option>
                                    <option value="1">Đối tác</option>
                                    <option value="2">Nhân viên</option>
                                </select>
                            </div>
                        </div>
                        <div class="row container m-0 p-0" id="taiKhoanNhanVien">
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label style="font-size:12px !important;">Email (*)</label>
                                    <input class="form-control" name="email" id="email" value=""
                                        pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                        title="(Gồm các ký tự chữ thường hoặc số, có chứa @, có chứa dấu . sau ký tự @, tối đa 150 ký tự)"
                                        type="email">
                                </div>
                            </div>
                            <div class="col-md-6 pr-2">
                                <div class="form-group form-group-default">
                                    <label style="font-size:12px !important;">Mật khẩu (*)</label>
                                    <input class="form-control" name="matKhau" id="matKhau"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}"
                                        title="(Gồm các ký tự chữ thường, in hoa hoặc số, có chứa tối thiểu 1 ký tự thường, 1 ký tự in hoa và 1 ký tự số, từ 8-32 ký tự)"
                                        type="password">
                                </div>
                            </div>
                            <div class="col-md-6 pl-2">
                                <div class="form-group form-group-default">
                                    <label style="font-size:12px !important;">Nhập lại mật khẩu (*)</label>
                                    <input class="form-control" name="nhapLaiMatKhau" id="nhapLaiMatKhau"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}"
                                        onkeyup="checkPasswordMatch();"
                                        title="(Gồm các ký tự chữ thường, in hoa hoặc số, có chứa tối thiểu 1 ký tự thường, 1 ký tự in hoa và 1 ký tự số, từ 8-32 ký tự)"
                                        type="password">
                                    <span class="hienthiloi invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-focus" data-dismiss="modal">Đóng</button>
                    <button type="submit" name="thaoTac" value="thêm người dùng" id="btnThemNguoiDung"
                        class="btn btn-primary submit">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('Admin.inc.inc_js')
