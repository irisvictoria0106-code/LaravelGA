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
    
    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}