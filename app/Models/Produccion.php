<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    /** @use HasFactory<\Database\Factories\ProduccionFactory> */
    use HasFactory;

    protected $fillable = [
        'lote_id',
        'fecha',
        'tipo_huevo',
        'cantidad',
        'observaciones',
    ];

    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }

    /** Regla de negocio: un día es productivo si se recolectó al menos un huevo. */
    public function esDiaProductivo(): bool
    {
        return (int) $this->cantidad > 0;
    }
}
