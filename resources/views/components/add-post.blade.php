  <amp-lightbox  id="add-post-lb" layout="nodisplay" style="z-index: 999;">
    <div style="background-color: rgba(0, 0, 0, .5);width:100%;height: 100%;">
      <div class="lb">

                <div class="row justify-content-center">
                    <div class="col-12" style="display: flex;justify-content: center;">
                        <div class="card" style="width: 300px;">
                            <h3 class="card-header text-center">Añadir Post</h3>
                            <div style="font-size: 14px;line-height: 1.1;" class="my-1">El post debe ser aprobado, mientras tanto estará disponible en la sección "ultimos memes".</div>
                            <div class="card-body">
                                <form action-xhr="{{route('post.add_post')}}"
                                method="post"
                                enctype="multipart/form-data"
                                on="submit:AMP.setState({ myClass: 'd-block' }) ;submit-success: add-post-lb.close;submit-error: AMP.setState({'error': event.response.error,'myClass': 'd-none'});"
                                >
                                    @csrf
                                    <input type="text" class="d-none" name="user_id" value="{{Auth::check() ? Auth::user()->id :''}}">
                                    <div class="form-group mb-1">
                                        <input type="file" name="data_file" class="form-control">
                                    </div>
                                     <div class="form-group mb-1">
                                        <input type="text" name="palabras_clave" placeholder="Tags" class="form-control">
                                    </div>
                                    <div class="form-group mb-1">
                                        <input type="text" name="descripcion" placeholder="Descripcion" class="form-control">
                                    </div>
                                    <div [text]="error ? error:''"></div>
                                    <div>
                                        <button type="submit" class="btn btn-primary w-100 mb-1">@include('components.includes.oval') Subir</button>
                                        <button  type="button" class="btn btn-danger w-100" on="tap:add-post-lb.close">Cancelar</button>

                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
      </div>
    </div>
  </amp-lightbox>
