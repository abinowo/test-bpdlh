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
            <h2 class="h2 text-center mb-4">{{ trFirst('change,password') }}</h2>
            {{ alertShow(['success' => \Session::get('success')])}}
            {{ alertShow(['failed' => \Session::get('failed')])}}
            @if($is_expired)
                <div class="text-center">
                    {{ trFirst('token,expired') }}
                </div>
            @elseif($is_invalid)
                @empty(\Session::get('success'))
                    <div class="text-center">
                        {{ trFirst('token,invalid') }}
                    </div>
                @endempty
            @else
                <form action="{{ route('auth.reset.password.proceed') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ trFirst('password') }}</label>
                        <input type="hidden" name="email" value="{{ $email }}"/>
                        <input type="hidden" name="token" value="{{ $token }}"/>
                        <input
                            required
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="******"
                            autocomplete="off"
                        />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ trFirst('password_confirmation') }}</label>
                        <input
                            required
                            type="password"
                            type="password_confirmation"
                            name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="******"
                            autocomplete="off"
                        />
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">{{ trUc('change,password') }}</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
