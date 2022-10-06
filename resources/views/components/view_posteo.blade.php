@php
$post->palabras_clave = explode(',',$post->palabras_clave);

$size = explode(',',$post->size);
list($width,$height)= $size;
$tmp = [];
@endphp

<div class="my-3">
    @if ($post->tipo == 2)
    <amp-video
    autoplay
    controls
    width="{{$width}}"
    height="{{$height}}"
    layout="responsive"
    poster="">
    <source src="/storage/post-video/{{$post->url}}" />
    <div fallback>
        <p>This browser does not support the video element.</p>
    </div>
    </amp-video>

    @else

    <amp-img
    style="border-radius: 8px 8px 0 0;"
    alt="A view of the sea"
    src="/storage/post/{{$post->url}}"
    width="{{$width}}"
    height="{{$height}}"
    layout="responsive"
    >
    </amp-img>

    @endif

    <a href="/post/{{$post->slug}}" class="text-decoration-none" style="color: #fff;">
        <div class="text-white" style="border-radius: 0 0 8px 8px;background-color:#252631;padding:1rem;">
            <amp-social-share
            style="border-radius: 50%;"
            width="30"
            height="30"
            type="twitter"
            data-param-text="{{$post->descripcion}}"
            data-param-url="{{ route('post.view', ['slug'=>$post->slug]) }}"
            aria-label="Compartir en Twitter"
            ></amp-social-share>

            <amp-social-share
            style="border-radius: 50%;"
            width="30"
            height="30"
            type="facebook"
            data-param-text="{{$post->descripcion}}"
            data-param-href="{{ route('post.view', ['slug'=>$post->slug]) }}"
            aria-label="Compartir en Facebook"
            ></amp-social-share>

            <amp-social-share
            style="border-radius: 50%;"
            width="30"
            height="30"
            type="whatsapp"
            data-param-app_id=""
            aria-label="Compartir en Whatsapp"
            ></amp-social-share>
            <div class="h3">
                {{$post->descripcion}}
            </div>
@foreach ($post->palabras_clave as $palabra)
    @if ($palabra && (strlen($palabra) >= 4))
            <a href="{{ route('tags', ['text'=>$palabra]) }}" style="font-size: 0.75rem;" class="badge badge-pill mb-1 text-decoration-none badge-primary">#{{$palabra}}</a>
    @endif
@endforeach

<div style="display: flex;align-items: center;justify-content: space-between;">
    <div>
@if (Auth::check())
@php
$check = $post->reactions->where('user_id',Auth::user()->id)->first();

@endphp
@if (!$check)

    <form style="display: inline-block;" action-xhr="{{route('post.addreaction')}}"  method="post" on="submit:AMP.setState({foo{{$post->id}}: !foo{{$post->id}}})">
        @csrf
        <input type="text" value="{{$post->id}}" name="id" class="d-none">
        <input type="text" value="kissing_heart" name="emoji" class="d-none">

        <amp-state id="foo{{$post->id}}">
            <script type="application/json">
              true
            </script>
        </amp-state>
        <input type="text"
        value="true"
        [value]="foo{{$post->id}}"
        name="like"
        class="d-none"
        >
        <button type="submit" [text]="foo{{$post->id}} ? '🤍' :'💙'" style="border:none;background:transparent;font-size:26px;" >🤍</button>
    </form>

@else
    <form style="display: inline-block;" action-xhr="{{route('post.removereaction')}}" method="post" on="submit:AMP.setState({foo{{$post->id}}: !foo{{$post->id}}})">
        @csrf
        <input type="text" value="{{$post->id}}" name="id" class="d-none">
        <input type="text" value="kissing_heart" name="emoji" class="d-none">
        <amp-state id="foo{{$post->id}}">
            <script type="application/json">
                true
            </script>
        </amp-state>
        <input type="text"
        value="true"
        [value]="foo{{$post->id}}"
        name="like"
        class="d-none"
        >
        <button type="submit"  [text]="foo{{$post->id}} ? '💙':'🤍'" style="border:none;background:transparent;font-size:26px;">💙</button>
    </form>
@endif
@else
    <button type="button" on="tap:login-lb" style="border:none;background:transparent;font-size:26px;">🤍</button>
@endif

<span class="badge badge-pill badge-primary">{{ $post->post_reactions_count }} fav</span>
    </div>
    <div style="display: flex;align-items: center;">
        @php
            $post->user = $post->user($post->user_id);
        @endphp
        <amp-img class="user" src="{{$post->user->image_perfil ? '/storage/user/'.$post->user->image_perfil : '/assets/img/user.svg'}}" width="40px" height="40px"  alt="{{$post->user->name}}" style="border-radius:50%;"></amp-img>
        <a style="margin-left: 1rem;" href="/profile/{{$post->user->id}}" class="text-decoration-none text-white">{{$post->user->name}}</a>
    </div>
</div>

        </div>
    </a>
    <h2 class="text-white">Comentarios</h2>
    <div class="bg-">
        <amp-facebook-comments
        width="486"
        height="657"
        layout="responsive"
        data-colorscheme="light"
        data-numposts="1"
        data-href="{{url()->full()}}"
        style="background-color: #fff;"
      >
      </amp-facebook-comments>
    </div>
</div>
