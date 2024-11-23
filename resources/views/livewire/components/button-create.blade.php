<div>
    <div class="btn-list">
        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#lw-modal" wire:click="onClickCreate">
            @include('svg.ic_plus')
            {{ trFirst('create') }}
        </a>
        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#lw-modal" aria-label="{{ trFirst('create') }}" wire:click="onClickCreate">
            @include('svg.ic_plus')
        </a>
    </div>
</div>
