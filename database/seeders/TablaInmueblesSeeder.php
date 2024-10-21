<?php

namespace Database\Seeders;

use App\Models\Empresa\Inmueble;
use App\Models\Empresa\MultimediaInmueble;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('predios')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('multimedia_predios')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $datas = [
            [
                'usuario_id' =>4,
                'tipo_inmueble_id' =>1,
                'regional_id' =>1,
                'municipio_id' =>480,
                'ubicacion' =>'URBANO',
                'avaluo_corporativo' =>'NO',
                'solicitud_avaluo' =>'NO',
                'precio' =>'280000000',
                'descripcion' =>'Apartamento en lujoso y magnífico edificio en Rosales. 324m2 construidos. Balcón de 12m2 aprox.
                                 Piso 3. Exterior. 3 cuartos, cada uno con baño y walk-in closet, principal con salida al balcón.
                                 Baño social. Sala-comedor con el balcón y chimenea a gas. Estar de alcobas. Cocina abierta que puede cerrarse.
                                 Comedor auxiliar. Área de lavandería. Cuarto y baño de servicio. Ascensor privado.
                                 Ascensor de servicio. 4 garajes independientes. Depósito. Edificio: 3 años de construido.
                                 Salón y terraza comunal. Gimnasio. Sala de espera. Cuarto de escoltas y conductores. Caldera.
                                 Planta eléctrica de suplencia total. Parqueadero de visitantes.',
                'direccion' =>'Cra9 # 1a-121',
                'area' =>'102',
                'tipo_area' =>'Metros Cuadrados',
                'visto' =>0,
                'propio' =>1,

            ],
            [
                'usuario_id' =>4,
                'tipo_inmueble_id' =>4,
                'regional_id' =>1,
                'municipio_id' =>480,
                'ubicacion' =>'RURAL',
                'avaluo_corporativo' =>'NO',
                'solicitud_avaluo' =>'NO',
                'precio' =>'2600000000',
                'descripcion' =>'EXCELENTE FINCA DE RECREO EN LA CALERA TERRENO CON UN ÁREA DE 8000 M2 CASA DE 680M2 DE CONSTRUCCIÓN CASA CON 5 HABITACIONES,
                                 6 BAÑOS, PISOS EN GUAYACÁN, 3 ESTUDIOS, CASA ADICIONAL CON 2 HABITACIONES, CON ALCOBA, BAÑO Y COCINA PARA CHOFERES, CABAÑA
                                 EXTERIOR, CUATRO (4) CABALLERIZAS,NACIMIENTO DE AGUA PROPIA, PLANTA DE TRATAMIENTO DE AGUA POTABLE, MIRADOR, MUCHOS ARBOLES
                                 NATIVOS, CAMINOS ADOQUINADOS Y LA BORDEA UN RIÓ. MAGNIFICO LUGAR PARA VIVIR RODEADO DE NATURALEZA.',
                'direccion' =>'Vereda la Francia Km3',
                'area' =>'10',
                'tipo_area' =>'Fanegadas',
                'visto' =>0,
                'propio' =>1,
            ],

        ];

        foreach ($datas as $data) {
            $inmueble = Inmueble::create([
                'usuario_id' => $data['usuario_id'],
                'tipo_inmueble_id' => $data['tipo_inmueble_id'],
                'regional_id' => $data['regional_id'],
                'municipio_id' => $data['municipio_id'],
                'ubicacion' => $data['ubicacion'],
                'avaluo_corporativo' => $data['avaluo_corporativo'],
                'solicitud_avaluo' => $data['solicitud_avaluo'],
                'precio' => $data['precio'],
                'descripcion' => $data['descripcion'],
                'direccion' => $data['direccion'],
                'area' => $data['area'],
                'tipo_area' => $data['tipo_area'],
                'visto' => $data['visto'],
                'propio' => $data['propio'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            for ($i=1; $i < 7; $i++) {
                if ($data['tipo_inmueble_id'] == 1) {
                    $url = 'apartamento';
                } else {
                    $url = 'finca';
                }

                MultimediaInmueble::create([
                    'predio_id' => $inmueble->id,
                    'tipo' => 'imagen',
                    'url' => $url.$i.'.jpg',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
