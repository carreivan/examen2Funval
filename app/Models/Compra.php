<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'proveedor_id',
        'fecha',
        'total',
        'observaciones',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
