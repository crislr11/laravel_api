@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endsection

@section('content')
<div class="register-page">
    <div class="register-form">
        <h3 class="register-form__title">{{ __('Register') }}</h3>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!--@if ($errors->any())
                <div class="register-form__alert alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif-->

            <div class="register-form__field row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
            </div>

            <div class="register-form__field row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                </div>
            </div>

            <div class="register-form__field row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="register-form__field row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="register-form__field row mb-3">
                <label class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rol" id="user" value="u" {{ old('rol') == 'u' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="user">{{ __('User') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rol" id="organizer" value="o" {{ old('rol') == 'o' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="organizer">{{ __('Organizer') }}</label>
                    </div>
                </div>
            </div>

            <div class="register-form__field row mb-3">
                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Upload Image') }}</label>
                <div class="col-md-6">
                    <input id="image-dropzone" type="file" name="image" class="form-control">
                </div>
            </div>

            <div class="register-form__footer row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="register-form__button btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
@endsection
