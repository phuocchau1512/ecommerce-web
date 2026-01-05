@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
@php
    $cart = session('cart', []);
    $total = 0;
@endphp

<div class="container py-5 checkout-page">
    <div class="row g-4">

        <!-- LEFT: FORM (GIỮ NGUYÊN – ĐANG OK) -->
        <div class="col-lg-8">

            <div class="checkout-box mb-4">
                <h5 class="checkout-title">Thông tin giao hàng</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <input class="form-control" placeholder="Nhập họ và tên">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" placeholder="Nhập email">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" value="Vietnam" readonly>
                    </div>
                    <div class="col-12">
                        <input class="form-control" placeholder="Địa chỉ, tên đường">
                    </div>
                    <div class="col-12">
                        <input class="form-control" placeholder="Tỉnh/TP, Quận/Huyện, Phường/Xã">
                    </div>
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
            <div class="checkout-box">
                <h5 class="checkout-title">Phương thức thanh toán</h5>

                <label class="option-card">
                    <input type="radio" name="payment_method" checked>
                    <span class="option-content">
                        <span class="option-text">
                            Thanh toán chuyển khoản qua ngân hàng
                        </span>
                    </span>
                </label>

                <label class="option-card">
                    <input type="radio" name="payment_method">
                    <span class="option-content">
                        <span class="option-text">
                            Thanh toán khi giao hàng (COD)
                        </span>
                    </span>
                </label>
            </div>


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

                        <!-- IMAGE -->
                        <div class="order-img-wrap">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="">
                        </div>

                        <!-- INFO -->
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

                        <!-- QTY -->
                        <div class="order-qty">
                            × {{ $item['quantity'] }}
                        </div>

                        <!-- REMOVE -->
                        <form action="{{ route('cart.remove', $key) }}"
                              method="POST"
                              class="order-remove"
                              onsubmit="return confirm('Xóa sản phẩm này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">🗑</button>
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

                <button class="btn btn-dark w-100 mt-3">
                    ĐẶT HÀNG
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
