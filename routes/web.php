<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TesteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PrincipalController::class, 'principal'])->name('site.index');
Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::get('/login', function () {return 'Login';})->name('site.login');

Route::prefix('/app')->group(function () {
    Route::get('/clientes', function () {return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('app.fornecedores');
    Route::get('/produtos', function () {return 'produtos';})->name('app.produtos');
});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');

Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para ir para página inicial';
});

// Route::get(
//     '/contato/{nome}/{categoria_id}',
//     function (
//         string $nome = 'Desconhecido',
//         int $categoria_id = 1 // 1 -Informação
//     ) {
//         echo "Estamos aqui: $nome - $categoria_id";
//     }
// )->where('nome', '[A-Za-z]+')->where('categoria_id', '[0-9]+');