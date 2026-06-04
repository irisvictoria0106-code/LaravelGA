<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'folio', 
        'fecha', 
        'total', 
        'metodo_pago', 
        'notas', 
        'user_id'
    ];
    
    
}