@extends('frontend.layouts.master-without-nav')
@section('title')
    Home
@endsection
@section('css')
    <!--Swiper slider css-->
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body')

    <body data-bs-spy="scroll" data-bs-target="#navbar-example">
    @endsection
    @section('content')
        <!-- Begin page -->
        <div class="layout-wrapper landing">
            @include('frontend.layouts.nav')
            <div class="bg-overlay bg-overlay-pattern"></div>
            <!-- end navbar -->
            <!-- start hero section -->
            <section class="section nft-hero" id="hero">
                <div class="bg-overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-sm-10">
                            <div class="text-center">
                                <h1 class="display-4 fw-medium mb-4 lh-base text-white">Discover Digital Art & Collect <span
                                        class="text-success">NFT Marketplace</span></h1>
                                <p class="fs-17 text-white-50 lh-base mb-4 pb-2">Can artwork be NFT? NFTs (non-fungible
                                    tokens) are one-of-a-kind digital assets. Given they're digital in nature, can physical
                                    works of art be turned into NFTs?.</p>

                                <div class="hstack gap-2 justify-content-center">
                                    <a href="{{ route('login') }}" class="btn btn-primary">Create Own <i
                                            class="ri-arrow-right-line align-middle ms-1"></i></a>
                                    <a href="{{ route('register') }}" class="btn btn-secondary">Explore Now <i
                                            class="ri-arrow-right-line align-middle ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div><!-- end row -->
                </div><!-- end container -->
            </section><!-- end hero section -->


            <!-- start marketplace -->
            <section class="section bg-light" id="marketplace">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center mb-5">
                                <h2 class="mb-3 fw-bold lh-base">Explore Products</h2>
                                <p class="text-muted mb-4">Collection widgets specialize in displaying many elements of the
                                    same type, such as a collection of pictures from a collection of articles.</p>
                                <ul class="nav nav-pills filter-btns justify-content-center" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-medium active" type="button" data-filter="all">All
                                            Items</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-medium" type="button"
                                            data-filter="artwork">Artwork</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-medium" type="button" data-filter="music">Music</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-medium" type="button" data-filter="games">Games</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-medium" type="button" data-filter="crypto-card">Crypto Card</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-medium" type="button"
                                            data-filter="photography">Photography</button>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <div class="row">
                        @foreach ($nft as $mint)
                            <div class="col-lg-4 product-item {{ $mint->category }}">
                                <div class="card explore-box card-animate">
                                    <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                        <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                            aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                    </div>
                                    <div class="explore-place-bid-img">
                                        <img src="{{ URL::asset('images/' . $mint->file) }}" alt=""
                                            class="card-img-top explore-img" />
                                        <div class="bg-overlay"></div>
                                        <div class="place-bid-btn">
                                            <a href="{{ route('nftDetails', $mint->sellcode) }}" class="btn btn-primary"><i
                                                    class="ri-auction-fill align-bottom me-1"></i> Buy Now</a>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h5 class="mb-1 fs-16"><a href="apps-nft-item-details"
                                                class="link-dark">{{ $mint->author }} @if ($user->find($mint->user_id)->has_badge)
                                                    <i class="text-success bx bx-badge-check"></i>
                                                @endif </a></h5>
                                        <p class="text-muted fs-14 mb-0">{{ $mint->nftname }}</p>
                                    </div>
                                    <div class="card-footer border-top border-top-dashed">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 fs-14">
                                                <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Floor
                                                Price: <span class="fw-medium"></span>
                                            </div>
                                            <h5 class="flex-shrink-0 fs-14 text-primary mb-0">{{ $mint->price }} {{ $settingsc->currency }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div><!-- end container -->
            </section>
            <!-- end marketplace -->

            <!-- start features -->
            <section class="section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center mb-5">
                                <h2 class="mb-3 fw-bold lh-base">Create and Sell Your NFTs</h2>
                                <p class="text-muted">The process of creating an NFT may cost less than a dollar, but the
                                    process of selling it can cost up to a thousand dollars. For example, Allen Gannett, a
                                    software developer.</p>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    
                                        <i class="bx bxs-user text-primary" style="font-size: 50px"></i>
                                    <h5 class="mt-4">Create An Account</h5>
                                    <p class="text-muted fs-14">Creating an account at {{ $settingsc->appname }} is a very easy process.</p>
                                    <a href="{{ route('register') }}" class="link-primary fs-14">Explore <i
                                            class="ri-arrow-right-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <i class="bx bxs-image-add text-primary" style="font-size: 50px;"></i>
                                    <h5 class="mt-4">Create your NFT</h5>
                                    <p class="text-muted fs-14">Create an NFT and give it a proper art.
                                    </p>
                                    <a href="{{ route('register') }}" class="link-primary fs-14">Explore <i
                                            class="ri-arrow-right-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <i class="bx bx-money text-primary" style="font-size: 50px"></i>
                                    <h5 class="mt-4">Sell Your NFT's</h5>
                                    <p class="text-muted fs-14">Create a Art Loves are always ready to buy your art.
                                    </p>
                                    <a href="{{ route('register') }}" class="link-primary fs-14">Explore <i
                                            class="ri-arrow-right-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div><!-- end container -->
            </section><!-- end features -->

            <!-- start plan -->
            <section class="section bg-light" id="categories">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="text-center mb-5">
                                <h2 class="mb-3 fw-bold lh-base">Trending All Categories</h2>
                                <p class="text-muted">The process of creating an NFT may cost less than a dollar, but the
                                    process of selling it can cost up to a thousand dollars. For example, Allen Gannett, a
                                    software developer.</p>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Swiper -->
                            <div class="swiper mySwiper pb-4">
                                <div class="swiper-wrapper">
                                    
                                    
                                    <div class="swiper-slide">
                                        <div class="product-item">
                                            <div class="card explore-box card-animate">
                                                <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                                    <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                                        aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                                </div>
                                                <div class="explore-place-bid-img">
                                                    <img src="{{ URL::asset('images/' . $games->file) }}" alt=""
                                                        class="card-img-top explore-img" />
                                                    <div class="bg-overlay"></div>
                                                    
                                                </div>
                                                <div class="card-footer border-top border-top-dashed">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 fs-14">
                                                            <h5 class="mb-0 fs-15"><a href="{{ route('category', 'games') }}" class="link-dark">Games
                                                                <span class="badge badge-soft-secondary">{{ $gamesowners }}+</span></a></h5>
                                                        </div>
                                                        <a href="{{ route('category', 'games') }}" class="float-end fs-14"> View All <i
                                                            class="ri-arrow-right-line align-bottom"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product-item">
                                            <div class="card explore-box card-animate">
                                                <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                                    <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                                        aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                                </div>
                                                <div class="explore-place-bid-img">
                                                    <img src="{{ URL::asset('images/' . $photography->file) }}" alt=""
                                                        class="card-img-top explore-img" />
                                                    <div class="bg-overlay"></div>
                                                    
                                                </div>
                                                <div class="card-footer border-top border-top-dashed">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 fs-14">
                                                            <h5 class="mb-0 fs-15"><a href="{{ route('category', 'photography') }}" class="link-dark">Photography
                                                                <span class="badge badge-soft-secondary">{{ $photographyowners }}+</span></a></h5>
                                                        </div>
                                                        <a href="{{ route('category', 'photography') }}" class="float-end fs-14"> View All <i
                                                            class="ri-arrow-right-line align-bottom"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product-item">
                                            <div class="card explore-box card-animate">
                                                <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                                    <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                                        aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                                </div>
                                                <div class="explore-place-bid-img">
                                                    <img src="{{ URL::asset('images/' . $music->file) }}" alt=""
                                                        class="card-img-top explore-img" />
                                                    <div class="bg-overlay"></div>
                                                </div>
                                                <div class="card-footer border-top border-top-dashed">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 fs-14">
                                                            <h5 class="mb-0 fs-15"><a href="{{ route('category', 'music') }}" class="link-dark">Music
                                                                <span class="badge badge-soft-secondary">{{ $musicowners }}+</span></a></h5>
                                                        </div>
                                                        <a href="{{ route('category', 'music') }}" class="float-end fs-14"> View All <i
                                                            class="ri-arrow-right-line align-bottom"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product-item">
                                            <div class="card explore-box card-animate">
                                                <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                                    <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                                        aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                                </div>
                                                <div class="explore-place-bid-img">
                                                    <img src="{{ URL::asset('images/' . $artwork->file) }}" alt=""
                                                        class="card-img-top explore-img" />
                                                    <div class="bg-overlay"></div>
                                                </div>
                                                <div class="card-footer border-top border-top-dashed">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 fs-14">
                                                            <h5 class="mb-0 fs-15"><a href="{{ route('category', 'artwork') }}" class="link-dark">Artwork
                                                                <span class="badge badge-soft-secondary">{{ $artworkowners }}+</span></a></h5>
                                                        </div>
                                                        <a href="{{ route('category', 'artwork') }}" class="float-end fs-14"> View All <i
                                                            class="ri-arrow-right-line align-bottom"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product-item">
                                            <div class="card explore-box card-animate">
                                                <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                                    <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                                        aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                                </div>
                                                <div class="explore-place-bid-img">
                                                    <img src="{{ URL::asset('images/' . $cryptocard->file) }}" alt=""
                                                        class="card-img-top explore-img" />
                                                    <div class="bg-overlay"></div>
                                                </div>
                                                <div class="card-footer border-top border-top-dashed">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 fs-14">
                                                            <h5 class="mb-0 fs-15"><a href="{{ route('category', 'crypto-card') }}" class="link-dark">Crypto Card
                                                                <span class="badge badge-soft-secondary">{{ $cryptocardowners }}+</span></a></h5>
                                                        </div>
                                                        <a href="{{ route('category', 'crypto-card') }}" class="float-end fs-14"> View All <i
                                                            class="ri-arrow-right-line align-bottom"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="product-item">
                                            <div class="card explore-box card-animate">
                                                <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                                    <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                                        aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                                </div>
                                                <div class="explore-place-bid-img">
                                                    <img src="{{ URL::asset('images/' . $others->file) }}" alt=""
                                                        class="card-img-top explore-img" />
                                                    <div class="bg-overlay"></div>
                                                </div>
                                                <div class="card-footer border-top border-top-dashed">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 fs-14">
                                                            <h5 class="mb-0 fs-15"><a href="{{ route('category', 'others') }}" class="link-dark">Others
                                                                <span class="badge badge-soft-secondary">{{ $othersowners }}+</span></a></h5>
                                                        </div>
                                                        <a href="{{ route('category', 'others') }}" class="float-end fs-14"> View All <i
                                                            class="ri-arrow-right-line align-bottom"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination swiper-pagination-dark"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- end container -->
            </section>
            <!-- end plan -->

            <!-- start Discover Items-->
            <section class="section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center mb-5">
                                <h2 class="mb-0 fw-bold lh-base flex-grow-1">Latest Collection</h2>
                                <a href="{{ route('allnft') }}" class="btn btn-secondary">View All <i
                                        class="ri-arrow-right-line align-bottom"></i></a>
                            </div>
                        </div>
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Swiper -->
                            <div class="swiper mySwiper pb-4">
                                <div class="swiper-wrapper">
                                    
                                    @foreach ($nftt as $mint)
                                    <div class="swiper-slide">
                                        
                                        <div class="product-item">
                                            <div class="card explore-box card-animate">
                                                <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                                    <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                                        aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                                </div>
                                                <div class="explore-place-bid-img">
                                                    <img src="{{ URL::asset('images/' . $mint->file) }}" alt=""
                                                        class="card-img-top explore-img" />
                                                    <div class="bg-overlay"></div>
                                                    <div class="place-bid-btn">
                                                        <a href="{{ route('nftDetails', $mint->sellcode) }}" class="btn btn-primary"><i
                                                                class="ri-auction-fill align-bottom me-1"></i> Buy Now</a>
                                                    </div>
                                                </div>
                                                
                                                <div class="card-body">
                                                    <h5 class="mb-1 fs-16"><a href="apps-nft-item-details"
                                                            class="link-dark">{{ $mint->author }} @if ($user->find($mint->user_id)->has_badge)
                                                                <i class="text-success bx bx-badge-check"></i>
                                                            @endif </a></h5>
                                                    <p class="text-muted fs-14 mb-0">{{ $mint->nftname }}</p>
                                                </div>
                                                <div class="card-footer border-top border-top-dashed">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 fs-14">
                                                            <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Floor
                                                            Price: <span class="fw-medium"></span>
                                                        </div>
                                                        <h5 class="flex-shrink-0 fs-14 text-primary mb-0">{{ $mint->price }} {{ $settingsc->currency }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination swiper-pagination-dark"></div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            <!--end Discover Items-->

            <!-- start Work Process -->
            <section class="section bg-light" id="creators">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center mb-5">
                                <h2 class="mb-3 fw-bold lh-base">Top Creator</h2>
                                <p class="text-muted">NFTs are valuable because they verify the authenticity of a
                                    non-fungible asset. This makes these assets unique and one of a kind.</p>
                            </div>
                        </div>
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shink-0">
                                            <img src="{{ URL::asset('build/images/nft/img-01.jpg') }}" alt=""
                                                class="avatar-sm object-cover rounded" />
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <a href="pages-profile">
                                                <h5 class="mb-1 fs-16">Timothy Smith</h5>
                                            </a>
                                            <p class="text-muted fs-14 mb-0"><i
                                                    class="mdi mdi-ethereum text-primary fs-14"></i> 4,754 ETH</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                class="avatar-sm object-cover rounded">
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <a href="pages-profile">
                                                <h5 class="mb-1 fs-16">Alexis Clarke</h5>
                                            </a>
                                            <p class="text-muted fs-14 mb-0"><i
                                                    class="mdi mdi-ethereum text-primary fs-14"></i> 1,369 ETH</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shink-0">
                                            <img src="{{ URL::asset('build/images/nft/img-06.jpg') }}" alt=""
                                                class="avatar-sm object-cover rounded">
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <a href="pages-profile">
                                                <h5 class="mb-1 fs-16">Glen Matney</h5>
                                            </a>
                                            <p class="text-muted fs-14 mb-0"><i
                                                    class="mdi mdi-ethereum text-primary fs-14"></i> 13,156 ETH</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shink-0">
                                            <img src="{{ URL::asset('build/images/nft/img-03.jpg') }}" alt=""
                                                class="avatar-sm object-cover rounded">
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <a href="pages-profile">
                                                <h5 class="mb-1 fs-16">Herbert Stokes</h5>
                                            </a>
                                            <p class="text-muted fs-14 mb-0"><i
                                                    class="mdi mdi-ethereum text-primary fs-14"></i> 4,754 ETH</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                class="avatar-sm object-cover rounded">
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <a href="pages-profile">
                                                <h5 class="mb-1 fs-16">Michael Morris</h5>
                                            </a>
                                            <p class="text-muted fs-14 mb-0"><i
                                                    class="mdi mdi-ethereum text-primary fs-14"></i> 13,841 ETH</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shink-0">
                                            <img src="{{ URL::asset('build/images/nft/img-02.jpg') }}" alt=""
                                                class="avatar-sm object-cover rounded">
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <a href="pages-profile">
                                                <h5 class="mb-1 fs-16">James Morris</h5>
                                            </a>
                                            <p class="text-muted fs-14 mb-0"><i
                                                    class="mdi mdi-ethereum text-primary fs-14"></i> 3,710 ETH</p>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div><!-- end container -->
            </section><!-- end Work Process -->

            @include('frontend.layouts.footer')

        </div>
        <!-- end layout wrapper -->
    @endsection
    @section('script')
        <!--Swiper slider js-->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/nft-landing.init.js') }}"></script>
    @endsection
