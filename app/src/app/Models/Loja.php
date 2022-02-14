<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;

    protected $fillable = [
        "proprietario",
        "nome"
    ];

    protected $table = "loja";

    /**
     * Retorna as operacoes
     *
     */
    public function operacoes()
    {
        return $this->hasMany(Operacao::class);
    }
}
