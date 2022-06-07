<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// 最初の訪問ページを表す
Route::get('/', [PostController::class, 'index'])->name('post.index');

Route::resource('post', PostController::class);
// 【メモ】↑リソースコントローラーは、以下の7つの処理を1行で記述できる
// Route::get('post', [PostController::class, 'index'])->name('post.index');
// Route::get('post/create', [PostController::class, 'create'])->name('post.create');
// Route::post('post', [PostController::class, 'store'])->name('post.store');
// Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
// Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
// Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');
// Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
