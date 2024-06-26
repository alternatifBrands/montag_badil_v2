@extends('web.auth.auth_layout')
@section('title','Reset Page')
@section('content')
<form method="POST" action="{{ route('reset.post') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password')
            }}</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" value="{{old('password')}}" required autocomplete="new-password">
            @error('password')
            <span class="text-dark" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{
            __('Confirm Password') }}</label>
        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                value="{{old('password_confirmation')}}" required autocomplete="new-password">
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-success">
                {{ __('Reset Password') }}
            </button>
        </div>
    </div>
</form>
@endsection