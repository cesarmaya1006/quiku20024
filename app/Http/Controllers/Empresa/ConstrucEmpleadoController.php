<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Config\TipoDocumento;
use App\Models\Empresa\ConstrucCargo;
use App\Models\Empresa\ConstrucEmpleado;
use App\Models\Empresa\Constructora;
use App\Models\User;
use Illuminate\Http\Request;

class ConstrucEmpleadoController extends Controller
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
        $tiposdocu = TipoDocumento::get();
        $constructora = Constructora::findOrFail($id);
        return view('intranet.constructoras.empleado.crear', compact('constructora','tiposdocu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $cargo = ConstrucCargo::findOrFail($request['cargo_id']);

        $usuario_new = User::create([
            'name' => strtolower($request['nombres']) . ' ' . strtolower($request['apellidos']),
            'email' => strtolower($request['email']),
            'password' => bcrypt(utf8_encode($request['identificacion'])),
        ])->syncRoles('Empleado Constructora');
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $empleado_new = ConstrucEmpleado::create([
            'id' => $usuario_new->id,
            'cargo_id' => $request['cargo_id'],
            'tipo_documento_id' => $request['tipo_documento_id'],
            'identificacion' => $request['identificacion'],
            'nombres' => ucwords(strtolower($request['nombres'])),
            'apellidos' => ucwords(strtolower($request['apellidos'])),
            'telefono' => $request['telefono']
        ]);

        return redirect('dashboard/configuracion/constructoras/editar/'.$cargo->area->constructora_id)->with('mensaje', 'Empleado creado con éxito');
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
        $tiposdocu = TipoDocumento::get();
        $empleado_edit = ConstrucEmpleado::findOrFail($id);
        $constructora = Constructora::findOrFail($constructora_id);
        return view('intranet.constructoras.empleado.editar', compact('constructora','empleado_edit','tiposdocu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $constructora_id, string $id)
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
        $usuario_editar->empleadoconstruc->update([
            'cargo_id' => $request['cargo_id'],
            'tipo_documento_id' => $request['tipo_documento_id'],
            'identificacion' => $request['identificacion'],
            'nombres' => ucwords(strtolower($request['nombres'])),
            'apellidos' => ucwords(strtolower($request['apellidos'])),
            'telefono' => $request['telefono'],
            'estado' => $request['estado']
        ]);
        return redirect('dashboard/configuracion/constructoras/editar/'.$constructora_id)->with('mensaje', 'Empleado actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
