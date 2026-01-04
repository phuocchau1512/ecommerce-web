@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
@php
    $cart = session('cart', []);
    $total = 0;
@endphp

<div class="container-fluid checkout-page">
    <div class="row">

        <!-- LEFT: FORM -->
        <div class="col-lg-8 p-5 checkout-left">

            <h5 class="checkout-title mb-4">Thông tin giao hàng</h5>

            <div class="checkout-box mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input class="form-control" placeholder="Họ và tên">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" placeholder="Số điện thoại">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" placeholder="Email">
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

            <div class="checkout-box mb-4">
                <h6 class="mb-2">Phương thức giao hàng</h6>
                <label class="shipping-method">
                    <input type="radio" checked>
                    <span>
                        Miễn phí giao hàng & lắp đặt tại TP.HCM
                        <strong class="float-end text-success">Miễn phí</strong>
                    </span>
                </label>
            </div>

            <div class="checkout-box mb-4">
                <h6 class="mb-2">Phương thức thanh toán</h6>
                <label class="payment-method">
                    <input type="radio" name="payment" checked>
                    <span>Chuyển khoản ngân hàng</span>
                </label>
                <label class="payment-method">
                    <input type="radio" name="payment">
                    <span>Thanh toán khi giao hàng (COD)</span>
                </label>
            </div>

            <!-- TÓM TẮT -->
            <div class="checkout-box">
                <h6 class="mb-3">Tóm tắt đơn hàng</h6>

                @foreach ($cart as $item)
                    @php
                        $itemTotal = $item['price'] * $item['quantity'];
                        $total += $itemTotal;
                    @endphp

                    <div class="mini-cart-item">
                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <strong>{{ number_format($itemTotal) }}đ</strong>
                    </div>
                @endforeach

                <hr>

                <div class="summary-row total">
                    <span>Tổng thanh toán</span>
                    <strong>{{ number_format($total) }}đ</strong>
                </div>

                <button class="btn btn-danger w-100 mt-3">
                    HOÀN TẤT ĐẶT HÀNG
                </button>
            </div>
        </div>

        <!-- RIGHT: IMAGE (NHỎ GỌN) -->
        <div class="col-lg-4 checkout-right d-none d-lg-flex">
            <img
                src="{{ asset('storage/' . ($cart[array_key_first($cart)]['image'] ?? '')) }}"
                class="checkout-hero"
                alt="">
        </div>

    </div>
</div>
@endsection
