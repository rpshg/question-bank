
<?php


use App\Http\Controllers\Backend\AdminController;
use Illuminate\Support\Facades\Route;



Route::get('/admin', function () {
    if (auth('admin')->check()) {
        return redirect()->route('admin.dashboard'); // Redirect to dashboard if authenticated
    } else {
        return redirect()->route('admin.login'); // Redirect to login if not authenticated
    }
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('logout', [AdminController::class, 'logout'])
                ->name('admin.logout');
});

Route::group(['prefix' => 'admin', 'middleware' => ['guest:admin']], function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);

    Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminController::class, 'register']);
});




