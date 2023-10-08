@if (Session::has('msg'))
    <!-- Success Alert -->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('msg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (Session::has('wmsg'))
<!-- Warning Alert -->
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('wmsg') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@if (Session::has('xmsg'))
    <!-- Danger Alert -->
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('xmsg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
