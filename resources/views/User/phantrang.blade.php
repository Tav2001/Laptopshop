@if ($paginator->hasPages())

    <div class="col-lg-12">
        <ul class="li-pagination-box">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="Previous">
                    <a><i class="fa fa-chevron-left"></i> Quay Lại</a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <span><i class="fa fa-chevron-left"></i></span> Quay Lại
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a>{{ $page }}</a></li>
                        @elseif ($page == $paginator->currentPage() + 1 ||
                            $page == $paginator->currentPage() + 2 ||
                            $page == $paginator->lastPage())
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="disabled"><a><i class="fa fa-ellipsis-h"></i></a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"> Tiếp Tục
                        <span><i class="fa fa-chevron-right"></i></span>
                    </a>
                </li>
            @else
                <li class="disabled"> Tiếp Tục
                    <span><i class="fa fa-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </div>

@endif
