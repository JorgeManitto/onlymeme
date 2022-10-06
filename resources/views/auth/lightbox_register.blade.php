<amp-lightbox id="register-lb" layout="nodisplay" style="z-index: 999;">
    <div style="background-color: rgba(0, 0, 0, .5);width:100%;height: 100%;">
      <div class="lb">

            <div class="row justify-content-center">
                <div class="col-12" style="display: flex;justify-content: center;">
                    <div class="card" style="width: 300px;">
                        <h3 class="card-header text-center">Registro</h3>
                        <div class="card-body">
                            <form
                            action-xhr="{{ route('register.custom') }}"
                            method="POST"
                            target="_top"
                            on="submit:AMP.setState({ myClass: 'd-block' }) ;submit-error: AMP.setState({'email' : event.response.errors.email[0],'password':event.response.errors.password[0],'message':event.response.message,'myClass': 'd-none'})"
                            >
                                @csrf
                                <input type="text" class="d-none" name="rol" value="1">
                                <div class="form-group mb-1">
                                    <label for="name">Nombre:</label>
                                    <input type="text"  id="name" class="form-control" name="name"
                                        required autofocus>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="email_address">Email:</label>
                                    <input type="text" id="email_address" class="form-control "
                                        name="email" required autofocus>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="password">Contraseña:</label>
                                    <input type="password"  id="password" class="form-control"
                                        name="password" required>
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-primary w-100 mb-1">@include('components.includes.oval') Ingresar</button>
                                    <button type="button" on="tap:register-lb.close" class="btn btn-danger w-100">Cancelar</button>
                                </div>
                                <div class="mt-1">
                                    <a on="tap:register-lb.close,login-lb" class="text-primary text-decoration-underline">Ya tenies cuenta, ingresa</a>
                                </div>
                                <div submit-error>
                                    <template type="amp-mustache" >
                                        {{-- <div [text]="email"></div> --}}
                                        <div [text]="password ? password:''"></div>
                                        <div [text]="message ? message :''"></div>
                                    </template>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

      </div>
    </div>
  </amp-lightbox>
