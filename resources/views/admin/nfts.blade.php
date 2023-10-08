@extends('admin.layouts.master')
@section('title')
    All NFT
@endsection
@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
        All NFT
        @endslot
    @endcomponent




    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"> All NFT</h5>
                </div>
                <div class="card-body">
                    <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th scope="col">NFT</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($mint as $nft)
                                <tr>
                                    <td scope="row">{{ $i++ }}</td>
                                    @php
                                        $user = App\Models\User::find($nft->user_id);
                                        $userName = $user ? $user->name : null;
                                    @endphp
                                    <td>{{ $userName }}</td>
                                    <td>
                                        <img class="header-profile-user" src="{{ URL::asset('images/' . $nft->file) }}"
                                            alt="NFT">
                                    </td>
                                    <td>{{ $nft->category }}</td>
                                    <td>
                                        @if ($nft->is_active)
                                            <span class="badge bg-success ">Active</span>
                                        @else
                                            <span class="badge bg-warning ">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">

                                                <li><a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#viewmint{{ $nft->id }}">View NFT</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#editmint{{ $nft->id }}">Edit</a></li>
                                                <li>
                                                    <form action="{{ route('admin.mintApproval', $nft->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-soft-success">
                                                            @if ($nft->is_active)
                                                                UnApprove
                                                            @else
                                                                Approve
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
        </div>
    </div>
    @foreach ($mint as $nft)
    
    
        <!-- staticBackdrop Modal -->
        <div class="modal fade" id="viewmint{{ $nft->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <div class="mt-4">
                            <img src="{{ URL::asset('images/' . $nft->file) }}" width="350px">

                            <div class="hstack gap-2 justify-content-center">
                                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- staticBackdrop Modal -->
        <div class="modal fade" id="editmint{{ $nft->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <div class="mt-4">
                            
                            <form action="{{ route('admin.editNFT', $nft->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row g-3">
                                    <div class="col-lg-12">   
                                        <img src="{{ URL::asset('images/' . $nft->file) }}" width="350px">                         
                                        <h5 class="fw-semibold mb-3">Image, or 3D Model</h5>
                                        <input type="file" class="form-control " name="file" id="file" >
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <label for="NFTName" class="form-label">NFT Name</label>
                                        <input type="text" class="form-control" id="NFTName" value="{{ $nft->nftname }}" name="nftname" placeholder="Enter NFT name" required>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="author" name="author" value="{{ $nft->author }}" placeholder="Enter Author name" required>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                            <label for="categories" class="form-label">Categories</label>
                                            <select class="form-select mb-3" name="category" aria-label="Default select example">
                                                <option value="{{ $nft->category }}">{{ $nft->category }}</option>
                                                <option value="Artwork">Artwork</option>
                                                <option value="Games">Games</option>
                                                <option value="Music">Music</option>
                                                <option value="Photography">Photography</option>
                                                <option value="Crypto Card">Crypto Card</option>
                                                <option value="Others">Others</option>
                                            </select>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <label for="NFTPrice" class="form-label">Price in ETH</label>
                                        <input type="text" class="form-control" id="NFTPrice" value="{{ $nft->price }}" name="price" placeholder="NFT Price" required>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" rows="3" name="desc" placeholder="Enter description" required>{{ $nft->desc }}</textarea>
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
                            <div class="hstack gap-2 justify-content-center">
                                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
