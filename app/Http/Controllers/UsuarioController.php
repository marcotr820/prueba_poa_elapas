<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuario;
use App\Models\Trabajadores;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UsuarioController extends Controller
{
    public function selectTrabajador()
    {
        return Trabajadores::query()
            ->select('id', 'documento', 'nombre')
            ->whereNotIn('id', Usuario::query()->select('trabajador_id'))->get();
    }

    public function index(Request $request){
        if($request->ajax())
        {
            $usuario = Usuario::join("trabajadores", "trabajadores.id", "=", "usuarios.trabajador_id")
                ->select('usuarios.*', 'trabajadores.nombre');
            // $usuario = Usuario::query()
            //     ->select('id', 'usuario', 'password', 'uuid');
            //retornamos los datos ajax formato json con la libreria yajra para poder convertirlo en JSON
            return DataTables::of($usuario)//retornamos con una consulta eloquent los datos necesarios para armar la tabla
                ->toJson();
        }
        
        //obtenemos todos los registros de la tabla usuarios como objeto
        $usuarios = Usuario::query();
        $roles = Role::all();
        //pasamos el objeto donde tenemos todos los usuarios
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    public function principal()
    {
        return view('principal');
    }

    //al usar request cualquier cosa que se envie en el formulario se recibira
    public function store(StoreUsuario $request){
        $trabajador = Trabajadores::findOrFail($request->trabajador_id);
        if($trabajador->usuario){
            return abort(404); //retornarmos un error para el trabajador que ya tenga un usuario
        }
        else{
            $usuario = Usuario::create([
                        'usuario' => $trabajador->documento,
                        'password' => hash::make(trim($request->password)),
                        'trabajador_id' => $trabajador->id
                    ]);
            
            //recorremos todos los roles que se reciben y se los asignamos al usuario creado
            // $roles = $request->roles;
            // foreach($roles as $rol){ //metodo largo con foreach
            //     $usuario->assignRole($rol);
            // }

            $usuario->roles()->sync($request->roles); //metodo mas corto
        }
    }

    public function rolesUsuario(Usuario $usuario){
        $rolesUsuario = DB::table('model_has_roles')->where('model_has_roles.model_id', $usuario->id)->get();
        return $rolesUsuario;
    }

    //si recivimos un array vacio al momento de pasar el objeto
    //ejecutamos el comando php artisan route:cache
    public function update(StoreUsuario $request, Usuario $usuario){

        //return $request->all();// mostramos todo lo que se envio en el formulario
        $usuario->update([
            'password' => Hash::make(trim($request->password)),
        ]);
        $usuario->roles()->sync($request->roles);
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
    }
}
