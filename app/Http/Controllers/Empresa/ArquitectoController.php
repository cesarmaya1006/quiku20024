<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Config\Departamento;
use App\Models\Config\Municipio;
use App\Models\Config\TipoDocumento;
use App\Models\Empresa\Arquitecto;
use App\Models\Empresa\ArquitectoInmueble;
use App\Models\Empresa\Inmueble;
use App\Models\Empresa\Regional;
use App\Models\Empresa\TipoInmueble;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ArquitectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regionales = Regional::get();
        return view('intranet.arquitectos.arquitecto.index', compact('regionales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regionales = Regional::get();
        $tiposdocu = TipoDocumento::get();
        return view('intranet.arquitectos.arquitecto.crear', compact('regionales', 'tiposdocu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nombres_array = explode(' ', ucwords(strtolower($request['nombres'])));
        $apellidos_array = explode(' ', ucwords(strtolower($request['apellidos'])));
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $usuario_new = User::create([
            'name' => strtolower($nombres_array[0]) . ' ' . strtolower($apellidos_array[0]),
            'email' => strtolower($request['email']),
            'password' => bcrypt(utf8_encode($request['identificacion'])),
        ])->syncRoles('Arquitecto');
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $arquitecto_new = Arquitecto::create([
            'id' => $usuario_new->id,
            'regional_id' => $request['regional_id'],
            'tipo_documento_id' => $request['tipo_documento_id'],
            'identificacion' => $request['identificacion'],
            'nombres' => ucwords(strtolower($request['nombres'])),
            'apellidos' => ucwords(strtolower($request['apellidos'])),
            'telefono' => $request['telefono']
        ]);
        return redirect('dashboard/configuracion/arquitectos')->with('mensaje', 'Arquitecto creado con éxito');
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
        $regionales = Regional::get();
        $tiposdocu = TipoDocumento::get();
        $arquitecto_edit = Arquitecto::findOrFail($id);

        return view('intranet.arquitectos.arquitecto.editar', compact('regionales', 'arquitecto_edit', 'tiposdocu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (isset($request['estado'])) {
            $request['estado'] = 1;
        } else {
            $request['estado'] = 0;
        }

        $nombres_array = explode(' ', ucwords(strtolower($request['nombres'])));
        $apellidos_array = explode(' ', ucwords(strtolower($request['apellidos'])));
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $usuario_editar = User::findOrFail($id);
        $usuario_editar->update([
            'name' => ucwords(strtolower($nombres_array[0])) . ' ' . ucwords(strtolower($apellidos_array[0])),
            'email' => strtolower($request['email']),
        ]);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $usuario_editar->arquitecto->update([
            'regional_id' => $request['regional_id'],
            'tipo_documento_id' => $request['tipo_documento_id'],
            'identificacion' => $request['identificacion'],
            'nombres' => ucwords(strtolower($request['nombres'])),
            'apellidos' => ucwords(strtolower($request['apellidos'])),
            'telefono' => $request['telefono'],
            'estado' => $request['estado']
        ]);

        return redirect('dashboard/configuracion/arquitectos')->with('mensaje', 'Arquitecto actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getArquitectosRegional(Request $request)
    {
        if ($request->ajax()) {
            $regional_id = $_GET['id'];
            return response()->json(['arquitectos' => Arquitecto::with('tipo_docu')
                ->with('usuario')
                ->where('regional_id', $regional_id)
                ->get()]);
        } else {
            abort(404);
        }
    }

    public function preferencias($id)
    {
        $arquitecto = Arquitecto::findOrFail($id);
        $tiposInmueble = TipoInmueble::get();
        $departamentos = Departamento::get();
        return view('intranet.arquitectos.preferencias.preferencia', compact('arquitecto', 'tiposInmueble', 'departamentos'));
    }

    public function setTipoInmueble(Request $request)
    {
        if ($request->ajax()) {
            $arquitecto = Arquitecto::findOrFail(session('id_usuario'));
            if ($_GET['estado'] == 1) {
                if ($_GET['id'] == 'todos_tipo_inmueble_id') {
                    $tiposInmuebles = TipoInmueble::get();

                    foreach ($tiposInmuebles as $key => $tiposInmueble) {
                        $arquitecto->arquitecto_tipoinmuebles()->sync([$tiposInmueble->id], false);
                    }
                } else {
                    $arquitecto->arquitecto_tipoinmuebles()->attach($_GET['id']);
                }
                return response()->json(['respuesta' => 'attach']);
            } else {
                if ($_GET['id'] == 'todos_tipo_inmueble_id') {
                    $arquitecto->arquitecto_tipoinmuebles()->sync([1]);
                    $arquitecto->arquitecto_tipoinmuebles()->detach(1);
                } else {
                    $arquitecto->arquitecto_tipoinmuebles()->detach($_GET['id']);
                }

                return response()->json(['respuesta' => 'detach']);
            }
        } else {
            abort(404);
        }
    }

    public function setDepartamento(Request $request)
    {
        if ($request->ajax()) {
            $arquitecto = Arquitecto::findOrFail(session('id_usuario'));
            if ($_GET['estado'] == 1) {
                $departamentos = Departamento::get();
                foreach ($departamentos as $key => $departamento) {
                    $arquitecto->arquitecto_departamentos()->sync([$departamento->id], false);
                }
                return response()->json(['respuesta' => 'attach']);
            } else {
                $arquitecto->arquitecto_departamentos()->sync([1]);
                $arquitecto->arquitecto_departamentos()->detach(1);
                return response()->json(['respuesta' => 'detach']);
            }
        } else {
            abort(404);
        }
    }

    public function getMunicipios(Request $request)
    {
        if ($request->ajax()) {
            $arquitecto = Arquitecto::findOrFail(session('id_usuario'));


            if (isset($_GET['departamentos'])) {
                $municipios = Municipio::whereIn('departamento_id', $_GET['departamentos'])->get();
            } else {
                $municipios = [];
            }

            if ($_GET['estado'] == 1) {
                $arquitecto->arquitecto_departamentos()->attach($_GET['id']);
                return response()->json(['municipios' => $municipios, 'respuesta' => 'attach']);
            } else {
                $arquitecto->arquitecto_departamentos()->detach($_GET['id']);
                return response()->json(['municipios' => $municipios, 'respuesta' => 'detach']);
            }
        } else {
            abort(404);
        }
    }

    public function setPreferencias(Request $request)
    {
        $arquitecto = Arquitecto::findOrFail(session('id_usuario'));
        $preferencia_new = ArquitectoInmueble::create([
            'arquitecto_id' => $arquitecto->id,
            'ubicacion' => $request['ubicacion'],
            'avaluo_corporativo' => $request['avaluo_corporativo'],
            'precio_min' => $request['precio_min'],
            'precio_max' => $request['precio_max'],
            'area_minima' => $request['area_minima'],
            'area_maxima' => $request['area_maxima'],
            'tipo_area' => $request['tipo_area'],
        ]);
        return redirect('dashboard')->with('mensaje', 'Preferencias guardadas con éxito');
    }
    public function getInmueblesArq(Request $request)
    {
        if ($request->ajax()) {
            $arquitecto = Arquitecto::findOrFail(session('id_usuario'));
            $query = Inmueble::with('municipio', 'multimedia', 'municipio.departamento', 'tipo')->where('estado', 'activo');
            if ($arquitecto->arquitecto_tipoinmuebles()->count() > 0) {
                $query->wherein('tipo_inmueble_id', $arquitecto->arquitecto_tipoinmuebles()->pluck('id'));
            }
            if ($arquitecto->arquitecto_departamentos()->count() > 0) {
                $query->whereHas('municipio', function ($p) use ($arquitecto) {
                    $p->wherein('departamento_id', $arquitecto->arquitecto_departamentos()->pluck('id'));
                });
            }
            if ($arquitecto->arquitecto_municipios()->count() > 0) {
                $query->wherein('municipio_id', $arquitecto->arquitecto_municipios()->pluck('id'));
            }
            if ($arquitecto->arquitecto_inmuebles->count() > 0) {
                foreach ($arquitecto->arquitecto_inmuebles as $preferencia) {
                    $query->where('ubicacion', $preferencia->ubicacion)->where('avaluo_corporativo', $preferencia->avaluo_corporativo);
                    if ($preferencia->precio_min > 0) {
                        $query->where('precio', '>', $preferencia->precio_min);
                    }
                    if ($preferencia->precio_max > 0) {
                        $query->where('precio', '<', $preferencia->precio_max);
                    }
                    if ($preferencia->area_minima > 0) {
                        $query->where('area', '>', $preferencia->area_minima)->where('tipo_area', $preferencia->tipo_area);
                    }
                    if ($preferencia->area_maxima > 0) {
                        $query->where('area', '<', $preferencia->area_maxima)->where('tipo_area', $preferencia->tipo_area);
                    }
                }
            }
            $inmuebles = $query->get();
            return response()->json(['inmuebles' => $inmuebles,]);
        } else {
            abort(404);
        }
    }

}
