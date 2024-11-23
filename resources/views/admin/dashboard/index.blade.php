@extends('layouts.admin')

@section('content-header')
<div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            {{-- <div class="page-pretitle">Overview</div> --}}
            <h2 class="page-title">
                {{ trUc('dashboard') }}
            </h2>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-xl d-flex flex-column justify-content-center">
    <div class="row g-3">
        <!-- Welcome Message -->
        <div class="col-12">
            <div class="alert alert-info bg-white">
                {{ trUc('welcome') . ', ' . ucwords(auth()->user()->name) }}
            </div>
        </div>
        <div class="col-12">
            <x-chart-finance />
        </div>
    </div>
</div>
@endsection
