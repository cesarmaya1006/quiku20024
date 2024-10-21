<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Config\Departamento;
use App\Models\Config\Municipio;
use App\Models\Empresa\Inmueble;
use App\Models\Empresa\MultimediaInmueble;
use App\Models\Empresa\Regional;
use App\Models\Empresa\TipoInmueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Laravel\Facades\Image;

class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoInmueble = TipoInmueble::get();
        $regionales = Regional::get();
        $departamentos  = Departamento::get();
        return view('intranet.inmuebles.crear', compact('regionales', 'tipoInmueble', 'departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $newInmueble['usuario_id'] = session('id_usuario');
        $newInmueble['tipo_inmueble_id'] = $request['tipo_inmueble_id'];

        $regional = Regional::Where('departamento_id', $request['departamento_id'])->get();
        $regional = $regional->first();
        if ($regional->estado == 1 ) {
            $newInmueble['regional_id'] = $regional->id;
        } else {
            $newInmueble['regional_id'] = 1;
        }
        $newInmueble['municipio_id'] = $request['municipio_id'];
        $newInmueble['ubicacion'] = $request['ubicacion'];
        $newInmueble['avaluo_corporativo'] = $request['avaluo_corporativo'];
        $newInmueble['solicitud_avaluo'] = $request['solicitud_avaluo'];

        $newInmueble['precio'] = $request['precio'];
        $newInmueble['direccion'] = $request['direccion'];
        $newInmueble['area'] = $request['area'];
        $newInmueble['tipo_area'] = $request['tipo_area'];
        $newInmueble['descripcion'] = $request['descripcion'];
        if (session('rol_principal_id')== 4) {
            $newInmueble['propio'] = 1;
        }else{
            $newInmueble['propio'] = 0;
        }
        $inmueble = Inmueble::create($newInmueble);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $nombrefoto = 'sin_imagen.png';
        if ($request->hasFile('multimedia')) {
            $files = $request->file('multimedia');
            $ruta = Config::get('constantes.folder_img_inmuebles');
            $ruta = trim($ruta);
            $i = 0;
            foreach ($files as $file) {
                $newMultimedia['predio_id']=$inmueble->id;
                if ($file->extension()=='mp4') {
                    $nombreVideo = time() . $file->getClientOriginalName();
                    $newMultimedia['tipo']='video';
                    $newMultimedia['url']=$nombreVideo;
                    $file->save($ruta . $nombrefoto, 100);
                } else {
                    $newMultimedia['tipo']='imagen';
                    $imagen_foto = Image::read($file);
                    $nombrefoto = time() . $file->getClientOriginalName();
                    $imagen_foto->resize(800, 600);
                    $imagen_foto->save($ruta . $nombrefoto, 100);
                    $newMultimedia['url']=$nombrefoto;
                }
                $multimedia = MultimediaInmueble::create($newMultimedia);
            }
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        //dd($newInmueble);
        return redirect('dashboard')->with('mensaje', 'Inmueble registrado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getMunicipiosByDepartamento(Request $request){
        if ($request->ajax()) {
            $departamento_id = $_GET['id'];
            $municipios = Municipio::where('departamento_id',$departamento_id)->orderBy('municipio', 'asc')->get();
            return response()->json(['municipios' => $municipios]);
        } else {
            abort(404);
        }
    }

    public function getInmuebles(Request $request,$id){
        if ($request->ajax()) {
            return response()->json(['inmueble' => Inmueble::with('multimedia')->with('usuario')->with('tipo')->with('regional')->with('municipio')->with('municipio.departamento')->findOrfail($id)]);
        } else {
            abort(404);
        }
    }
}
