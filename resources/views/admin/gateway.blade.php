@extends('admin.layouts.master')
@section('title')
    Payment Gateway
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
            Gateway
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Payment Gateway</h5>
                </div>
                <!-- Bordered Tables -->
                <table class="table table-bordered table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Crypto</th>
                            <th scope="col">Wallet Address</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($gateway as $payment)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $payment->crypto }}</td>
                                <td>{{ $payment->wallet }}</td>
                                <td>
                                    @if ($payment->is_active)
                                        <span class="badge badge-soft-primary"> on
                                        @else
                                            <span class="badge badge-soft-danger"> off
                                    @endif
                                    </span>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#editgateway{{ $payment->id }}">Edit</a></li>
                                            <li>
                                                <form action="{{ route('admin.gatewaystatus', $payment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-soft-secondary ">
                                                        @if ($payment->is_active)
                                                            off
                                                        @else
                                                            on
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    @foreach ($gateway as $payment)
        <!-- staticBackdrop Modal -->
        <div class="modal fade" id="editgateway{{ $payment->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <div class="mt-4">
                            <form action="{{ route('admin.gatewayedit', $payment->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <h4 class="mb-3">{{ $payment->crypto }} Wallet Address</h4>
                                <div class="mb-4">
                                    <label for="wallet" class="form-label">Wallet address</label>
                                    <input type="text" name="wallet" class="form-control" value="{{ $payment->wallet }}"
                                        id="wallet">
                                </div>
                                <div class="hstack gap-2 justify-content-center">
                                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                                        data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                    <input type="submit" value="Save" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
@endsection
