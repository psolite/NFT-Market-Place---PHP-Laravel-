<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/' . $settingsc->logo) }}" alt="" height="33">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/' . $settingsc->logo) }}" alt="" height="33">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/' . $settingsc->logo) }}" alt="" height="33">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/' . $settingsc->logo) }}" alt="" height="33">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('user.index') }}" >
                        <i data-feather="home" class="icon-dual"></i> <span>User Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('user.mint') }}" >
                        <i data-feather="codesandbox" class="icon-dual"></i> <span>Mint NFT</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('user.myNFT') }}" >
                        <i data-feather="layers" class="icon-dual"></i> <span>Your NFTs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('user.deposit') }}" >
                        <i data-feather="arrow-down-circle" class="icon-dual"></i> <span>Deposit</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('user.withdrawal') }}" >
                        <i data-feather="credit-card" class="icon-dual"></i> <span>Withdrawal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('user.history') }}" >
                        <i data-feather="archive" class="icon-dual"></i> <span>History</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out" class="icon-dual"></i> <span key="t-logout">Logout</span></a>
                    
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                            @csrf
                        </form>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
