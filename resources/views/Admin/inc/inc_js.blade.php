@section('js1')
    <script>
        // Kiem Tra Hinh Anh
        $('#hinhSanPham').change(function() {
            var loi = '';
            var hinhSanPham = $('#hinhSanPham')[0].files;
            $('.error').attr("data-browse", hinhSanPham.length + ' tệp');

            if (hinhSanPham.length > 5) {
                loi += 'Tối đa 5 ảnh';
            } else if (hinhSanPham.length == '') {
                loi += 'Chưa có tệp nào được chọn';
            } else if (hinhSanPham.size > 5000000) {
                loi += 'File ảnh không quá 5MB';
            }
            if (loi != '') {
                $('.error').text(loi);
                $('#hiddenloi').val('loi');
                $('#hinhSanPham').addClass('is-invalid');
                return false;
            } else {
                $('#hinhSanPham').removeClass('is-invalid');
                $('#hinhSanPham').addClass('is-valid');
                $('.error').text('Thành công');
                $('#hiddenloi').val('');
            }
        });
        $('#hinhSanPhamLap').change(function() {
            var loi = '';
            var hinhSanPham = $('#hinhSanPhamLap')[0].files;
            $('.error').attr("data-browse", hinhSanPham.length + ' tệp');

            if (hinhSanPham.length > 5) {
                loi += 'Tối đa 5 ảnh';
            } else if (hinhSanPham.length == '') {
                loi += 'Chưa có tệp nào được chọn';
            } else if (hinhSanPham.size > 5000000) {
                loi += 'File ảnh không quá 5MB';
            }
            if (loi != '') {
                $('.error').text(loi);
                $('.hiddenloi').val('loi');
                $('#hinhSanPhamLap').addClass('is-invalid');
                return false;
            } else {
                $('#hinhSanPhamLap').removeClass('is-invalid');
                $('#hinhSanPhamLap').addClass('is-valid');
                $('.error').text('Thành công');
                $('.hiddenloi').val('');
            }
        });
        // Click Button Them Laptop
        $('.themLaptop').click(function() {
            $('#themLaptop').modal('show');
            $('#submitform')[0].reset();
            $('div[name="display"]').hide();
            $('#hinhSanPhamLap').attr('required', true);
            $('.submit').attr('disabled', false);
            $('#hidden_action').val('add');
            $('#hidden_id').val('');
        });
        // Submit Form Add & Update Laptop
        $(document).on('submit', '#submitform', function(e) {
            e.preventDefault();
            var url = '';
            var loi = $('.hiddenloi').val();
            var action = $('#hidden_action').val();

            if (loi == '') {
                var hinhSanPham = $('#hinhSanPhamLap')[0].files;
                var quaTang = [];
                var tenSanPham = $('#tenSanPhamLap').val();
                var baoHanh = $('#baoHanhLap').val();
                var hangSanXuat = $('#hangSanXuatLap').val();
                var cpu = $('#cpu').val();
                var ram = $('#ram').val();
                var cardDoHoa = $('#cardDoHoa').val();
                var oCung = $('#oCung').val();
                var manHinh = $('#manHinh').val();
                var nhuCau = $('#nhuCau').val();
                var tinhTrang = $('#tinhTrang').val();
                var moTa = $('#moTaLap').val();
                $('.quaTang').each(function() {
                    if ($(this).val() != '') {
                        quaTang.push($(this).val());
                    }
                });


                var data = new FormData(this);
                data.append('tenSanPham', tenSanPham);
                data.append('baoHanh', baoHanh);
                data.append('hangSanXuat', hangSanXuat);
                data.append('cpu', cpu);
                data.append('ram', ram);
                data.append('cardDoHoa', cardDoHoa);
                data.append('oCung', oCung);
                data.append('manHinh', manHinh);
                data.append('nhuCau', nhuCau);
                data.append('tinhTrang', tinhTrang);
                data.append('moTa', moTa);
                data.append('quaTang', quaTang);
                data.append('hinhSanPham', hinhSanPham);

                if (action == 'edit') {
                    var id = $('#hidden_id').val();
                    url = 'laptop/' + id;
                    data.append('_method', 'PUT');
                } else {
                    url = '{{ route('laptop.store') }}';
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
                                $('#themLaptop').modal('hide');
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
        // Click Button Them Phu Kien
        $('.themPhukien').click(function() {
            $('#themPhukien').modal('show');
            $('#submitFormPhuKien')[0].reset();
            $('div[name="display"]').hide();
            $('#hinhSanPham').attr('required', true);
            $('.submit').attr('disabled', false);
            $('#hidden_action').val('add');
            $('#hidden_id').val('');
        });
        // Submit Form Add & Update Phu Kien
        $(document).on('submit', '#submitFormPhuKien', function(e) {
            e.preventDefault();
            var url = '';
            var loi = $('#hiddenloi').val();
            var action = $('#hidden_action').val();

            if (loi == '') {
                var hinhSanPham = $('#hinhSanPham')[0].files;
                var quaTang = [];
                var tenSanPham = $('#tenSanPham').val();
                var baoHanh = $('#baoHanh').val();
                var hangSanXuat = $('#hangSanXuat').val();
                var tenLoaiPhuKien = $('#tenLoaiPhuKien').val();
                var moTa = $('#moTa').val();
                $('.quaTang').each(function() {
                    if ($(this).val() != '') {
                        quaTang.push($(this).val());
                    }
                });

                var data = new FormData(this);
                data.append('tenSanPham', tenSanPham);
                data.append('baoHanh', baoHanh);
                data.append('hangSanXuat', hangSanXuat);
                data.append('tenLoaiPhuKien', tenLoaiPhuKien);
                data.append('hinhSanPham', hinhSanPham);
                data.append('moTa', moTa);
                data.append('quaTang', quaTang);

                if (action == 'edit') {
                    var id = $('#hidden_id').val();
                    url = 'phukien/' + id;
                    data.append('_method', 'PUT');
                } else {
                    url = '{{ route('phukien.store') }}';
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
                            $('#submitFormPhuKien')[0].reset();
                            setTimeout(function() {
                                $('.submit').text('Thêm');
                                $('.submit').attr('disabled', false);
                                $('#themPhukien').modal('hide');
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
        // Click Button Them Hang
        $('.themHang').click(function() {
            $('#themHangSanXuat').modal('show');
            $('#submitformHang')[0].reset();
            $('.submit_hang').attr('disabled', false);
            $('#hidden_action_hang').val('add');
            $('#hidden_id_hang').val('');
        });
        // Submit Form Hang San Xuat
        $(document).on('submit', '#submitformHang', function(e) {
            e.preventDefault();

            var url = '';
            var method = '';
            var action = $('#hidden_action_hang').val();
            var id = $('#hidden_id_hang').val();
            var tenHang = $('#tenHang').val();
            var loaiHang = $('#loaiHang').val();

            if (action == 'add') {
                method = 'POST';
                url = '{{ route('hangsanxuat.store') }}';
            } else {
                method = 'PUT';
                url = 'hangsanxuat/' + id;
            }

            $.ajax({
                type: method,
                url: url,
                data: {
                    tenHang: tenHang,
                    loaiHang: loaiHang
                },
                beforeSend: function() {
                    $('.submit_hang').attr('disabled', 'disabled');
                    $('.submit_hang').text('Đang Xử Lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('#submitformHang')[0].reset();
                        setTimeout(function() {
                            $('.submit_hang').text('Thêm');
                            $('.submit_hang').attr('disabled', false);
                            $('#themHangSanXuat').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        $('.submit_hang').attr('disabled', false);
                        $('.submit_hang').text('Thêm');
                    }
                }
            });
        });

        // Kiem tra Nhap Lai Mat Khau
        function checkPasswordMatch() {
            var matkhau = $("#matKhau").val();
            var nhaplaimatkhau = $("#nhapLaiMatKhau").val();

            if (matkhau != nhaplaimatkhau) {
                $(".hienthiloi").show();
                $(".hienthiloi").text("Mật Khẩu Không Khớp!");
                $("#nhapLaiMatKhau").addClass('is-invalid');
            } else {
                $(".hienthiloi").hide();
                $("#nhapLaiMatKhau").removeClass('is-invalid');
                $("#nhapLaiMatKhau").addClass('is-valid');
            }
        }
        // Chon Loai Nguoi Dung
        $('#loaiNguoiDung').change(function() {
            var kiemtra = $(this).val();

            if (kiemtra == 2) {
                $('#taiKhoanNhanVien').show();
                $('#email').attr('required', true);
                $('#matKhau').attr('required', true);
                $('#nhapLaiMatKhau').attr('required', true);

            } else {
                $('#taiKhoanNhanVien').hide();
                $('#email').attr('required', false);
                $('#matKhau').attr('required', false);
                $('#nhapLaiMatKhau').attr('required', false);
            }
        });
        // Click Button Them Nguoi Dung
        $('.themNguoidung').click(function() {
            $('#themNguoiDung').modal('show');
            $('#submitform_add')[0].reset();
            $('.submit').attr('disabled', false);

            $(".hienthiloi").hide();
            $('#taiKhoanNhanVien').hide();
            $("#nhapLaiMatKhau").removeClass('is-valid');
            $("#nhapLaiMatKhau").removeClass('is-invalid');
        });
        // Submit Form Them Nguoi Dung
        $(document).on('submit', '#submitform_add', function(e) {
            e.preventDefault();
            var hoTen = $('#hoTen').val();
            var soDienThoai = $('#soDienThoai').val();
            var diaChi = $('#diaChi').val();
            var loaiNguoiDung = $('#loaiNguoiDung').val();
            var email = $('#email').val();
            var matKhau = $('#matKhau').val();

            $.ajax({
                type: 'post',
                url: '{{ route('nguoidung.store') }}',
                data: {
                    hoTen: hoTen,
                    soDienThoai: soDienThoai,
                    diaChi: diaChi,
                    loaiNguoiDung: loaiNguoiDung,
                    email: email,
                    matKhau: matKhau,
                },
                beforeSend: function() {
                    $('.submit').attr('disabled', 'disabled');
                    $('.submit').text('Đang Xử Lý...');
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('#submitform_add')[0].reset();
                        setTimeout(function() {
                            $('.submit').text('Thêm');
                            $('.submit').attr('disabled', false);
                            $('#themNguoiDung').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        $('.submit').attr('disabled', false);
                        $('.submit').text('Thêm');

                    }
                }
            })
        });
    </script>
@stop
