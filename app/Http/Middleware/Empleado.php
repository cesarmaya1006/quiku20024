<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Empleado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->permiso()) {
            return redirect('dashboard')->with('mensaje', 'Su rol aignado no le permite el ingreso a esta parte del sistema');
        }
        return $next($request);
    }

    private function permiso()
    {
        $rolArray = [];
        foreach (session('roles') as $rol) {
            $rolArray[] = $rol['name'];
        }
        return in_array("Super Administrador", $rolArray)||in_array("Administrador", $rolArray)||in_array("Administrador Empresa", $rolArray)||in_array("Empleado", $rolArray);

    }
}
