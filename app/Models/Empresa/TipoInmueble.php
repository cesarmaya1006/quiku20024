<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TipoInmueble extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'tipo_inmuebles';
    protected $guarded = [];

    //==================================================================================
    public function inmuebles()
    {
        return $this->hasMany(Empleado::class, 'tipo_inmueble_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
