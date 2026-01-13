@php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Product[] $products
 */
@endphp
@extends('layouts.app')

@section('title', 'Cửa hàng')

@section('content')

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">

            <!-- ================= SIDEBAR FILTER ================= -->
            <div class="col-lg-3 mb-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h3 class="fw-bold mb-4">Lọc theo</h3>

                        <!-- FORM FILTER -->
                        <form method="GET" action="{{ route('shop.index') }}">

                            <!-- ================= CATEGORY ================= -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Danh mục</h5>

                                <!-- PHÒNG NGỦ -->
                                <div class="fw-bold text-dark mb-2">Phòng Ngủ</div>
                                <div class="ps-3 mb-3">
                                    @foreach ([12 => 'Giường ngủ', 13 => 'Tủ quần áo', 14 => 'Bàn trang điểm'] as $id => $name)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="categories[]"
                                                   value="{{ $id }}"
                                                   {{ in_array($id, request()->categories ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- PHÒNG KHÁCH -->
                                <div class="fw-bold text-dark mb-2">Phòng Khách</div>
                                <div class="ps-3 mb-3">
                                    @foreach ([15 => 'Ghế Sofa', 16 => 'Bàn Sofa', 17 => 'Tủ kệ Tivi', 18 => 'Tủ giày - Tủ trang trí'] as $id => $name)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="categories[]"
                                                   value="{{ $id }}"
                                                   {{ in_array($id, request()->categories ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- PHÒNG ĂN -->
                                <div class="fw-bold text-dark mb-2">Phòng Ăn</div>
                                <div class="ps-3 mb-3">
                                    @foreach ([19 => 'Bàn ăn', 20 => 'Ghế ăn'] as $id => $name)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="categories[]"
                                                   value="{{ $id }}"
                                                   {{ in_array($id, request()->categories ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- PHÒNG LÀM VIỆC -->
                                <div class="fw-bold text-dark mb-2">Phòng Làm Việc</div>
                                <div class="ps-3">
                                    @foreach ([21 => 'Bàn làm việc', 22 => 'Ghế văn phòng'] as $id => $name)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="categories[]"
                                                   value="{{ $id }}"
                                                   {{ in_array($id, request()->categories ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- ================= PRICE ================= -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Giá</h5>

                                @foreach ([
                                    '0-3000000' => '0đ – 3,000,000đ',
                                    '3000000-5000000' => '3,000,000đ – 5,000,000đ',
                                    '5000000-7000000' => '5,000,000đ – 7,000,000đ',
                                    '7000000+' => 'Trên 7,000,000đ'
                                ] as $value => $label)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="prices[]"
                                               value="{{ $value }}"
                                               {{ in_array($value, request()->prices ?? []) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- ================= ORIGIN ================= -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Nơi sản xuất</h5>

                                @foreach (['Việt Nam', 'Nhật Bản', 'Hàn Quốc'] as $origin)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="origins[]"
                                               value="{{ $origin }}"
                                               {{ in_array($origin, request()->origins ?? []) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $origin }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- APPLY -->
                            <button type="submit" class="btn btn-dark w-100">
                                Áp dụng bộ lọc
                            </button>

                        </form>
                        <div class="d-grid mt-2">
                            <a href="{{ route('shop.index') }}"
                            class="btn btn-danger">
                                Xóa tất cả bộ lọc
                            </a>
                        </div>
                        <!-- END FORM -->

                    </div>
                </div>
            </div>
            <!-- ================= END SIDEBAR ================= -->



            <!-- ================= PRODUCT AREA ================= -->
            <div class="col-lg-9">

                <!-- SEARCH BOX -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('shop.index') }}" class="d-flex">

                            <!-- giữ filter hiện tại -->
                            @foreach (request()->categories ?? [] as $cat)
                                <input type="hidden" name="categories[]" value="{{ $cat }}">
                            @endforeach

                            @foreach (request()->prices ?? [] as $price)
                                <input type="hidden" name="prices[]" value="{{ $price }}">
                            @endforeach

                            @foreach (request()->origins ?? [] as $origin)
                                <input type="hidden" name="origins[]" value="{{ $origin }}">
                            @endforeach

                            <input type="text"
                                name="q"
                                class="form-control me-2"
                                placeholder="🔍 Tìm kiếm sản phẩm..."
                                value="{{ request('q') }}">

                            <button class="btn btn-primary px-4">Tìm</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="row">

                            @forelse ($products as $product)
                                <div class="col-12 col-md-4 col-lg-3 mb-5">
                                    <a class="product-item"
                                       href="{{ route('products.show', [
                                            'id' => $product->id,
                                            'name' => Str::slug($product->name)
                                       ]) }}">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             class="img-fluid product-thumbnail"
                                             alt="{{ $product->name }}">

                                        <h3 class="product-title">
                                            {{ $product->name }}
                                        </h3>

                                        <strong class="product-price">
                                            {{ number_format($product->min_price) }} VNĐ
                                        </strong>
                                    </a>
                                </div>
                            @empty
                                <p>Không có sản phẩm nào</p>
                            @endforelse

                        </div>
                    </div>
                </div>

                {{-- pagination  --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>

            </div>
            <!-- ================= END PRODUCT AREA ================= -->

        </div>
    </div>
</div>

@endsection
