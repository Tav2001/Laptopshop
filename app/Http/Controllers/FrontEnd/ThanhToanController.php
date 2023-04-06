<?php

namespace App\Http\Controllers\FrontEnd;

use App\ChiTietPhieuXuat;
use App\Http\Controllers\Controller;
use App\PhieuXuat;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ThanhToanController extends Controller
{
    public function __construct()
    {
        $this->vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $this->vnp_TmnCode = "HHP1RX2O"; //Mã website tại VNPAY
        $this->vnp_HashSecret = "IIVOHTNIMSVQZTAUSANLVVBPRDRHNEPS"; //Chuỗi bí mật
    }

    public function DanhSachTT()
    {
        $tieude = 'Thanh Toán';
        return view('User.thanhtoan', compact('tieude'));
    }

    public function ThemDonhang()
    {
        try {
            DB::beginTransaction();
            // dd(request()->all());

            if (request()->vnp_OrderInfo) {
                $thongTinNguoiNhanKhac = Session::get('thongtinDatHang')['thongTinNguoiNhanKhac'];
                $hotenNguoiNhan = Session::get('thongtinDatHang')['hotenNguoiNhan'];
                $sodienthoainguoinhan = Session::get('thongtinDatHang')['sodienthoainguoinhan'];
                $diachinguoinhan = Session::get('thongtinDatHang')['diachinguoinhan'];
                $hoten = Session::get('thongtinDatHang')['hoten'];
                $sodienthoai = Session::get('thongtinDatHang')['sodienthoai'];
                $diachi = Session::get('thongtinDatHang')['diachi'];
                $ghichu = Session::get('thongtinDatHang')['ghichu'];
                $hinhthucthanhtoan = Session::get('thongtinDatHang')['hinhthucthanhtoan'];
            } else {
                $thongTinNguoiNhanKhac = isset(request()->thongTinNguoiNhanKhac) ? 'yes' : 'no';
                $hotenNguoiNhan = request()->hotenNguoiNhan;
                $sodienthoainguoinhan = request()->sodienthoaiNguoiNhan;
                $diachinguoinhan = request()->diachiNguoiNhan;
                $hoten = request()->hoten;
                $sodienthoai = request()->sodienthoai;
                $diachi = request()->diachi;
                $ghichu = request()->ghichu;
                $hinhthucthanhtoan = request()->hinhthucthanhtoan;
            }
            $tong = 0;
            foreach (Cart::content() as $sp) {
                $tong += $sp->price * $sp->qty;
            }

            $tong = Session::has('giamgia') ? $tong - Session::get('giamgia')['sotiengiam'] : $tong;

            $phieuxuat = new PhieuXuat();
            if ($thongTinNguoiNhanKhac == 'yes') {
                $phieuxuat->hotennguoinhan = ucwords($hotenNguoiNhan);
                $phieuxuat->sodienthoainguoinhan = $sodienthoainguoinhan;
                $phieuxuat->diachinguoinhan = $diachinguoinhan;
            } else {
                $phieuxuat->hotennguoinhan = ucwords($hoten);
                $phieuxuat->sodienthoainguoinhan = $sodienthoai;
                $phieuxuat->diachinguoinhan = $diachi;
            }
            $phieuxuat->manguoidung = Session::get('dangnhap')['manguoidung'];
            $phieuxuat->magiamgia = Session::has('giamgia') ? Session::get('giamgia')['id'] : null;
            $phieuxuat->ghichu = $ghichu;
            $phieuxuat->tinhtranggiaohang = 1;
            $phieuxuat->hinhthucthanhtoan = $hinhthucthanhtoan;
            $phieuxuat->tongtien = $tong;
            $phieuxuat->congno = $hinhthucthanhtoan == 0 ? $tong : 0;
            $phieuxuat->ngaytao = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $phieuxuat->save();

            foreach (Cart::content() as $sp) {
                $chitiet = new ChiTietPhieuXuat();
                $chitiet->madonhang = $phieuxuat->madonhang;
                $chitiet->masanpham = $sp->id;
                $chitiet->baohanh = $sp->weight;
                $chitiet->soluong = $sp->qty;
                $chitiet->dongia = $sp->price;
                $chitiet->save();

                if (count($sp->options) > 1) {
                    foreach ($sp->options->gift as $gift) {
                        $chitiet = new ChiTietPhieuXuat();
                        $chitiet->madonhang = $phieuxuat->madonhang;
                        $chitiet->masanpham = $gift->masanpham;
                        $chitiet->baohanh = $gift->baohanh;
                        $chitiet->soluong = 1;
                        $chitiet->dongia = 0;
                        $chitiet->save();
                    }
                }
            }
            DB::commit();
            Session::forget('cart');
            Session::forget('giamgia');
            Session::forget('thongtinDatHang');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    public function ThemThanhToan(Request $request)
    {
        if ($request->hinhthucthanhtoan == 0) {
            $this->ThemDonhang();
            return redirect()->route('trangchu.index')->with('alert', 'Đặt hàng thành công, sẽ có nhân viên liên hệ bạn để xác nhận trong 24h tới!');
        } else {
            $vnp_Url = $this->vnp_Url;
            $vnp_TmnCode = $this->vnp_TmnCode;
            $vnp_HashSecret = $this->vnp_HashSecret;
            $vnp_Returnurl = "" . route('vnpayreturn') . "";

            $tong = 0;
            foreach (Cart::content() as $sp) {
                $tong += $sp->price * $sp->qty;
            }
            $tong = Session::has('giamgia') ? $tong - Session::get('giamgia')['sotiengiam'] : $tong;

            Session::put('thongtinDatHang', [
                'thongTinNguoiNhanKhac' => isset($request->thongTinNguoiNhanKhac) ? 'yes' : 'no',
                'hotenNguoiNhan' => $request->hotenNguoiNhan,
                'sodienthoainguoinhan' => $request->sodienthoaiNguoiNhan,
                'diachinguoinhan' => $request->diachiNguoiNhan,
                'hoten' => $request->hoten,
                'sodienthoai' => $request->sodienthoai,
                'diachi' => $request->diachi,
                'ghichu' => $request->ghichu,
                'hinhthucthanhtoan' => $request->hinhthucthanhtoan,

            ]);

            $vnp_TxnRef = date('YmdHis');
            $vnp_OrderInfo = "Thanh Toán";
            $vnp_OrderType = "billpayment";
            $vnp_Amount = $tong * 100;
            $vnp_Locale = config('app.locale');
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            return redirect($vnp_Url);
        }

    }

    public function ThemThanhToanVNPAY(Request $request)
    {
        if ($request->vnp_ResponseCode == "00" || $request->vnp_ResponseCode == "07") {
            $this->ThemDonhang();
            return redirect()->route('trangchu.index')->with('alert', 'Đặt hàng thành công, sẽ có nhân viên liên hệ bạn để xác nhận trong 24h tới!');
        } else if ($request->vnp_ResponseCode == "09") {
            return redirect()->route('danhsachtt')->with('alert', 'Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng');
        } else if ($request->vnp_ResponseCode == "10") {
            return redirect()->route('danhsachtt')->with('alert', 'Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần');
        } else if ($request->vnp_ResponseCode == "11") {
            return redirect()->route('danhsachtt')->with('alert', 'Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch');
        } else if ($request->vnp_ResponseCode == "12") {
            return redirect()->route('danhsachtt')->with('alert', 'Thẻ/Tài khoản của khách hàng bị khóa');
        } else if ($request->vnp_ResponseCode == "13") {
            return redirect()->route('danhsachtt')->with('alert', 'Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch');
        } else if ($request->vnp_ResponseCode == "24") {
            return redirect()->route('danhsachtt')->with('alert', 'Giao dịch không thành công do: Khách hàng hủy giao dịch');
        } else if ($request->vnp_ResponseCode == "51") {
            return redirect()->route('danhsachtt')->with('alert', 'Tài khoản của quý khách không đủ số dư để thực hiện giao dịch');
        } else if ($request->vnp_ResponseCode == "65") {
            return redirect()->route('danhsachtt')->with('alert', 'Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày');
        } else if ($request->vnp_ResponseCode == "75") {
            return redirect()->route('danhsachtt')->with('alert', 'Ngân hàng thanh toán đang bảo trì');
        } else if ($request->vnp_ResponseCode == "79") {
            return redirect()->route('danhsachtt')->with('alert', 'KH nhập sai mật khẩu thanh toán quá số lần quy định. Xin quý khách vui lòng thực hiện lại giao dịch');
        } else if ($request->vnp_ResponseCode == "99") {
            return redirect()->route('danhsachtt')->with('alert', 'Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê)');
        }
    }
}