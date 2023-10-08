@extends('user.layouts.master')
@section('title')
    Deposit
@endsection
@section('css')
    <!-- Filepond css -->
    <link href="{{ URL::asset('build/libs/filepond/filepond.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Deposit
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Confirm Deposit</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.confirmdepositstore') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <p>Make a deposit of {{ $amount }} {{ $settingsc->currency }} ≈ ${{ $amount * $settingsc->ethusd }} in the {{ $crypto }} wallet address below <br> <br> <b  id="textToCopy">@foreach ($gateway as $payment)
                                @if ($payment->crypto == $crypto)
                                {{ $payment->wallet }}
                                @endif
                            @endforeach</b> <a id="copyLink" href="javascript:void(0)" class="text-secondary"><i class=" ri-file-copy-fill" style="font-size: 20px"></i></a>
                        </p>

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button class="btn btn-primary" >Save</button>
                                </div>
                            </div>


                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    
@endsection
@section('script')
    <!-- filepond js -->
    <script src="{{ URL::asset('build/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
    <!--nft create init js-->
    <script src="{{ URL::asset('build/js/pages/apps-nft-create.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        document.getElementById('copyLink').addEventListener('click', function(e) {
            e.preventDefault();
            var textToCopy = document.getElementById('textToCopy');
            var range = document.createRange();
            range.selectNode(textToCopy);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
            alert('Text copied to clipboard');
        });
    </script>
@endsection
