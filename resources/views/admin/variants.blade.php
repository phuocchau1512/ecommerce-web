@php
/** @var \App\Models\Product $product */
@endphp
@extends('layouts.admin')

@section('title', 'Loại sản phẩm')

@section('content')
<div class="user-page">

    <a href="{{ route('admin.adproducts.index') }}" class="btn-back">
        <span class="icon">←</span>
        <span>Quay lại</span>
    </a>


    {{-- Header  + Add --}}
    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px;">

        

        <div>
            <h1>{{ $product->name }}</h1>
            <p>Danh sách loại sản phẩm</p>
        </div>

        <div style="display:flex; gap:10px;">
            

            
        </div>
    </div>

    
    <div class="toolbar">
        

        <div class="toolbar-actions">
            <button class="btn-primary"
                    onclick="document.getElementById('addVariantModal').style.display='flex'">
                + Thêm loại sản phẩm
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên loại sản phẩm</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            @foreach($product->variants as $variant)
                <tr>
                    <td>
                        @if($variant->image)
                            <img src="{{ asset('storage/' .$variant->image) }}"
                                 class="variant-thumb"
                                 alt="{{ $variant->variant_name }}">
                        @else
                            —
                        @endif
                    </td>

                    <td>{{ $variant->variant_name }}</td>
                    <td>{{ number_format($variant->price) }} đ</td>
                    <td>{{ $variant->stock }}</td>

                    <td class="actions">
                        <span class="edit-btn"
                            title="Sửa"
                            data-id="{{ $variant->id }}"
                            data-name="{{ $variant->variant_name }}"
                            data-price="{{ $variant->price }}"
                            data-stock="{{ $variant->stock }}">
                            ✏️
                        </span>

                        <form method="POST"
                             action="{{ route('admin.adproducts.variants.destroy', $variant->id) }}"
                              onsubmit="return confirm('Xóa loại sản phẩm này?')">
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

</div>

{{-- ADD VARIANT MODAL --}}
<div id="addVariantModal" class="modal">
    <div class="modal-content">
        <h2>Thêm loại sản phẩm</h2>

        <form method="POST"
              action="{{ route('admin.adproducts.variants.store', $product->id) }}"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Tên loại sản phẩm</label>
                <input type="text" name="variant_name" required>
            </div>

            <div class="form-group">
                <label>Giá</label>
                <input type="number" name="price" required>
            </div>

            <div class="form-group">
                <label>Tồn kho</label>
                <input type="number" name="stock" required>
            </div>

            <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="image">
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn-primary">Lưu</button>
                <button type="button" class="btn-outline"
                        onclick="document.getElementById('addVariantModal').style.display='none'">
                    Hủy
                </button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT VARIANT MODAL --}}
<div id="editVariantModal" class="modal">
    <div class="modal-content">
        <h2>Sửa loại sản phẩm</h2>

        <form id="editVariantForm"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên loại sản phẩm</label>
                <input type="text" name="variant_name" id="edit-variant-name" required>
            </div>

            <div class="form-group">
                <label>Giá</label>
                <input type="number" name="price" id="edit-price" required>
            </div>

            <div class="form-group">
                <label>Tồn kho</label>
                <input type="number" name="stock" id="edit-stock" required>
            </div>

            <div class="form-group">
                <label>Hình ảnh (không bắt buộc)</label>
                <input type="file" name="image">
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn-primary">Cập nhật</button>
                <button type="button"
                        class="btn-outline"
                        onclick="document.getElementById('editVariantModal').style.display='none'">
                    Hủy
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            document.getElementById('edit-variant-name').value = this.dataset.name;
            document.getElementById('edit-price').value        = this.dataset.price;
            document.getElementById('edit-stock').value        = this.dataset.stock;

            document.getElementById('editVariantForm').action =
                "{{ url('admin/variants') }}/" + this.dataset.id;

            document.getElementById('editVariantModal').style.display = 'flex';
        });
    });
});
</script>


@endsection
