@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
@php
    $cart = session('cart', []);
    $total = 0;
@endphp

<div class="container py-5 cart-page">

    <h2 class="text-center mb-4 fw-bold">Giỏ hàng của bạn</h2>

    {{-- thông báo --}}
    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

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

                        // query tồn kho (đồ án OK)
                        $variant = \App\Models\ProductVariant::find($key);
                        $stock = $variant ? $variant->stock : 0;
                    @endphp

                    <!-- ITEM -->
                    <div class="cart-item d-flex align-items-center">

                        <!-- IMAGE -->
                        <div class="cart-img">
                            <img src="{{ !empty($item['image']) ? asset('storage/'.$item['image']) : asset('images/product-demo.jpg') }}">
                        </div>

                        <!-- INFO -->
                        <div class="cart-info flex-grow-1 ms-3">
                            <h5 class="cart-title">{{ $item['name'] }}</h5>

                            <div class="cart-price">
                                <span class="price-current">
                                    {{ number_format($item['price']) }}đ
                                </span>
                            </div>

                            @if (!empty($item['variant']))
                                <p class="cart-variant">{{ $item['variant'] }}</p>
                            @endif

                            <!-- QTY -->
                            <div class="cart-qty">
                                <form action="{{ route('cart.update', $key) }}"
                                      method="POST"
                                      class="d-flex align-items-center qty-form">
                                    @csrf
                                    @method('PATCH')

                                    <button type="button"
                                            class="qty-btn btn-minus"
                                            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                        −
                                    </button>

                                    <input type="text"
                                           value="{{ $item['quantity'] }}"
                                           readonly>

                                    <input type="hidden"
                                           name="quantity"
                                           value="{{ $item['quantity'] }}">

                                    <button type="button"
                                            class="qty-btn btn-plus"
                                            data-stock="{{ $stock }}">
                                        +
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- TOTAL -->
                        <div class="cart-total text-end" style="font-weight:700">
                            <strong>{{ number_format($itemTotal) }}đ</strong>

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
                @empty
                    <p class="text-center text-muted">Giỏ hàng đang trống</p>
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

                <a href="{{ route('checkout') }}"
                   class="btn btn-danger w-100 mt-3 {{ empty($cart) ? 'disabled' : '' }}">
                    THANH TOÁN
                </a>
            </div>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
document.querySelectorAll('.btn-plus').forEach(btn => {
    btn.addEventListener('click', function () {

        const form = this.closest('form');
        const displayQty = form.querySelector('input[type="text"]');
        const hiddenQty = form.querySelector('input[name="quantity"]');

        let currentQty = parseInt(displayQty.value);
        const stock = parseInt(this.dataset.stock);

        if (currentQty + 1 > stock) {
            const ok = confirm(
                'Số lượng vượt quá tồn kho.\n' +
                'Kho chỉ còn ' + stock + ' sản phẩm.\n\n' +
                'Giữ số lượng tối đa?'
            );
            if (!ok) return;
            currentQty = stock;
        } else {
            currentQty++;
        }

        displayQty.value = currentQty;
        hiddenQty.value = currentQty;

        form.submit();
    });
});

document.querySelectorAll('.btn-minus').forEach(btn => {
    btn.addEventListener('click', function () {

        const form = this.closest('form');
        const displayQty = form.querySelector('input[type="text"]');
        const hiddenQty = form.querySelector('input[name="quantity"]');

        let currentQty = parseInt(displayQty.value);

        if (currentQty <= 1) return;

        currentQty--;

        displayQty.value = currentQty;
        hiddenQty.value = currentQty;

        form.submit();
    });
});
</script>
@endsection
