<!DOCTYPE html>
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>[Admin] In {{ $tieude1 }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body class="login-page" style="background: white">

    <div>
        <div class="row">
            <div class="col-xs-7" style="font-family:'Roboto', sans-serif;">
                <h4>VanShop</h4>
                <b>SĐT:</b> 0941578785 (Anh Van)<br>
                <b>EMAIL</b>: vanshop@gmail.com<br>
                <b>ĐỊA CHỈ:</b> Đường 3/2, quận Ninh Kiều, TP.Cần Thơ <br>
                <br>
            </div>

            
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>
        @php
            $ngay = Carbon\Carbon::parse($phieupdf->ngay);
        @endphp
        <div class="row" style="font-family:'Roboto'; text-align: center;margin-bottom: 3.5rem;">
            <h2 style="font-weight: bold">PHIẾU {{ $tieude }}</h2>
            <div style="text-align: center; margin-bottom: 2%;margin-top: -1%;font-size: 9pt">
                Mã phiếu: {{ $loai }}{{ $loai == 'PN' ? $phieupdf->maphieunhap : $phieupdf->madonhang }}<br>
                Ngày {{ $ngay->format('d') }} tháng {{ $ngay->format('m') }} năm {{ $ngay->format('Y') }}
            </div>
        </div>

        <div class="row" style="margin-bottom: 3%;font-size: 10pt">
            <div class="col-xs-6">
                <b>{{ $loai == 'PN' ? 'Nhà cung cấp' : 'Họ và tên' }}:</b>
                {{ $loai == 'PN' ? $phieupdf->j_nguoidung->hoten : $phieupdf->hotennguoinhan }}<br>
                <b>SĐT:</b>
                {{ $loai == 'PN' ? $phieupdf->j_nguoidung->sodienthoai : $phieupdf->sodienthoainguoinhan }}<br>
                <b>Địa chỉ:</b> {{ $loai == 'PN' ? $phieupdf->j_nguoidung->diachi : $phieupdf->diachinguoinhan }}
            </div>
            <div class="col-xs-6">
                @if ($loai == 'PN')
                    <b>Mã NCC:</b> ND{{ $phieupdf->manguoidung }}<br>
                @else
                    <b>Hình thức:</b> {{ $phieupdf->hinhthucthanhtoan == 0 ? 'Tiền mặt' : 'ATM' }}<br>
                    <b>Tình trạng:</b>
                    @if ($phieupdf->tinhtranggiaohang == 0)
                        Đã hủy
                    @elseif ($phieupdf->tinhtranggiaohang == 1)
                        Chờ xác nhận
                    @elseif ($phieupdf->tinhtranggiaohang == 2)
                        Đang chuẩn bị hàng
                    @elseif ($phieupdf->tinhtranggiaohang == 3)
                        Đang giao hàng
                    @else
                        Đã giao thành công
                    @endif
                    <br>
                @endif
                <b>Ghi chú:</b> {{ $phieupdf->ghichu }}
            </div>
        </div>
        <table class="table" style="font-family:'Roboto';">
            <thead style="background: #F5F5F5;">
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Sản phẩm</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Đơn giá</th>
                    <th class="text-right">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chitietphieu as $key => $ct)
                    <tr>
                        <td class="text-center">{{ $key+1 }}</td>
                        <td>SP{{ $ct->masanpham }} | {{ $ct->j_chitietphieu_sp->tensanpham }}</td>
                        <td class="text-center">{{ $ct->soluong }}</td>
                        <td class="text-center">{{ number_format($ct->dongia) }}</td>
                        <td class="text-right">{{ number_format($ct->soluong * $ct->dongia) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-xs-6"></div>
            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px">
                                <div>Tổng tiền</div>
                            </th>
                            <td style="padding: 5px" class="text-right">{{ number_format($phieupdf->tongtien) }}</td>
                        </tr>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px">
                                <div>Đã thanh toán</div>
                            </th>
                            <td style="padding: 5px" class="text-right">
                                {{ number_format($phieupdf->tongtien - $phieupdf->congno) }}</td>
                        </tr>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px">
                                <div>Công nợ</div>
                            </th>
                            <td style="padding: 5px" class="text-right">{{ number_format($phieupdf->congno) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-bottom: 6%">&nbsp;</div>

        <div class="row">
            <table style="width: 100%" class="text-center">
                <tr>
                    <td>Ngày {{ $ngay->format('d') }} tháng {{ $ngay->format('m') }} năm
                        {{ $ngay->format('Y') }}</td>
                    <td>Ngày {{ $ngay->format('d') }} tháng {{ $ngay->format('m') }} năm
                        {{ $ngay->format('Y') }}</td>
                </tr>
                <tr>
                    <td>Người giao hàng</td>
                    <td>Người nhận hàng</td>
                </tr>
            </table>
        </div>

</body>

</html>
