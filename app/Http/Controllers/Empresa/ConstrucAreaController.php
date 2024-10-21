<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\ConstrucArea;
use App\Models\Empresa\Constructora;
use Illuminate\Http\Request;

class ConstrucAreaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $constructora = Constructora::findOrFail($id);
        return view('intranet.constructoras.area.crear', compact('constructora'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['area'] = ucfirst(strtolower($request['area']));
        ConstrucArea::create($request->all());
        return redirect('dashboard/configuracion/constructoras/editar/'.$request['constructora_id'])->with('mensaje', 'Área creada con éxito');
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
        $area_edit = ConstrucArea::findOrFail($id);
        $constructora = Constructora::findOrFail($constructora_id);

        return view('intranet.constructoras.area.editar', compact('constructora','area_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $constructora_id,string $id)
    {
        $request['area'] = ucfirst(strtolower($request['area']));
        ConstrucArea::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion/constructoras/editar/'.$request['constructora_id'])->with('mensaje', 'Área actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
