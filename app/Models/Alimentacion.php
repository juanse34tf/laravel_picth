<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimentacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'lote_id',
        'tipo_alimento',
        'cantidad_kg',
        'fecha',
    ];

    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }
}
