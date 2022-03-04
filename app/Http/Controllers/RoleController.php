<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $roles = Role::select('id', 'name');
            return datatables()
                ->eloquent($roles)
                ->toJson();
        }
        $permisos = Permission::get();
        return view('roles.index', compact('permisos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_rol' => ['required'],
        ]);

        $role = Role::create([
            'guard_name' => 'usuario',
            'name' => $request->nombre_rol
        ]);
        $role->permissions()->sync($request->permisos);
    }

    public function permisos_rol(Role $role)
    {
        $permisos = DB::table('role_has_permissions')->where('role_id', $role->id)->get();
        return $permisos;
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nombre_rol' => ['required'],
        ]);
        
        $role->update([
            'name' => $request->nombre_rol,
        ]);
        $role->permissions()->sync($request->permisos); //sincronizamos los roles seleccionados
    }

    public function destroy(Role $role)
    {
        $role->delete();
    }
}
