<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Config\TipoDocumento;
use App\Models\Empresa\Constructora;
use App\Models\Empresa\Regional;
use Illuminate\Http\Request;

class ConstructoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regionales = Regional::get();
        return view('intranet.constructoras.constructora.index', compact('regionales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regionales = Regional::get();
        $tiposdocu = TipoDocumento::get();
        return view('intranet.constructoras.constructora.crear', compact('regionales','tiposdocu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $constructora_new = Constructora::create($request->all());
        return redirect('dashboard/configuracion/constructoras')->with('mensaje', 'Constructora creado con éxito');
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
        $constructora_edit = Constructora::findOrFail($id);

        return view('intranet.constructoras.constructora.editar', compact('regionales','constructora_edit','tiposdocu'));
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
        $constructora_edit = Constructora::findOrFail($id);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $constructora_edit->update($request->all());

        return redirect('dashboard/configuracion/constructoras')->with('mensaje', 'Constructora actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getConstructorasRegional(Request $request)
    {
        if ($request->ajax()) {
            $regional_id = $_GET['id'];
            return response()->json(['constructoras' => Constructora::with('tipo_docu')
                ->where('regional_id',$regional_id)
                ->get()]);
        } else {
            abort(404);
        }
    }
}
