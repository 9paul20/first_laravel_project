{{ csrf_field() }}
<div class="card-body">
    <div class="form-group">
        <label>Identificador</label>
        @if ($permission->exists)
            <input type="text" class="form-control" placeholder="Un Nombre al Rol" value="{{ $permission->name }}"
                disabled>
        @else
            <input type="text" name="name" id="name" class="form-control"
                placeholder="Un Nombre al Identidicador" value="{{ old('name', $permission->name) }}">
        @endif
    </div>
    <div class="form-group">
        <label for="display_name">Nombre</label>
        <input type="text" class="form-control" name="display_name" id="display_name"
            placeholder="Un Nombre al Permiso" value="{{ old('display_name', $permission->display_name) }}">
    </div>
    {{-- <div class="form-group">
        <label for="guard_name">Guard</label>
        <select name="guard_name" class="custom-select rounded-0" id="exampleSelectRounded0">
            @foreach (config('auth.guards') as $guardName => $guard)
                <option {{ old('guard_name', $role->guard_name) === $guardName ? 'selected' : '' }}value="{{ $guardName }}">{{ $guardName }}</option>
            @endforeach
        </select>
    </div> --}}
</div>
