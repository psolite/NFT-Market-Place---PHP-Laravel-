@extends('frontend.layouts.master-without-nav')
@section('title')
{{ $page->title }}
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
                        <div class="col-lg-10">
                            <div class="text-center mb-5 mt-5">
                                <h2 class="mb-3 fw-bold lh-base">{{ $page->title }}</h2>
                                <!--<p class="text-muted mb-4">Collection widgets specialize in displaying many elements of the
                                    same type, such as a collection of pictures from a collection of articles.</p>-->
                                    {!! $page->content !!}
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
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
