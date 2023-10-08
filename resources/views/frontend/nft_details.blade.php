@extends('frontend.layouts.master-without-nav')
@section('title')
{{ $mint->nftname }}
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
            <!-- end navbar -->
            <section class="section mb-n5">
                <div class="card  bg-light pt-5">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                        @include('components.alert')
                                <div class="sticky-side-div">
                                    <div class="card ribbon-box border shadow-none right">
                                        <img src="{{ URL::asset('images/' . $mint->file) }}" alt=""
                                            class="img-fluid rounded">
                                        <div class="position-absolute bottom-0 p-3">
                                            <div class="position-absolute top-0 end-0 start-0 bottom-0 bg-white opacity-25">
                                            </div>
                                        </div>
                                    </div>
                                        <form action="{{ route('user.buy', $mint->sellcode) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="hstack gap-2">
                                                <button class="btn btn-success w-100">
                                                    Buy Now
                                                </button>
                                            </div>
                                            
                                        </form>
                                        
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-4">
                                <div>
                                    <span class="badge badge-soft-info mb-3 fs-12"><i
                                            class="ri-eye-line me-1 align-bottom"></i> {{ $view }} people views
                                        this</span>
                                    <h4>{{ $mint->nftname }}</h4>
                                    <div class="hstack gap-3 flex-wrap">
                                        <div class="text-muted">Creators : <a href="#!"
                                                class="text-primary fw-medium">{{ $mint->author }}</a></div>

                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-lg-6 col-6">
                                            <div class="p-2 border border-dashed rounded text-center">
                                                <div>
                                                    <p class="text-muted fw-medium mb-1">Price :</p>
                                                    <h5 class="fs-17 text-success mb-0"><i
                                                            class="mdi mdi-ethereum me-1"></i> {{ $mint->price }} {{ $settingsc->currency }}</h5>
                                                    <span class="badge badge-soft-secondary mb-3 fs-12">${{ $mint->price * $settingsc->ethusd }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-lg-6 col-6">
                                            <div class="p-2 border border-dashed rounded text-center">
                                                <div>
                                                    <p class="text-muted fw-medium mb-1">Highest Bid :</p>
                                                    <h5 class="fs-17 text-success mb-0"><i
                                                            class="mdi mdi-ethereum me-1"></i> {{ $mint->price }} {{ $settingsc->currency }}</h5>
                                                    <span class="badge badge-soft-secondary mb-3 fs-12">$5677</span>
                                                </div>
                                            </div>
                                        </div>
                                         end col -->

                                    </div>
                                    <!--end row-->
                                    <div class="mt-4 text-muted">
                                        <h5 class="fs-14">Description :</h5>
                                        <p>{{ $mint->desc }}</p>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end card-->
            </section>


            <!-- start plan -->
            <section class=" mt-n5">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center mb-5">
                                <h2 class="mb-0 fw-bold lh-base flex-grow-1">More On Collection</h2>
                                <a href="{{ route('frontend') }}#marketplace" class="btn btn-secondary">View All <i
                                        class="ri-arrow-right-line align-bottom"></i></a>
                            </div>
                        </div>
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Swiper -->
                            <div class="swiper mySwiper pb-4">
                                <div class="swiper-wrapper">
                                    @foreach ($nft as $mint)
                                        <div class="swiper-slide">
                                            <div class="card explore-box card-animate">
                                                <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                                    <button type="button" class="btn btn-icon" data-bs-toggle="button"
                                                        aria-pressed="true"><i
                                                            class="mdi mdi-cards-heart fs-16"></i></button>
                                                </div>
                                                <div class="explore-place-bid-img">
                                                    <img src="{{ URL::asset('images/' . $mint->file) }}" alt=""
                                                        class="card-img-top explore-img" />
                                                    <div class="bg-overlay"></div>
                                                    <div class="place-bid-btn">
                                                        <a href="{{ route('nftDetails', $mint->sellcode) }}"
                                                            class="btn btn-primary"><i
                                                                class="ri-auction-fill align-bottom me-1"></i> Buy Now</a>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="mb-1 fs-16"><a href="apps-nft-item-details"
                                                            class="link-dark">{{ $mint->author }} <i
                                                                class="text-success bx bx-badge-check"></i></a></h5>
                                                    <p class="text-muted fs-14 mb-0">{{ $mint->nftname }}</p>
                                                </div>
                                                <div class="card-footer border-top border-top-dashed">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 fs-14">
                                                            <i
                                                                class="ri-price-tag-3-fill text-warning align-bottom me-1"></i>
                                                            Floor Price: <span class="fw-medium"></span>
                                                        </div>
                                                        <h5 class="flex-shrink-0 fs-14 text-primary mb-0">
                                                            {{ $mint->price }} {{ $settingsc->currency }}</h5>
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
                </div><!-- end container -->
            </section>
            <!-- end plan -->



            @include('frontend.layouts.footer')

        </div>
        <!-- end layout wrapper -->
    @endsection
    @section('script')
        <!--Swiper slider js-->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/nft-landing.init.js') }}"></script>
    @endsection
