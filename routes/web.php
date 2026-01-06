<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ====================
// ROUTE GROUP UNTUK AUTHENTICATED USERS
// ====================
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ====================
    // PROTECTED ROUTES DENGAN AUTH MIDDLEWARE
    // (Hanya untuk user yang sudah login)
    // ====================
    Route::middleware(['auth'])->group(function () {
        // Dashboard khusus (bisa diakses semua user yang login)
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
        // ====================
        // PRODUCT ROUTES DENGAN ROLE CHECKING
        // ====================
        
        // Route untuk semua user (role user/admin)
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
        
        // Route khusus untuk admin saja
        Route::middleware(['check.admin'])->group(function () {
            Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/products', [ProductController::class, 'store'])->name('products.store');
            Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        });
        
        // Atau bisa menggunakan resource route dengan middleware di controller
        // Route::resource('products', ProductController::class);
        
        // ====================
        // ADMIN DASHBOARD (Hanya untuk admin)
        // ====================
        Route::get('/admin/dashboard', function () {
            // Cek role di controller atau middleware
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        // Contoh route lainnya yang perlu dilindungi
        Route::get('/reports', function () {
            return view('reports.index');
        })->name('reports');
        
        Route::get('/settings', function () {
            return view('settings.index');
        })->name('settings');
    });
});

// ====================
// CUSTOM MIDDLEWARE UNTUK CHECK ROLE
// ====================
// Buat middleware terlebih dahulu dengan:
// php artisan make:middleware CheckAdmin

// Kemudian di app/Http/Middleware/CheckAdmin.php:
/*
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        
        abort(403, 'Unauthorized action.');
    }
}
*/

// Daftarkan middleware di app/Http/Kernel.php:
/*
protected $routeMiddleware = [
    // ... middleware lainnya
    'check.admin' => \App\Http\Middleware\CheckAdmin::class,
];
*/

require __DIR__.'/auth.php';