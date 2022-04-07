<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RefController;
use App\Http\Controllers\Managements\UserController;
use Maatwebsite\Excel\Row;

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
    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home')->middleware('isActiveUser');
    Route::get('/changepassword', [App\Http\Controllers\ChangepasswordController::class, 'index'])->name('changepassword')->middleware('isActiveUser');
    Route::put('/changepassword/{user}', [App\Http\Controllers\ChangepasswordController::class, 'update'])->middleware('isActiveUser')
    ->where(['user' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('isActiveUser');
    Route::put('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->middleware('isActiveUser')
    ->where(['user' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);
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
        Route::get('/peserta/showall', [App\Http\Controllers\Data\PesertaController::class, 'showall']);
        Route::resource('/peserta', App\Http\Controllers\Data\PesertaController::class)->except(['create','edit'])
        ->where(['peserta' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
        ->parameters(['peserta' => 'peserta']);

        Route::get('/paketsoal/showall', [App\Http\Controllers\Data\PaketsoalController::class, 'showall']);
        Route::resource('/paketsoal', App\Http\Controllers\Data\PaketsoalController::class)->except(['create','edit'])
        ->where(['paketsoal' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
        ->parameters(['paketsoal' => 'paketsoal']);

        Route::get('/paketsoal/kolom/{id}', [App\Http\Controllers\Data\KolomController::class, 'index']);
        Route::get('/kolom/showall', [App\Http\Controllers\Data\KolomController::class, 'showall']);
        Route::resource('/kolom', App\Http\Controllers\Data\KolomController::class)->except(['create','edit'])
        ->where(['kolom' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
        ->parameters(['kolom' => 'kolom']);

        Route::get('/soalkecermatan/showall', [App\Http\Controllers\Data\SoalkecermatanController::class, 'showall']);
        Route::get('/paketsoal/soalkecermatan/{id}', [App\Http\Controllers\Data\SoalkecermatanController::class, 'index']);
        Route::resource('/soalkecermatan', App\Http\Controllers\Data\SoalkecermatanController::class)->except(['create','edit'])
        ->where(['soalkecermatan' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])
        ->parameters(['soalkecermatan' => 'soalkecermatan']);
    });

    Route::prefix('paketsoal')->group(function () {
        Route::get('soalkecermatan', [App\Http\Controllers\Paketsoal\SoalkecermatanController::class, 'index']);
        Route::get('soalkecermatan/getready/{paketsoal}', [App\Http\Controllers\Paketsoal\SoalkecermatanController::class, 'create'])
        ->where(['paketsoal' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);
        Route::get('soalkecermatan/take/{paketsoal}', [App\Http\Controllers\Paketsoal\SoalkecermatanController::class, 'store'])
        ->where(['paketsoal' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);
    });

    Route::prefix('latihan')->group(function () {
        Route::get('paketsoal/{latihan}', [App\Http\Controllers\Latihan\PaketsoalController::class, 'index'])
        ->where(['paketsoal' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'])->name('latihan.paketsoal');
        Route::patch('paketsoal/{latihan}', [App\Http\Controllers\Latihan\PaketsoalController::class, 'update'])
        ->where(['paketsoal' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);
        Route::post('jawaban/store', [App\Http\Controllers\Latihan\JawabanController::class, 'store']);
        Route::get('riwayat', [App\Http\Controllers\Latihan\RiwayatController::class, 'index']);
        Route::get('riwayat/{latihan}', [App\Http\Controllers\Latihan\RiwayatController::class, 'show'])->name('latihan.riwayat')
        ->where(['latihan' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}']);
    });

});

Route::get('/alpine', function () {
    return view('alpine');
});
