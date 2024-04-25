<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AssistenteController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SobreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sobre', [SobreController::class, 'index'])->name('sobre');

Route::get('/contato', [ContatoController::class, 'index'])->name('contato');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/carrinho', [ShopController::class, 'carrinho'])->name('carrinho');

Route::get('/shop-detalhes', [ShopController::class, 'shopDetalhes'])->name('shopDetalhes');

#region Login

// Logar
Route::get('/login', [LoginController::class, 'index'])->name('login');
// Autenticação
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.autenticar');

// logout
Route::get('/sair', function(){
    session()->flush();
    return redirect('/login');
})->name('sair');


#endregion Login

Route::middleware(['autenticacao:administrador'])->group(function(){

     Route::get('/dashboard/administrador', [AdministradorController::class, 'index'])->name('dashboard.administrador');
     Route::get('/dashboard/administrador/funcionario', [FuncionarioController::class, 'index'])->name('funcionario.index');

     // Produtos
     Route::get('/dashboard/administrador/produto', [ProdutoController::class, 'index'])->name('produto.index');
     
});

Route::middleware(['autenticacao:assistente'])->group(function (){

    Route::get('dashboard/assistente', [AssistenteController::class, 'index'])->name('dashboard.assistente');

});

