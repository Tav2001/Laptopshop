@extends('LayoutAdmin')
@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">Tổng Quan</h1>
                </div>

                <div class="col-sm-auto">
                    <a class="btn btn-primary" href="{{ route('nguoidung.index') }}">
                        <i class="tio-user-add mr-1"></i> Thêm Người Dùng
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Stats -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-90" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-laptop"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <h6 class="card-subtitle">Laptop</h6>
                                    <h4 class="card-title">{{ $laptop }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- End Card -->
            </div>

            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-90" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-keyboard"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <h6 class="card-subtitle">Phụ Kiện</h6>
                                    <h4 class="card-title">{{ $phukien }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- End Card -->
            </div>

            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-90" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <h6 class="card-subtitle">Đơn Hàng</h6>
                                    <h4 class="card-title">{{ $donhang }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- End Card -->
            </div>

            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-90" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <h6 class="card-subtitle">Người Dùng</h6>
                                    <h4 class="card-title">{{ $nguoidung }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Stats -->

        <div class="row gx-2 gx-lg-3">

            <div class="col-lg-7 mb-3 mb-lg-5">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Header -->
                    <div class="card-header">
                        <h5 class="card-header-title">Doanh Thu</h5>

                        <!-- Nav -->
                        <ul class="nav nav-segment" id="expensesTab" role="tablist">
                            <li class="nav-item" data-toggle="chart-bar" data-trigger="click" data-action="toggle">
                                <a class="nav-link active clickchart" data-datasets="tuannay" href="javascript:;"
                                    data-toggle="tab">Tuần Này</a>
                            </li>
                            <li class="nav-item" data-toggle="chart-bar" data-trigger="click" data-action="toggle">
                                <a class="nav-link clickchart" data-datasets="tuantruoc" href="javascript:;"
                                    data-toggle="tab">Tuần Trước</a>
                            </li>
                        </ul>
                        <!-- End Nav -->
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <div class="row mb-4">
                            {{--  <div class="col-sm mb-2 mb-sm-0">
                                <div class="d-flex align-items-center">
                                    <span class="h1 mb-0">35%</span>
                                    <span class="text-success ml-2">
                                        <i class="tio-trending-up"></i> 25.3%
                                    </span>
                                </div>
                            </div>  --}}

                        </div>
                        <!-- End Row -->

                        <!-- Bar Chart -->
                        <div class="chartjs-custom">
                            <div id="charttuan" style="height: 20rem;text-transform: capitalize;"></div>
                        </div>
                        <!-- End Bar Chart -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-5 mb-3 mb-lg-5">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Header -->
                    <div class="card-header">
                        <h5 class="card-header-title">Lời nhắn liên hệ</h5>

                        <!-- Unfold -->
                        <div class="card-tools">

                            <a class="btn btn-primary btn-pill btn-xs" href="{{ route('tongquan.create') }}"><i
                                    class="fa fa-check"></i> Đã đọc tất cả</a>

                        </div>
                        <!-- End Unfold -->
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body"
                        style="height: 425.34px;overflow:{{ count($lienhe) > 5 ? 'scroll' : 'hidden' }}; overflow-x: hidden">
                        <ul class="list-group list-group-flush list-group-no-gutters">
                            <!-- List Group Item -->
                            @foreach ($lienhe as $lh)
                                @php
                                    \Carbon\Carbon::setLocale('vi');
                                    $thoigian = $lh->ngaytao;
                                    $thoigian = \Carbon\Carbon::parse($thoigian);
                                    $currentTime = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
                                @endphp
                                <li class="list-group-item py-3">
                                    <div class="media">
                                        <div class="hs-unfold">

                                            <div style="background: #ebf2ff;"
                                                class="mt-1 mr-3 {{ $lh->trangthai != 0 ? '' : 'text-primary' }} js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle">
                                                <a href="#" onclick="LienHe('{{ $lh->email }}','{{ $lh->sdt }}','{{ $lh->hoten }}','{{ $lh->noidung }}')" data-toggle="modal" data-target="#modalLienHe" class="{{ $lh->trangthai != 0 ? 'text-dark' : 'text-primary' }}"><i class="fas fa-envelope"></i></a>
                                                <span
                                                    class="{{ $lh->trangthai != 0 ? '' : 'btn-status btn-sm-status  btn-status-danger' }}"></span>
                                            </div>
                                        </div>
                                        <div class="media-body">

                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0"><a class="text-dark"
                                                            href="{{ route('tongquan.show', $lh->maLH) }}">{{ $lh->hoten }}</a>
                                                    </h5>
                                                    <span
                                                        class="d-block font-size-sm">{{ substr($lh->noidung, 0, 35) }}{{ strlen($lh->noidung) > 35 ? '...' : '' }}</span>
                                                </div>

                                                <div class="col-auto" style="text-align: center">
                                                    <small class="text-muted">
                                                        {{ $thoigian->diffForHumans($currentTime) }}
                                                    </small>
                                                    @if ($lh->trangthai == 0)
                                                        <small>
                                                            <a class="text-muted"
                                                                href="{{ route('tongquan.show', $lh->maLH) }}"
                                                                style="text-transform: none !important;display:block">Đánh
                                                                dấu chưa đọc</a>
                                                        </small>
                                                    @endif

                                                </div>
                                            </div>

                                            <!-- End Row -->
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            <!-- End List Group Item -->

                        </ul>
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->

        <div id="modalLienHe" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-top-cover bg-dark text-center">
                        <figure class="position-absolute right-0 bottom-0 left-0" style="margin-bottom: -1px;">
                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px"
                                y="0px" viewBox="0 0 1920 100.1">
                                <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z" />
                            </svg>
                        </figure>

                        <div class="modal-close">
                            <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal"
                                aria-label="Close">
                                <svg width="16" height="16" viewBox="0 0 18 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- End Header -->

                    <div class="modal-top-cover-icon">
                        <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>

                    <div class="modal-body">
                        <p>Email: <span id="email"></span> <span class="ml-10">Sdt: <span id="sdt"></span></span></p>

                        <hr/>
                        <p>Xin Chào {{ session()->get('dangnhap')['hoten'] }},</p>
                        <p>Tôi là <span id="hoTen"></span>, hiện đang cần tư vấn</p>
                        <p id="noiDung"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        function LienHe($email,$sdt,$hoTen,$noiDung){
            $('#email').text($email);
            $('#sdt').text($sdt);
            $('#hoTen').text($hoTen);
            $('#noiDung').text($noiDung);
        }
        $(document).ready(function() {
            bieudotuan();
        });
        var chart = new Morris.Bar({

            element: 'charttuan',
            parseTime: false,
            hideHover: 'auto',
            barColors: ['#cd1818'],

            xkey: 'ngaytao',
            ykeys: ['tongtien'],
            labels: ['Tổng'],
            xLabelAngle: 43,
            labelTop: true
        });

        function bieudotuan() {
            $.ajax({
                type: "get",
                url: "{{ route('tongquan.index') }}",
                dataType: 'json',
                data: {
                    hanhdong: 'tuannay'
                },
                success: function(data) {
                    chart.setData(data);
                    chart.redraw();
                }
            });
        };
        $('.clickchart').click(function() {
            var handong = $(this).data('datasets');

            $.ajax({
                type: "get",
                url: "{{ route('tongquan.index') }}",
                dataType: 'json',
                data: {
                    hanhdong: handong
                },
                success: function(data) {
                    chart.setData(data);
                }
            });
        });
    </script>
@stop
