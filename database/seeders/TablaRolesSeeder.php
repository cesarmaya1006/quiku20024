<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TablaRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $rol1 = Role::create(['name' => 'Super Administrador']);
        $rol2 = Role::create(['name' => 'Administrador']);
        $rol3 = Role::create(['name' => 'Empleado']);
        $rol4 = Role::create(['name' => 'Usuario']);
        $rol5 = Role::create(['name' => 'Arquitecto']);
        $rol6 = Role::create(['name' => 'Empleado Constructora']);
        // =======================================================================================================
        Permission::create(['name' => 'dashboard'])->syncRoles([$rol1, $rol2, $rol3, $rol4, $rol5, $rol6]);
        // =======================================================================================================
        //Regionales
        Permission::create(['name' => 'regionales.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'regionales.create'])->syncRoles([$rol1]);
        Permission::create(['name' => 'regionales.edit'])->syncRoles([$rol1]);
        Permission::create(['name' => 'regionales.store'])->syncRoles([$rol1]);
        Permission::create(['name' => 'regionales.update'])->syncRoles([$rol1]);
        Permission::create(['name' => 'regionales.destroy'])->syncRoles([$rol1]);
        Permission::create(['name' => 'regionales.getRegionalesActivar'])->syncRoles([$rol1]);
        // =======================================================================================================
        //Areas
        Permission::create(['name' => 'areas.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'areas.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'areas.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'areas.store'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'areas.update'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'areas.destroy'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
        //Cargos
        Permission::create(['name' => 'cargos.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'cargos.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'cargos.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'cargos.store'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'cargos.update'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'cargos.destroy'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
        //Empleados
        Permission::create(['name' => 'empleados.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'empleados.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'empleados.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'empleados.store'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'empleados.update'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'empleados.destroy'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'empleados.activar'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
        //Usarios
        Permission::create(['name' => 'usuarios.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuarios.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuarios.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuarios.store'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuarios.update'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuarios.destroy'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuarios.activar'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
        //Arquitectos
        Permission::create(['name' => 'arquitectos.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'arquitectos.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'arquitectos.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'arquitectos.store'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'arquitectos.update'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'arquitectos.destroy'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'arquitectos.activar'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
        //Constructoras
        Permission::create(['name' => 'constructoras.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'constructoras.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'constructoras.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'constructoras.store'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'constructoras.update'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'constructoras.destroy'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'constructoras.activar'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
        //Constructoras
        Permission::create(['name' => 'publicidad.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'publicidad.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'publicidad.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'publicidad.store'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'publicidad.update'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'publicidad.destroy'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'publicidad.activar'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
        Permission::create(['name' => 'arquitecto.preferencias'])->syncRoles([$rol1, $rol5]);






    }
}
