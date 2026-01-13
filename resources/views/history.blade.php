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
                    <th>Chi tiết</th>
                </tr>
            </thead>

            <tbody>
            @forelse($orders as $order)

                {{-- ORDER ROW --}}
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
                            <button class="user-cancel-btn" data-id="{{ $order->id }}">
                                Hủy đơn
                            </button>
                        @else
                            <span class="user-muted">—</span>
                        @endif
                    </td>

                    <td>
                        <button class="user-view-btn" data-id="{{ $order->id }}">
                            👁
                        </button>
                    </td>
                </tr>

                {{-- ORDER DETAIL --}}
                <tr id="user-order-{{ $order->id }}" class="user-order-items-row" style="display:none;">
                    <td colspan="7">
                        <div class="user-order-items-card">

                            <div class="user-order-items-header">
                                Danh sách sản phẩm
                            </div>

                            <table class="user-order-items-table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Phân loại</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->variant_name }}</td>
                                        <td>x{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price) }}₫</td>
                                    </tr>
                                @endforeach

                                <tr class="user-order-total">
                                    <td colspan="2">Tổng cộng</td>
                                    <td>x{{ $order->items->sum('quantity') }}</td>
                                    <td>{{ number_format($order->total_amount) }}₫</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7" class="user-muted">
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

{{-- JS --}}
<script>
document.querySelectorAll('.user-view-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const row = document.getElementById('user-order-' + id);
        row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    });
});

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
