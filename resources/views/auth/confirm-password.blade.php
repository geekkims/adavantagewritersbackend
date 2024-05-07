@extends('adminlte::auth.auth-page', ['auth_type' => 'password-confirm'])

@section('auth_type', 'password-confirm')

@section('auth_body')
    <div class="card card-outline card-primary">
        <div class="card-header">{{ __('Confirm Password') }}</div>
        <div class="card-body">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
