<!-- start cta -->
<section class="py-5 bg-primary position-relative">
    <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-sm">
                <div>
                    <h4 class="text-white mb-0 fw-bold">Create and Sell Your NFT's</h4>
                </div>
            </div>
            <!-- end col -->
            <div class="col-sm-auto">
                <div>
                    <a href="{{ route('user.mint') }}" class="btn bg-gradient btn-danger">Create NFT</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Discover More</a>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end cta -->

<!-- Start footer -->
<footer class="custom-footer bg-dark py-5 position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mt-4">
                <div>
                    <div>
                        <img src="{{ URL::asset('images/' . $settingsc->logo) }}" alt="logo light" height="33">
                    </div>
                    <div class="mt-4">
                        <p>Discover, Collect, Sell and Create your own NFTs.</p>
                        <p>The world’s first and largest digital marketplace for crypto collectibles and non-fungible tokens (NFTs). Buy, sell, and discover exclusive digital items.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 ms-lg-auto">
                <div class="row">
                    <div class="col-sm-4 mt-4">
                        <h5 class="text-white mb-0">Categories</h5>
                        <div class="text-muted mt-3">
                            <ul class="list-unstyled footer-list fs-14 text-capitalize">
                                    <li><a href="{{ route('category', 'games' ) }}">Games</a></li>
                                    <li><a href="{{ route('category', 'artwork' ) }}">Artwork</a></li>
                                    <li><a href="{{ route('category', 'crypto-card' ) }}">Crypto Card</a></li>
                                    <li><a href="{{ route('category', 'photography' ) }}">Photography</a></li>
                                    <li><a href="{{ route('category', 'music' ) }}">Music</a></li>
                                    <li><a href="{{ route('category', 'others' ) }}">Others</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-4">
                        <h5 class="text-white mb-0">Support</h5>
                        <div class="text-muted mt-3">
                            <ul class="list-unstyled footer-list fs-14">
                                @foreach ($pagesc as $page)
                                    <li><a href="{{ route('pages', $page->slug)  }}">{{ $page->title }}</a></li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row text-center text-sm-start align-items-center mt-5">
            <div class="col-sm-6">

                <div>
                    <p class="copy-rights mb-0">
                        <script>
                            document.write(new Date().getFullYear())

                        </script> © {{ $settingsc->appname }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->