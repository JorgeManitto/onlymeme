<div class="text-white bg-dark d-none d-lg-block" style="width: 280px;position: fixed;z-index: 999;" next-page-hide>
    <ul class="nav nav-pills flex-column mb-auto p-0">
            <li class="nav-item list-style-none mb-1">
                <a href="/" class="nav-link fw-bold text-decoration-none text-white">Memes del día</a>
            </li>
            <li class="nav-item list-style-none mb-1">
                <a href="/top-memes" class="nav-link fw-bold text-decoration-none text-white">Top memes</a>
            </li>
            <li class="nav-item list-style-none mb-1">
                <a href="/ultimos-memes" class="nav-link fw-bold text-decoration-none text-white">Últimos memes</a>
            </li>
    </ul>
    <hr>
    <div class="my-3">
        <ul class="list-style-none p-0">
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
        @guest
            <button type="button" class="btn btn-primary btn-sm w-100" on="tap:login-lb">
                Subir meme
            </button>
        @else
            <button class="btn btn-primary btn-sm w-100" on="tap:add-post-lb">Subir meme</button>
        @endguest

    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto p-0">
@foreach ($categorias as $categoria)
    <li class="nav-item list-style-none " style="margin-bottom: .5rem;">
        <a href="/{{$categoria->slug}}" class="nav-link fw-bold text-decoration-none text-white">
        {{$categoria->titulo}}
        </a>
    </li>
@endforeach

    </ul>
    <hr>
  </div>
