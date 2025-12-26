<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">Mộc gia<span>.</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarsFurni">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsFurni">
      <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
        <li><a class="nav-link" href="/">Trang chủ</a></li>
        <li><a class="nav-link" href="/shop">Cửa hàng</a></li>
        <li><a class="nav-link" href="/about">Giới thiệu</a></li>
        <li><a class="nav-link" href="/services">Dịch vụ</a></li>
        <li><a class="nav-link" href="/blog">Bài viết</a></li>
        <li><a class="nav-link" href="/contact">Liên hệ</a></li>
      </ul>

     <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5 align-items-center">
        {{-- USER --}}
        @guest
            {{-- CHƯA ĐĂNG NHẬP --}}
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">
                    <img src="{{ asset('images/user.svg') }}" alt="Tài khoản">
                </a>
            </li>
        @endguest

        @auth
            {{-- ĐÃ ĐĂNG NHẬP --}}
            <li class="nav-item user-dropdown">
                <a href="#" class="nav-link user-toggle">
                    <img src="{{ asset('images/user.svg') }}" alt="Tài khoản">
                </a>

                <div class="user-menu">
                    <div class="user-info">
                        <span>Xin chào</span>
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>

                    <a  class="user-item">
                        Thông tin tài khoản
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="user-item logout">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </li>
        @endauth

        {{-- CART --}}
        <li class="nav-item ms-3">
            <a href="/cart">
                <img src="{{ asset('images/cart.svg') }}" alt="Giỏ hàng">
            </a>
        </li>

    </ul>
    </div>
  </div>
</nav>
