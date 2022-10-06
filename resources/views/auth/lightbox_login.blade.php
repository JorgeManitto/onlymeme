<amp-lightbox id="login-lb" layout="nodisplay" style="z-index: 999;">
    <div style="background-color: rgba(0, 0, 0, .5);width:100%;height: 100%;">
      <div class="lb">

                <div class="row">
                    <div class="col-12" style="display: flex;justify-content: center;">
                        <div class="card" style="width: 300px;">
                            <h3 class="card-header text-center">Login</h3>
                            <div class="card-body">
                                <form
                                method="POST"
                                action-xhr="{{ route('login.custom') }}"
                                target="_top"
                                on="submit:AMP.setState({ myClass: 'd-block' }) ;submit-error: AMP.setState({'error': event.response.error,'myClass': 'd-none'})"
                                >
                                @csrf
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

                                    <div class="form-group mb-1">
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck2" >
                                            <label class="form-check-label" for="defaultCheck2">Recuerdame</label>
                                        </div>
                                    </div>
                                    <div class="d-grid mx-auto">
                                        <button type="submit" class="btn btn-primary w-100 mb-1">@include('components.includes.oval') Ingresar</button>
                                        <button type="button" on="tap:login-lb.close" class="btn btn-danger w-100">Cancelar</button>
                                    </div>
                                    <div class="mt-1">
                                        <a on="tap:login-lb.close,register-lb" class="text-primary text-decoration-underline">Registrame</a>
                                    </div>

                                    <div submit-success>
                                    <template type="amp-mustache">
                                    </template>
                                    </div>
                                    <div submit-error>
                                    <template type="amp-mustache" >
                                        <div [text]="error ? error :''"></div>
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
