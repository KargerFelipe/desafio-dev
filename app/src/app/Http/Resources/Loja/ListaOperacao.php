<?php

namespace App\Http\Resources\Loja;

use App\Enums\Operacao\Tipo;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ListaOperacao extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "nomeLoja" => $this->nome,
            "proprietario" => $this->proprietario,
            "operacoes" => $this->operacoes(),
            "total" => "R$ " . number_format($this->totalOperacoes(), 2, ',', '.'),
        ];
    }

    /**
     *
     * @return float
     */
    private function totalOperacoes(): ?float
    {
        try {
            if(!$this->relationLoaded("operacoes"))
                return null;

            $total = 0;
            $this->operacoes->map(
                function($operacao) use(&$total) {
                    if(Tipo::simbulo(Tipo::fromValue($operacao["tipo"])))
                        $total += $operacao["valor"];
                    else
                        $total -= $operacao["valor"];
                }
            );

            return $total;
        } catch (\Exception $error) {
            report($error);
            return null;
        }
    }

    /**
     *
     * @return Collection
     */
    private function operacoes(): ?Collection
    {
        try {
            if(!$this->relationLoaded("operacoes"))
                return null;

            $operacoes = collect();
            $this->operacoes->map(
                function($operacao) use(&$operacoes) {
                    $data = Carbon::createFromFormat(
                        'Y-d-m H:i:s',
                        $operacao["data"]
                    );

                    $operacoes->push([
                        "tipo" => Tipo::getDescription(intval($operacao["tipo"])),
                        "cartao" => $operacao["cartao"],
                        "cpf" => formatCnpjCpf($operacao["cpf"]),
                        "valor" => number_format($operacao["valor"], 2, ',', '.'),
                        "data" => $data->format('d/m/Y h:i:s'),
                    ]);
                }
            );

            return $operacoes;
        } catch (\Exception $error) {
            report($error);
            return null;
        }
    }
}
