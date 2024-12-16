@if ($paginator->hasPages())
    <nav class="navigation pagination" aria-label="Products">
        <ul class="page-numbers">
            <li class="@if ($paginator->onFirstPage()) disabled @endif">
                <a class="next page-numbers" href="{{$paginator->previousPageUrl()}}" tabindex="-1"><i class="fal fa-arrow-right"></i></a>
            </li>
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span aria-current="page" class="page-numbers current">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="@if ($page == $paginator->currentPage()) paginaterActive @endif"><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                    @endforeach
                @endif
            @endforeach
            <li><a class="next page-numbers" href="{{$paginator->nextPageUrl()}}" @if (!$paginator->hasMorePages()) disabled @endif><i class="fal fa-arrow-left"></i></a></li>
        </ul>
    </nav>
@endif
