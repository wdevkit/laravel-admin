@extends('wdevkit_admin::layouts.auth')

@section('content')

<form class="form-signin" action="{{ route('wdevkit_admin.login') }}" method="POST">
    @csrf

    <img class="mb-4" src="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal">{{ __("Please sign in") }}</h1>

    @include('wdevkit_admin::partials.errors')

    <label for="inputEmail" class="sr-only">{{ __("Email") }}</label>

    <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" placeholder="{{ __("Email") }}" value="{{ old('email') }}" required autofocus autocomplete="off">

    <label for="inputPassword" class="sr-only">{{ __("Password") }}</label>

    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="{{ __("Password") }}" required autocomplete="off">

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" id="rememberCheckbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __("Remember me") }}
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __("Sign in") }}</button>

    <p class="mt-5 mb-3 text-muted">&copy; {{ now()->format('Y') }}</p>

</form>

@endsection
