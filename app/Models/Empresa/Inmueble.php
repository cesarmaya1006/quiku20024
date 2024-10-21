<?php

namespace App\Models\Empresa;

use App\Models\Config\Municipio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Inmueble extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'predios';
    protected $guarded = [];

    //==================================================================================
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tipo()
    {
        return $this->belongsTo(TipoInmueble::class, 'tipo_inmueble_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function multimedia()
    {
        return $this->hasMany(MultimediaInmueble::class, 'predio_id', 'id');
    }
    //---------------------------------------------------------------
    //---------------------------------------------------------------
    public function inmueble_arquitecto ()
    {
        return $this->belongsToMany(Arquitecto::class,'arquitecto_tipoinmuebles','tipo_inmueble_id','arquitecto_id');
    }
    //---------------------------------------------------------------
}
