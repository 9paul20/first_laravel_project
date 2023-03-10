{{ csrf_field() }}
<div class="card-body">
    <div class="form-group">
        <label >Identificador</label>
        @if($role->exists)
            <input type="text" class="form-control" placeholder="Un Nombre al Rol" value="{{ $role->name }}" disabled>
            @else
            <input type="text" name="name" id="name" class="form-control" placeholder="Un Nombre al Identidicador" value="{{ old('name',$role->name) }}">
        @endif
    </div>
    <div class="form-group">
        <label for="display_name">Nombre</label>
        <input type="text" class="form-control" name="display_name" id="display_name" placeholder="Un Nombre al Rol" value="{{ old('display_name', $role->display_name) }}">
    </div>
    {{-- <div class="form-group">
        <label for="guard_name">Guard</label>
        <select name="guard_name" class="custom-select rounded-0" id="exampleSelectRounded0">
            @foreach (config('auth.guards') as $guardName=>$guard)
                <option {{ old('guard_name', $role->guard_name) === $guardName ? 'selected' : '' }}value="{{ $guardName }}">{{ $guardName }}</option>
            @endforeach
        </select>
    </div> --}}
</div>
<div class="form-group card card-primary card-outline col-md-5" style="margin-left:10px">
    <div class="box-header card-header">
        <h3>Permisos</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            @include('admin.users.permissions.checkboxes', ['model' => $role])
        </div>
    </div>
</div>
