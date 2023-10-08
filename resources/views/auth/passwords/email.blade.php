@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.password-reset')
@endsection
@section('content')
    <div class="auth-page">
        <div class="container-fluid p-0 pt-5 bg-light">
            <div class="row g-0 justify-content-center pt-5">
                <div class="col-xxl-4 col-lg-4 col-md-6">
                    <div class="row justify-content-center g-0">
                        <div class="col-xl-9">
                            <div class="p-4">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="auth-full-page-content rounded d-flex p-3 my-2">
                                            <div class="w-100">
                                                <div class="d-flex flex-column h-100">
                                                    <div class="auth-content my-auto">
                                                        <div class="text-center">
                                                            <h5 class="mb-0">Reset Password</h5>
                                                            <p class="text-muted mt-2">Reset Password -
                                                                {{ $settingsc->appname }}.</p>
                                                        </div>
                                                        <div class="alert alert-success text-center my-4 font-size-12"
                                                            role="alert">
                                                            Enter your Email and instructions will be sent to you!
                                                        </div>
                                                        <div class="mt-4">
                                                            @if (session('status'))
                                                                <div class="alert alert-success text-center mb-4"
                                                                    role="alert">
                                                                    {{ session('status') }}
                                                                </div>
                                                            @endif
                                                            <form class="form-horizontal" method="POST"
                                                                action="{{ route('password.email') }}">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="useremail" class="form-label">Email</label>
                                                                    <input type="email"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        id="useremail" name="email"
                                                                        placeholder="Enter email"
                                                                        value="{{ old('email') }}" id="email">
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="text-end">
                                                                    <button
                                                                        class="btn btn-primary w-md waves-effect waves-light"
                                                                        type="submit">Reset</button>
                                                                </div>

                                                            </form>
                                                            <div class="mt-4 pt-3 text-center">
                                                                <p class="text-muted mb-0">Remember It ? <a
                                                                        href="{{ url('login') }}"
                                                                        class="text-primary fw-semibold"> Sign In </a> </p>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <div class="mt-4 text-center">
                <p class="mb-0">©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> {{ $settingsc->appname }}
                </p>
            </div>
        </div>
        <!-- end container fluid -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/pages/eva-icon.init.js') }}"></script>
@endsection
