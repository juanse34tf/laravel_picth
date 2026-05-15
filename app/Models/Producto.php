<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'precio',
        'precio_venta',
        'stock',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    /** Regla de negocio: margen de ganancia por unidad vendida. */
    public function calcularMargen(): float
    {
        return round((float) $this->precio_venta - (float) $this->precio, 2);
    }
}
