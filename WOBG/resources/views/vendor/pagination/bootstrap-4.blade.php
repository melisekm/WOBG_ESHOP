@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-lg justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true"><i class="fas fa-chevron-circle-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       aria-label="@lang('pagination.previous')"><i
                            class="fas fa-chevron-circle-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">&nbsp;{{ $page }}&nbsp;</span>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')"><i
                            class="fas fa-chevron-circle-right"></i></a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true"><i
                            class="fas fa-chevron-circle-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
@push("scripts")
    <script>
        const redirect = (e) => {
            e.preventDefault()
            const target = e.currentTarget
            const adresa = target.getAttribute("href")
            console.log(target, adresa)
            const params = (new URL(adresa)).searchParams
            const page = params.get("page")
            url.searchParams.set("page", page)
            window.location.href = url.href;
        }

        const elements = document.getElementsByClassName("page-link");
        for (let i = 0; i < elements.length; i++) {
            elements[i].addEventListener('click', redirect, false);
        }

    </script>
@endpush
