@extends('user.layouts.master')
@section('title') Dashboard @endsection
@section('css')
<!--Swiper slider css-->
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<!-- jsvectormap css -->
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@if (Auth::user()->email_verified_at == null)
<div class="row">
    <div class="col-lg-12">
        <div class="card overflow-hidden shadow-none">
            <div class="card-body bg-soft-danger text-danger fw-semibold d-flex">
                <marquee class="fs-14">
                    Verify your email and have access to all the features. check your email or click on Verify button below
                </marquee>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
@endif

<div class="row dash-nft">
    <div class="col-xxl-12">
        <div class="row">
            <div class="col-xl-6">
                <div class="card overflow-hidden">
                    <div class="card-body bg-marketplace d-flex">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 lh-base mb-0">Discover, Collect, Sell and Create <br> your own <span class="text-success">NFTs.</span> </h4>
                            <p class="mb-0 mt-2 pt-1 text-muted">The world's first and largest digital marketplace.</p>
                            <div class="d-flex gap-3 mt-4">
                                <a href="{{ route('user.deposit') }}" class="btn btn-primary">Deposit</a>
                                @if (Auth::user()->email_verified_at == null)
                                    <form action="{{ route('verification.resend') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary" type="submit">Verify</button>
                                    </form>
                                    
                                @endif
                                
                                <a href="{{ route('user.mint') }}" class="btn btn-secondary">Create NFT</a>
                            </div>
                        </div>
                        <img src="{{URL::asset('build/images/bg-d.png')}}" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-xl-3 col-md-6">
                <div class="card card-height-100">
                    <div class="card-body">
                        <div class="float-end">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <p class="dropdown-item" >Total Revenue Acquired</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-primary rounded fs-3">
                                    <i class="bx bx-dollar-circle text-primary"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ps-3">
                                <h5 class="text-muted text-uppercase fs-13 mb-0">Total Revenue</h5>
                            </div>
                        </div>
                        <div class="mt-4 pt-1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="{{ Auth::user()->balance }}"></span> {{ $settingsc->currency }}</h4>
                            <p class="mt-4 mb-0 text-muted"><span class="badge bg-soft-warning text-warning mb-0 me-1"> {{ $pendingtransaction }} {{ $settingsc->currency }} </span> Pending Transaction</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-xl-3 col-md-6">
                <div class="card card-height-100">
                    <div class="card-body">
                        <div class="float-end">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <p class="dropdown-item" >Total NFT Acquired</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-primary rounded fs-3">
                                 
                                    <i data-feather="layers" class="icon-dual text-primary"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ps-3">
                                <h5 class="text-muted text-uppercase fs-13 mb-0">Total NFT</h5>
                            </div>
                        </div>
                        <div class="mt-4 pt-1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="{{ $nftcount }}"></span>@if($nftcount == 1) NFT
                            @else NFTs @endif </h4>
                            <p class="mt-4 mb-0 text-muted"><span class="badge bg-soft-warning text-warning mb-0">{{ $pendingnftcount }} @if($pendingnftcount == 1) NFT
                                @else NFTs @endif</span> Pending Approval</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">History</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted bg-soft-light">
                                    <tr>
                                        <th>id</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @if (!isset($dhistory) || count($dhistory) === 0)
                                    <p class=" text-center text-muted mt-4">No transaction Yet</p>
                                    @else
                                    @php $i=1 @endphp
                                    @foreach ($dhistory as $dhistory)
                                    <tr>
                                        <td> {{ $i++ }}</td>
                                        <td> {{ $dhistory->type }} </td>
                                        <td>{{ $dhistory->amount }} {{ $settingsc->currency }} <br> <span class="badge bg-soft-secondary text-secondary mb-0">${{ $dhistory->amount * $settingsc->ethusd }}</span></td>
                                        <td>
                                            @if ( $dhistory->status == 'Complete' )
                                            <span class="badge bg-soft-success text-success mb-0 me-1"> <i class=" ri-markup-fill align-middle"></i> {{ $dhistory->status }} </span>
                                            @elseif ( $dhistory->status == 'Puged' )
                                            <span class="badge bg-soft-danger text-danger mb-0 me-1"> <i class=" ri-alert-line align-middle"></i> {{ $dhistory->status }} </span>
                                            @else 
                                            <span class="badge bg-soft-warning text-warning mb-0 me-1"> <i class=" ri-markup-line align-middle"></i> {{ $dhistory->status }} </span>
                                            @endif
                                        </td>
                                    </tr><!-- end -->
                                    @endforeach
                                    
                                    
                                    @endif
                                    
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

        
    </div>
    <!--end col-->

  
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
