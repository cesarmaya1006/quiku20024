<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MultimediaInmueble extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'multimedia_predios';
    protected $guarded = [];

    //==================================================================================
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->belongsTo(Inmueble::class, 'predio_id', 'id');
    }
    //---------------------------------------------------------------
}
