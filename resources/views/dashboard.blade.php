<!DOCTYPE html>
<html ⚡ lang="es">
<head>
    {{-- amp --}}
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-lightbox" src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js"></script>
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-next-page" src="https://cdn.ampproject.org/v0/amp-next-page-1.0.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
    <script async custom-element="amp-facebook-like" src="https://cdn.ampproject.org/v0/amp-facebook-like-0.1.js"></script>

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="##111111">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="##111111">

    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>

    <link rel="canonical" href="{{url()->full()}}">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

@php
if(!empty($categoria)){
    $title = 'Onlymeme - '.$categoria->titulo;
}elseif (!empty($titulo)) {
    $title = '#'.str_replace('-',' ',$titulo);
}else{
    $title = "Onlymeme - Memes del dia";
}
@endphp
    <title>{{$title}}</title>
    <meta property="og:title" content="{{$title}}" />
    <meta property="og:site_name" content="{{$title}}" />

    <meta name="description" content="Onlymeme es un sitio en donde podras encontrar los memes mas divertidos.">
    <meta property="og:description" content="Onlymeme es un sitio en donde podras encontrar los memes mas divertidos."/>
    {{-- TIPO --}}
    <meta property="og:type" content="blog" />
    {{-- URL --}}
    <meta property="og:url" content="{{url()->full()}}" />
    {{-- IMAGEN --}}
    <meta property="og:image" content="{{asset('assets/img/logo.png')}}" />
    {{-- LOCALIZACION --}}
    <meta property="og:locale" content="es_ES" />
    <meta property="keywords" content="onlymeme, onlymemes, memes, memes de programcion, cringe, wtf, memes de fútbol, memes de anime, memes de peliculas, memes de política, pepe the frog, gaming" />
    <meta property="og:keywords" content="onlymeme, onlymemes, memes, memes de programcion, cringe, wtf, memes de fútbol, memes de anime, memes de peliculas, memes de política, pepe the frog, gaming" />

    @php
    $css = file_get_contents('assets/css/style.css');
    echo '<style amp-custom>'.$css.'</style>';
   @endphp
</head>
<body class="bg-dark">
    @include('components.sidebar')
    @include('components.menu-horizontal')

    <div class="container" style="max-width: 1180px;">
        <div class="row">
            <div class="col-lg-3 " >
                @include('components.menu-vertical')
            </div>
            <div class="col-lg-9">
                <div class="row">

                    <div class="col-lg-8 col-12">
                        @include('components.titulo')
                        @include('components.posteo')
                    </div>
                    <div class="col-lg-4">
                        @include('components.footer-vertical')
                    </div>
                </div>
            </div>
        </div>

    </div>
    @yield('content')
    <div next-page-hide>
        @include('auth.lightbox_login')
        @include('components.add-post')
        @include('auth.lightbox_register')
    </div>
@php
    $titulo = '';
    $url    = '/';

    if(!empty($categoria)){
        $titulo = $categoria->titulo;
        $url    = '/'.$categoria->slug.'/';
    }else if(strstr($_SERVER["REQUEST_URI"],'tags')){
        $titulo =strstr($_SERVER["REQUEST_URI"],'tags');
        $url = "/tags/$titulo/";
    }else {

    }

@endphp

    <amp-next-page class="">
        <script type="application/json">

            [
                @for ($x = 2; $x <= $total; $x++)
                {"image":"", "title": "{{$titulo}}/{{$x}}", "url": "{{$url}}?pagina={{$x}}"}@if ((($x+1) <= $total)?",":"")
                    {{','}}
                @endif
                @endfor
            ]
        </script>

        <div class="text-center" separator></div>
        <div footer>

        </div>
    </amp-next-page>
</body>
</html>
