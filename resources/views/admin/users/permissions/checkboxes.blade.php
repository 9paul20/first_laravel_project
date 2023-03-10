@foreach ($permissions as $id => $name)
    <div class="custom-control custom-checkbox">
            <input class="custom-control-input" name="permissions[]" id="permissions{{ $id }}" type="checkbox" value="{{ $name }}"
                {{ $model->permissions->contains($id)
                || collect(old('permissions'))->contains($name) ? 'checked' : '' }}>
        <label for="permissions{{ $id }}" class="custom-control-label">{{ $name }}</label>
    </div>
@endforeach
