<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::group(['namespace' => 'FrontEnd'], function () {
    Route::get('/', 'TrangChuController@index')->name('trangchu.index');
    // Thong tin tai khoan
    Route::any('thong-tin', 'TrangChuController@TaiKhoan')->name('thongtintaikhoan');
    Route::get('thong-tin-don-hang/{id}', 'TrangChuController@ChiTietDH')->name('chitietdh');

    Route::post('xem-nhanh', 'TrangChuController@XemNhanh');
    // Lien He
    Route::any('lien-he', 'TrangChuController@LienHe')->name('lienhe');
    //San Pham
    Route::get('chi-tiet-san-pham/{id}', 'SanPhamController@ChiTietSp')->name('chitiet');
    Route::get('danh-sach-san-pham/{id}', 'SanPhamController@DanhSachSp')->name('danhsachsp');
    Route::post('danh-gia-sao', 'SanPhamController@DanhGiaSao')->name('danhgiasao');
    // Gio Hang
    Route::get('gio-hang', 'GioHangController@DanhSachGH')->name('danhsachgh');
    Route::post('them-gio-hang', 'GioHangController@ThemGH')->name('themgh');
    Route::post('cap-nhap-so-luong', 'GioHangController@CapNhatGH')->name('capnhatgh');
    Route::get('xoa-gio-hang/{id}', 'GioHangController@XoaGH')->name('xoagh');
    // Ma Giam Gia
    Route::post('them-ma-giam-gia', 'GioHangController@ThemMGG')->name('themmgg');
    //Thanh Toan
    Route::get('thanh-toan', 'ThanhToanController@DanhSachTT')->name('danhsachtt');
    Route::post('thanh-toan', 'ThanhToanController@ThemThanhToan')->name('thanhtoanPost');
    Route::get('thanh-toan-vnpay', 'ThanhToanController@ThemThanhToanVNPAY')->name('vnpayreturn');
    //Dang Nhap & Dang Ky
    Route::middleware('KiemTraDangNhap')->group(function () {
        Route::get('dang-ky-dang-nhap', 'TaiKhoanController@DanhSachTK')->name('danhsachtk');
        Route::post('dang-nhap-post', 'TaiKhoanController@DangNhap')->name('dangnhap');
        Route::post('dang-ky', 'TaiKhoanController@DangKy')->name('dangky');
    });
    Route::get('dang-xuat', 'TaiKhoanController@DangXuat')->name('dangxuat');
    //Bai viet
    Route::get('bai-viet', 'BaiVietUController@BaiViet')->name('danhsachbaiviet');
    Route::get('bai-viet-{id}/{slug?}', 'BaiVietUController@ChiTietBaiViet')->name('chitietbaiviet');
    //Yeu Thich
    Route::get('yeu-thich', 'YeuThichController@DanhSachYeuThich')->name('danhsachyeuthich');
    Route::post('them-yeu-thich', 'YeuThichController@ThemYeuThich')->name('themyeuthich');
    //Tim Kiem
    Route::get('tim-kiem', 'SanPhamController@TimKiem')->name('timkiem');

});

Route::group(['namespace' => 'BackEnd'], function () {
    Route::middleware('KiemTraTaiKhoan')->group(function () {
        Route::resources([
            'tongquan' => 'TongquanController',
            'laptop' => 'LaptopController',
            'phukien' => 'PhuKienController',
            'hangsanxuat' => 'HangSanXuatController',
            'nguoidung' => 'NguoiDungController',
            'magiamgia' => 'GiamGiaController',
            'phieunhap' => 'PhieuNhapController',
            'donhang' => 'DonHangController',
            'slider' => 'SliderController',
            'baiviet' => 'BaiVietController',
        ]);
    });
});