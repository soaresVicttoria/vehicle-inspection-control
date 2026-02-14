<?php

use App\Http\Controllers\Api\ProprietarioController;
use App\Http\Controllers\Api\RelatorioController;
use App\Http\Controllers\Api\RevisaoController;
use App\Http\Controllers\Api\VeiculoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/proprietarios', ProprietarioController::class);
Route::apiResource('/resivoes', RevisaoController::class);
Route::apiResource('/veiculos', VeiculoController::class);
Route::prefix('/relatorios')->group(function () {
  Route::get('/veiculos/todos', [RelatorioController::class, 'todosVeiculos']);
  Route::get('/veiculos/por-proprietario', [RelatorioController::class, 'veiculosPorProprietario']);
  Route::get('/veiculos/por-sexo', [RelatorioController::class, 'veiculosPorSexo']);
  Route::get('/veiculos/marcas-quantidade', [RelatorioController::class, 'marcasPorQuantidade']);
  Route::get('/veiculos/marcas-por-sexo', [RelatorioController::class, 'marcasPorSexo']);

  Route::get('/pessoas/todas', [RelatorioController::class, 'todosProprietarios']);
  Route::get('/pessoas/por-sexo', [RelatorioController::class, 'proprietariosPorSexo']);

  Route::get('/revisoes/por-periodo', [RelatorioController::class, 'revisoesPorPeriodo']);
  Route::get('/revisoes/marcas-mais-revisoes', [RelatorioController::class, 'marcasComMaisRevisoes']);
  Route::get('/revisoes/proprietarios-mais-revisoes', [RelatorioController::class, 'proprietariosComMaisRevisoes']);
  Route::get('/revisoes/tempo-medio', [RelatorioController::class, 'tempoMedioPorProprietario']);
  Route::get('/revisoes/proximas', [RelatorioController::class, 'proximasRevisoes']);
});
