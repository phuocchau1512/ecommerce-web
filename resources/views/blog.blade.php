@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Blog</h1>
                    <p class="mb-4">
                        Chia sẻ kiến thức, kinh nghiệm và những bài viết hữu ích
                        giúp bạn có thêm cảm hứng và thông tin giá trị.
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

<!-- Start Blog Section -->
<div class="blog-section">
    <div class="container">
        <div class="row">

            <div class="col-12 col-sm-6 col-md-4 mb-5">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail">
                        <img src="{{ asset('images/post-1.jpg') }}" class="img-fluid">
                    </a>
                    <div class="post-content-entry">
                        <h3><a href="#">Ý tưởng cho người mua nhà lần đầu</a></h3>
                        <div class="meta">
                            <span>bởi <a href="#">Nguyễn Thu Trang</a></span>
                            <span>ngày <a href="#">19/12/2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-5">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail">
                        <img src="{{ asset('images/post-2.jpg') }}" class="img-fluid">
                    </a>
                    <div class="post-content-entry">
                        <h3><a href="#">Cách giữ đồ nội thất luôn sạch sẽ</a></h3>
                        <div class="meta">
                            <span>bởi <a href="#">Trần Minh Quân</a></span>
                            <span>ngày <a href="#">15/12/2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-5">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail">
                        <img src="{{ asset('images/post-3.jpg') }}" class="img-fluid">
                    </a>
                    <div class="post-content-entry">
                        <h3><a href="#">Giải pháp nội thất cho không gian nhỏ</a></h3>
                        <div class="meta">
                            <span>bởi <a href="#">Nguyễn Thu Trang</a></span>
                            <span>ngày <a href="#">12/12/2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-5">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail">
                        <img src="{{ asset('images/post-1.jpg') }}" class="img-fluid">
                    </a>
                    <div class="post-content-entry">
                        <h3><a href="#">Ý tưởng cho người mua nhà lần đầu</a></h3>
                        <div class="meta">
                            <span>bởi <a href="#">Nguyễn Thu Trang</a></span>
                            <span>ngày <a href="#">19/12/2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-5">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail">
                        <img src="{{ asset('images/post-2.jpg') }}" class="img-fluid">
                    </a>
                    <div class="post-content-entry">
                        <h3><a href="#">Cách giữ đồ nội thất luôn sạch sẽ</a></h3>
                        <div class="meta">
                            <span>bởi <a href="#">Trần Minh Quân</a></span>
                            <span>ngày <a href="#">15/12/2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-5">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail">
                        <img src="{{ asset('images/post-3.jpg') }}" class="img-fluid">
                    </a>
                    <div class="post-content-entry">
                        <h3><a href="#">Giải pháp nội thất cho không gian nhỏ</a></h3>
                        <div class="meta">
                            <span>bởi <a href="#">Nguyễn Thu Trang</a></span>
                            <span>ngày <a href="#">12/12/2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Blog Section -->
@endsection
