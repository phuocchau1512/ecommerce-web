@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
@php
    $cart = session('cart', []);
    $total = 0;
@endphp

<div class="container py-5 cart-page">

    <h2 class="text-center mb-4 fw-bold">Giỏ hàng của bạn</h2>

    <div class="row">
        <!-- LEFT -->
        <div class="col-lg-8">

            <div class="cart-box mb-3">
                <p class="mb-3 text-muted">
                    Có <strong>{{ count($cart) }}</strong> sản phẩm trong giỏ hàng
                </p>

                @forelse ($cart as $key => $item)
                    @php
                        $itemTotal = $item['price'] * $item['quantity'];
                        $total += $itemTotal;
                    @endphp

                    <!-- ITEM -->
                    <div class="cart-item d-flex align-items-center">

                        <!-- IMAGE -->
                        <div class="cart-img">
                            @if (!empty($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="">
                            @else
                                <img src="{{ asset('images/product-demo.jpg') }}" alt="">
                            @endif
                        </div>

                        <!-- INFO -->
                        <div class="cart-info flex-grow-1 ms-3">
                            <h5 class="cart-title">
                                {{ $item['name'] ?? 'Sản phẩm' }}
                            </h5>

                            <div class="cart-price">
                                <span class="price-current">
                                    {{ number_format($item['price']) }}đ
                                </span>
                            </div>

                            @if (!empty($item['variant']))
                                <p class="cart-variant">
                                    {{ $item['variant'] }}
                                </p>
                            @endif

                            <!-- QTY (chưa xử lý update) -->
                            <div class="cart-qty">
                                <button class="qty-btn" disabled>-</button>
                                <input type="text" value="{{ $item['quantity'] }}" readonly>
                                <button class="qty-btn" disabled>+</button>
                            </div>
                        </div>

                        <!-- TOTAL -->
                        <div class="cart-total text-end" style="color:#000;font-weight:700">
                            <strong>
                                {{ number_format($itemTotal) }}đ
                            </strong>

                            {{-- route remove --}}
                            <form action="{{ route('cart.remove', $key) }}"
                            method="POST"
                            class="cart-remove-form"
                            onsubmit="return confirm('Xóa sản phẩm này khỏi giỏ hàng?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" title="Xóa sản phẩm">
                                ✕
                            </button>
                        </form>
                        </div>
                    </div>
                    <!-- END ITEM -->

                @empty
                    <p class="text-center text-muted">
                        Giỏ hàng đang trống
                    </p>
                @endforelse

            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-lg-4">
            <div class="summary-box">
                <h5 class="summary-title">Thông tin đơn hàng</h5>

                <div class="summary-row">
                    <span>Tổng tiền:</span>
                    <strong class="summary-total">
                        {{ number_format($total) }}đ
                    </strong>
                </div>

                <button class="btn btn-danger w-100 mt-3"
                        {{ empty($cart) ? 'disabled' : '' }}>
                    THANH TOÁN
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
