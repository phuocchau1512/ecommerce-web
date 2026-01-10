@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')

<div class="container">

    {{-- THÊM SẢN PHẨM --}}
    <section class="add-products" id="add">
        <h2 class="title">Thêm sản phẩm mới</h2>

        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Tên sản phẩm" class="box" required>
            <input type="number" name="price" placeholder="Giá sản phẩm" class="box" required>
            <input type="number" name="stock" placeholder="Số lượng" class="box" required>
            <input type="file" name="image" accept="image/*" class="box" required>
            <input type="submit" value="Thêm Sản Phẩm" class="btn">
        </form>
    </section>

    {{-- DANH SÁCH SẢN PHẨM --}}
    <section class="product-list">
        <div class="top-bar">
            <h2>Danh sách sản phẩm</h2>
        </div>

        <div class="filter-bar">
            <form method="get">
                <label>Hiển thị:</label>
                <select name="per_page" onchange="this.form.submit()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>

                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm...">
                <input type="submit" value="Tìm">
            </form>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Đã bán</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ asset('uploaded_img/'.$product->image) }}" class="thumb">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price) }} VNĐ</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->sold }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="option-btn">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                              method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="delete-btn"
                                    onclick="return confirm('Xóa sản phẩm?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- PHÂN TRANG --}}
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </section>

</div>

@endsection
