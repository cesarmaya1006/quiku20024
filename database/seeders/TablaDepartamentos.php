<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaDepartamentos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('departamentos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $datas = [
            ['codigo' => '05', 'departamento' => 'ANTIOQUIA'],
            ['codigo' => '08', 'departamento' => 'ATLANTICO'],
            ['codigo' => '11', 'departamento' => 'BOGOTA'],
            ['codigo' => '13', 'departamento' => 'BOLIVAR'],
            ['codigo' => '15', 'departamento' => 'BOYACA'],
            ['codigo' => '17', 'departamento' => 'CALDAS'],
            ['codigo' => '18', 'departamento' => 'CAQUETA'],
            ['codigo' => '19', 'departamento' => 'CAUCA'],
            ['codigo' => '20', 'departamento' => 'CESAR'],
            ['codigo' => '23', 'departamento' => 'CORDOBA'],
            ['codigo' => '25', 'departamento' => 'CUNDINAMARCA'],
            ['codigo' => '27', 'departamento' => 'CHOCO'],
            ['codigo' => '41', 'departamento' => 'HUILA'],
            ['codigo' => '44', 'departamento' => 'LA GUAJIRA'],
            ['codigo' => '47', 'departamento' => 'MAGDALENA'],
            ['codigo' => '50', 'departamento' => 'META'],
            ['codigo' => '52', 'departamento' => 'NARIÑO'],
            ['codigo' => '54', 'departamento' => 'N. DE SANTANDER'],
            ['codigo' => '63', 'departamento' => 'QUINDIO'],
            ['codigo' => '66', 'departamento' => 'RISARALDA'],
            ['codigo' => '68', 'departamento' => 'SANTANDER'],
            ['codigo' => '70', 'departamento' => 'SUCRE'],
            ['codigo' => '73', 'departamento' => 'TOLIMA'],
            ['codigo' => '76', 'departamento' => 'VALLE DEL CAUCA'],
            ['codigo' => '81', 'departamento' => 'ARAUCA'],
            ['codigo' => '85', 'departamento' => 'CASANARE'],
            ['codigo' => '86', 'departamento' => 'PUTUMAYO'],
            ['codigo' => '88', 'departamento' => 'SAN ANDRES'],
            ['codigo' => '91', 'departamento' => 'AMAZONAS'],
            ['codigo' => '94', 'departamento' => 'GUAINIA'],
            ['codigo' => '95', 'departamento' => 'GUAVIARE'],
            ['codigo' => '97', 'departamento' => 'VAUPES'],
            ['codigo' => '99', 'departamento' => 'VICHADA'],

        ];

        foreach ($datas as $data) {
            DB::table('departamentos')->insert([
                'codigo' => $data['codigo'],
                'departamento' => $data['departamento'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
