@extends('layouts.blankLayout')

@section('title', 'Login')
@section('page-style')
    @vite(['resources/assets/vendor/scss/core.scss','resources/assets/vendor/scss/pages/page-auth.scss'])

@endsection
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo"></span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Добро пожаловать в Стеклоград</h4>
                        <p class="mb-6">Пожалуйста, войдите в свой аккаунт.</p>

                        <form id="formAuthentication" class="mb-6" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="Enter your email " autofocus/>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="Password"/>
                                    <span class="input-group-text cursor-pointer"><i
                                                class="icon-base bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection