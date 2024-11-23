@extends('layouts.auth-tabler')

@section('content')
<div class="container container-tight py-4">
    <div class="text-center mb-4">
      <a href="." class="navbar-brand navbar-brand-autodark">
        <img src="{{ asset('images/logo-black.svg') }}" style="height: 100px">
      </a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ trFirst('verification,success') }}</h2>
            {{ alertShow(['success' => \Session::get('success')])}}
            {{ alertShow(['failed' => \Session::get('failed')])}}
            <p class="text-center">
                {{ tr('your,email,verification,success') }}
            </p>
        </div>
    </div>
</div>
@endsection
