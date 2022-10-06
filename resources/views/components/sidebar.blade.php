<amp-sidebar id="sidebar1" layout="nodisplay" side="right" style="width: 300px;background-color: #252631;">
    <h3 class="text-center mt-3" style="margin-block-end: 0;">
        <a href="/" class="navbar-brand">
            <amp-img src="{{asset('assets/img/logo.png')}}" layout="fixed" width="110" height="40px"></amp-img>
        </a>
    </h3>
    <hr style="width: 80%;margin: 0.5rem auto 1.5rem auto;">
    <ul class="list-style-none" style="width: 80%;margin: auto;padding:0;">
        @guest
        <li class="nav-item my-1">
            <button class="btn btn-outline-danger btn-sm w-100" on="tap:register-lb,sidebar1.close">Register</button>
        </li>
        <li class="nav-item">
            <button class="btn btn-outline-warning btn-sm w-100" on="tap:login-lb,sidebar1.close">Login</button>
        </li>
        @else
        <li class="nav-item" style="display: flex;align-items: center;">
            <amp-img src="{{Auth::user()->image_perfil ? '/storage/user/'.Auth::user()->image_perfil : '/assets/img/user.svg'}} " width="60px" height="60px"  alt="{{Auth::user()->name}}" style="border-radius:50%;"></amp-img>
            <div style="margin-left: 1rem;">
                <a href="/profile/{{Auth::user()->id}}" class="text-decoration-none text-white">Mi Perfil</a>
                <form  action-xhr="{{ route('signout') }}" target="_top" method="post">
                    @csrf
                    <button style="border:none;background:transparent;padding:0;margin:0;" class="text-white" type="submit">Salir</button>
                </form>
            </div>
        </li>
        @endguest
    </ul>
    <hr style="width: 80%;margin:1.5rem auto;">
    <div class="my-1 text-center" style="width: 80%;margin: 0 auto;">
        @guest
            <button type="button" class="btn btn-primary btn-sm w-100"  on="tap:login-lb,sidebar1.close">
                Subir meme
            </button>
        @else
            <button class="btn btn-primary btn-sm w-100" on="tap:add-post-lb,sidebar1.close">Subir meme</button>
        @endguest
        {{-- <form action="" style="display: flex;" class="mt-1">
            <input placeholder="Buscador" type="search" class="form-control btn-sm">
            <button type="submit" class="btn btn-primary btn-sm ml-1">♪</button>
        </form> --}}
    </div>
    <hr style="width: 80%;margin:1.5rem auto;">
    <ul class="text-center list-style-none my-2 p-0" style="width: 80%;margin: auto;padding:0;">

        <li class="nav-item list-style-none mb-1">
            <a href="/" class="nav-link fw-bold text-decoration-none text-white">Memes del día</a>
        </li>
        <li class="nav-item list-style-none mb-1">
            <a href="/top-memes" class="nav-link fw-bold text-decoration-none text-white">Top memes</a>
        </li>
        <li class="nav-item list-style-none mb-1">
            <a href="/ultimos-memes" class="nav-link fw-bold text-decoration-none text-white">Últimos memes</a>
        </li>

@foreach ($categorias as $categoria)
        <li class="nav-item mb-1">
            <a href="/{{$categoria->slug}}" class="nav-link fw-bold text-decoration-none text-white">{{$categoria->titulo}}</a>
        </li>
@endforeach

    </ul>
  </amp-sidebar>
