<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\Area;
use App\Models\Empresa\Cargo;
use App\Models\Empresa\Clinica;
use App\Models\Empresa\EmpGrupo;
use App\Models\Empresa\Regional;
use App\Models\User;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regionales = Regional::get();
        return view('intranet.regionales.cargo.index', compact('regionales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regionales = Regional::get();
        return view('intranet.regionales.cargo.crear', compact('regionales'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['cargo'] = ucfirst(strtolower($request['cargo']));
        Cargo::create($request->all());
        return redirect('dashboard/configuracion/cargos')->with('mensaje', 'Cargo creado con éxito');
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
        $cargo_edit = Cargo::findOrFail($id);
        $regionales = Regional::get();
        return view('intranet.regionales.cargo.editar', compact('regionales','cargo_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request['cargo'] = ucfirst(strtolower($request['cargo']));
        Cargo::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion/cargos')->with('mensaje', 'Cargo actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $cargo = Cargo::findOrFail($id);
            if ($cargo->empleados->count() > 0) {
                return response()->json(['mensaje' => 'ng']);
            } else {
                if (Cargo::destroy($id)) {
                    return response()->json(['mensaje' => 'ok']);
                } else {
                    return response()->json(['mensaje' => 'ng']);
                }
            }
        } else {
            abort(404);
        }
    }

    public function getAreas(Request $request){
        if ($request->ajax()) {
            return response()->json(['areas' => Area::with('cargos')->with('cargos.area')->where('clinica_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
    public function getCargos(Request $request){
        if ($request->ajax()) {
            $regional_id = $_GET['id'];
            return response()->json(['cargos' => Cargo::with('area')->whereHas('area', function($q) use($regional_id){
                $q->where('regional_id', $regional_id);
            })->get()]);
        } else {
            abort(404);
        }
    }
    public function getCargosByArea(Request $request){
        if ($request->ajax()) {
            return response()->json(['cargos' => Cargo::where('area_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
    public function getAreasCargos(Request $request){
        if ($request->ajax()) {
            $regional_id = $_GET['id'];
            return response()->json(['areas' => Area::with('cargos')->with('regional')->where('regional_id',$regional_id)->get()]);
        } else {
            abort(404);
        }
    }
    public function getCargosTodos(Request $request){
        if ($request->ajax()) {
            $clinica_id = $_GET['id'];
            return response()->json(['cargos' => Cargo::with('area')->whereHas('area', function($q) use($clinica_id){
                $q->where('clinica_id', $clinica_id);
            })->get()]);
        } else {
            abort(404);
        }
    }
}
