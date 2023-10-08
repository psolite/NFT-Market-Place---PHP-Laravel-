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
                    <h5 class="card-title mb-0">Make a Deposit</h5>
                </div>
                <div class="card-body">
                    <form oninput="checkForm()" action="{{ route('user.depositform') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <div class="col-lg-6">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" id="amount" class="form-control" name="amount" placeholder="Amount" step="0.0001" min="0.0001" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="size" class="form-label">Choose Payment Method</label>
                                <select class="form-select mb-3" name="crypto" aria-label="Default select example"
                                    required>
                                    @foreach ($gateway as $payment)
                                      <option value="{{ $payment->crypto }}">{{ $payment->crypto }}</option>  
                                    @endforeach
                                    
                                </select>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button id="submitBtn" class="btn btn-primary"  disabled>Save</button>
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
        function checkForm() {
            var input1 = document.getElementById('amount');
            var button = document.getElementById('submitBtn');

            if (input1.value !== "") {
                button.disabled = false;
            } else {
                button.disabled = true;
            }

            
        }
    </script>
@endsection
