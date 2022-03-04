<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabajadorRequest;
use App\Models\Gerencias;
use App\Models\Trabajadores;
use App\Models\Unidades;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function index(Request $request){
        //obtenemos los datos pedidos de la peticion ajax
        if($request->ajax())
        {
            $trabajadores = Gerencias::join("unidades", "gerencias.id", "=", "unidades.gerencia_id")
                ->join('trabajadores', 'unidades.id', '=', 'trabajadores.unidad_id')
                ->select('trabajadores.*', 'gerencias.nombre_gerencia', 'unidades.nombre_unidad')
                ->orderBy('trabajadores.id', 'desc');
            //retornamos los datos ajax formato json con la libreria yajra para poder convertirlo en JSON
            return datatables()
                ->eloquent($trabajadores)
                // ->addColumn('btn_trabajadores', view('trabajadores.acciones_trabajador'))
                ->toJson();
        }

        // //indicamos que nos obtenga los usuarios dondel el id del usuario no este en los datos de la tabla trabajadores en el campo usuario_id
        // $usuarios = Usuario::whereNotIn('id', Trabajadores::all('usuario_id'))->get();
        $unidades = Unidades::query()->select('id', 'nombre_unidad')->get();
        return view('trabajadores.index', compact('unidades'));
    }

    public function store(TrabajadorRequest $request)
    {
        Trabajadores::create([  //debemos llenar el campo fillable del modelo
            'documento' => trim($request->documento),
            'nombre' => trim($request->nombre),
            'cargo' => trim($request->cargo),
            'unidad_id' => $request->unidad_id,
        ]);
    }

    public function update(TrabajadorRequest $request, Trabajadores $trabajador)
    {
        $trabajador->update([
            'documento' => $request->documento,
            'nombre' => $request->nombre,
            'cargo' => $request->cargo,
            'unidad_id' => $request->unidad_id
        ]);

        //$request->session()->forget('id_gerencia');
        //actualizamos el id de la gerencia para mostrar gerencia a la que pertenece un trabajador 
        // $gerencia = Trabajadores::join('unidades', 'unidades.id', '=', 'trabajadores.unidad_id')
        //                     ->join('gerencias', 'gerencias.id', '=', 'unidades.gerencia_id')
        //                     ->select('gerencias.id')
        //                     ->where('trabajadores.id', Auth::guard('trabajador')->user()->id)->first();

        // $request->session()->put('id_gerencia', $gerencia->id);
    }

    public function destroy(Trabajadores $trabajador)
    {
        $trabajador->delete();
    }
}
