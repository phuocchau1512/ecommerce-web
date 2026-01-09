<header class="header">
    <div class="flex">

        {{-- LOGO --}}
        <a href="{{ route('admin.dashboard') }}" class="logo">
            Admin<span>Panel</span>
        </a>

        {{-- MENU --}}
        <nav class="navbar">
            <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
            {{-- CHƯA CÓ ROUTE THÌ ĐỂ # --}}
            <a href="#">Sản phẩm</a>
            <a href="#">Đặt hàng</a>
            <a href="#">Users</a>
            <a href="#">Tin nhắn</a>
            <a href="#">Bán hàng</a>
        </nav>

        {{-- ICON --}}
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        {{-- ACCOUNT --}}
        <div class="account-box">
            <p>Tên người dùng :
                <span>{{ Auth::user()->name }}</span>
            </p>
            <p>Email :
                <span>{{ Auth::user()->email }}</span>
            </p>

            {{-- LOGOUT BẮT BUỘC POST --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="delete-btn">
                    Đăng xuất
                </button>
            </form>
        </div>

    </div>
</header>
