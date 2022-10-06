<div style="background-color: #252631;position:sticky;top: 0;z-index:999;" next-page-hide>
    <nav class="navbar">
        <a href="/" class="navbar-brand">
            <amp-img src="{{asset('assets/img/logo.png')}}" layout="fixed" width="110" height="40px"></amp-img>
        </a>
        <div class="navbar-collapse ">
            <ul class="navbar-nav">
                {{-- @guest
                <li class="nav-item d-none d-lg-block">
                    <button class="btn btn-outline-danger btn-sm mx-1" on="tap:register-lb">Register</button>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <button class="btn btn-outline-warning btn-sm mx-1" on="tap:login-lb">Login</button>
                </li>
                @else
                @endguest --}}
                {{-- <li>
                    <input type="search" placeholder="buscador..." style="padding: 0;margin: 0;">
                </li> --}}
                <li>
                    <button style="height:10px;" class="text-white d-block border-0 bg-transparent ms-3" on="tap:sidebar1.toggle"><i class="gg gg-menu"></i></button>
                </li>
            </ul>
        </div>
    </nav>
</div>

