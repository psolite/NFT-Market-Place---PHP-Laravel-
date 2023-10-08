<nav class="navbar navbar-expand-lg navbar-landing navbar-light fixed-top bg-white" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ URL::asset('images/' . $settingsc->logo) }}" class="card-logo card-logo-dark" alt="logo dark" height="33">
            <img src="{{ URL::asset('images/' . $settingsc->logo) }}" class="card-logo card-logo-light" alt="logo light" height="33">
        </a>
        <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                <li class="nav-item">
                    <a class="nav-link fs-14 text-dark active" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14 text-dark" href="{{ route('allnft') }}">Marketplace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14 text-dark" href="/#categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-14 text-dark" href="/#creators">Top Creators</a>
                </li>
            </ul>

            <div class="">
                @if (Auth::user())
                <a href="{{ route('userRole') }}" class="btn btn-primary btn-sm">{{ Auth::user()->name }}</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                @endif
                
            </div>
        </div>

    </div>
</nav>