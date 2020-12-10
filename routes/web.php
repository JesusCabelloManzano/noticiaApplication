<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\BackendNoticiaController;
use App\Http\Controllers\BackendAutorController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\AfterMiddleware;
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

//frontend
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('pdo', [IndexController::class, 'pdo'])->name('pdo');
Route::get('sql', [IndexController::class, 'sql'])->name('sql');
Route::resource('noticia', NoticiaController::class, ['names' => 'noticia'])->only(['index', 'show']);
Route::get('autor', [IndexController::class, 'autor'])->name('autor');

Route::prefix('backend')->group(function (){
    Route::get('/', [BackendController::class, 'main'])->name('backend.noticia');
    Route::resource('autor', BackendAutorController::class, ['names' => 'backend.autor']);
    //Route::resource('autornoticia', BackendAutorNoticiaController::class, ['names' => 'backend.autornoticia'])->only(['create', 'store']);
    //Route::get('enterpriseticket/createmultiple', [BackendEnterpriseTicketController::class, 'createmultiple'])->name('backend.enterpriseticket.createmultiple');
    //Route::post('enterpriseticket/createmultiple', [BackendEnterpriseTicketController::class, 'storemultiple'])->name('backend.enterpriseticket.storemultiple');
    Route::get('autor/paginate/index', [BackendAutorController::class, 'paginate'])->name('backend.autor.paginate.index');
    Route::prefix('noticia')->group(function() {
        Route::resource('/', BackendTicketController::class, ['names' => 'backend.noticia']);
        Route::get('backend/noticia/create/{idautor}', [BackendNoticiaController::class, 'createNoticiaAu'])->name('backend.noticia.createNoticiaAu');
        Route::get('backend/noticia/{idautor}/noticias', [BackendNoticiaController::class, 'showNoticias'])->name('backend.noticia.showNoticias');
    });
});