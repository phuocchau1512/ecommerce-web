@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
@php
    $cart = session('cart', []);
    $total = 0;
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="container py-5 checkout-page">
    <div class="row g-4">

        <!-- LEFT: FORM -->
        <div class="col-lg-8">

            {{-- FORM CHECKOUT --}}
            <form action="{{ route('checkout.place') }}" method="POST">
            @csrf

            <div class="checkout-box mb-4">
                <h5 class="checkout-title">Thông tin giao hàng</h5>

                <div class="row g-3">
                    <input class="form-control"
                        name="name"
                        placeholder="Nhập họ và tên"
                        required>

                    <input class="form-control"
                        name="phone"
                        placeholder="Nhập số điện thoại"
                        required>

                    <input class="form-control"
                        name="email"
                        placeholder="Nhập email">

                    <input class="form-control"
                        name="address"
                        placeholder="Địa chỉ, tên đường, quận, tỉnh"
                        required>
                </div>
            </div>

            {{-- PHƯƠNG THỨC GIAO HÀNG --}}
            <div class="checkout-box mb-4">
                <h5 class="checkout-title">Phương thức giao hàng</h5>

                <label class="option-card">
                    <input type="radio" name="shipping_method" checked>
                    <span class="option-content">
                        <span class="option-text">
                            Miễn phí giao hàng & lắp đặt tại tất cả quận huyện thuộc TP.HCM đối với các sản phẩm nội thất.
                            Các sản phẩm thuộc danh mục Đồ Trang Trí, phí giao hàng sẽ được MOHO liên hệ báo sau.
                        </span>
                        <strong class="option-price">Miễn phí</strong>
                    </span>
                </label>
            </div>

            {{-- PHƯƠNG THỨC THANH TOÁN --}}
            <div class="checkout-box mb-4">
                <h5 class="checkout-title">Phương thức thanh toán</h5>

                <label class="option-card">
                    <input type="radio" name="payment_method" value="bank" checked>
                    <span class="option-content">
                        <span class="option-text">
                            Thanh toán chuyển khoản qua ngân hàng
                        </span>
                    </span>
                </label>

                <label class="option-card">
                    <input type="radio" name="payment_method" value="cod">
                    <span class="option-content">
                        <span class="option-text">
                            Thanh toán khi giao hàng (COD)
                        </span>
                    </span>
                </label>
            </div>

            {{-- NÚT ĐẶT HÀNG  --}}
            <button type="submit" class="btn btn-dark w-100">
                ĐẶT HÀNG
            </button>

            </form>
            {{-- END FORM CHECKOUT --}}

        </div>

        <!-- RIGHT: GIỎ HÀNG + TÓM TẮT -->
        <div class="col-lg-4">

            <!-- GIỎ HÀNG -->
            <div class="order-summary mb-4">
                <h5 class="summary-title">Giỏ hàng</h5>

                @foreach ($cart as $key => $item)
                    @php
                        $itemTotal = $item['price'] * $item['quantity'];
                        $total += $itemTotal;
                    @endphp

                    <div class="order-item">

                        <div class="order-img-wrap">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="">
                        </div>

                        <div class="order-info">
                            <div class="order-name">
                                {{ $item['name'] }}
                            </div>

                            @if (!empty($item['variant']))
                                <div class="order-variant">
                                    {{ $item['variant'] }}
                                </div>
                            @endif

                            <div class="order-price">
                                {{ number_format($item['price']) }}đ
                            </div>
                        </div>

                        <div class="order-qty">
                            × {{ $item['quantity'] }}
                        </div>

                        <!-- REMOVE ITEM -->
                        <form action="{{ route('cart.remove', $key) }}"
                              method="POST"
                              class="order-remove"
                              onsubmit="return confirm('Xóa sản phẩm này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>

                    </div>
                @endforeach
            </div>

            <!-- TÓM TẮT -->
            <div class="order-summary">
                <h5 class="summary-title">Tóm tắt đơn hàng</h5>

                <div class="summary-row">
                    <span>Tổng tiền hàng</span>
                    <strong>{{ number_format($total) }}đ</strong>
                </div>

                <div class="summary-row">
                    <span>Phí vận chuyển</span>
                    <strong class="text-success">Miễn phí</strong>
                </div>

                <hr>

                <div class="summary-row total">
                    <span>Tổng thanh toán</span>
                    <strong>{{ number_format($total) }}đ</strong>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
