<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $permission = Permission::class;
        $this->authorize('view', $permission);
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $permission = new Permission;
        $this->authorize('create', $permission);
        return view(
            'admin.permissions.create',
            [
                'permission' => $permission,
            ]
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:roles',
                'display_name' => 'required'
            ],
            [
                'name.required' => 'Campo Nombre Requerido.',
                'name.unique' => 'Campo Nombre Debe Ser Unico.',
                'display_name.required' => 'Campo Nombre Es Obligatorio.'
            ]
        );
        $permission = Permission::create($data);
        $this->authorize('create', $permission);
        return redirect()->route('admin.permissions.index')->withFlash('El Permiso Fue Agregado');
    }

    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);
        return view('admin.permissions.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);
        $data = $request->validate(['display_name' => 'required']);
        $permission->update($data);
        return redirect()->route('admin.permissions.index', $permission)->withFlash('El Rol Fue Actualizado');
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);
        $permission->delete();
        return redirect()->route('admin.permissions.index')->withFlash('El Permiso Fue eliminado');
    }
}