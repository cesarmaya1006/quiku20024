<?php

namespace Database\Seeders;

use App\Models\Config\Menu;
use App\Models\Empresa\Empresa;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('menus')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('menu_rol')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        $menus = [
            //Menu Inicio
            ['nombre' => 'Dashboard', 'menu_id' => null, 'url' => 'dashboard', 'orden' => '1', 'icono' => 'mdi mdi-view-dashboard', 'Array_1' => []],
            //Menu configuración 2
            [
                'nombre' => 'Configuración Sistema', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    //Menu menu
                    ['nombre' => 'Menús', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/menu', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/rol', 'orden' => '2',  'icono' => 'fas fa-users', 'Array_1' => []],
                    //Menu Menu_Roles
                    ['nombre' => 'Menú - Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permisos_menus_rol', 'orden' => '2',  'icono' => 'fas fa-chalkboard-teacher', 'Array_1' => []],
                    //Menu permisos
                    ['nombre' => 'Permisos', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permiso_rutas', 'orden' => '2',  'icono' => 'fas fa-check-square', 'Array_1' => []],
                    //Menu permisos-rol
                    ['nombre' => 'Permisos - Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permisos_rol', 'orden' => '2',  'icono' => 'fas fa-user-shield', 'Array_1' => []],
                    //Menu Empresas
                    ['nombre' => 'Regionales', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/regionales', 'orden' => '2',  'icono' => 'fas fa-building', 'Array_1' => []],

                ],
            ],
            [
                'nombre' => 'Configuración', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    //Menu organigrama
                    [
                        'nombre' => 'Organigrama', 'menu_id' => '2',  'url' => '#', 'orden' => '1',  'icono' => 'fas fa-sitemap',
                        'Array_1' => [
                            //Menu Areas
                            ['nombre' => 'Áreas', 'menu_id' => '2',  'url' => 'dashboard/configuracion/areas', 'orden' => '1',  'icono' => 'fas fa-project-diagram', 'Array_1' => []],
                            //Cargos
                            ['nombre' => 'Cargos', 'menu_id' => '2',  'url' => 'dashboard/configuracion/cargos', 'orden' => '2',  'icono' => 'fas fa-user-tie', 'Array_1' => []],
                            //Empleados
                            ['nombre' => 'Empleados', 'menu_id' => '2',  'url' => 'dashboard/configuracion/empleados', 'orden' => '2',  'icono' => 'fas fa-users', 'Array_1' => []],
                            //Permisos Empleados
                            ['nombre' => 'Permisos Empleados', 'menu_id' => '2',  'url' => 'dashboard/configuracion/permisoscargos', 'orden' => '2',  'icono' => 'fas fa-user-shield', 'Array_1' => []],
                            //Usuarios
                            ['nombre' => 'Usuarios', 'menu_id' => '2',  'url' => 'dashboard/configuracion/usuarios', 'orden' => '2',  'icono' => 'fas fa-address-card', 'Array_1' => []],
                            //Usuarios
                            ['nombre' => 'Arquitectos', 'menu_id' => '2',  'url' => 'dashboard/configuracion/arquitectos', 'orden' => '2',  'icono' => 'fas fa-id-badge', 'Array_1' => []],
                            //Usuarios
                            ['nombre' => 'Constructoras', 'menu_id' => '2',  'url' => 'dashboard/configuracion/constructoras', 'orden' => '2',  'icono' => 'fas fa-gopuram', 'Array_1' => []],


                        ]
                    ],
                    // Modulo Configuracion Facturacion
                    ['nombre' => 'Publicidad', 'menu_id' => '2',  'url' => 'dashboard/configuracion/publicidad', 'orden' => '1',  'icono' => 'fas fa-bullhorn','Array_1' => []],

                ],
            ],
            // Modulo noticias
            ['nombre' => 'Noticias', 'menu_id' => null, 'url' => 'dashboard/noticias', 'icono' => 'fas fa-newspaper', 'Array_1' => []],
        ];
        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        $x = 0;
        foreach ($menus as $menu) {
            $x++;
            $menu_new = Menu::create([
                'menu_id' => $menu['menu_id'],
                'nombre' => utf8_encode(utf8_decode($menu['nombre'])),
                'url' => $menu['url'],
                'orden' => $x,
                'icono' => $menu['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            if (count($menu['Array_1']) > 0) {
                $this->sub_menu($menu['Array_1'], $menu_new->id);
            }
        }
        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        $menus = Menu::get();
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        foreach ($menus as $menu) {
            DB::table('menu_rol')->insert(['menu_id' => $menu->id, 'rol_id' => 1,]);
        }
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        /*DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 2,]);
        for ($i = 17; $i < 34; $i++) {
            DB::table('menu_rol')->insert(['menu_id' => $i, 'rol_id' => 2,]);
        }*/
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
    }
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    public function sub_menu($Array_1, $x)
    {
        $y = 0;
        foreach ($Array_1 as $sub_menu_array) {
            $y++;
            $sub_menu = Menu::create([
                'menu_id' => $x,
                'nombre' => utf8_encode(utf8_decode($sub_menu_array['nombre'])),
                'url' => $sub_menu_array['url'],
                'orden' => $y,
                'icono' => $sub_menu_array['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            if (count($sub_menu_array['Array_1']) > 0) {
                $this->sub_menu($sub_menu_array['Array_1'], $sub_menu->id);
            }
        }
    }
}
