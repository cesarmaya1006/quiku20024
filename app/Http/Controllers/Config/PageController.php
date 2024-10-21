<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Empresa\Arquitecto;
use App\Models\Empresa\Empleado;
use App\Models\Empresa\Inmueble;
use App\Models\Empresa\Publicidad;
use App\Models\Sistema\Mensaje;
use App\Models\Sistema\Notificacion;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Config;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard(Request $request)
    {
        $usuario = User::with('roles')->findOrFail(session('id_usuario'));
        $roles = session('roles');
        $roles = substr($roles, 0, -1);
        $roles = substr($roles, 1);
        $roles = str_replace('"','', $roles);
        $roles = explode(',',$roles);
        $inmuebles = $this->inmueblesArq();
        //dd($inmuebles->toArray());
        if ($usuario->empleado && $usuario->empleado->estado == 0) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/')->with(['errores' => 'Usuario Deshabilitado']);
        }else{
            $usuario = User::findOrFail(session('id_usuario'));
            return view('dashboard',compact('roles','usuario'));
        }
    }

    public function profile()
    {
        return view('intranet.infojet.profile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function logout(Request $request)
    {
        /*Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with(['errores' => 'Usuario Deshabilitado']);*/
    }

    public function getEmpleadosChat(Request $request){
        if ($request->ajax()) {
            $ruta = Config::get('constantes.folder_img_usuarios');
            $ruta = trim($ruta);
            $superAdminstradores = User::role('Super Administrador')->get();

            if (session('rol_principal_id') == 1) {
                $empleados = User::role('Empleado')->with('empleado')->whereHas('empleado',function($q){$q->where('estado', 1);})->with('empleado.cargo')->with('empleado.cargo.area')->with('empleado.cargo.area.empresa')->get();
            } else {
                $empelados_ids = $this->getEmpleadosWithChat(session('id_usuario'));
                $empleados = User::role('Empleado')->whereIn('id',$empelados_ids)->with('empleado')->with('empleado.cargo')->with('empleado.cargo.area')->with('empleado.cargo.area.empresa')->get();
            }
            foreach ($superAdminstradores as $superAdminstrador) {
                $superAdminstrador['cant_sin_leer'] = $superAdminstrador->mensajes_remitente()->where('estado',0)->where('destinatario_id' , session('id_usuario'))->count();
                $superAdminstrador['foto_chat'] = 'usuario-inicial.jpg';
                $superAdminstrador['nombre_chat'] = $superAdminstrador['name'];
            }

            foreach ($empleados as $empleado) {
                if ($empleado->hasRole('Administrador Empresa')) {
                    $empleado['adminEmpresa'] = 1;
                } else {
                    $empleado['adminEmpresa'] = 0;
                }
                $empleado['cant_sin_leer'] = $empleado->mensajes_remitente()->where('estado',0)->where('destinatario_id' , session('id_usuario'))->count();
                $empleado['foto_chat'] = $empleado->empleado->foto;
                $empleado['nombre_chat'] = $empleado->empleado['nombres'] . ' ' . $empleado->empleado['apellidos'];
            }
            return response()->json(['superAdminstradores'=>$superAdminstradores,'empleados'=>$empleados]);
        } else {
            abort(404);
        }
    }

    public function getMensajesNuevosEmpleadosChat(Request $request)
    {
        if ($request->ajax()) {
            $id_usuario = session('id_usuario');
            $mensajesNuevos = Mensaje::where('estado',0)->where('destinatario_id',$id_usuario)->with('remitente')->with('remitente.empleado')->with('remitente.mensajes_remitente')->get();
            foreach ($mensajesNuevos as $mensaje) {
                if ($mensaje->remitente->empleado) {
                    $mensaje->remitente['fotoChat'] = $mensaje->remitente->empleado->foto;
                    $mensaje->remitente['nombre_chat'] = $mensaje->remitente->empleado->nombres . ' ' . $mensaje->remitente->empleado->apellidos;
                } else {
                    $mensaje->remitente['fotoChat'] = 'usuario-inicial.jpg';
                    $mensaje->remitente['nombre_chat'] = $mensaje->remitente->name;
                }
                $date1 = new DateTime($mensaje->fec_creacion);
                $date2 = new DateTime("now");
                $diff = $date1->diff($date2);
                $mensaje['diff_creacion'] = $this->get_format($diff);
                $mensaje->remitente['cant_sin_leer'] = $mensaje->remitente->mensajes_remitente()->where('estado',0)->where('destinatario_id' , session('id_usuario'))->count();
            }
            return response()->json(['mensajesDestinatario'=> $mensajesNuevos, 'cantidadMensajesNuevos' => $mensajesNuevos->count() ]);
        } else {
            abort(404);
        }
    }


    public function getEmpleadosWithChat($empleado_id){
        $empleadoFind = Empleado::findOrFail($empleado_id);
        $ids_empresas = [];
        if ($empleadoFind->empresas_tranv->count() > 0) {
            foreach ($empleadoFind->empresas_tranv as $empresa) {
                $ids_empresas[] = $empresa->id;
            }
            $empleados1 = Empleado::where('estado', 1)
                    ->whereHas('cargo', function ($p) use ($ids_empresas) {
                        $p->whereHas('area', function ($q) use ($ids_empresas) {
                            $q->whereIn('empresa_id', $ids_empresas);
                        });
                    })->get();
            $empleados2 = Empleado::where('estado', 1)
                    ->whereHas('cargo', function ($p) use ($ids_empresas) {
                        $p->whereHas('area', function ($q) use ($ids_empresas) {
                            $q->whereNotIn('empresa_id', $ids_empresas);
                        });
                    })->whereHas('empresas_tranv', function ($p) use ($empleadoFind) {
                        $p->where('empresa_id', $empleadoFind->cargo->area->empresa_id);
                    })->get();
            $empleados = $empleados1->concat($empleados2);
        } else {
            $empleados = Empleado::where('estado', 1)
                    ->whereHas('cargo', function ($p) use ($empleadoFind) {
                        $p->whereHas('area', function ($q) use ($empleadoFind) {
                            $q->where('empresa_id', $empleadoFind->cargo->area->empresa_id);
                        });
                    })->get();
                }

        return $empleados->pluck('id')->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function setNuevoMensaje(Request $request)
    {
        if ($request->ajax()) {
            $request['fec_creacion'] = date('Y-m-d H:i:s');
            $mensaje = Mensaje::create($request->all());
            return response()->json(['mensaje'=> $mensaje, 'respuesta' => 'ok' ]);

        } else {
            abort(404);
        }
    }

    public function getMensajesChatUsuario(Request $request)
    {
        if ($request->ajax()) {

            $mensajes = Mensaje::with('remitente')-> with('destinatario')->whereIn('remitente_id',[session('id_usuario'),$request['id_usuario']])->whereIn('destinatario_id',[session('id_usuario'),$request['id_usuario']])->get();

            foreach ($mensajes as $mensaje) {
                if ($mensaje->destinatario_id == session('id_usuario')) {
                    $mensaje->update(['estado'=>1]);
                }
            }

            return response()->json(['mensajes'=> $mensajes]);

        } else {
            abort(404);
        }
    }

    public function getMensajesNuevosDestinatarioChat(Request $request)
    {
        if ($request->ajax()) {
            $mensajes = Mensaje::where('estado',0)->where('remitente_id',$request['id_usuario'])->where('destinatario_id',session('id_usuario'))->get();
            foreach ($mensajes as $mensaje) {
                if ($mensaje->destinatario_id == session('id_usuario')) {
                    $mensaje->update(['estado'=>1]);
                }
            }
            return response()->json(['mensajes'=> $mensajes]);
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function getNotificacionesEmpleado(Request $request)
    {
        if ($request->ajax()) {
            $notificaciones = Notificacion::where('usuario_id',3)->where('estado',1)->get();
            foreach ($notificaciones as $notificacion) {
                $date1 = new DateTime($notificacion->fec_creacion);
                $date2 = new DateTime("now");
                $diff = $date1->diff($date2);
                $notificacion['diff_creacion'] = $this->get_format($diff);
            }
            return response()->json(['notificaciones'=> $notificaciones]);
        } else {
            abort(404);
        }
    }

    public function getPublicidadCinta(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['publicidad'=> Publicidad::where('estado',1)->where('tipo','Cinta')->where('rol_id',session('rol_principal_id'))->get()]);
        } else {
            abort(404);
        }
    }


    public function getPublicidadLateral(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['publicidad'=> Publicidad::where('estado',1)->where('tipo','Lateral')->where('rol_id',session('rol_principal_id'))->get()]);
        } else {
            abort(404);
        }
    }

    public function get_format($df) {

        $str = '';
        $str .= ($df->invert == 1) ? ' - ' : '';
        if ($df->y > 0) {
            // years
            $str .= ($df->y > 1) ? $df->y . ' A ' : $df->y . ' A ';
        } if ($df->m > 0) {
            // month
            $str .= ($df->m > 1) ? $df->m . ' M ' : $df->m . ' M ';
        } if ($df->d > 0) {
            // days
            $str .= ($df->d > 1) ? $df->d . ' D ' : $df->d . ' D ';
        } if ($df->h > 0) {
            // hours
            $str .= ($df->h > 1) ? $df->h . ' H ' : $df->h . ' H ';
        } if ($df->i > 0) {
            // minutes
            $str .= ($df->i > 1) ? $df->i . ' mins ' : $df->i . ' min ';
        } if ($df->s > 0) {
            // seconds
            $str .= ($df->s > 1) ? $df->s . ' segs ' : $df->s . ' seg ';
        }

        return $str;
    }
    private function inmueblesArq()
    {
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
        return $inmuebles;
    }
}
