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
        <!-- Pagination Elements -->
            {{--    https://stackoverflow.com/a/48152155/12348001--}}
            @foreach ($elements as $element)
            <!-- Array Of Links -->
                @foreach ($element as $page => $url)
                <!--  Use three dots when current page is greater than 4.  -->
                    @if ($paginator->currentPage() > 4 && $page === 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif

                <!--  Show active page else show the first and last two pages from current page.  -->
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif

                <!--  Use three dots when current page is away from end.  -->
                    @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                @endforeach
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
        // len to nastavi page a zachova existujuce parametre
        const mergeWithParamsAndGo = (e) => {
            e.preventDefault()
            const adresa = e.currentTarget.getAttribute("href")
            const params = (new URL(adresa)).searchParams
            const page = params.get("page")
            url.searchParams.set("page", page)
            window.location.href = url.href;
        }

        const elements = document.getElementsByClassName("page-link");
        for (let i = 0; i < elements.length; i++) {
            elements[i].addEventListener('click', mergeWithParamsAndGo);
        }
    </script>
@endpush
