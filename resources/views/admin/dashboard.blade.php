@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="order-page">

    {{-- Header --}}
    <div class="page-header">
        <h1>Bảng điều khiển</h1>
        <p>Tổng quan hoạt động hệ thống</p>
    </div>

    {{-- OUTER: căn giữa --}}
    <div class="dashboard-wrapper">

        <div class="dashboard-wrapper">
            <div class="dashboard-grid">
                <!-- dashboard-card ở đây -->
                 <a href="{{ route('admin.orders.index') }}" class="dashboard-card pending">
                    <div class="card-icon">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                    <div class="card-content">
                        <span>Tổng tiền đang xử lý</span>
                        <strong>{{ number_format($pendingRevenue) }} ₫</strong>
                    </div>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="dashboard-card success">
                    <div class="card-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="card-content">
                        <span>Thanh toán thành công</span>
                        <strong>{{ number_format($completedRevenue) }} ₫</strong>
                    </div>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="dashboard-card info">
                    <div class="card-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <div class="card-content">
                        <span>Tổng đơn hàng</span>
                        <strong>{{ $orderCount }}</strong>
                    </div>
                </a>

                <a href="{{ route('admin.adproducts.index') }}" class="dashboard-card purple">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-content">
                        <span>Tổng sản phẩm</span>
                        <strong>{{ $productCount }}</strong>
                    </div>
                </a>

                <a href="{{ route('admin.users.index') }}" class="dashboard-card user">
                    <div class="card-icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="card-content">
                        <span>Tài khoản User</span>
                        <strong>{{ $userCount }}</strong>
                    </div>
                </a>

                <a href="{{ route('admin.users.index') }}" class="dashboard-card admin">
                    <div class="card-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="card-content">
                        <span>Tài khoản Admin</span>
                        <strong>{{ $adminCount }}</strong>
                    </div>
            </a>
            </div>
        </div>
        
    </div>
</div>



@endsection
