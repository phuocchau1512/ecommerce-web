@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="user-page">

    <div class="page-header">
        <h1>Quản lý người dùng</h1>
        <p>Quản lý toàn bộ tài khoản, phân quyền và kiểm soát truy cập.</p>
    </div>

    {{-- Toolbar --}}
    <div class="toolbar">
        <form method="GET" style="display:flex; gap:10px; align-items:center;">
            <input type="text"
                name="search"
                placeholder="Tìm kiếm người dùng..."
                value="{{ request('search') }}">

            @if(request()->filled('search'))
                <a href="{{ route('admin.users.index') }}"
                class="btn-icon"
                title="Reset tìm kiếm">
                    <img src="{{ asset('images/power-reset.svg') }}" alt="Reset">
                </a>
            @endif
        </form>


        <div class="toolbar-actions">
            <button class="btn-outline">Xuất dữ liệu</button>
            <button class="btn-primary" onclick="document.getElementById('addUserModal').style.display='flex'">
                + Thêm người dùng
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>

                    <td style="display:flex;align-items:center;gap:12px;">
                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random"
                             style="width:36px;height:36px;border-radius:50%">
                        {{ $user->name }}
                    </td>

                    <td>{{ $user->email }}</td>

                    <td>
                        <span class="badge {{ $user->role }}">
                            {{ $user->role === 'admin' ? 'Quản trị' : 'Người dùng' }}
                        </span>
                    </td>

                    <td>{{ $user->created_at->format('d/m/Y') }}</td>

                    <td class="actions">
                        <span class="edit-btn"
                        title="Sửa"
                        data-id="{{ $user->id }}"
                        data-name="{{ $user->name }}"
                        data-email="{{ $user->email }}"
                        data-role="{{ $user->role }}">
                        ✏️
                    </span>

                        <form method="POST"
                            action="{{ route('admin.users.destroy', $user->id) }}"
                            onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này?')">
                            @csrf
                            @method('DELETE')
                            <button title="Xóa">🗑️</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination">
        {{ $users->links() }}
    </div>

    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <h2>Thêm người dùng</h2>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label>Quyền</label>
                    <select name="role">
                        <option value="user">Người dùng</option>
                        <option value="admin">Quản trị</option>
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Lưu</button>
                    <button type="button" class="btn-outline"
                            onclick="document.getElementById('addUserModal').style.display='none'">
                        Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editUserModal" class="modal">
    <div class="modal-content">
        <h2>Sửa người dùng</h2>

        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" name="name" id="edit-name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="edit-email" required>
            </div>

            <div class="form-group">
                <label>Mật khẩu mới (không bắt buộc)</label>
                <input type="password" name="password">
            </div>

            <div class="form-group">
                <label>Quyền</label>
                <select name="role" id="edit-role">
                    <option value="user">Người dùng</option>
                    <option value="admin">Quản trị</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn-primary">Cập nhật</button>
                <button type="button" class="btn-outline"
                        onclick="document.getElementById('editUserModal').style.display='none'">
                    Hủy
                </button>
            </div>
        </form>
    </div>
</div>


</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('edit-name').value  = this.dataset.name;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-role').value  = this.dataset.role;

            document.getElementById('editUserForm').action =
                "{{ url('admin/users') }}/" + this.dataset.id;

            document.getElementById('editUserModal').style.display = 'flex';
        });
    });
});
</script>



@endsection
