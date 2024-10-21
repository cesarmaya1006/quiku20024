<?php

namespace App\Models\Empresa;

use App\Models\Config\Departamento;
use App\Models\Config\Municipio;
use App\Models\Config\TipoDocumento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Arquitecto extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'arquitectos';
    protected $guarded = [];
    //==================================================================================
    //----------------------------------------------------------------------------------
    public function tipo_docu()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->hasOne(User::class, 'id');
    }
    //----------------------------------------------------------------------------------
    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
    //---------------------------------------------------------------
    public function arquitecto_tipoinmuebles()
    {
        return $this->belongsToMany(TipoInmueble::class, 'arquitecto_tipoinmuebles', 'arquitecto_id', 'tipo_inmueble_id');
    }
    //---------------------------------------------------------------
    //---------------------------------------------------------------
    public function arquitecto_departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'arquitecto_departamentos', 'arquitecto_id', 'departamento_id');
    }
    //---------------------------------------------------------------
    //---------------------------------------------------------------
    public function arquitecto_municipios()
    {
        return $this->belongsToMany(Municipio::class, 'arquitecto_municipios', 'arquitecto_id', 'municipio_id');
    }
    //---------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function arquitecto_inmuebles()
    {
        return $this->hasMany(ArquitectoInmueble::class, 'arquitecto_id', 'id');
    }
    //----------------------------------------------------------------------------------

}
