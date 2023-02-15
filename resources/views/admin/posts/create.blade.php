<div class="modal fade" id="modal-xl" name="modal-xl" style="display: none;" tabindex="-1" role="dialog" aria-labelledby="modal-xl" aria-hidden="true">
    <form method="POST" action="{{ route('admin.posts.store', '#create') }}">
        {{ csrf_field() }}
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-xl">Agrega Post</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titulo de la publicación</label>
                        <input type="text" class="form-control {{ $errors->has('title')? 'is-invalid' : '' }}" name="title" id="title" placeholder="Redacta tu titulo" required value="{{ old('title') }}" autofocus>
                        @if ($errors->any())
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Crear Post</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>

@push('scripts')
    <script>
        if(window.location.hash == '#create'){
            $('#modal-xl').modal('show');
        }
        $('#modal-xl').on('hidden.bs.modal', function () {
            window.location.hash = '#';
        });
        $('#modal-xl').on('shown.bs.modal', function () {
            $('#title').focus();
            window.location.hash = '#create';
        });
    </script>
@endpush
