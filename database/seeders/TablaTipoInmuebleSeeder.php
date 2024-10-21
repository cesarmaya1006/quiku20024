<?php

namespace Database\Seeders;

use App\Models\Empresa\TipoInmueble;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaTipoInmuebleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('tipo_inmuebles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $datas = [
            ['tipo' => 'Casa',],
            ['tipo' => 'Apartamento',],
            ['tipo' => 'Lote',],
            ['tipo' => 'Finca',],
            ['tipo' => 'Bodega',],
            ['tipo' => 'Edificio',],
        ];

        foreach ($datas as $data) {
            $tipoInmueble = TipoInmueble::create([
                'tipo' => $data['tipo'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
