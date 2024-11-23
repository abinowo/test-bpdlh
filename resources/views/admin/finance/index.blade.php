@extends('layouts.admin')

@section('content-header')
<div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            {{-- <div class="page-pretitle">Overview</div>
            <h2 class="page-title">Vertical layout</h2> --}}
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <livewire:components.button-create />
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-xl d-flex flex-column justify-content-center">
    <livewire:finances.finance-list />
    <x-livewire-modal title="{{ trFirst('create,finance') }}">
        <livewire:finances.finance-form />
    </x-livewire-modal>
</div>
@endsection