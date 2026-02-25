    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\CvTemplateController;
    use App\Http\Controllers\User\TemplateController;

    Route::get('/', function () {
        return view('pages.home');
    });

    Route::prefix('admin')->name('admin.')->group(function() {
        // Dashboard
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('/', function() {
                return view('admin.dashboard');
            })->name('index');
        });

        // Transaksi 
        Route::prefix('transaksi')->name('transaksi.')->group(function () {
            Route::get('/', function() {
                return view('admin.transactions.index');
            })->name('index');

            Route::get('/show', function() {
                return view('admin.transactions.show');
            })->name('show');
        });

        // Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', function() {
                return view('admin.users.index');
            })->name('index');
        });
        
        // Templates
        Route::prefix('templates')->controller(CvTemplateController::class)->name('templates.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('edit/{id}', 'edit')->name('edit' );
            Route::put('update/{id}', 'update')->name('update');
            Route::post('store', 'store')->name('store');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
        });
        
    });

    Route::get('/', function () {
        return view('pages.home');
    });

    Route::controller(TemplateController::class)->group(function() {
        Route::get('templates', 'index')->name('templates');
        Route::get('templates-{slug}', 'detail')->name('template-detail');
        Route::get('test-editor-{slug}', 'editor')->name('test-editor');
    });

    Route::get('/features', function() {
        return view('pages.features');
    })->name('features');

    Route::get('/pricing', function () {
        return view('pages.pricing');
    })->name('pricing');

    Route::get('/checkout', function() {
        return view('pages.pricing.checkout');
    })->name('checkout');

    Route::get('/login', function() {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function() {
        return view('auth.register');
    })->name('register');

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('forgot-password');

    Route::get('/kode-otp', function() {
        return view('auth.otp');
    })->name('otp');

    Route::get('/reset-password', function() {
        return view('auth.reset-password');
    })->name('reset-password');

    Route::get('/email-otp', function() {
        return view('auth.emailotp');
    })->name('emailotp');

    Route::get('/modal-test', function() {
        return view('auth.success');
    })->name('modal-test');       

    Route::get('/edit-user', function () {
        return view('admin.users.edit');
    })->name('edit-user');

    Route::get('/tambah-user', function () {
        return view('admin.users.create');
    })->name('tambah-user');

    Route::get('/reset-password', function () {
        return view('admin.users.reset-password');
    })->name('reset-password');

    Route::get('/isi-data-tempalate', function () {
        return view('pages.dashboard.form-template');
    })->name('form-tempalte');

    Route::get('/profile', function () {
        return view('pages.dashboard.profile');
    });