@extends('user.layouts.master')
@section('title') History @endsection
@section('css')
<!--Swiper slider css-->
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<!-- jsvectormap css -->
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title')History @endslot
@endcomponent


<div class="row dash-nft">
    <div class="col-xxl-8">
        

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
                                    @if ($dhistory !== [])
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
                                    @else
                                    
                                    <p class=" text-center text-muted mt-4">No transaction Yet</p>
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
