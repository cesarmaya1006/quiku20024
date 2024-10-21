<?php

namespace Database\Seeders;

use App\Models\Empresa\Arquitecto;
use App\Models\Empresa\ConstrucEmpleado;
use App\Models\Empresa\Empleado;
use App\Models\Empresa\Usuario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class TablaUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('empleados')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $usuario1 = User::create([
            'name' => 'Cesar Maya',
            'email' => 'cesarmaya1006@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Super Administrador');

        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
        $usuario1 = User::create([
            'name' => 'Diego Muñoz',
            'email' => 'diego.munoz@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Administrador');

        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
        $usuario1 = User::create([
            'name' => 'Silvia Mendoza',
            'email' => 'silviamendoza@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Empleado');

        $empleado = Empleado::create([
            'id' => $usuario1->id,
            'cargo_id' => 1,
            'tipo_documento_id' => 1,
            'identificacion' => '123456789',
            'nombres' => 'Silvia',
            'apellidos' => 'Mendoza',
            'telefono' => '32165498787',
        ]);
        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
        $usuario1 = User::create([
            'name' => 'Pepito Perez',
            'email' => 'pepeperez@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Usuario');

        $usuario = Usuario::create([
            'id' => $usuario1->id,
            'regional_id' => 1,
            'tipo_documento_id' => 1,
            'identificacion' => '123456790',
            'nombres' => 'Pepito',
            'apellidos' => 'Perez',
            'telefono' => '32165498790',
        ]);
        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
        $usuario1 = User::create([
            'name' => 'Juan Gomez',
            'email' => 'juangomez@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Arquitecto');

        $usuario = Arquitecto::create([
            'id' => $usuario1->id,
            'regional_id' => 1,
            'tipo_documento_id' => 1,
            'identificacion' => '123456791',
            'nombres' => 'Juan',
            'apellidos' => 'Gomez',
            'telefono' => '32165498791',
        ]);
        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
        $usuario1 = User::create([
            'name' => 'Catalina Diaz',
            'email' => 'catalinadiaz@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Empleado Constructora');

        $usuario = ConstrucEmpleado::create([
            'id' => $usuario1->id,
            'cargo_id' => 1,
            'tipo_documento_id' => 1,
            'identificacion' => '123456792',
            'nombres' => 'Juan',
            'apellidos' => 'Gomez',
            'telefono' => '32165498792',
        ]);
        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
    }
}
































































