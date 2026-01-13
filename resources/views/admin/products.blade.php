@php
/** 
 * @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Product[] $products
 */
@endphp
@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="user-page">

    {{-- HEADER --}}
    <div class="page-header">
        <h1>Quản lý sản phẩm</h1>
        <p>Quản lý danh sách sản phẩm và phân loại</p>
    </div>

    {{-- TOOLBAR --}}
    <div class="toolbar">
        <form method="GET" class="toolbar-search">
            <input type="text"
                   name="search"
                   placeholder="Tìm sản phẩm..."
                   value="{{ request('search') }}">

            @if(request()->filled('search'))
                <a href="{{ route('admin.adproducts.index') }}"
                   class="btn-icon"
                   title="Reset">
                    <img src="{{ asset('images/power-reset.svg') }}">
                </a>
            @endif
        </form>

        <div class="toolbar-actions">
            <button class="btn-primary"
                    onclick="document.getElementById('addProductModal').style.display='flex'">
                + Thêm sản phẩm
            </button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card table-scroll">
        <table class="user-table wide-table">
            <thead>
                <tr>
                    <th class="sticky-col col-id">ID</th>
                    <th class="sticky-col col-image">Hình ảnh</th>
                    <th class="sticky-col col-name">Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Thuộc tính</th>
                    <th>Nguồn gốc</th>
                    <th>Kích thước</th>
                    <th>Loại</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    {{-- ID --}}
                    <td class="sticky-col col-id">#{{ $product->id }}</td>

                    {{-- IMAGE --}}
                    <td class="sticky-col col-image">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="product-thumb">
                        @else
                            —
                        @endif
                    </td>

                    {{-- NAME --}}
                    <td class="sticky-col col-name">
                        {{ $product->name }}
                    </td>

                    <td>{{ $product->category->name ?? '—' }}</td>

                    <td>
                        {{ $product->material ?? '—' }} /
                        {{ $product->color ?? '—' }}
                    </td>

                    <td>{{ $product->origin ?? '—' }}</td>

                    <td>{{ $product->size ?? '—' }}</td>

                    <td>{{ $product->variants_count }}</td>

                    {{-- ACTIONS --}}
                    <td class="actions">
                        <a href="{{ route('admin.adproducts.variants', $product->id) }}"
                           title="Biến thể">
                            📦
                        </a>
                        <span class="edit-product-btn"
                            title="Sửa"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-category="{{ $product->category_id }}"
                            data-material="{{ $product->material }}"
                            data-color="{{ $product->color }}"
                            data-size="{{ $product->size }}"
                            data-origin="{{ $product->origin }}"
                            data-description="{{ $product->description }}"
                            data-image="{{ $product->image }}">
                            ✏️
                        </span>    
                        <form method="POST"
                              action="{{ route('admin.adproducts.destroy', $product->id) }}"
                              onsubmit="return confirm('Xóa sản phẩm này?')">
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

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>

</div>

{{-- ================= ADD PRODUCT MODAL ================= --}}
<div id="addProductModal" class="modal">
    <div class="modal-content">

        <h2>Thêm sản phẩm</h2>

        <form method="POST"
              action="{{ route('admin.adproducts.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="product-form-grid">

                {{-- PRODUCT INFO --}}
                <div class="product-form-group full">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="name" required>
                </div>

                <div class="product-form-group">
                    <label>Danh mục</label>
                    <select name="category_id" required>
                        <option value="">— Chọn danh mục —</option>
                        @foreach($categories as $parent)
                            <optgroup label="{{ $parent->name }}">
                                @foreach($parent->children as $child)
                                    <option value="{{ $child->id }}">
                                        {{ $child->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <div class="product-form-group">
                    <label>Ảnh sản phẩm</label>
                    <input type="file" name="product_image">
                </div>

                <div class="product-form-group">
                    <label>Chất liệu</label>
                    <input type="text" name="material">
                </div>

                <div class="product-form-group">
                    <label>Màu sắc</label>
                    <input type="text" name="color">
                </div>

                <div class="product-form-group">
                    <label>Kích thước</label>
                    <input type="text" name="size">
                </div>

                <div class="product-form-group">
                    <label>Nguồn gốc</label>
                    <input type="text" name="origin">
                </div>

                <div class="product-form-group full">
                    <label>Mô tả</label>
                    <textarea name="description"></textarea>
                </div>

                {{-- VARIANT --}}
                <div class="product-form-group full"
                     style="font-weight:600;margin-top:10px;">
                    Loại sản phẩm đầu tiên
                </div>

                <div class="product-form-group">
                    <label>Tên loại</label>
                    <input type="text" name="variant_name" required>
                </div>

                <div class="product-form-group">
                    <label>Giá</label>
                    <input type="number" name="price" required>
                </div>

                <div class="product-form-group">
                    <label>Tồn kho</label>
                    <input type="number" name="stock" required>
                </div>

                <div class="product-form-group">
                    <label>Ảnh loại</label>
                    <input type="file" name="variant_image">
                </div>

            </div>

            <div class="modal-actions">
                <button type="button"
                        class="btn-outline"
                        onclick="document.getElementById('addProductModal').style.display='none'">
                    Hủy
                </button>
                <button type="submit" class="btn-primary">
                    Lưu sản phẩm
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ================= EDIT PRODUCT MODAL ================= --}}
<div id="editProductModal" class="modal">
    <div class="modal-content">

        <h2>Chỉnh sửa sản phẩm</h2>

        <form id="editProductForm"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="name" id="edit_name" required>
            </div>

            <div class="form-group">
                <label>Danh mục</label>
                <select name="category_id" id="edit_category">
                    @foreach($categories as $parent)
                        <optgroup label="{{ $parent->name }}">
                            @foreach($parent->children as $child)
                                <option value="{{ $child->id }}">
                                    {{ $child->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Ảnh sản phẩm</label>
                <input type="file" name="product_image">
                <img id="edit_product_preview"
                     class="product-thumb"
                     style="margin-top:8px;display:none">
            </div>

            <div class="form-group">
                <label>Chất liệu</label>
                <input type="text" name="material" id="edit_material">
            </div>

            <div class="form-group">
                <label>Màu sắc</label>
                <input type="text" name="color" id="edit_color">
            </div>

            <div class="form-group">
                <label>Kích thước</label>
                <input type="text" name="size" id="edit_size">
            </div>

            <div class="form-group">
                <label>Nguồn gốc</label>
                <input type="text" name="origin" id="edit_origin">
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description"
                          id="edit_description"></textarea>
            </div>

            <div class="modal-actions">
                <button type="button"
                        class="btn-outline"
                        onclick="closeEditProduct()">
                    Hủy
                </button>
                <button class="btn-primary">
                    Lưu
                </button>
            </div>

        </form>
    </div>
</div>

<script>
document.querySelectorAll('.edit-product-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;

        document.getElementById('editProductModal').style.display = 'flex';
        document.getElementById('editProductForm').action =
            `/admin/products/${id}`;

        edit_name.value        = btn.dataset.name;
        edit_category.value    = btn.dataset.category;
        edit_material.value    = btn.dataset.material || '';
        edit_color.value       = btn.dataset.color || '';
        edit_size.value        = btn.dataset.size || '';
        edit_origin.value      = btn.dataset.origin || '';
        edit_description.value = btn.dataset.description || '';

        const img = btn.dataset.image;
        const preview = document.getElementById('edit_product_preview');

        if (img) {
            preview.src = `/storage/${img}`;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
});

function closeEditProduct() {
    document.getElementById('editProductModal').style.display = 'none';
}
</script>


@endsection
