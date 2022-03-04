<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Trabajadores;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    public function autenticacion (LoginRequest $request)
    {
        /*con request() recuperamos datos enviados del formulario
        y con ->only() indicamos que datos queremos recuperar*/
        $usuario = Usuario::where('usuario', $request->usuario)->first();
        if($usuario && Hash::check($request->password, $usuario->password))
        {
            // $trabajador = Trabajadores::query()->where('id', $usuario->trabajador_id)->first();
            $trabajador = Trabajadores::join('usuarios', 'trabajadores.id', '=', 'usuarios.trabajador_id')
                ->select('trabajadores.*')
                ->where('trabajadores.id', $usuario->trabajador_id)
                ->firstOrFail();

            Auth::guard('usuario')->login($usuario); //autenticamos al usuario
            // Auth::guard('trabajador')->login($trabajador);

            $request->session()->regenerate();
            //redireccionamos por el nombre
            return redirect()->route('index_principal');
        }
    
        //si el login es incorrecto redireccionamos a la pagina raiz donde esta el login
        return redirect()->route("login")->with("error_login", "Incorrecto password o usuario.");
    
    
        //mandamos mensaje de error de las credenciales y la mostramos en el error registros del login
        // throw ValidationException::withMessages([
        //     'registros' => __('auth.failed') mensage en la carpeta lang/es/auth
        // ]);
    
    }
    
    public function logout(Request $request)
    {
        //usamos el metodo de laravel ya creado logout
        Auth::guard()->logout();

        $request->session()->flush();
        $request->session()->invalidate();

        return redirect('/');
    }
    
}
