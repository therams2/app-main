<?php

use App\Http\Livewire\Clasificadores\Funcionario;
use App\Http\Livewire\Clasificadores\Nombramientos;
use App\Http\Livewire\Clasificadores\Organigramas;
use App\Http\Livewire\Clasificadores\OrganigramasArbol;
use App\Http\Livewire\Adq\ShowCatArticulos;
use App\Http\Livewire\Adq\ShowCatCategorias;
use App\Http\Livewire\Adq\ShowCatIngresoInv;
use App\Http\Livewire\Egre\ShowVentas;
use App\Http\Livewire\Ing\ShowCatVentas;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/organigramas', Organigramas::class)->name('organigramas');
Route::get('/organigramas-arbol', OrganigramasArbol::class)->name('organigramasArbol');
Route::get('/funcionario', Funcionario::class)->name('funcionario');
Route::get('/nombramientos', Nombramientos::class)->name('nombramientos');
Route::get('/adq-cat-articulos', ShowCatArticulos::class)->name('articulos');
Route::get('/adq-cat-categorias', ShowCatCategorias::class)->name('categorias');
Route::get('/adq-cat-ingresos_inventario', ShowCatIngresoInv::class)->name('ingresoInventario');
Route::get('/eger-ventas', ShowVentas::class)->name('ventas');
Route::get('/eger-cat-ventas', ShowCatVentas::class)->name('catventas');

