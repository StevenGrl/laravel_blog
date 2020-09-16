<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item @if($paginate->currentPage() === 1) disabled @endif">
            @if($currentPath === 'index_article')
                <a class="page-link" href="{{ route($currentPath, ['page' => $paginate->currentPage() - 1]) }}">
                    Précédent
                </a>
            @else
                <a class="page-link" href="{{ route($currentPath, ['category' => $category, 'page' => $paginate->currentPage() - 1]) }}">
                    Précédent
                </a>
            @endif
        </li>
        @for($i = 1; $i <= $paginate->lastPage(); $i++)
            <li class="page-item @if($i === $paginate->currentPage()) disabled @endif">
                @if($currentPath === 'index_article')
                    <a class="page-link" href="{{ route($currentPath, ['page' => $i]) }}">{{ $i }}</a>
                @else
                    <a class="page-link" href="{{ route($currentPath, ['category' => $category, 'page' => $i]) }}">{{ $i }}</a>
                @endif
            </li>
        @endfor
        <li class="page-item @if($paginate->currentPage() === $paginate->lastPage()) disabled @endif">
            @if($currentPath === 'index_article')
                <a class="page-link" href="{{ route($currentPath, ['page' => $paginate->currentPage() + 1]) }}">
                    Suivant
                </a>
            @else
                <a class="page-link" href="{{ route($currentPath, ['category' => $category, 'page' => $paginate->currentPage() + 1]) }}">
                    Suivant
                </a>
            @endif
        </li>
    </ul>
</nav>