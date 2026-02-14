<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProprietarioRequest;
use App\Http\Requests\UpdateProprietarioRequest;
use App\Models\Proprietario;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class ProprietarioController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proprietarios = Proprietario::get();

        return $this->success($proprietarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProprietarioRequest $request)
    {
        $dadosValidados = $request->validated();

        $proprietario = Proprietario::create($dadosValidados);

        return $this->success($proprietario, 'Proprietário cadastrado com sucesso!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proprietario $proprietario)
    {
        $proprietario->load('veiculos');

        return $this->success($proprietario, 'Sucesso ao buscar proprietário!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UpdateProprietarioRequest $proprietario)
    {
        $dadosValidados = $request->validated();

        $proprietario->update($dadosValidados);

        return $this->success($proprietario, 'Sucesso ao atualizar dados do proprietário!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proprietario $proprietario)
    {
        $proprietario->delete();

        return $this->success('', 'Proprietário deletado com sucesso!', 204);
    }
}
