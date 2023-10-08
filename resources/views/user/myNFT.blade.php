@extends('user.layouts.master')
@section('title')
    MyNFT
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            NFT Marketplace
        @endslot
        @slot('title')
            MyNFT
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden shadow-none">
                <div class="card-body bg-soft-success text-success fw-semibold d-flex">
                    <marquee class="fs-14">
                        NFT art is a digital asset that is collectable, unique, and non-transferrable, Cortes explained.
                        Every NFT is unique in it's creative design and cannot be duplicated, making them limited and rare.
                        NFTs get their value because the transaction proves ownership of the art.
                    </marquee>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->





    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1">
        @foreach ($nft as $mint)
            <div class="col">
                <div class="card explore-box card-animate">
                    <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                        <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i
                                class="mdi mdi-cards-heart fs-16"></i></button>
                    </div>
                    <div class="explore-place-bid-img">
                        <img src="{{ URL::asset('images/' . $mint->file) }}" alt=""
                            class="card-img-top explore-img" />
                        <div class="bg-overlay"></div>
                        <!-- <div class="place-bid-btn">
                            <a href="#!" class="btn btn-primary"><i class="ri-auction-fill align-bottom me-1"></i>
                                Place Bid</a>
                        </div> -->
                    </div>
                    <div class="card-body">
                        @if ($mint->is_active)
                            <p class="fw-medium mb-0 float-end badge bg-soft-success text-success mb-0 me-1"> Approved </p>
                        @else
                            <p class="fw-medium mb-0 float-end badge bg-soft-warning text-warning mb-0 me-1"> Unapproved
                            </p>
                        @endif
                        <h5 class="mb-1 fs-15"><a href="apps-nft-item-details" class="link-dark">{{ $mint->author }} <i
                                    class="text-success bx bx-badge-check"></i></a></h5>
                        <p class="text-muted fs-14 mb-0">{{ $mint->category }}</p>
                    </div>
                    <div class="card-footer border-top border-top-dashed">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 fs-14">
                                <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Floor Price:
                            </div>
                            <h5 class="flex-shrink-0 fs-14 text-primary mb-0">{{ $mint->price }} {{ $settingsc->currency }}
                            </h5>
                        </div>
                    </div>
                    <div class="hstack gap-2">
                        <a class="btn btn-secondary w-100" href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#edit{{ $mint->id }}">Edit</a></li>
                    </div>
                    
                    <form action="{{ route('user.list', $mint->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="hstack gap-2">
                            @if ($mint->is_listed)
                                <button class="btn btn-danger w-100">
                                    UnList
                                </button>
                            @else
                                <button class="btn btn-success w-100">
                                    List
                                </button>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        @endforeach
    </div>
        @foreach ($nft as $mint)
            
        
        <!-- staticBackdrop Modal -->
        <div class="modal fade" id="edit{{ $mint->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <div class="mt-4">
                            <form action="{{ route('user.updateNftPrice', $mint->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <h4 class="mb-3"> Update your NFT</h4>
                                <div class="mb-4">
                                    <label for="price" class="form-label">NFT Price</label>
                                    <input type="text" name="price" class="form-control" value="{{ $mint->price }}"
                                        id="price" required>
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
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
