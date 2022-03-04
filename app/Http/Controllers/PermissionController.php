<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $permisos = Permission::query();
            return datatables()
                ->eloquent($permisos)
                ->addColumn('btn_permissions', view('permissions.btn_permissions'))
                ->toJson();
        }
        // $operacion = Operaciones::findOrFail($operacion_id);
        return view('permissions.index');
    }
}
