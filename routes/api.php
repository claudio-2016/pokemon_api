<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// ESTE CASO ES SOLO PARA FACILITAR EL TEST
Route::get('/config', function() {
    try {
        Artisan::call('migrate:refresh', ['--seed' => true, '--force' => true]);
        return response()->json(["status" => 200, "msg" => "Migracion correctamente."]);
    } catch (Exception $e) {
        return response()->json(["status" => 500, "msg" => "Error al realizar migraciones."]);
    }
});

//-------------------------------------------------------------------------------------------------------------------------------------------//

// OBTENER TODOS LOS USUARIOS PARA EL TEST
Route::get('/users', [ApiController::class, 'users']);
// LOGIN
Route::post('/login', [ApiController::class, 'login']);

//------------------------------------------- RUTAS PARA ABM CARTAS - SOLO USUARIOS AUTORIZADOS  -------------------------------------------//

// TODAS LAS CARTAS DE N USUARIO
Route::get('/letter', [ApiController::class, 'index'])->middleware('auth:sanctum');

// CREAR CARTA PARA N USUARIO
Route::post('/create', [ApiController::class, 'create'])->middleware('auth:sanctum');

// DEVOLVER UNA CARDA POR SU ID PARA N USUARIO RELACIONADO
Route::post('/show', [ApiController::class, 'show'])->middleware('auth:sanctum');

//  ACTUALIZAR N CARTA PARA EL USUARIO RELACIONADO
Route::post('/update', [ApiController::class, 'update'])->middleware('auth:sanctum');

//  ELIMINAR UNA CARTA POR SU ID
Route::post('/delete', [ApiController::class, 'delete'])->middleware('auth:sanctum');
