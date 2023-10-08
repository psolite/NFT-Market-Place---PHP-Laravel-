@extends('frontend.layouts.master-without-nav')
@section('title')
    MarketPlace
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

           


            <!-- start marketplace -->
            <section class="section bg-light" id="marketplace">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center mb-5">
                                <h2 class="mb-3 fw-bold lh-base">Explore Products</h2>
                                <p class="text-muted mb-4">Collection widgets specialize in displaying many elements of the
                                    same type, such as a collection of pictures from a collection of articles.</p>
                                
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <div class="row">
                        @foreach ($nft as $mint)
                            <div class="col-lg-4 product-item">
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
                    {{ $nft }}
                </div><!-- end container -->
            </section>
            <!-- end marketplace -->



            

            @include('frontend.layouts.footer')

        </div>
        <!-- end layout wrapper -->
    @endsection
    @section('script')
        <!--Swiper slider js-->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/nft-landing.init.js') }}"></script>
    @endsection
