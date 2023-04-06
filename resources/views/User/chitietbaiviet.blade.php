@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    @php
        $url = request()->url();
        \Carbon\Carbon::setLocale('vi');
        $thoigian = $baiviet->ngaytao;
        $thoigian = \Carbon\Carbon::parse($thoigian);
        $currentTime = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
    @endphp
    <!-- Begin Lis Main Blog Page Area -->
    <div class="li-main-blog-page li-main-blog-details-page pt-60 pb-60 pb-sm-45 pb-xs-45">
        <div class="container">
            <div class="row">
                <!-- Begin Lis Blog Sidebar Area -->

                <!-- Lis Blog Sidebar Area End Here -->
                <!-- Begin s Main Content Area -->
                <div class="col-lg-12 order-lg-1 order-1">
                    <div class="row li-main-content">
                        <div class="col-lg-12">
                            <div class="li-blog-single-item pb-30">
                                <div class="li-blog-banner">
                                    <a href="{{ $url }}"><img class="img-full"
                                            src="{{ asset('uploads/baiviet/' . $baiviet->hinh) }}" alt=""></a>
                                </div>

                                <div class="li-blog-content">
                                    <div class="li-blog-details">
                                        <h3 class="li-blog-heading pt-25"><a href="#">{{ $baiviet->tieude }}</a></h3>
                                        <div class="li-blog-meta">
                                            <a class="author" href="#"><i
                                                    class="fa fa-user"></i>{{ $baiviet->BaivietToNguoidung->hoten }}</a>
                                            <a class="comment" href="#"><i class="fa fa-comment-o"></i> <span
                                                    class="fb-comments-count" data-href="{{ $url }}"></span> bình
                                                luận</a>
                                            <a class="post-time" href="#"><i class="fa fa-clock-o"></i>
                                                {{ $thoigian->diffForHumans($currentTime) }}</a>
                                        </div>
                                        <div>
                                            {!! $baiviet->mota !!}
                                        </div>

                                        <div class="li-blog-sharing text-center pt-30">
                                            <h4>chia sẻ bài này:</h4>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Begin Lis Blog Comment Section -->
                            <div class="li-comment-section">
                                <ul>
                                    <div class="fb-comments" data-href="{{ $url }}" data-width="100%"
                                        data-numposts="5"></div>

                                </ul>
                            </div>
                            <!-- Lis Blog Comment Section End Here -->
                        </div>
                    </div>
                </div>
                <!-- Lis Main Content Area End Here -->
            </div>
        </div>
    </div>
    <!-- Lis Main Blog Page Area End Here -->
@endsection
@section('js')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0"
        nonce="OSaMYvie"></script>
@stop
