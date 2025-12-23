@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<!-- Start Hero Section -->
<div class="hero">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1>Nội Thất Tinh Tế<span class="d-block"> </span></h1>
					<p class="mb-4">
						Mang đến giải pháp nội thất tinh tế, hiện đại và phù hợp với không gian sống của bạn.
					</p>
					<p>
						<a href="#" class="btn btn-secondary me-2">Mua ngay</a>
						<a href="#" class="btn btn-white-outline">Khám phá</a>
					</p>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="hero-img-wrap">
					<img src="images/couch.png" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Hero Section -->

<!-- Start Product Section -->
<div class="product-section">
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
				<h2 class="mb-4 section-title">Chất liệu cao cấp</h2>
				<p class="mb-4">
					Sản phẩm được hoàn thiện từ vật liệu chất lượng, bền bỉ theo thời gian.
				</p>
				<p><a href="shop.html" class="btn">Khám phá</a></p>
			</div>

			<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
				<a class="product-item" href="cart.html">
					<img src="images/product-1.png" class="img-fluid product-thumbnail">
					<h3 class="product-title">Ghế Bắc Âu</h3>
					<strong class="product-price">$50.00</strong>
					<span class="icon-cross">
						<img src="images/cross.svg" class="img-fluid">
					</span>
				</a>
			</div>

			<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
				<a class="product-item" href="cart.html">
					<img src="images/product-2.png" class="img-fluid product-thumbnail">
					<h3 class="product-title">Ghế Kruzo Aero</h3>
					<strong class="product-price">$78.00</strong>
					<span class="icon-cross">
						<img src="images/cross.svg" class="img-fluid">
					</span>
				</a>
			</div>

			<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
				<a class="product-item" href="cart.html">
					<img src="images/product-3.png" class="img-fluid product-thumbnail">
					<h3 class="product-title">Ghế Công Thái Học</h3>
					<strong class="product-price">$43.00</strong>
					<span class="icon-cross">
						<img src="images/cross.svg" class="img-fluid">
					</span>
				</a>
			</div>

		</div>
	</div>
</div>
<!-- End Product Section -->

<!-- Start Why Choose Us -->
<div class="why-choose-section">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-6">
				<h2 class="section-title">Vì Sao Chọn Chúng Tôi</h2>
				<p>
					Chúng tôi cam kết mang đến trải nghiệm mua sắm tốt nhất cho khách hàng.
				</p>

				<div class="row my-5">
					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="images/truck.svg" class="img-fluid">
							</div>
							<h3>Giao hàng nhanh & miễn phí</h3>
							<p>Vận chuyển toàn quốc, không phát sinh chi phí.</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="images/bag.svg" class="img-fluid">
							</div>
							<h3>Dễ dàng mua sắm</h3>
							<p>Đặt hàng nhanh chóng, thao tác đơn giản.</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="images/support.svg" class="img-fluid">
							</div>
							<h3>Hỗ trợ 24/7</h3>
							<p>Luôn sẵn sàng hỗ trợ mọi lúc.</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="images/return.svg" class="img-fluid">
							</div>
							<h3>Đổi trả dễ dàng</h3>
							<p>Chính sách đổi trả rõ ràng, minh bạch.</p>
						</div>
					</div>

				</div>
			</div>

			<div class="col-lg-5">
				<div class="img-wrap">
					<img src="images/why-choose-us-img.jpg" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Why Choose Us -->

<!-- Start We Help Section -->
<div class="we-help-section">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-7 mb-5 mb-lg-0">
				<div class="imgs-grid">
					<div class="grid grid-1"><img src="images/img-grid-1.jpg"></div>
					<div class="grid grid-2"><img src="images/img-grid-2.jpg"></div>
					<div class="grid grid-3"><img src="images/img-grid-3.jpg"></div>
				</div>
			</div>
			<div class="col-lg-5 ps-lg-5">
				<h2 class="section-title mb-4">
					Chúng tôi giúp bạn tạo không gian sống hiện đại
				</h2>
				<p>
					Thiết kế tối giản, tinh tế, phù hợp với nhiều phong cách nội thất khác nhau.
				</p>

				<ul class="list-unstyled custom-list my-4">
					<li>Thiết kế hiện đại</li>
					<li>Chất lượng bền bỉ</li>
					<li>Dễ phối nội thất</li>
					<li>Phù hợp nhiều không gian</li>
				</ul>
				<p><a href="#" class="btn">Khám phá</a></p>
			</div>
		</div>
	</div>
</div>
<!-- End We Help Section -->

@endsection
