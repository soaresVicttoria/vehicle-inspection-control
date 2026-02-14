<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVeiculoRequest;
use App\Http\Requests\UpdateVeiculoRequest;
use App\Models\Veiculo;
use App\Traits\ApiResponse;

class VeiculoController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $veiculos = Veiculo::get();

        return $this->success($veiculos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVeiculoRequest $request)
    {
        $dadosValidados = $request->validated();

        $veiculo = Veiculo::create($dadosValidados);

        return $this->success($veiculo, 'Veículo cadastrado com sucesso!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        $veiculo->load(['proprietario:id,nome_completo', 'revisoes:id,data_revisao,veiculo_id']);

        return $this->success($veiculo, 'Sucesso ao buscar veículo!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVeiculoRequest $request, Veiculo $veiculo)
    {
        $dadosValidados = $request->validated();

        $veiculo = Veiculo::update($dadosValidados);

        return $this->success($veiculo, 'Sucesso ao atualizar dados do veículo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();

        return $this->success('', 'Veículo deletado com sucesso!', 204);
    }
}
