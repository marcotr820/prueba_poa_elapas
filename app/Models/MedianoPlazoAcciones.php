<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MedianoPlazoAcciones extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'uuid'; //USAREMOS EL UUID COMO IDENTIFICADOR DE RUTA
    }

    protected $fillable = [
        'accion_mediano_plazo',
        'status',
        'resultado_id',
        //nombramos a los campos que se pueden llenar y estamos enviando
    ];

    protected static function boot()
    {//metodo para que cuando cree un registro se ejecute y asigne un uuid automaticamente
        parent::boot();
        static::creating(function($model){
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function resultados(){
        return $this->belongsTo(Resultados::class);
    }
}
