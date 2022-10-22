<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::get('/about', function () { return view('infopage.about'); })->name('info.about');

Route::get('/contacts', function () { return view('infopage.contacts'); })->name('info.contacts');

Route::get('/info/{id?}', [HomeController::class, 'info']);

Route::get('/hospital', function() {
    return view('hospital');
})->name('hospital');

Route::get('/stocks', [ItemController::class, 'sales'])->name('stocks');

// ANIMALS CATEGORYES
Route::get('/animals/create', [AnimalController::class, 'create'])->name('animals.create')->middleware('auth');
Route::get('/animals/{slug}', [AnimalController::class, 'show'])->name('animals.show');
Route::get('/animals/{slug}/edit', [AnimalController::class, 'edit'])->name('animals.edit')->middleware('auth');
Route::post('/animals/{slug}', [AnimalController::class, 'update'])->name('animals.update')->middleware('auth');
Route::post('/animals', [AnimalController::class, 'store'])->name('animals.store')->middleware('auth');

// ITEMS
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create')->middleware('auth');
Route::get('/items/list', [ItemController::class, 'list'])->name('items.list')->middleware('auth');
Route::get('/items/{slug}', [ItemController::class, 'show'])->name('items.show');
Route::post('/items', [ItemController::class, 'store'])->name('items.store')->middleware('auth');
Route::get('/items/{slug}/edit', [ItemController::class, 'edit'])->name('items.edit')->middleware('auth');
Route::post('/items/{slug}', [ItemController::class, 'update'])->name('items.update')->middleware('auth');

Route::post('/items/{slug}/update_animal', [ItemController::class, 'update_animal'])->name('items.update_animal')->middleware('auth');
Route::post('/items/{slug}/attach_tag', [ItemController::class, 'attach_tag'])->name('items.attach_tag')->middleware('auth');
Route::post('/items/{slug}/detach_tag', [ItemController::class, 'detach_tag'])->name('items.detach_tag')->middleware('auth');


Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.show');

Route::get('/search/{q}', [ItemController::class, 'search_g'])->name('items.search');
Route::post('/search', [ItemController::class, 'search_p']);


Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'auth']);
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');
Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/register', [UserController::class, 'reg_user']);
