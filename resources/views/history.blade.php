@extends('layouts.app')

@section('title', 'Lịch sử mua hàng')

@section('content')

<link rel="stylesheet" href="{{ asset('css/user-orders.css') }}">

<div class="user-order-page">

    <div class="user-order-header">
        <h1>Lịch sử mua hàng</h1>
        <p>Theo dõi các đơn hàng bạn đã đặt</p>
    </div>

    <div class="user-order-card">
        <table class="user-order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ngày đặt</th>
                    <th>Thanh toán</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($order->payment_method) }}</td>
                    <td><strong>{{ number_format($order->total_amount) }}₫</strong></td>

                    <td>
                        <span class="user-order-badge {{ $order->status }}">
                            @switch($order->status)
                                @case('pending') Chờ xử lý @break
                                @case('shipping') Đang giao @break
                                @case('completed') Hoàn thành @break
                                @case('cancelled') Đã hủy @break
                            @endswitch
                        </span>
                    </td>

                    <td>
                        @if($order->status === 'pending')
                            <button class="user-cancel-btn"
                                    data-id="{{ $order->id }}">
                                Hủy đơn
                            </button>
                        @else
                            <span class="user-muted">—</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="user-muted">
                        Chưa có đơn hàng nào
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>

    <div id="user-toast" class="user-toast"></div>
</div>

<script>
document.querySelectorAll('.user-cancel-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;

        if (!confirm('Bạn có chắc muốn hủy đơn hàng này không?')) return;

        fetch(`/orders/${id}/cancel`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error();
            return res.json();
        })
        .then(() => {
            showUserToast('Hủy đơn hàng thành công ❌', 'success');
            setTimeout(() => location.reload(), 800);
        })
        .catch(() => {
            showUserToast('Không thể hủy đơn hàng ❗', 'error');
        });
    });
});

function showUserToast(message, type) {
    const toast = document.getElementById('user-toast');
    toast.textContent = message;
    toast.className = `user-toast show ${type}`;
    setTimeout(() => toast.classList.remove('show'), 3000);
}
</script>

@endsection
