<div class="card mb-3" >
    {{-- <amp-img src="https://via.placeholder.com/1980x1280" layout="responsive" width="1" height="0.5"></amp-img> --}}
    <div style="width: 150px;height: 150px;margin:1rem auto 0 auto;">
        <amp-img class="user" style="border-radius: 100%;border:1px solid #fff;" src="{{$user->image_perfil ? '/storage/user/'.$user->image_perfil : '/assets/img/user.svg'}}" layout="responsive" width="150px" height="150px">
        </amp-img>
    </div>

</div>
    <h3 class="text-white text-center">{{$user->name}} @if (Auth::user()->id == $user->id)
        <a href="{{ route('edit_profile', ['id'=>$user->id]) }}">Editar</a>
    @endif</h3>
