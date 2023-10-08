@extends('frontend.layouts.master-without-nav')
@section('title')
{{ $main->category }}
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


            <div class="position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg profile-setting-img">
                    <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
                    <div class="overlay-content">
                        <div class="text-end p-3">
                            <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                <input id="profile-foreground-img-file-input" type="file"
                                    class="profile-foreground-img-file-input">
                                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xxl-3">
                        <div class="card mt-n5">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        <img src="{{ URL::asset('images/' . $main->file) }}"
                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                            alt="user-profile-image">
                                    </div>
                                    <h5 class="fs-16 mb-1 text-capitalize">{{ $main->category }}</h5>
                                    <p class="text-muted mb-0">Items : {{ $count }}</p>
                                    <p class="text-muted mb-0">Chain : ETHEREUM</p>
                                </div>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="text-center mb-5">
                            <h2 class="mb-3 fw-bold lh-base text-capitalize">{{ $main->category }}</h2>
                            <p class="text-muted">{{ $desc }}</p>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
                <div class="row mt-4 justify-content-center">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="p-2 border border-dashed rounded text-center">
                                    <div>
                                        <p class="text-muted fw-medium mb-1">Total Volume</p>
                                        <h5 class="fs-17 text-success mb-0"><i class="mdi mdi-ethereum me-1"></i> {{ $volume }} {{ $settingsc->currency }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-3 col-6">
                                <div class="p-2 border border-dashed rounded text-center">
                                    <div>
                                        <p class="text-muted fw-medium mb-1">Listed</p>
                                        <h5 class="fs-17 mb-0">{{ $listed }}%</h5>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-3 col-6">
                                <div class="p-2 border border-dashed rounded text-center">
                                    <div>
                                        <p class="text-muted fw-medium mb-1">Owners</p>
                                        <h5 class="fs-17 mb-0">{{ $owners }}+</h5>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-3 col-6">
                                <div class="p-2 border border-dashed rounded text-center">
                                    <div>
                                        <p class="text-muted fw-medium mb-1">Unique Owners</p>
                                        <h5 id="auction-time-1" class="mb-0">{{ $uowners }}%</h5>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div>
                    </div>
                </div>
                <!--end row-->
                <div class="row mt-5 mb-5">
                    @foreach ($nft as $mint)
                        <div class="col-xl-3 col-md-4 col-sm-6">

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
                                        @endif</a></h5>
                                    <p class="text-muted fs-14 mb-0">{{ $mint->nftname }}</p>
                                </div>
                                <div class="card-footer border-top border-top-dashed">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 fs-14">
                                            <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i>
                                            Floor Price: <span class="fw-medium"></span>
                                        </div>
                                        <h5 class="flex-shrink-0 fs-14 text-primary mb-0">
                                            {{ $mint->price }} {{ $settingsc->currency }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    @endforeach
                        {{ $nft }}
                </div>
            </div>
            <!--end row-->

            @include('frontend.layouts.footer')

        </div>
        <!-- end layout wrapper -->
    @endsection
    @section('script')
        <!--Swiper slider js-->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/nft-landing.init.js') }}"></script>
    @endsection
