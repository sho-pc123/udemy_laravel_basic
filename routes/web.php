<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ShopController;

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

//eloquantの練習
Route::get('tests/test', [TestController::class, 'index']);

//リレーション(1対多)
Route::get('shops', [ShopController::class, 'index']);

//resouceとすることで7つのメソッドをかける(URLも7つ作成できる)
// Route::resource('contacts', ContactFormController::class);

//contactsはフォルダ名
Route::get('contacts', [ ContactFormController::class, 'index'])->name('contacts.index');

Route::prefix('contacts') // URIの頭にcontactsをつける
    ->middleware(['auth']) //認証
    ->controller(ContactFormController::class) // コントローラ指定(laravel9から)
    ->name('contacts.') // ルート名
    ->group(function(){ // グループ化
    Route::get('/', 'index')->name('index'); // 名前つきルート
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::get('/{id}/edit', 'edit')->name('edit'); 
    Route::post('/{id}', 'update')->name('update');
    Route::post('/{id}/destroy', 'destroy')->name('destroy');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
