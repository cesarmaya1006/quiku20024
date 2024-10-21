<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\TipoInmueble;
use Illuminate\Http\Request;

class TipoInmuebleController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $tipo = ucfirst(strtolower($_GET['tipo']));
            $tipos = TipoInmueble::where('tipo',$tipo)->get();
            if ($tipos->count()>0) {
                $mensaje = 'existe';
            } else {
                $tipo = TipoInmueble::create(['tipo' => $tipo]);
                $mensaje = 'nuevo';

            }
            $tipo_r = TipoInmueble::get();
            return response()->json(['mensaje' => $mensaje,'tipo' =>$tipo,'tipos' => $tipo_r]);

        } else {
            abort(404);
        }
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
}
