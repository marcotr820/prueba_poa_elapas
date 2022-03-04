<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Unidades extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_unidad',
        'gerencia_id',
    ];

    protected static function boot()
    {//metodo para que cuando cree un registro se ejecute y asigne un uuid automaticamente
        parent::boot();
        static::creating(function($model){
            $model->uuid = Str::uuid()->toString();
        });
    }
    
    //relacion uno a muchos
    public function trabajadores(){
        return $this->hasMany(Trabajadores::class);
    }

    // una unidad pertenece a una gerencia
    public function gerencia(){
        return $this->belongsTo(Gerencias::class);
    }
}
