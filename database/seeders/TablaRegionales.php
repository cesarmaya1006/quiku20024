<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaRegionales extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('regionales')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $datas = [
            ['departamento_id' => null, 'regional' => 'PRESIDENCIA NACIONAL', 'estado' => 1, 'nacional' => 1,],
            ['departamento_id' => 29, 'regional' => 'AMAZONAS', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 1, 'regional' => 'ANTIOQUIA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 25, 'regional' => 'ARAUCA', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 2, 'regional' => 'ATLANTICO', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 11, 'regional' => 'BOGOTÁ Y CUNDINAMARCA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 4, 'regional' => 'BOLIVAR', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 5, 'regional' => 'BOYACA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 6, 'regional' => 'CALDAS', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 7, 'regional' => 'CAQUETA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 26, 'regional' => 'CASANARE', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 8, 'regional' => 'CAUCA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 9, 'regional' => 'CESAR', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 10, 'regional' => 'CORDOBA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 12, 'regional' => 'CHOCO', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 30, 'regional' => 'GUAINIA', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 14, 'regional' => 'GUAJIRA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 31, 'regional' => 'GUAVIARE', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 13, 'regional' => 'HUILA ', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 15, 'regional' => 'MAGDALENA', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 16, 'regional' => 'META', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 17, 'regional' => 'NARIÑO', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 18, 'regional' => 'NORTE DE SANTANDER', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 27, 'regional' => 'PUTUMAYO', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 19, 'regional' => 'QUINDIO', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 20, 'regional' => 'RISARALDA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 28, 'regional' => 'SAN ANDRES', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 21, 'regional' => 'SANTANDER', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 22, 'regional' => 'SUCRE', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 23, 'regional' => 'TOLIMA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 24, 'regional' => 'VALLE DEL CAUCA', 'estado' => 1, 'nacional' => 0,],
            ['departamento_id' => 32, 'regional' => 'VAUPES', 'estado' => 0, 'nacional' => 0,],
            ['departamento_id' => 33, 'regional' => 'VICHADA', 'estado' => 0, 'nacional' => 0,],

        ];

        foreach ($datas as $data) {
            DB::table('regionales')->insert([
                'departamento_id' => $data['departamento_id'],
                'regional' => $data['regional'],
                'estado' => $data['estado'],
                'nacional' => $data['nacional'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
