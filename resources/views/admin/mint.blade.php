@extends('admin.layouts.master')
@section('title') Mint @endsection
@section('css')
<!-- Filepond css -->
<link href="{{ URL::asset('build/libs/filepond/filepond.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title')Create NFT @endslot
@endcomponent

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Mint New NFT</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.mintNFT') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-12">                            
                            <h5 class="fw-semibold mb-3">Image, or 3D Model</h5>
                            <input type="file" class="form-control " name="file" id="file" required>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label for="NFTName" class="form-label">NFT Name</label>
                            <input type="text" class="form-control" id="NFTName" name="nftname" placeholder="Enter NFT name" required>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" placeholder="Enter Author name" required>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                                <label for="categories" class="form-label">Categories</label>
                                <select class="form-select mb-3" name="category" aria-label="Default select example">
                                    <option value="artwork">Artwork</option>
                                    <option value="games">Games</option>
                                    <option value="music">Music</option>
                                    <option value="photography">Photography</option>
                                    <option value="crypto-card">Crypto Card</option>
                                    <option value="Others">Others</option>
                                </select>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label for="NFTPrice" class="form-label">Price in ETH</label>
                            <input type="text" class="form-control" id="NFTPrice" name="price" placeholder="NFT Price" required>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="desc" placeholder="Enter description" required></textarea>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button class="btn btn-primary">Mint NFT</button>
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
<script src="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
<!--nft create init js-->
<script src="{{ URL::asset('build/js/pages/apps-nft-create.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
