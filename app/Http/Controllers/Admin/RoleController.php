<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Roles/Index',[
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Roles/Create',[
            'permissions' => Permission::select('id','name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'exists:permissions,id'],
        ],[
            'name.required' => 'El nombre del rol es requerido',
            'name.string' => 'El nombre del rol debe ser una cadena de texto',
            'name.max' => 'El nombre del rol debe tener como máximo 255 caracteres',
            'name.unique' => 'El nombre del rol ya existe',
            'permissions.required' => 'Debe seleccionar al menos un permiso',
            'permissions.*.required' => 'Debe seleccionar al menos un permiso',
            'permissions.*.exists' => 'El permiso seleccionado no existe',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->permissions()->attach($request->permissions);

        session()->flash('message', 'Rol creado correctamente');
        return redirect()->route('roles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(Role $role)
    {
        return inertia('Roles/Edit',[
            'role' => $role->load('permissions'),
            'permissions' => Permission::select('id','name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,'.$role->id],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'exists:permissions,id'],
        ],[
            'name.required' => 'El nombre del rol es requerido',
            'name.string' => 'El nombre del rol debe ser una cadena de texto',
            'name.max' => 'El nombre del rol debe tener como máximo 255 caracteres',
            'name.unique' => 'El nombre del rol ya existe',
            'permissions.required' => 'Debe seleccionar al menos un permiso',
            'permissions.*.required' => 'Debe seleccionar al menos un permiso',
            'permissions.*.exists' => 'El permiso seleccionado no existe',
        ]);


        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);

        session()->flash('message', 'Rol actualizado correctamente');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
