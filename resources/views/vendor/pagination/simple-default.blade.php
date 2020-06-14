@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true"><span>Precedent</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Precedent</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant</a></li>
        @else
            <li class="disabled" aria-disabled="true"><span>Suivant</span></li>
        @endif
    </ul>
@endif
