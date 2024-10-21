<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Municipio extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'municipios';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
