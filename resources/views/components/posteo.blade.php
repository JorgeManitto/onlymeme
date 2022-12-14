

@foreach ($posts as $post)
@php
$post->palabras_clave = explode(',',$post->palabras_clave);

$size = explode(',',$post->size);
list($width,$height)= $size;
@endphp

<div class="mb-3">
    @if ($post->tipo == 2)

    <amp-video

    autoplay
    controls
    width="{{$width}}"
    height="{{$height}}"
    layout="responsive"
    poster="">

    {{-- <source src="/static/inline-examples/videos/kitten-playing.webm"
        type="video/webm" /> --}}

    <source src="/storage/post-video/{{$post->url}}" />

    <div fallback>
        <p>This browser does not support the video element.</p>
    </div>
    </amp-video>

    @else
    <a href="/post/{{$post->slug}}">
        <amp-img
        style="border-radius: 8px 8px 0 0;"
        alt="A view of the sea"
        src="/storage/post/{{$post->url}}"
        width="{{$width}}"
        height="{{$height}}"
        layout="responsive"
        >
        </amp-img>
    </a>
    @endif


        <div class="text-white" style="border-radius: 0 0 8px 8px;background-color:#252631;padding:1rem;">
            <a href="/post/{{$post->slug}}" class="text-decoration-none" style="color: #fff;">
                <div class="h3">
                    {{$post->descripcion}}
                </div>
            </a>
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
// START
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
            <button type="submit" [text]="foo{{$post->id}} ? '????' :'????'" style="border:none;background:transparent;font-size:26px;" >????</button>
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

            <button type="submit"  [text]="foo{{$post->id}} ? '????':'????'" style="border:none;background:transparent;font-size:26px;">????</button>

        </form>
    @endif
@else
        <button type="button" on="tap:login-lb" style="border:none;background:transparent;font-size:26px;">????</button>
@endif
{{-- ENDDDDDD --}}

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


</div>


@endforeach
