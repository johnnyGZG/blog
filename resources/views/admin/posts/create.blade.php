<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{ route('admin.posts.store', '#create') }}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Agrega el Titulo de tu nueva publicación
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        {{-- <label>Titulo de la publicación</label> --}}
                        <input  type="text" 
                                        name="title"
                                        value="{{ old('title') }}" 
                                        id="title-post"
                                        class="form-control" 
                                        placeholder="Ingrese aqui el titulo de la publicación" autofocus required />
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Crear publicación</button>
            </div>
        </div>
    </form>
    </div>
</div>

@push('scripts')
    <script>
        // 'window.location.hash' - sirve para seleccionar el has que trae la url en el momento
        if( window.location.hash === '#create')
        {
        $('#exampleModal').modal('show');
        }

        // Metodo que se llama cuando se da click en el boton cerrar de la modal
        // estos metodos son de boostrap
        $('#exampleModal').on('hide.bs.modal', function(){
        window.location.hash = '#';
        });

        // Metodo que se llama cuando se muestra la modal
        // estos metodos son de boostrap
        /* $('#exampleModal').on('show.bs.modal', function(){
        $('#title-post').focus();
        window.location.hash = '#create';
        }); */

        // Metodo que se invoca despues de llamar el modal muestra la modal
        // estos metodos son de boostrap
        $('#exampleModal').on('shown.bs.modal', function(){
        $('#title-post').focus();
        window.location.hash = '#create';
        });
  </script>
@endpush