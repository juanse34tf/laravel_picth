<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    /** @use HasFactory<\Database\Factories\LoteFactory> */
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'fecha_inicio',
        'estado',
    ];

    public function producciones()
    {
        return $this->hasMany(Produccion::class);
    }
}
