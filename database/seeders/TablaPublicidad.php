<?php

namespace Database\Seeders;

use App\Models\Empresa\Publicidad;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaPublicidad extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('publicidad')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $datas = [
            ['cliente' => 'Ladrillera Santafé','tipo' => 'Cinta','imagen' => 'ladrillera1.png','url' => 'https://www.santafe.com.co/','rol_id' => 4],
            ['cliente' => 'Centros Corona','tipo' => 'Cinta','imagen' => 'centro_corona.png','url' => 'https://corona.co/','rol_id' => 4],
            ['cliente' => 'Homecenter','tipo' => 'Cinta','imagen' => 'homecenter.png','url' => 'https://www.homecenter.com.co/homecenter-co/','rol_id' => 4],
            ['cliente' => 'Constructora Colpatria','tipo' => 'Cinta','imagen' => 'colpatria.png','url' => 'https://constructoracolpatria.com/','rol_id' => 4],
            ['cliente' => 'Amarilo','tipo' => 'Cinta','imagen' => 'amarilo.png','url' => 'https://amarilo.com.co/','rol_id' => 4],
            ['cliente' => 'Constructora Bolívar','tipo' => 'Cinta','imagen' => 'bolivar.png','url' => 'https://www.constructorabolivar.com/','rol_id' => 4],
            ['cliente' => 'Constructora Oikos','tipo' => 'Cinta','imagen' => 'oikos.png','url' => 'https://www.oikos.com.co/constructora/','rol_id' => 4],
            ['cliente' => 'Homecenter','tipo' => 'Lateral','imagen' => 'puertas1.jpeg','url' => 'https://www.homecenter.com.co/homecenter-co/','rol_id' => 4],
            ['cliente' => 'Constructora Guevara','tipo' => 'Lateral','imagen' => 'patrocinio10.jpeg','url' => 'https://www.instagram.com/guevara_arquitectos/?hl=es','rol_id' => 4],
            ['cliente' => 'Piscinas Bogota','tipo' => 'Lateral','imagen' => 'patrocinio11.jpeg','url' => 'https://www.piscinas.com.co/empresas','rol_id' => 4],
        ];

        foreach ($datas as $data) {
            $publicidad = Publicidad::create([
                'rol_id' => $data['rol_id'],
                'cliente' => $data['cliente'],
                'tipo' => $data['tipo'],
                'imagen' => $data['imagen'],
                'url' => $data['url'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}



