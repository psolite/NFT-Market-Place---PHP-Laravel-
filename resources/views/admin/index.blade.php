@extends('admin.layouts.master')
@section('title')
    Admin Dashboard
@endsection
@section('css')
    <!--Swiper slider css-->
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


    <div class="row dash-nft">
        <div class="col-xl-6">
            <div class="card overflow-hidden">
                <div class="card-body bg-marketplace d-flex">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 lh-base mb-0">Mr Admin Minting More <span class="text-success">NFTs</span> is
                            needed the make ths web app look good. </h4>
                        <p class="mb-0 mt-2 pt-1 text-muted">The world's first and largest digital marketplace.</p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="" class="btn btn-primary">Mint NFT</a>

                        </div>
                    </div>
                    <img src="{{ URL::asset('build/images/bg-d.png') }}" alt="" class="img-fluid" />
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-3 col-md-6">
            <div class="card card-height-100">
                <div class="card-body">
                    <div class="float-end">

                    </div>
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-primary rounded fs-3">
                                <i class="bx bx-dollar-circle text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ps-3">
                            <h5 class="text-muted text-uppercase fs-13 mb-0">Total Deposit</h5>
                        </div>
                    </div>
                    <div class="mt-4 pt-1">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value"
                                data-target="{{ $tdeposit }}"></span> {{ $settingsc->currency }}</h4>
                                <p class="mt-4 mb-0 text-muted"><span class="badge bg-soft-warning text-warning mb-0">
                                    {{ $tdepositpending }} </span> Total Pending Deposit</p>

                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-3 col-md-6">
            <div class="card card-height-100">
                <div class="card-body">

                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-primary rounded fs-3">
                                <i class="bx bx-wallet text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ps-3">
                            <h5 class="text-muted text-uppercase fs-13 mb-0">Total NFT</h5>
                        </div>
                    </div>
                    <div class="mt-4 pt-1">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value"
                                data-target="{{ $totalnft }}"></span> NFT</h4>
                        <p class="mt-4 mb-0 text-muted"><span class="badge bg-soft-success text-success mb-0">
                                {{ $totalnftlisted }} </span> Total Listed NFT</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-body p-0">
                    <div class="border-start p-4 h-100 d-flex flex-column">

                        <div class="w-100">
                            <div class="d-flex align-items-center">
                                <div class="ms-3 flex-grow-1">
                                    <h5 class="fs-16 mb-1">Ethereum Price update</h5>
                                    <p>Current Price this web app is run on</p>
                                </div>
                            </div>

                            <h3 class="ff-secondary fw-bold mt-4"><i class="mdi mdi-ethereum text-primary"></i>
                                1 ETH ≈ ${{ $settingsc->ethusd }}</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Recent Transaction</h4>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted bg-soft-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($history as $transaction)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $transaction->type }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td><span
                                            class="badge @if ($transaction->status == 'Complete') bg-success @elseif ($transaction->status == 'Puged') bg-danger @else bg-warning @endif">{{ $transaction->status }}</td>
                                    </tr>
                                @endforeach

                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div><!-- end tbody -->

                </div>
            </div>
        </div>
        <!--end col-->
        <!--end card-->

    </div>
    <!--end row-->
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- Countdown js -->
    <script src="{{ URL::asset('build/js/pages/coming-soon.init.js') }}"></script>

    <!-- Marketplace init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-nft.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
