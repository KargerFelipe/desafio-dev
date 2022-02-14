<?php

namespace App\Enums\Operacao;

use BenSampo\Enum\Enum;

/**
 * @method static static Debito()
 * @method static static Boleto()
 * @method static static Financiamento()
 * @method static static Credito()
 * @method static static Emprestimo()
 * @method static static Venda()
 * @method static static TED()
 * @method static static DOC()
 * @method static static Aluguel()
 */

final class Tipo extends Enum
{
    const Debito        = 1;
    const Boleto        = 2;
    const Financiamento = 3;
    const Credito       = 4;
    const Emprestimo    = 5;
    const Venda         = 6;
    const TED           = 7;
    const DOC           = 8;
    const Aluguel       = 9;

    /**
     * Retorna a operação matemática de cada tipo
     *
     * @param Tipo $tipo
     * @return int
     */
    public static function simbulo(Tipo $tipo): int
    {
        $negativos = [
            self::Boleto(),
            self::Financiamento(),
            self::Aluguel()
        ];

        if(in_array($tipo, $negativos))
            return 0;

        return 1;
    }
}