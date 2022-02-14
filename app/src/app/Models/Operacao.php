<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Operacao extends Model
{
    use HasFactory;

    protected $fillable = [
        "loja_id",
        "tipo",
        "cartao",
        "cpf",
        "valor",
        "data",
    ];

    protected $table = "operacao";

    /**
     * Cast tipo column to int
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function tipo(): Attribute
    {
        return new Attribute(
            get: fn ($value) => intval($value),
        );
    }

    /**
     *
     * @param string $cnab
     */
    public static function salvarCNAB(string $cnab): void
    {
        try {
            $operacoes = Operacao::importarCNAB($cnab);
            $operacoes->map(function($operacao){
                $loja = Loja::firstOrCreate([
                    "nome" => $operacao["loja"],
                    "proprietario" => $operacao["proprietario"],
                ]);

                Operacao::create([
                    "loja_id" => $loja["id"],
                    "tipo" => $operacao["tipo"],
                    "cartao" => $operacao["cartao"],
                    "cpf" => $operacao["cpf"],
                    "valor" => $operacao["valor"],
                    "data" => $operacao["data"],
                ]);
            });
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     *
     *
     * @param string $cnab
     */
    public static function importarCNAB(string $cnab): Collection
    {
        try {
            $operacoes = collect([]);
            $linhas = collect(explode("\n", $cnab));

            $linhas->filter(function($linha){
                return filled($linha);

            })->map(function($linha) use (&$operacoes){
                $data = Str::substr($linha, 1, 8);
                $data = Str::substr($data, 0, 4) . '-' .
                    Str::substr($data, 4, 2) . '-' .
                    Str::substr($data, 6, 2);

                $hora = Str::substr($linha, 42, 6);
                $hora = Str::substr($hora, 0, 2) . ':' .
                    Str::substr($hora, 2, 2) . ':' .
                    Str::substr($hora, 4, 2);

                $operacoes->push(
                    [
                        "tipo" => Str::substr($linha, 0, 1),
                        "data" => "$data $hora",
                        "valor" => intval(Str::substr($linha, 9, 10))/100,
                        "cpf" => Str::substr($linha, 19, 11),
                        "cartao" => Str::substr($linha, 30, 12),
                        "proprietario" => Str::substr($linha, 48, 14),
                        "loja" => Str::substr($linha, 62, 19)
                    ]
                );
            });

            return $operacoes;
        } catch (\Exception $error) {
            throw $error;
        }
    }
}
