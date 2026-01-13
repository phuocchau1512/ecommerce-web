@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="order-page">

    {{-- Header --}}
    <div class="page-header">
        <h1>Quản lý đơn hàng</h1>
        <p>Theo dõi, xử lý và kiểm soát toàn bộ đơn hàng.</p>
    </div>

    {{-- Toolbar --}}
    <div class="toolbar">
        <form method="GET" class="order-search">
            <input type="text"
                   name="search"
                   placeholder="Tìm theo mã đơn, tên hoặc SĐT..."
                   value="{{ request('search') }}">

            @if(request()->filled('search'))
                <a href="{{ route('admin.orders.index') }}" class="btn-icon" title="Reset">
                    🔄
                </a>
            @endif
            <select name="status" onchange="this.form.submit()" class="order-filter">
                <option value="">Tất cả trạng thái</option>
                <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>
                    Đã hủy
                </option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>
                    Chờ xử lý
                </option>
                <option value="shipping" {{ request('status')=='shipping'?'selected':'' }}>
                    Đang giao
                </option>
                <option value="completed" {{ request('status')=='completed'?'selected':'' }}>
                    Hoàn thành
                </option>
            </select>
        </form>

        
    </div>

    {{-- Table --}}
    <div class="order-card">
        <table class="order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Liên hệ</th>
                    <th>Thanh toán</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)
                {{-- Order row --}}
                <tr>
                    <td>#{{ $order->id }}</td>

                    <td>
                        <strong>{{ $order->customer_name }}</strong><br>
                        <small class="muted">{{ $order->customer_address }}</small>
                    </td>

                    <td>
                        {{ $order->customer_phone }}<br>
                        <small class="muted">{{ $order->customer_email }}</small>
                    </td>

                    <td>{{ ucfirst($order->payment_method) }}</td>

                    <td>
                        <strong>{{ number_format($order->total_amount) }}₫</strong>
                    </td>

                    <td>
                        <select class="order-status-select {{ $order->status }}"
                            data-id="{{ $order->id }}"
                            {{ in_array($order->status, ['completed', 'cancelled']) ? 'disabled' : '' }}>

                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                            Chờ xử lý
                        </option>

                        <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>
                            Đang giao
                        </option>

                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                            Hoàn thành
                        </option>

                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                            Đã hủy
                        </option>
                    </select>
                    </td>

                    <td>{{ $order->created_at->format('d/m/Y') }}</td>

                    <td>
                        <button class="btn-outline view-order"
                                data-id="{{ $order->id }}">
                            👁
                        </button>
                    </td>
                </tr>

                {{-- Order items --}}
                <tr id="order-{{ $order->id }}" class="order-items-row" style="display:none;">
                    <td colspan="8">
                        <div class="order-items-card">
                            <div class="order-items-header">
                                Danh sách sản phẩm
                            </div>

                        <table class="order-items-table">
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
                            <tr style="background:#f8fafc;font-weight:600;">
                                <td colspan="2">Tổng cộng</td>
                                <td>
                                    x{{ $order->items->sum('quantity') }}
                                </td>
                                <td>
                                    {{ number_format($order->total_amount) }}₫
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
    <div id="toast" class="toast"></div>
</div>

{{-- Script --}}
<script>
document.querySelectorAll('.view-order').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const row = document.getElementById('order-' + id);
        row.style.display = row.style.display === 'none'
            ? 'table-row'
            : 'none';
    });
});

function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className = `toast show ${type}`;

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

document.querySelectorAll('.order-status-select').forEach(select => {

    let previousStatus = select.value;

    select.addEventListener('change', () => {
        const orderId = select.dataset.id;
        const newStatus = select.value;

        //  ĐÃ HỦY HOẶC HOÀN THÀNH
        if (previousStatus === 'completed' || previousStatus === 'cancelled') {
            showToast('Đơn hàng đã kết thúc, không thể thay đổi ❗', 'error');
            select.value = previousStatus;
            return;
        }

        const label = {
            pending: 'Chờ xử lý',
            shipping: 'Đang giao',
            completed: 'Hoàn thành',
            cancelled: 'Đã hủy'
        };

        const confirmed = confirm(
            `Bạn có chắc muốn chuyển đơn #${orderId} sang trạng thái "${label[newStatus]}" không?`
        );

        if (!confirmed) {
            select.value = previousStatus;
            return;
        }

        fetch(`/admin/orders/${orderId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(res => {
            if (!res.ok) throw new Error();
            return res.json();
        })
        .then(data => {
            if (data.success) {
                previousStatus = newStatus;
                select.className = 'order-status-select ' + newStatus;

                // nếu hủy → khóa luôn
                if (newStatus === 'cancelled') {
                    select.disabled = true;
                }

                showToast('Cập nhật trạng thái thành công ✅', 'success');
            }
        })
        .catch(() => {
            select.value = previousStatus;
            showToast('Cập nhật trạng thái thất bại ❌', 'error');
        });
    });
});



</script>

@endsection
