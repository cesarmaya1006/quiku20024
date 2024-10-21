<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\Publicidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Laravel\Facades\Image;

class PublicidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicidades = Publicidad::get();
        return view('intranet.publicidad.index', compact('publicidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('intranet.publicidad.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('imagen')) {
            $ruta = Config::get('constantes.folder_img_publicidad');
            $ruta = trim($ruta);

            $foto = $request->imagen;
            $imagen_foto = Image::read($foto);
            $nombrefoto = time() . $foto->getClientOriginalName();
            $imagen_foto->resize(250, 100);
            $imagen_foto->save($ruta . $nombrefoto, 100);
            $newPublicidad['imagen'] = $nombrefoto;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $newPublicidad['rol_id'] = $request['rol_id'];
        $newPublicidad['tipo'] = $request['tipo'];
        $newPublicidad['cliente'] = $request['cliente'];
        $newPublicidad['url'] = $request['url'];
        Publicidad::create($newPublicidad);
        return redirect('dashboard/configuracion/publicidad')->with('mensaje', 'Publicidad creada con éxito');

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
        $publicidad_edit = Publicidad::findOrFail($id);
        return view('intranet.publicidad.editar',compact('publicidad_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('imagen')) {
            $ruta = Config::get('constantes.folder_img_publicidad');
            $ruta = trim($ruta);

            $foto = $request->imagen;
            $imagen_foto = Image::read($foto);
            $nombrefoto = time() . $foto->getClientOriginalName();
            $imagen_foto->resize(250, 100);
            $imagen_foto->save($ruta . $nombrefoto, 100);
            $updatePublicidad['imagen'] = $nombrefoto;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if (isset($request['estado'])) {
            $updatePublicidad['estado'] = 1;
        } else {
            $updatePublicidad['estado'] = 0;
        }
        $updatePublicidad['rol_id'] = $request['rol_id'];
        $updatePublicidad['tipo'] = $request['tipo'];
        $updatePublicidad['cliente'] = $request['cliente'];
        $updatePublicidad['url'] = $request['url'];
        Publicidad::findOrFail($id)->update($updatePublicidad);
        return redirect('dashboard/configuracion/publicidad')->with('mensaje', 'Publicidad actualizada con éxito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
