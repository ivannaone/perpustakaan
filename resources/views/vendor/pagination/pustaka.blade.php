@if ($paginator->hasPages())
    <nav class="pager" role="navigation" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="pager-btn is-disabled">Sebelumnya</span>
        @else
            <a class="pager-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a>
        @endif
        <span class="pager-meta">Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>
        @if ($paginator->hasMorePages())
            <a class="pager-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">Berikutnya</a>
        @else
            <span class="pager-btn is-disabled">Berikutnya</span>
        @endif
    </nav>
    <style>
        .pager { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; margin-top: 16px; font-size: 13px; }
        .pager-btn { display: inline-flex; padding: 8px 14px; border-radius: 999px; border: 1px solid #e2e8f0; background: #fff; color: #1e3a5f; text-decoration: none; }
        .pager-btn.is-disabled { opacity: .45; }
        .pager-meta { color: #64748b; }
    </style>
@endif
