<h3 class="text-white">Editar Usuario <hr></h3>
<div class="mb-3" style="background-color: #fff;margin-top:1rem;padding:1rem;border-radius:5%;">
    <form action-xhr="{{route('profile.update_profile')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" class="d-none" name="id" value="{{Auth::user()->id}}">
        <div class="mb-3 text-center">
@if ($user->image_perfil)
            <amp-img class="user" src="/storage/user/{{$user->image_perfil}}" width="100px" height="100px">
@endif
        </div>
        <div class="mb-3">
            <label for="image_perfil">Foto de perfil:</label>
            <input type="file" name="image_perfil" class="form-control">
        </div>
        <div class="mb-3">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" value="{{$user->name}}">
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{$user->email}}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password">Contraseña</label>
            <input type="pasword" class="form-control" name="password">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
            <a href="/profile/{{Auth::user()->id}}" class="mt-1 text-decoration-none btn btn-danger w-100">Cancelar</a>
        </div>
    </form>
</div>
