@extends('layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
<div class="container py-5 checkout-success-page">

    <div class="success-box text-center mx-auto">

        <!-- ICON -->
        <div class="success-icon">
            ✓
        </div>

        <!-- TITLE -->
        <h2 class="success-title">
            Đặt hàng thành công!
        </h2>

        <!-- MESSAGE -->
        <p class="success-desc">
            Cảm ơn bạn đã mua hàng tại <strong>Mộc Gia</strong>.<br>
            Đơn hàng của bạn đã được ghi nhận và đang chờ xử lý.
        </p>

        <!-- ORDER INFO -->
        <div class="order-info-box text-start">
            <div class="order-row">
                <span>Mã đơn hàng</span>
                <strong>#{{ $order->id }}</strong>
            </div>

            <div class="order-row">
                <span>Tên khách hàng</span>
                <strong>{{ $order->customer_name }}</strong>
            </div>

            <div class="order-row">
                <span>Số điện thoại</span>
                <strong>{{ $order->customer_phone }}</strong>
            </div>

            <div class="order-row">
                <span>Địa chỉ giao hàng</span>
                <strong>{{ $order->customer_address }}</strong>
            </div>

            <div class="order-row">
                <span>Tổng thanh toán</span>
                <strong class="text-danger">
                    {{ number_format($order->total_amount) }}đ
                </strong>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="success-actions mt-4">
            <a href="{{ route('shop.index') }}" class="btn btn-outline-dark me-2">
                Tiếp tục mua sắm
            </a>

            <a href="{{ route('home') }}" class="btn btn-dark">
                Về trang chủ
            </a>
        </div>

    </div>

</div>
@endsection
