<div>
    {{ alertShow(['success' => \Session::get('success')])}}
    {{ alertShow(['failed' => \Session::get('failed')])}}
    @if($items->count() > 0)
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trFirst('staff') }}</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>{{ trFirst('name') }}</th>
                                <th>{{ trFirst('role') }}</th>
                                <th>{{ trFirst('email') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name ?? '-'}}</td>
                                    <td>{{ $item->getRoleNames()->first() ?? '-' }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-warning btn-icon" data-bs-toggle="modal" data-bs-target="#lw-modal" wire:click="onClickEdit({{ $item->id }})">
                                            @include('svg.ic_pencil')
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-icon" wire:click="onDeleteItem({{$item->id}})">
                                            @include('svg.ic_trash')
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <x-livewire-pagination :items="$items" />
            </div>
        </div>
    @else
        <div class="empty">
            <div class="empty-img"><img src="{{ asset('themes/static/illustrations/undraw_printing_invoices_5r4r.svg') }}" height="128" alt=""></div>
            <p class="empty-title">{{ trFirst('notfound') }}</p>
            <p class="empty-subtitle text-secondary">
                {{ trFirst('try_adjusting') }}
            </p>
        </div>
    @endif
</div>
