@extends('layouts.app')

@section('title', 'Dịch vụ')

@section('content')
        <!-- Start Hero Section -->
        <div class="hero">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-5">
                        <div class="intro-excerpt">
                            <h1>Dịch vụ của chúng tôi</h1>
                            <p class="mb-4">
                                Chúng tôi cung cấp các dịch vụ chất lượng cao, giúp bạn dễ dàng tiếp cận
                                những sản phẩm tốt nhất với trải nghiệm mua sắm tiện lợi và an toàn.
                            </p>
                            <p>
                                <a href="#" class="btn btn-secondary me-2">Mua ngay</a>
                                <a href="#" class="btn btn-white-outline">Khám phá</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="hero-img-wrap">
                            <img src="{{ asset('images/couch.png') }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Hero Section -->

        <!-- Start Why Choose Us Section -->
        <div class="why-choose-section">
            <div class="container">
                <div class="row my-5">

                    <div class="col-6 col-md-6 col-lg-3 mb-4">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/truck.svg') }}" class="img-fluid">
                            </div>
                            <h3>Giao hàng nhanh & miễn phí</h3>
                            <p>Đảm bảo giao hàng đúng hẹn, nhanh chóng và không phát sinh chi phí.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 col-lg-3 mb-4">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/bag.svg') }}" class="img-fluid">
                            </div>
                            <h3>Mua sắm dễ dàng</h3>
                            <p>Giao diện thân thiện, thao tác đơn giản cho mọi người dùng.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 col-lg-3 mb-4">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/support.svg') }}" class="img-fluid">
                            </div>
                            <h3>Hỗ trợ 24/7</h3>
                            <p>Luôn sẵn sàng hỗ trợ và giải đáp mọi thắc mắc của khách hàng.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 col-lg-3 mb-4">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/return.svg') }}" class="img-fluid">
                            </div>
                            <h3>Đổi trả dễ dàng</h3>
                            <p>Chính sách đổi trả linh hoạt, đảm bảo quyền lợi khách hàng.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Why Choose Us Section -->

        <!-- Start Product Section -->
        <div class="product-section pt-0">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                        <h2 class="mb-4 section-title">Sản phẩm được chọn lọc kỹ lưỡng</h2>
                        <p class="mb-4">
                            Chúng tôi mang đến những sản phẩm chất lượng cao, phù hợp với nhu cầu đa dạng
                            của khách hàng.
                        </p>
                        <p><a href="#" class="btn">Xem thêm</a></p>
                    </div>

                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="#">
                            <img src="{{ asset('images/product-1.png') }}" class="img-fluid product-thumbnail">
                            <h3 class="product-title">Ghế Nordic</h3>
                            <strong class="product-price">50.000đ</strong>
                        </a>
                    </div>

                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="#">
                            <img src="{{ asset('images/product-2.png') }}" class="img-fluid product-thumbnail">
                            <h3 class="product-title">Ghế Kruzo Aero</h3>
                            <strong class="product-price">78.000đ</strong>
                        </a>
                    </div>

                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="#">
                            <img src="{{ asset('images/product-3.png') }}" class="img-fluid product-thumbnail">
                            <h3 class="product-title">Ghế công thái học</h3>
                            <strong class="product-price">43.000đ</strong>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Product Section -->

        <!-- Start Testimonial Slider -->
        <div class="testimonial-section before-footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto text-center">
                        <h2 class="section-title">Ý kiến khách hàng</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="testimonial-slider-wrap text-center">

                            <div id="testimonial-nav">
                                <span class="prev" data-controls="prev">
                                    <span class="fa fa-chevron-left"></span>
                                </span>
                                <span class="next" data-controls="next">
                                    <span class="fa fa-chevron-right"></span>
                                </span>
                            </div>

                            <div class="testimonial-slider">

                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="testimonial-block text-center">
                                                <blockquote class="mb-5">
                                                    <p>
                                                        “Dịch vụ rất tuyệt vời, giao hàng nhanh chóng và sản phẩm đúng như mô tả.
                                                        Tôi hoàn toàn hài lòng và sẽ tiếp tục ủng hộ trong thời gian tới.”
                                                    </p>
                                                </blockquote>

                                                <div class="author-info">
                                                    <div class="author-pic">
                                                        <img src="{{ asset('images/person-1.png') }}" alt="Khách hàng" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END item -->

                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="testimonial-block text-center">
                                                <blockquote class="mb-5">
                                                    <p>
                                                        “Trang web dễ sử dụng, đặt hàng nhanh gọn.
                                                        Nhân viên hỗ trợ nhiệt tình, rất đáng tin cậy.”
                                                    </p>
                                                </blockquote>

                                                <div class="author-info">
                                                    <div class="author-pic">
                                                        <img src="{{ asset('images/person-1.png') }}" alt="Khách hàng" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END item -->

                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="testimonial-block text-center">
                                                <blockquote class="mb-5">
                                                    <p>
                                                        “Sản phẩm chất lượng, giá cả hợp lý.
                                                        Trải nghiệm mua sắm rất tốt, sẽ giới thiệu cho bạn bè.”
                                                    </p>
                                                </blockquote>

                                                <div class="author-info">
                                                    <div class="author-pic">
                                                        <img src="{{ asset('images/person-1.png') }}" alt="Khách hàng" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END item -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Testimonial Slider -->

@endsection
