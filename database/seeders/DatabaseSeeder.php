<?php

namespace Database\Seeders;
use App\Models\Actividades;
use App\Models\CortoPlazoAcciones;
use App\Models\Evaluaciones;
use App\Models\Gerencias;
use App\Models\Items;
use App\Models\MedianoPlazoAcciones;
use App\Models\Metas;
use App\Models\Operaciones;
use App\Models\Partidas;
use App\Models\PeiObjetivosEspecificos;
use App\Models\Pilares;
use App\Models\Planificaciones;
use App\Models\Resultados;
use App\Models\TareasEspecificas;
use App\Models\Trabajadores;
use App\Models\Unidades;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $usuario = new Usuario();

        // $usuario->usuario = 'usuario';
        // $usuario->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        // $usuario->remember_token = Str::random(10);
        // $usuario->save();

        Gerencias::factory(2)->create();
        Unidades::factory(4)->create();
        $this->call(RoleSeeder::class);
        $this->call(TrabajadorSeeder::class);
        $this->call(UsuarioSeeder::class);
        // User::factory(2)->create();

        // Pilares::factory(2)->create();
        // Metas::factory(2)->create();
        // Resultados::factory(3)->create();
        // MedianoPlazoAcciones::factory(3)->create();
        // PeiObjetivosEspecificos::factory(3)->create();

        // CortoPlazoAcciones::factory(5)->create();
        // Operaciones::factory(100)->create();
        // Actividades::factory(150)->create();
        // TareasEspecificas::factory(200)->create();
        // Partidas::factory(5)->create();
        // Items::factory(5)->create();
        // Planificaciones::factory(1)->create(); //para el metodo numberBetween debe crearse menos del 50% del los registros del padre 
        // Evaluaciones::factory(2)->create();
    }
}
