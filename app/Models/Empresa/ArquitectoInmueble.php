<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ArquitectoInmueble extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'arquitecto_inmuebles';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function Arquitecto()
    {
        return $this->belongsTo(Arquitecto::class, 'arquitecto_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
