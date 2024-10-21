<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ConstrucCargo extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'construc_cargos';
    protected $guarded = [];

    //==================================================================================
    //----------------------------------------------------------------------------------
    public function area()
    {
        return $this->belongsTo(ConstrucArea::class, 'area_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleados()
    {
        return $this->hasMany(ConstrucEmpleado::class, 'cargo_id', 'id');
    }
    //---------------------------------------------------------------
}
