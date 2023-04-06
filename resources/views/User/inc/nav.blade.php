<!-- Begin Lis Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ route('trangchu.index') }}">Trang Chủ</a></li>
                {!! request()->is('chi-tiet-san-pham/*') ? '<li><a href="#">Laptop</a></li>' : '' !!}
                {!! request()->is('bai-viet-*') ? '<li><a href="#">Bài Viết</a></li>' : '' !!}
                <li class="active">{{ $tieude }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Lis Breadcrumb Area End Here -->
