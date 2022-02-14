<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOperacaoRequest;
use App\Http\Requests\UpdateOperacaoRequest;
use App\Http\Resources\Loja\ListaOperacao;
use App\Models\Operacao;
use App\Models\Loja;

class OperacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            ListaOperacao::collection(
                Loja::with("operacoes")->get()
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOperacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperacaoRequest $request)
    {
        try {
            $cnab = $request->file("cnab");
            $cnab = file_get_contents($cnab->getRealPath());
            Operacao::salvarCNAB($cnab);

        } catch(\Exception $error) {
            report($error);
            return response()->json([
                "message" => "Importado com sucesso"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operacao  $operacao
     * @return \Illuminate\Http\Response
     */
    public function show(Operacao $operacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operacao  $operacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Operacao $operacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperacaoRequest  $request
     * @param  \App\Models\Operacao  $operacao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperacaoRequest $request, Operacao $operacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operacao  $operacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operacao $operacao)
    {
        //
    }
}
