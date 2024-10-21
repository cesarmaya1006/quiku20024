<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\ConstrucArea;
use App\Models\Empresa\ConstrucCargo;
use App\Models\Empresa\Constructora;
use Illuminate\Http\Request;

class ConstrucCargoController extends Controller
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
    public function create($id)
    {
        $constructora = Constructora::findOrFail($id);
        return view('intranet.constructoras.cargo.crear', compact('constructora'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $area = ConstrucArea::findOrFail($request['area_id']);
        $request['cargo'] = ucfirst(strtolower($request['cargo']));
        ConstrucCargo::create($request->all());
        return redirect('dashboard/configuracion/constructoras/editar/'.$area->constructora_id)->with('mensaje', 'Cargo creado con éxito');
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
    public function edit(string $constructora_id,string $id)
    {
        $cargo_edit = ConstrucCargo::findOrFail($id);
        $constructora = Constructora::findOrFail($constructora_id);

        return view('intranet.constructoras.cargo.editar', compact('constructora','cargo_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $constructora_id, string $id)
    {
        $request['cargo'] = ucfirst(strtolower($request['cargo']));
        ConstrucCargo::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion/constructoras/editar/'.$constructora_id)->with('mensaje', 'Cargo actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getCargos(Request $request){
        if ($request->ajax()) {
            return response()->json(['cargos' => ConstrucCargo::where('area_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
}
