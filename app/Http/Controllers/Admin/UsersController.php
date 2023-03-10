<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::allowed()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        $this->authorize('update',$user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.users.create', compact('user', 'roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO: Autenticación de permisos
        $this->authorize('create', new User);

        //*Validar formulario
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);

        //*Generar Contraseña
        $data['password'] = str_random(8);

        //*Crear Usuario
        $user = User::create($data);

        //*Asignar Roles
        if($request->filled('roles')){
            $user->assignRole($request->roles);
        }

        //*Asignar Permisos
        if($request->filled('permissions')){
            $user->givePermissionTo($request->permissions);
        }

        //*Enviar un email para la contraseña
        UserWasCreated::dispatch($user, $data['password']);

        //*Enviar datos y regresar notificación al usuario
        return redirect()->route('admin.users.index')->withFlash('Se Creó el Usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view',$user);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.users.edit', compact('user', 'roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->validated());
        return redirect()->route('admin.users.edit', $user)->withFlash('Usuario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //TODO: en caso de no tener permiso, no se puede hacer la petición
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('admin.users.index')->withFlash('Usuario Eliminado');
    }
}