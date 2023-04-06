@extends('LayoutUser')
@section('content')
    @include('User.inc.nav')
    <!-- Begin Lis Main Blog Page Area -->
    <div class="li-main-blog-page pt-60 pb-55">
        <div class="container">
            <div class="row">
                <!-- Begin Lis Main Content Area -->
                <div class="col-lg-12">
                    <div class="row li-main-content">
                        @foreach ($baiviet as $bv)
                            @php
                                \Carbon\Carbon::setLocale('vi');
                                $ngayTao = \Carbon\Carbon::parse($bv->ngaytao)->translatedFormat('d F Y');
                            @endphp
                            <div class="col-lg-4 col-md-6">
                                <div class="li-blog-single-item pb-25">
                                    <div class="li-blog-banner">
                                        <a href="{{ route('chitietbaiviet',['id'=>$bv->mabaiviet,'slug'=>Str::slug($bv->tieude)]) }}"><img class="img-full"
                                                src="{{ asset('uploads/baiviet/' . $bv->hinh) }}" alt=""></a>
                                    </div>
                                    <div class="li-blog-content">
                                        <div class="li-blog-details">
                                            <h3 class="li-blog-heading pt-25"><a style=" font-family: 'FontAwesome'; "
                                                    href="{{ route('chitietbaiviet',['id'=>$bv->mabaiviet,'slug'=>Str::slug($bv->tieude)]) }}">{{ $bv->tieude }}</a></h3>
                                            <div class="li-blog-meta">
                                                <a class="author" href="#"><i class="fa fa-user"></i>{{ $bv->BaivietToNguoidung->hoten }}</a>
                                                <a class="comment" href="#"><i class="fa fa-comment-o"></i> <span class="fb-comments-count" data-href="{{ route('chitietbaiviet',['id'=>$bv->mabaiviet,'slug'=>Str::slug($bv->tieude)]) }}"></span>
                                                    bình luận</a>
                                                <a class="post-time" href="#"><i class="fa fa-calendar"></i> {{ $ngayTao }}</a>
                                            </div>
                                            <p>{!! substr($bv->motangan,0,199) !!}{{ strlen($bv->motangan) > 199 ? '...' : '' }}</p>
                                            <a class="read-more" href="{{ route('chitietbaiviet',['id'=>$bv->mabaiviet,'slug'=>Str::slug($bv->tieude)]) }}">Đọc Thêm...</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Begin Lis Pagination Area -->
                        <div class="col-lg-12">
                            <div class="li-paginatoin-area text-center pt-25">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! $baiviet->render('User.phantrang')  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Lis Pagination End Here Area -->
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
