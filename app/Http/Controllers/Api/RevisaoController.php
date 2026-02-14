<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRevisaoRequest;
use App\Http\Requests\UpdateRevisaoRequest;
use App\Models\Revisao;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class RevisaoController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $revisoes = Revisao::get();

        return $this->success($revisoes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRevisaoRequest $request)
    {
        $dadosValidados = $request->validated();

        $revisao = Revisao::create($dadosValidados);

        return $this->success($revisao, 'Revisão cadastrada com sucesso!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Revisao $revisao)
    {
        $revisao->load('veiculo');

        return $this->success($revisao, 'Sucesso ao buscar a revisão!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRevisaoRequest $request, Revisao $revisao)
    {
        $dadosValidados = $request->validated();

        $revisao = Revisao::update($dadosValidados);

        return $this->success($revisao, 'Sucesso ao atualizar dados do veículo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revisao $revisao)
    {
        $revisao->delete();

        return $this->success('', 'Revisão deletada com sucesso!', 204);
    }
}
