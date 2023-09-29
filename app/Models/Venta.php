<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'fecha',
        'total',
        'observaciones',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
