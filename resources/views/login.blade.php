@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="auth-section">
    <div class="container-fluid">
        <div class="row min-vh-100">

            <!-- LEFT: IMAGE / BACKGROUND -->
            <div class="col-lg-6 d-none d-lg-flex auth-left">
                <div class="auth-left-content">
                    <span class="welcome-badge">Chào mừng trở lại 👋</span>

                    <h1>Nội thất tinh tế</h1>

                    <p class="subtitle">
                        Đăng nhập để tiếp tục khám phá những thiết kế nội thất hiện đại,
                        tối giản và đầy cảm hứng cho không gian sống của bạn.
                    </p>

                    <img src="{{ asset('images/couch.png') }}" alt="Nội thất" class="auth-image">
                </div>
            </div>

            <!-- RIGHT: FORM -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="auth-form-wrap">
                    <h2 class="mb-4">Đăng nhập</h2>

                    {{-- THÔNG BÁO LỖI --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Email hoặc mật khẩu không chính xác.
                        </div>
                    @endif

                    {{-- THÔNG BÁO THÀNH CÔNG --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Email"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-4">
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="Mật khẩu"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Đăng nhập
                        </button>

                        {{-- REGISTER LINK --}}
                        <p class="text-center mt-3 text-muted">
                            Chưa có tài khoản?
                            <a href="{{ url('/register') }}" class="text-decoration-none">
                                Đăng ký ngay
                            </a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
