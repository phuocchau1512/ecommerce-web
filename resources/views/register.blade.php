@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="auth-section">
    <div class="container-fluid">
        <div class="row min-vh-100">

            <!-- LEFT -->
            <div class="col-lg-6 d-none d-lg-flex auth-left">
                <div class="auth-left-content">
                    <span class="welcome-badge">Chào mừng quý khách 👋</span>
                    <h1>Nội thất tinh tế</h1>
                    <p class="subtitle">
                        Tạo tài khoản để khám phá những thiết kế nội thất hiện đại,
                        tối giản và đầy cảm hứng cho không gian sống của bạn.
                    </p>
                    <img src="{{ asset('images/couch.png') }}" class="auth-image">
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="auth-form-wrap">
                    <h2 class="mb-4">Tạo tài khoản</h2>

                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3">
                            <input type="text" name="name" id="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Họ và tên">
                            <small class="text-danger" id="error-name">
                                @error('name') {{ $message }} @enderror
                            </small>
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <input type="email" name="email" id="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email">
                            <small class="text-danger" id="error-email">
                                @error('email') {{ $message }} @enderror
                            </small>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Mật khẩu">
                            <small class="text-danger" id="error-password">
                                @error('password') {{ $message }} @enderror
                            </small>
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="mb-4">
                            <input type="password" name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="Nhập lại mật khẩu">
                            <small class="text-danger" id="error-confirm"></small>
                        </div>

                        <button class="btn btn-primary w-100">
                            Đăng ký
                        </button>

                        <p class="text-center mt-3 text-muted">
                            Đã có tài khoản?
                            <a href="{{ route('login') }}">Đăng nhập</a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('registerForm').addEventListener('submit', function (e) {
    let valid = true;

    // clear lỗi
    document.querySelectorAll('small.text-danger').forEach(el => el.innerText = '');
    document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));

    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');

    // NAME
    if (name.value.trim().length < 3) {
        setError(name, 'error-name', 'Họ tên phải ít nhất 3 ký tự');
        valid = false;
    }

    // EMAIL
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        setError(email, 'error-email', 'Email không đúng định dạng');
        valid = false;
    }

    // PASSWORD
    if (password.value.length < 6) {
        setError(password, 'error-password', 'Mật khẩu phải ít nhất 6 ký tự');
        valid = false;
    }

    // CONFIRM
    if (password.value !== confirm.value) {
        setError(confirm, 'error-confirm', 'Mật khẩu nhập lại không khớp');
        valid = false;
    }

    if (!valid) e.preventDefault();
});

function setError(input, errorId, message) {
    input.classList.add('is-invalid');
    document.getElementById(errorId).innerText = message;
}
</script>
@endsection
