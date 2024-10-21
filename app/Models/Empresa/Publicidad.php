<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;

class Publicidad extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'publicidad';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function rol()
    {
        return $this->belongsTo(Role::class, 'rol_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
