<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});


Route::middleware(['auth','admin'])->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::post('logout',[AuthController::class,'logout'])->name('logout');
    Route::post('/users/{user}/block', [AdminController::class, 'blockUser'])->name('blockUser');
    Route::post('/users/{user}/unblock', [AdminController::class, 'unblockUser'])->name('unblockUser');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name("admin.users.delete");
    Route::get('/admin/users/add', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/add', [AdminController::class, 'store'])->name('admin.users.store');
    /* ========================= */
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/add', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories/add', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/update/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name("admin.categories.delete");
    /* ========================== */
    Route::get('/admin/tags', [TagController::class, 'index'])->name('admin.tags.index');
    Route::get('/admin/tags/add', [TagController::class, 'create'])->name('admin.tags.create');
    Route::post('/admin/tags/add', [TagController::class, 'store'])->name('admin.tags.store');
    Route::get('/admin/tags/edit/{tag}', [TagController::class, 'edit'])->name('admin.tags.edit');
    Route::put('/admin/tags/update/{tag}', [TagController::class, 'update'])->name('admin.tags.update');
    Route::delete('/admin/tags/{tag}', [TagController::class, 'destroy'])->name("admin.tags.delete");
});
