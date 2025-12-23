@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="auth-section">
    <div class="container-fluid">
        <div class="row min-vh-100">

            <!-- LEFT: IMAGE / BACKGROUND -->
            <div class="col-lg-6 d-none d-lg-flex auth-left">
                <div class="auth-left-content">
                    <span class="welcome-badge">Chào mừng bạn 👋</span>

                    <h1>Nội thất tinh tế</h1>

                    <p class="subtitle">
                        Tạo tài khoản để khám phá những thiết kế nội thất hiện đại,
                        tối giản và đầy cảm hứng cho không gian sống của bạn.
                    </p>

                    <img src="{{ asset('images/couch.png') }}" alt="Nội thất" class="auth-image">
                </div>
            </div>

            <!-- RIGHT: FORM -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="auth-form-wrap">
                    <h2 class="mb-4">Tạo tài khoản</h2>

                    <form method="POST"  >
                        @csrf

                        <div class="mb-3">
                            <input type="text" class="form-control" name="name"
                                placeholder="Họ và tên" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control" name="email"
                                placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" name="password"
                                placeholder="Mật khẩu" required>
                        </div>

                        <div class="mb-4">
                            <input type="password" class="form-control"
                                name="password_confirmation"
                                placeholder="Nhập lại mật khẩu" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Đăng ký
                        </button>

                        <p class="text-center mt-3">
                            Đã có tài khoản?
                            <a  class="text-primary">Đăng nhập</a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
