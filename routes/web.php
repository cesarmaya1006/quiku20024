<?php

use App\Http\Controllers\Config\MenuController;
use App\Http\Controllers\Config\MenuRolController;
use App\Http\Controllers\Config\PageController;
use App\Http\Controllers\Config\PermisoController;
use App\Http\Controllers\Config\PermisoRolController;
use App\Http\Controllers\Config\RolController;
use App\Http\Controllers\Config\UsuarioController;
use App\Http\Controllers\Empresa\AreaController;
use App\Http\Controllers\Empresa\ArquitectoController;
use App\Http\Controllers\Empresa\CargoController;
use App\Http\Controllers\Empresa\ConstrucAreaController;
use App\Http\Controllers\Empresa\ConstrucCargoController;
use App\Http\Controllers\Empresa\ConstrucEmpleadoController;
use App\Http\Controllers\Empresa\ConstructoraController;
use App\Http\Controllers\Empresa\EmpleadoController;
use App\Http\Controllers\Empresa\InmuebleController;
use App\Http\Controllers\Empresa\PublicidadController;
use App\Http\Controllers\Empresa\RegionalController;
use App\Http\Controllers\Empresa\TipoInmuebleController;
use App\Http\Controllers\Empresa\UsuarioController as EmpresaUsuarioController;
use App\Http\Controllers\Extranet\ExtranetPageController;
use App\Http\Middleware\AdminEmp;
use App\Http\Middleware\Arquitecto;
use App\Http\Middleware\Empleado;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Support\Facades\Route;


Route::controller(ExtranetPageController::class)->group(function () {
    Route::get('/', 'index')->name('extranet.index');
    Route::get('/registro', 'registro')->name('extranet.registro');
    Route::get('/loginapp', 'loginapp')->name('extranet.loginapp');
    Route::post('/register', 'register')->name('extranet.store');
});
Route::prefix('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'),])->group(function () {
    Route::get('', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PageController::class, 'profile'])->name('profile');

    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    //Middleware Super admin
    Route::prefix('configuracion_sis')->middleware(SuperAdmin::class)->group(function () {
        // Ruta Administrador del Sistema Menus
        // ------------------------------------------------------------------------------------
        Route::controller(MenuController::class)->prefix('menu')->group(function () {
            Route::get('', 'index')->name('menu.index');
            Route::get('crear', 'create')->name('menu.create');
            Route::get('editar/{id}', 'edit')->name('menu.edit');
            Route::post('guardar', 'store')->name('menu.store');
            Route::put('actualizar/{id}', 'update')->name('menu.update');
            Route::get('eliminar/{id}', 'destroy')->name('menu.destroy');
            Route::get('guardar-orden', 'guardarOrden')->name('menu.ordenar');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(RolController::class)->prefix('rol')->group(function () {
            Route::get('', 'index')->name('rol.index');
            Route::get('crear', 'create')->name('rol.create');
            Route::get('editar/{id}', 'edit')->name('rol.edit');
            Route::post('guardar', 'store')->name('rol.store');
            Route::put('actualizar/{id}', 'update')->name('rol.update');
            Route::delete('eliminar/{id}', 'destroy')->name('rol.destroy');
        });
        // ----------------------------------------------------------------------------------------
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(MenuRolController::class)->prefix('permisos_menus_rol')->group(function () {
            Route::get('', 'index')->name('menu.rol.index');
            Route::post('guardar', 'store')->name('menu.rol.store');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(PermisoController::class)->prefix('permiso_rutas')->group(function () {
            Route::get('', 'index')->name('permiso_rutas.index');
        });
        // ----------------------------------------------------------------------------------------
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(PermisoRolController::class)->prefix('permisos_rol')->group(function () {
            Route::get('', 'index')->name('permisos_rol.index');
            Route::post('guardar', 'store')->name('permisos_rol.store');
            Route::get('excepciones/{permission_id}/{role_id}', 'excepciones')->name('permisos_rol.excepciones');
            Route::post('guardar_excepciones', 'store_excepciones')->name('permisos_rol.store_excepciones');
        });
        // ----------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Regionales
        Route::controller(RegionalController::class)->prefix('regionales')->group(function () {
            Route::get('', 'index')->name('regionales.index');
            Route::get('crear', 'create')->name('regionales.create');
            Route::get('editar/{id}', 'edit')->name('regionales.edit');
            Route::post('guardar', 'store')->name('regionales.store');
            Route::put('actualizar/{id}', 'update')->name('regionales.update');
            Route::delete('eliminar/{id}', 'destroy')->name('regionales.destroy');
            Route::get('getRegionales', 'getRegionales')->name('regionales.getRegionales');
            Route::get('getRegionalesActivar', 'getRegionalesActivar')->name('regionales.getRegionalesActivar');
        });
        // ------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------
    });
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    Route::prefix('configuracion')->middleware(AdminEmp::class)->group(function () {
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Areas
        Route::controller(PublicidadController::class)->prefix('publicidad')->group(function () {
            Route::get('', 'index')->name('publicidad.index');
            Route::get('crear', 'create')->name('publicidad.create');
            Route::get('editar/{id}', 'edit')->name('publicidad.edit');
            Route::post('guardar', 'store')->name('publicidad.store');
            Route::put('actualizar/{id}', 'update')->name('publicidad.update');
            Route::delete('eliminar/{id}', 'destroy')->name('publicidad.destroy');
            Route::get('activar', 'activar')->name('publicidad.activar');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Areas
        Route::controller(AreaController::class)->prefix('areas')->group(function () {
            Route::get('', 'index')->name('areas.index');
            Route::get('crear', 'create')->name('areas.create');
            Route::get('editar/{id}', 'edit')->name('areas.edit');
            Route::post('guardar', 'store')->name('areas.store');
            Route::put('actualizar/{id}', 'update')->name('areas.update');
            Route::delete('eliminar/{id}', 'destroy')->name('areas.destroy');
            Route::get('getDependencias/{id}', 'getDependencias')->name('areas.getDependencias');
            Route::get('getAreas', 'getAreas')->name('areas.getAreas');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Cargos
        Route::controller(CargoController::class)->prefix('cargos')->group(function () {
            Route::get('', 'index')->name('cargos.index');
            Route::get('crear', 'create')->name('cargos.create');
            Route::get('editar/{id}', 'edit')->name('cargos.edit');
            Route::post('guardar', 'store')->name('cargos.store');
            Route::put('actualizar/{id}', 'update')->name('cargos.update');
            Route::delete('eliminar/{id}', 'destroy')->name('cargos.destroy');
            Route::get('getCargos', 'getCargos')->name('cargos.getCargos');
            Route::get('getAreasCargos', 'getAreasCargos')->name('cargos.getAreasCargos');
            Route::get('getCargosTodos', 'getCargosTodos')->name('cargos.getCargosTodos');
            Route::get('getAreas', 'getAreas')->name('cargos.getAreas');
            Route::get('getCargosByArea', 'getCargosByArea')->name('cargos.getCargosByArea');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Empleados
        Route::controller(EmpleadoController::class)->prefix('empleados')->group(function () {
            Route::get('', 'index')->name('empleados.index');
            Route::get('crear', 'create')->name('empleados.create');
            Route::get('editar/{id}', 'edit')->name('empleados.edit');
            Route::post('guardar', 'store')->name('empleados.store');
            Route::put('actualizar/{id}', 'update')->name('empleados.update');
            Route::delete('eliminar/{id}', 'destroy')->name('empleados.destroy');
            Route::put('activar/{id}', 'activar')->name('empleados.activar');
            Route::get('getEmpleadosRegional', 'getEmpleadosRegional')->name('empleados.getEmpleadosRegional');
            // *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--*
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Usuarios
        Route::controller(EmpresaUsuarioController::class)->prefix('usuarios')->group(function () {
            Route::get('', 'index')->name('usuarios.index');
            Route::get('crear', 'create')->name('usuarios.create');
            Route::get('editar/{id}', 'edit')->name('usuarios.edit');
            Route::post('guardar', 'store')->name('usuarios.store');
            Route::put('actualizar/{id}', 'update')->name('usuarios.update');
            Route::put('activar/{id}', 'activar')->name('usuarios.activar');
            Route::get('getUsuariosRegional', 'getUsuariosRegional')->name('usuarios.getUsuariosRegional');
            // *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--*
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Arquitectos
        Route::controller(ArquitectoController::class)->prefix('arquitectos')->group(function () {
            Route::get('', 'index')->name('arquitectos.index');
            Route::get('crear', 'create')->name('arquitectos.create');
            Route::get('editar/{id}', 'edit')->name('arquitectos.edit');
            Route::post('guardar', 'store')->name('arquitectos.store');
            Route::put('actualizar/{id}', 'update')->name('arquitectos.update');
            Route::put('activar/{id}', 'activar')->name('arquitectos.activar');
            Route::get('getArquitectosRegional', 'getArquitectosRegional')->name('arquitectos.getArquitectosRegional');
            // *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--*
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Constructoras
        Route::controller(ConstructoraController::class)->prefix('constructoras')->group(function () {
            Route::get('', 'index')->name('constructoras.index');
            Route::get('crear', 'create')->name('constructoras.create');
            Route::get('editar/{id}', 'edit')->name('constructoras.edit');
            Route::post('guardar', 'store')->name('constructoras.store');
            Route::put('actualizar/{id}', 'update')->name('constructoras.update');
            Route::put('activar/{id}', 'activar')->name('constructoras.activar');
            Route::get('getconstructorasRegional', 'getconstructorasRegional')->name('constructoras.getconstructorasRegional');
            // *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--*
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Areas
            Route::controller(ConstrucAreaController::class)->prefix('areas')->group(function () {
                Route::get('crear/{id}', 'create')->name('constructora.areas.create');
                Route::get('editar/{constructora_id}/{id}', 'edit')->name('constructora.areas.edit');
                Route::post('guardar', 'store')->name('constructora.areas.store');
                Route::put('actualizar/{constructora_id}/{id}', 'update')->name('constructora.areas.update');
                Route::get('getDependencias/{id}', 'getDependencias')->name('constructora.areas.getDependencias');
                Route::get('getAreas', 'getAreas')->name('constructora.areas.getAreas');
            });
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Cargos
            Route::controller(ConstrucCargoController::class)->prefix('cargos')->group(function () {
                Route::get('crear/{id}', 'create')->name('constructora.cargos.create');
                Route::get('editar/{constructora_id}/{id}', 'edit')->name('constructora.cargos.edit');
                Route::post('guardar', 'store')->name('constructora.cargos.store');
                Route::put('actualizar/{constructora_id}/{id}', 'update')->name('constructora.cargos.update');
                Route::get('getDependencias/{id}', 'getDependencias')->name('constructora.cargos.getDependencias');
                Route::get('getCargos', 'getCargos')->name('constructora.cargos.getCargos');
            });
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Empleados Constructoras
            Route::controller(ConstrucEmpleadoController::class)->prefix('empleados')->group(function () {
                Route::get('crear/{id}', 'create')->name('constructora.empleados.create');
                Route::get('editar/{constructora_id}/{id}', 'edit')->name('constructora.empleados.edit');
                Route::post('guardar', 'store')->name('constructora.empleados.store');
                Route::put('actualizar/{constructora_id}/{id}', 'update')->name('constructora.empleados.update');
                Route::get('getDependencias/{id}', 'getDependencias')->name('constructora.empleados.getDependencias');
                Route::get('getEmpleados', 'getEmpleados')->name('constructora.empleados.getEmpleados');
            });
            // ----------------------------------------------------------------------------------------
        });
        // ----------------------------------------------------------------------------------------
    });
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    // ------------------------------------------------------------------------------------
    // Ruta Inmuebles
    Route::controller(InmuebleController::class)->prefix('inmuebles')->group(function () {
        Route::get('crear', 'create')->name('inmuebles.create');
        Route::post('guardar', 'store')->name('inmuebles.store');
        Route::get('editar/{id}', 'edit')->name('inmuebles.edit');
        Route::put('actualizar/{id}', 'update')->name('inmuebles.update');
        Route::get('getInmuebles/{id}', 'getInmuebles')->name('inmuebles.getInmuebles');
        Route::get('getMunicipiosByDepartamento', 'getMunicipiosByDepartamento')->name('inmuebles.getMunicipiosByDepartamento');
    });
    // ------------------------------------------------------------------------------------
    // Ruta Inmuebles
    Route::controller(TipoInmuebleController::class)->prefix('tipo_inmuebles')->group(function () {
        Route::get('guardar', 'store')->name('tipo_inmuebles.store');
        Route::get('editar/{id}', 'edit')->name('tipo_inmuebles.edit');
        Route::put('actualizar/{id}', 'update')->name('tipo_inmuebles.update');
    });
    // ----------------------------------------------------------------------------------------
    Route::prefix('arquitecto')->middleware(Arquitecto::class)->group(function(){
        // Ruta Administrador del Sistema Menus
        // ------------------------------------------------------------------------------------
        Route::controller(ArquitectoController::class)->group(function () {
            Route::get('preferencias/{id}', 'preferencias')->name('arquitecto.preferencias');
            Route::get('getMunicipios', 'getMunicipios')->name('arquitecto.getMunicipios');
            Route::get('setTipoInmueble', 'setTipoInmueble')->name('arquitecto.setTipoInmueble');
            Route::get('setDepartamento', 'setDepartamento')->name('arquitecto.setDepartamento');
            Route::post('setPreferencias', 'setPreferencias')->name('arquitecto.setPreferencias');
            Route::get('getInmueblesArq', 'getInmueblesArq')->name('arquitecto.getInmueblesArq');



        });
        // ------------------------------------------------------------------------------------
    });
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

    Route::get('/getEmpleadosChat', [PageController::class, 'getEmpleadosChat'])->name('getEmpleadosChat');
    Route::get('/getMensajesNuevosEmpleadosChat', [PageController::class, 'getMensajesNuevosEmpleadosChat'])->name('getMensajesNuevosEmpleadosChat');
    Route::post('/setNuevoMensaje', [PageController::class, 'setNuevoMensaje'])->name('setNuevoMensaje');
    Route::get('/getMensajesChatUsuario', [PageController::class, 'getMensajesChatUsuario'])->name('getMensajesChatUsuario');
    Route::get('/getMensajesNuevosDestinatarioChat', [PageController::class, 'getMensajesNuevosDestinatarioChat'])->name('getMensajesNuevosDestinatarioChat');
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    Route::get('/getNotificacionesEmpleado', [PageController::class, 'getNotificacionesEmpleado'])->name('getNotificacionesEmpleado');
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    Route::get('/getPublicidadCinta', [PageController::class, 'getPublicidadCinta'])->name('getPublicidadCinta');
    Route::get('/getPublicidadLateral', [PageController::class, 'getPublicidadLateral'])->name('getPublicidadLateral');


    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
});
