<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadAlunosController;
use App\Http\Controllers\CadTurmasController;
use App\Http\Controllers\CadEscolasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
//----------------- ALUNOS
Route::apiResource('alunos','App\Http\Controllers\CadAlunosController');
//----------------- ESCOLAS
Route::apiResource('escolas','App\Http\Controllers\CadEscolasController');
//----------------- TURMAS
Route::apiResource('turmas','App\Http\Controllers\CadTurmasController');
*/

Route::get('alunos',[CadAlunosController::class,'index']);
Route::get('alunos/{id}',[CadAlunosController::class,'show']);
Route::get('alunos/nome/{nome}',[CadAlunosController::class,'showbyname']);
Route::post('alunos',[CadAlunosController::class,'store']);
Route::put('alunos/{id}',[CadAlunosController::class,'update']);
Route::delete('alunos/{id}',[CadAlunosController::class,'destroy']);
//----------------- ESCOLAS
Route::get('escolas',[CadEscolasController::class,'index']);
Route::get('escolas/{id}',[CadEscolasController::class,'show']);
Route::get('escolas/nome/{nome}',[CadEscolasController::class,'showbyname']);
Route::post('escolas',[CadEscolasController::class,'store']);
Route::put('escolas/{id}',[CadEscolasController::class,'update']);
Route::delete('escolas/{id}',[CadEscolasController::class,'destroy']);
//----------------- TURMAS
Route::get('turmas',[CadTurmasController::class,'index']);
Route::get('turmas/{id}',[CadTurmasController::class,'show']);
Route::get('turmas/nome/{nome}',[CadTurmasController::class,'showbyname']);
Route::post('turmas',[CadTurmasController::class,'store']);
Route::put('turmas/{id}',[CadTurmasController::class,'update']);
Route::delete('turmas/{id}',[CadTurmasController::class,'destroy']);