@extends('admin.layouts.master')
@section('title')
    Settings
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
        Settings
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settingsupdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">

                            <div class="col-lg-12">   
                                <img src="{{ URL::asset('images/' . $settings->logo) }}" width="200px">                         
                                <h5 class="fw-semibold mb-3">Logo</h5>
                                <input type="file" class="form-control " name="file" id="file" >
                            </div>

                            <div class="col-lg-6">
                                <label for="appname" class="form-label">App Name</label>
                                <input type="text" id="appname" class="form-control" name="appname" value="{{ $settings->appname }}" placeholder="App Name" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="sitelink" class="form-label">Site Link</label>
                                <input type="text" id="sitelink" class="form-control" name="sitelink" value="{{ $settings->sitelink }}" placeholder="sitelink" required>
                            </div>
                            <!--end col-->

                            <div class="col-lg-6">
                                <label for="currency" class="form-label">Currency</label>
                                <input type="text" id="currency" class="form-control" name="currency" value="{{ $settings->currency }}" placeholder="currency" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="mintprice" class="form-label">Mint Price</label>
                                <input type="decmail" id="mintprice" class="form-control" name="mintprice" value="{{ $settings->mintprice }}" placeholder="Mint Price" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="appemail" class="form-label">App mail</label>
                                <input type="email" id="appemail" class="form-control" name="appemail" value="{{ $settings->appemail }}" placeholder="App mail" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="emailnoreply" class="form-label">Email for mailing</label>
                                <input type="email" id="emailnoreply" class="form-control" name="emailnoreply" value="{{ $settings->emailnoreply }}" placeholder="" required>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="mailfooter" class="form-label">Mail Footer</label>
                                <textarea class="form-control" name="mailfooter" id="mailfooter" cols="30" rows="10" required>{{ $settings->mailfooter }}</textarea>
                               
                            </div>
                            <!--end col-->
                            
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button class="btn btn-primary">Save</button>
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
