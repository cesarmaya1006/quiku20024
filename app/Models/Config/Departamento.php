<?php

namespace App\Models\Config;

use App\Models\Empresa\Regional;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Departamento extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'departamentos';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'departamento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function regionales()
    {
        return $this->hasMany(Regional::class, 'departamento_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
