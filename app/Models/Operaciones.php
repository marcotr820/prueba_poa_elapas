<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Operaciones extends Model
{
    use HasFactory;
    public $timestamps = false;

    //nombramos a los campos que se pueden llenar y editar enviando
    protected $fillable = [
        'nombre_operacion',
        'corto_plazo_accion_id'
    ];
    
    public function getRouteKeyName()
    {
        return 'uuid'; //USAREMOS EL UUID COMO IDENTIFICADOR DE RUTA
    }

    protected static function boot()
    {//metodo para que cuando cree un registro se ejecute y asigne un uuid automaticamente
        parent::boot();
        static::creating(function($model){
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function actividades(){
        return $this->hasMany(Actividades::class, 'operacion_id');
    }

    public function corto_plazo_accion()
    {
        return $this->belongsTo(CortoPlazoAcciones::class, 'corto_plazo_accion_id');
    }

    public function tareas_especificas(){
        return $this->hasManyThrough(TareasEspecificas::class, Actividades::class, 'operacion_id', 'actividad_id');
        // return $this->hasManyThrough(tabla_final, tabla_atravez_de, 'llave foranea de la tabla atravez de', 'llave foranea de la tabla final');
    }

}
