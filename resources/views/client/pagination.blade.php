@if ($paginator->hasPages())
<div class="col-lg-12 pt-5">
    <nav aria-label="Page navigation example">
        <ul class="pagination d-flex justify-content-end">
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link arrow" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item"><a class="page-link active" >{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}" >{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link arrow" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif