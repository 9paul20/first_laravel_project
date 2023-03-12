<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRolesRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Este metodo comentado es un código que se ahorra la parte de SaveRolesRequest y Roles Policy
        // $user = Auth::user();
        // if ($user->hasRole('Admin') && $user->can('View Roles', new Role)) {
        //     return view('admin.roles.index', ['roles' => Role::all()]);
        // } else {
        //     abort(403, 'No tienes permisos para acceder a esta página.');
        // }
        // $user = Auth::user();
        // $roleClass = Role::class;
        // $roles = Role::all();
        //TODO: La comprobación del IF es solamente para no usar las clases de SaveRoles y RolePolicy, no es necesario aplicarlo en caso de tener las politicas y request reestructuradas, ya que estaría validando de dos a tres veces la autentificación
        // if ($this->authorize('view', $user, $roleClass)->allowed()) {
        //     return view('admin.roles.index', compact('roles'));
        // } else {

        //     abort(403, 'No tienes permisos para acceder a esta página.');
        // }
        //TODO: una manera de optimizar las consultas de los cruds puede ser haciendo peticion de los select exactos a usar, ejemplo de los roles sería (id,name,name_display) y realizarle un paginado, en este caso no es necesario por el framework de Adminlte que ya realiza el paginado por si solo
        //$roles = Role::select('id', 'name', 'name_display')->paginate(10);
        $roles = Role::all();
        $role = Role::class;
        $this->authorize('view', $role);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role;
        $this->authorize('create', $role);
        return view(
            'admin.roles.create',
            [
                'role' => $role,
                'permissions' => Permission::pluck('name', 'id')
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(SaveRolesRequest $request)
    {
        //TODO: En este metodo comentado, es para comprobar los datos que se están enviando, las reglas son las que sean necesarias para el CRUD, En store(SaveRolesRequest $request), solo se cambia el SaveRolesRequest por Request)
        // $data = $request->validate(
        //     [
        //         'name' => 'required|unique:roles',
        //         'display_name' => 'required'
        //     ],
        //     [
        //         'name.required' => 'Campo Nombre Requerido.',
        //         'name.unique' => 'Campo Nombre Debe Ser Unico.',
        //         'display_name.required' => 'Campo Nombre Es Obligatorio.'
        //     ]
        // );
        // $role = Role::create($data);
        //Primero Pasa el SaveRolesRequest, luego seguiria el código de abajo

        $role = Role::create($request->validated());
        $role->permissions()->detach();
        $role->givePermissionTo($request->permissions);
        return redirect()->route('admin.roles.index')->withFlash('El Role Fue Agregado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $user = Auth::user();
        $roleClass = Role::class;
        if ($this->authorize('update', $user, $roleClass)->allowed()) {
            return view('admin.roles.edit', [
                'role' => $role,
                'permissions' => Permission::pluck('name', 'id')
            ]);
        } else {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(SaveRolesRequest $request, Role $role)
    {
        $role->update($request->validated());
        $role->permissions()->detach();
        $role->givePermissionTo($request->permissions);
        return redirect()->route('admin.roles.index', $role)->withFlash('El Rol Fue Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //TODO: Este metodo es para comprobar si el rol es igual a uno, si lo es, no se puede eliminar(Ya que es el rol Admin, de ser así se puede ahorrar la clase RolePolicy)
        // if($role->id === 1){
        //     throw new \Illuminate\Auth\Access\AuthorizationException('No se Puede Eliminar este Role');
        // }
        $user = Auth::user();
        $roleClass = Role::class;
        if ($this->authorize('delete', $user, $roleClass)->allowed()) {
            $role->delete();
            return redirect()->route('admin.roles.index')->withFlash('El Rol Fue eliminado');
        } else {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
    }
}