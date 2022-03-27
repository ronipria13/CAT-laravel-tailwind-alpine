<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RefController;
use App\Http\Controllers\Managements\UserController;

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

//public routes
Route::middleware('guest')->group(function () {
    Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/', [App\Http\Controllers\LoginController::class, 'authenticate'])->middleware('throttle:10,5');

});

// protected routes for all roles
Route::middleware('auth')->group(function () {
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'destroy'])->name('logout');
    Route::get('/roleplay/switch/{role_id}', [App\Http\Controllers\RolePlayController::class, 'switch'])->name('switch')->middleware('isActiveUser');
    Route::get('/home', function () { return view('dashboard'); })->name('home')->middleware('isActiveUser');
});

//protected routes with roleplay
Route::middleware(['auth','roleplay','isActiveUser'])->group(function () {

    Route::prefix('managements')->group(function(){
        Route::resource('/user', UserController::class)->except(['create', 'edit'])
        ->where(['user' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);

        Route::get('/functions/showall', [App\Http\Controllers\Managements\FunctionsController::class, 'showall']);
        Route::resource('/functions', App\Http\Controllers\Managements\FunctionsController::class)->except(['create', 'edit'])
        ->where(['function' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);

        Route::get('/controllers/showall', [App\Http\Controllers\Managements\ControllersController::class, 'showall']);
        Route::resource('/controllers', App\Http\Controllers\Managements\ControllersController::class)->except(['create', 'edit'])
        ->where(['controller' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);


        Route::resource('/modules', App\Http\Controllers\Managements\ModulesController::class)->except(['create', 'edit'])
        ->where(['module' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);

        Route::get('/roles/showall', [App\Http\Controllers\Managements\RolesController::class, 'showall']);
        Route::resource('/roles', App\Http\Controllers\Managements\RolesController::class)->except(['create', 'edit'])
        ->where(['role' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);

        Route::get('/actions/{id}', [App\Http\Controllers\Managements\ActionsController::class, 'index']);
        Route::post('/actions', [App\Http\Controllers\Managements\ActionsController::class, 'store']);
        Route::get('/actions/showall/{id}', [App\Http\Controllers\Managements\ActionsController::class, 'showall']);
        Route::delete('/actions/{id}', [App\Http\Controllers\Managements\ActionsController::class, 'destroy']);

        Route::get('/permissions/showall/{id}', [App\Http\Controllers\Managements\PermissionsController::class, 'showall']);
        Route::resource('/permissions', App\Http\Controllers\Managements\PermissionsController::class)->except(['create', 'edit','show'])
        ->where(['permission' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);

        Route::get('/menugroups/showall', [App\Http\Controllers\Managements\MenugroupsController::class, 'showall']);
        Route::resource('/menugroups', App\Http\Controllers\Managements\MenugroupsController::class)->except(['create', 'edit'])
        ->where(['menugroup' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);

        Route::get('/menus/showall', [App\Http\Controllers\Managements\MenusController::class, 'showall']);
        Route::resource('/menus', App\Http\Controllers\Managements\MenusController::class)->except(['create', 'edit'])
        ->where(['menu' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);

    });

    Route::prefix('data')->group(function () {
        Route::resource('/penyuluh', App\Http\Controllers\Data\PenyuluhController::class)->except(['create','edit']);
        Route::resource('/segments', App\Http\Controllers\Data\SegmentsController::class)->except(['create','edit']);
    });

});

Route::prefix('ref')->group(function () {
    Route::post('/province', [RefController::class, 'provinces']);
    Route::post('/regency', [RefController::class, 'regencies']);
    Route::post('/district', [RefController::class, 'districts']);
    Route::post('/village', [RefController::class, 'villages']);
    Route::post('/user', [RefController::class, 'users']);
    Route::post('/penyuluh', [RefController::class, 'penyuluh']);
});

Route::get('/alpine', function () {
    return view('alpine');
});
