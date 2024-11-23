<div>
    @if($items->hasPages())
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">
                {{trFirst('showing')}} 
                <span>{{ $items->firstItem() }}</span> {{tr('to')}} 
                <span>{{ $items->lastItem() }}</span> {{tr('of')}} 
                <span>{{ $items->total() }}</span> {{tr('entries')}}
            </p>
            <ul class="pagination m-0 ms-auto">
                @if ($items->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 6l-6 6l6 6"></path>
                            </svg>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="#" wire:click.prevent="previousPage" rel="prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 6l-6 6l6 6"></path>
                            </svg>
                        </a>
                    </li>
                @endif

                @foreach ($items->links()->elements[0] as $page => $url)
                    <li class="page-item {{ $page == $items->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($items->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="#" wire:click.prevent="nextPage" rel="next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 6l6 6l-6 6"></path>
                            </svg>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 6l6 6l-6 6"></path>
                            </svg>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    @endif
</div>