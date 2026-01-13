@php
/** @var \App\Models\Product $product */
@endphp
@extends('layouts.app')

@section('title', $product->name)

@section('content')



<div class="container py-5 product-detail">
    
    <nav class="breadcrumb-wrapper">
        <a href="/">Trang chủ</a>
        <span>/</span>

        <a href="/shop">Cửa hàng</a>
        <span>/</span>

        <span class="current">
            {{ $product->name }}
        </span>
    </nav>

    <div class="row">

        <!-- LEFT: GALLERY -->
        <div class="col-lg-7">
            <div class="d-flex">

                <!-- Thumbnails -->
                <div class="product-thumbs me-3">

                    <!-- MAIN IMAGE -->
                    <div class="thumb mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="img-fluid thumb-img active-thumb"
                             data-image="{{ asset('storage/' . $product->image) }}">
                    </div>

                    <!-- VARIANT IMAGES -->
                    @foreach ($product->variants as $variant)
                        @if ($variant->image)
                            <div class="thumb mb-2">
                                <img src="{{ asset('storage/' . $variant->image) }}"
                                     class="img-fluid thumb-img"
                                     data-image="{{ asset('storage/' . $variant->image) }}">
                            </div>
                        @endif
                    @endforeach

                </div>

                <!-- MAIN IMAGE -->
                <div class="product-main-img flex-grow-1">
                    <img id="mainImage"
                         src="{{ asset('storage/' . $product->image) }}"
                         class="img-fluid">
                </div>

            </div>
        </div>

        <!-- RIGHT: INFO -->
        <div class="col-lg-5">

            <!-- PRODUCT NAME -->
            <h4 class="product-title mb-3">
                {{ $product->name }}
            </h4>
           
            @if (session('success'))
                <div class="alert alert-success add-cart-alert">
                    {{ session('success') }}
                </div>
            @endif


            <!-- PRICE -->
            <div class="price mb-4">
                <span id="productPrice">
                    {{ number_format($product->variants->first()->price ?? 0) }}đ
                </span>
            </div>

            <!-- COLOR -->
            <div class="mb-4">
                <span class="section-title">Màu sắc</span>
                <div class="section-content">
                    {{ $product->color }}
                </div>
            </div>

            <!-- SIZE -->
            @foreach ($product->variants as $index => $variant)
                <button type="button"
                    class="size-btn {{ $index === 0 ? 'active' : '' }}"
                    data-price="{{ $variant->price }}"
                    data-stock="{{ $variant->stock }}"
                    data-variant-id="{{ $variant->id }}"
                    data-image="{{ $variant->image ? asset('storage/' . $variant->image) : asset('storage/' . $product->image) }}">
                    {{ $variant->variant_name }}
                </button>
            @endforeach


            <div class="stock-wrapper">
                <span class="stock-label">Tồn kho:</span>
                <span id="stockText" class="stock-value">
                    {{ $product->variants->first()->stock ?? 0 }}
                </span>
            </div>


            <!-- INFO -->
            <div class="mb-4">
                <span class="section-title">Thông tin sản phẩm</span>

                <div class="section-content">
                    <p><strong>Chất liệu:</strong> {{ $product->material }}</p>
                    <p><strong>Xuất xứ:</strong> {{ $product->origin }}</p>
                    <p>{{ $product->description }}</p>
                </div>
            </div>

            <!-- QUANTITY -->
            <div class="quantity mb-4">
                <button type="button" id="minus">-</button>
                <input type="text" id="quantity" value="1">
                <button type="button" id="plus">+</button>
            </div>

            <!-- ACTION -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <input type="hidden" name="variant_id" id="variantId"
                    value="{{ $product->variants->first()->id ?? '' }}">

                <input type="hidden" name="quantity" id="quantityInput" value="1">

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        THÊM VÀO GIỎ
                    </button>
                </div>
            </form>



        </div>
    </div>

    <!-- REVIEWS SECTION -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">

                <div class="review-box">

                    <!-- HEADER -->
                    <div class="review-header">
                        <h4>Đánh giá & Bình luận</h4>

                        <div class="review-rating-row">
                            <span>Số điểm của bạn:</span>
                            <strong id="scoreText">0/5</strong>

                            <div class="star-rating">
                                <i class="star" data-value="1">★</i>
                                <i class="star" data-value="2">★</i>
                                <i class="star" data-value="3">★</i>
                                <i class="star" data-value="4">★</i>
                                <i class="star" data-value="5">★</i>
                            </div>
                        </div>
                    </div>

                    @auth
                    <form action="{{ route('reviews.store') }}" method="POST" class="review-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="rating" id="ratingValue" required>

                        <textarea
                            name="comment"
                            class="review-textarea"
                            placeholder="Chia sẻ cảm nhận của bạn về sản phẩm..."
                            required></textarea>

                        <div class="review-actions">
                            <button type="submit" class="btn-submit">
                                Đăng đánh giá
                            </button>
                        </div>
                    </form>
                    @else
                        <p><a href="{{ route('login') }}">Đăng nhập</a> để đánh giá.</p>
                    @endauth

                    <!-- LIST -->
                    <div class="review-list">
                        <div class="review-list-header">
                            <strong>Bình luận</strong>
                            <span class="text-muted">{{ $product->reviews->count() }} đánh giá</span>
                        </div>

                        @forelse ($product->reviews as $review)
                            <div class="review-item">
                                <div class="review-item-header">
                                    <strong>{{ $review->user->name }}</strong>
                                    <small>{{ $review->created_at->format('d/m/Y') }}</small>
                                </div>

                                <div class="review-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {{ $i <= $review->rating ? '★' : '☆' }}
                                    @endfor
                                </div>

                                <p>{{ $review->comment }}</p>
                            </div>
                        @empty
                            <p class="text-muted">Chưa có đánh giá nào.</p>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>
    </div>



</div>

<script>


/* THUMB CLICK */
document.querySelectorAll('.thumb-img').forEach(img => {
    img.addEventListener('click', function () {
        document.getElementById('mainImage').src = this.dataset.image;
        document.querySelectorAll('.thumb-img')
            .forEach(i => i.classList.remove('active-thumb'));
        this.classList.add('active-thumb');
    });
});


document.querySelectorAll('.size-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        document.querySelectorAll('.size-btn')
            .forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        /* PRICE */
        document.getElementById('productPrice').innerText =
            Number(this.dataset.price).toLocaleString('vi-VN') + 'đ';

        /* IMAGE */
        document.getElementById('mainImage').src = this.dataset.image;

        /* VARIANT ID */
        document.getElementById('variantId').value = this.dataset.variantId;

        /* STOCK */
        currentStock = parseInt(this.dataset.stock);
        stockText.innerText = currentStock;

        /* RESET QTY */
        qtyInput.value = 1;
        qtyHidden.value = 1;

        /* UPDATE BUTTON */
        updateButtonState();
    });
});



/* QUANTITY */


const qtyInput = document.getElementById('quantity');
const qtyHidden = document.getElementById('quantityInput');
const stockText = document.getElementById('stockText');
const addBtn = document.querySelector('button[type="submit"]');
let currentStock = parseInt(stockText.innerText) || 0;

/* CẬP NHẬT NÚT */
function updateButtonState() {
    if (currentStock <= 0) {
        addBtn.disabled = true;
        addBtn.innerText = 'HẾT HÀNG';
    } else {
        addBtn.disabled = false;
        addBtn.innerText = 'THÊM VÀO GIỎ';
    }
}

/* PLUS */
document.getElementById('plus').onclick = () => {
    let val = parseInt(qtyInput.value);

    if (val < currentStock) {
        qtyInput.value = val + 1;
        qtyHidden.value = qtyInput.value;
    } else {
        const ok = confirm(
            'Số lượng vượt quá tồn kho hiện có.\n' +
            'Kho chỉ còn ' + currentStock + ' sản phẩm.'
        );

        if (ok) {
            // Giữ nguyên số lượng tối đa
            qtyInput.value = currentStock;
            qtyHidden.value = currentStock;
        }
    }
};


/* MINUS */
document.getElementById('minus').onclick = () => {
    let val = parseInt(qtyInput.value);
    if (val > 1) {
        qtyInput.value = val - 1;
        qtyHidden.value = qtyInput.value;
    }
};

/* KHỞI TẠO */
updateButtonState();




const stars = document.querySelectorAll('.star-rating .star');
const ratingInput = document.getElementById('ratingValue');
let currentRating = 0;

stars.forEach(star => {
    // hover
    star.addEventListener('mouseenter', () => {
        const val = star.dataset.value;
        highlightStars(val);
    });

    // click
    star.addEventListener('click', () => {
        currentRating = star.dataset.value;
        ratingInput.value = currentRating;
        highlightStars(currentRating);
    });
});

// khi rời chuột → giữ lại sao đã chọn
document.querySelector('.star-rating').addEventListener('mouseleave', () => {
    highlightStars(currentRating);
});

function highlightStars(value) {
    stars.forEach(star => {
        star.classList.toggle(
            'active',
            star.dataset.value <= value
        );
    });
}



</script>

@endsection
