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

      <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
        <li>
          <a href="/register">
            <img src="{{ asset('images/user.svg') }}" alt="Tài khoản">
          </a>
        </li>
        <li><img src="{{ asset('images/cart.svg') }}" alt="Giỏ hàng"></li>
      </ul>
    </div>
  </div>
</nav>
