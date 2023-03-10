@foreach ($roles as $role)
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" name="roles[]" id="roles{{ $role->id }}" type="checkbox" value="{{ $role->name }}"
            {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
        <label for="roles{{ $role->id }}" class="custom-control-label">{{ $role->name }}</label><br>
        <small class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small>
    </div>
@endforeach
