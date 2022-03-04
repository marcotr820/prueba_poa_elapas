<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //debemos indicar el guard que queremos que le asignen los roles y permisos
        $role1 = Role::create(['guard_name' => 'usuario', 'name' => 'Admin']);
        $role2 = Role::create(['guard_name' => 'usuario', 'name' => 'Planificador']);
        // $role2 = Role::create(['name' => 'Jefe Planificacion']);

        //despues de crear el permiso lo relaciona con el rol ->assignRole
        Permission::create(['guard_name' => 'usuario', 'name' => 'super.admin'])->assignRole($role1);
        Permission::create(['guard_name' => 'usuario', 'name' => 'administrar.trabajadores'])->assignRole($role1);
        Permission::create(['guard_name' => 'usuario', 'name' => 'administrar.usuarios'])->assignRole($role1);
        Permission::create(['guard_name' => 'usuario', 'name' => 'administrar.gerencias'])->assignRole($role1);
    }
}
