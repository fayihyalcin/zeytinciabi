<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\PublicLandingPageController;
use App\Http\Controllers\PublicOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DealerController as AdminDealerController;
use App\Http\Controllers\Admin\EarningController as AdminEarningController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PayoutController as AdminPayoutController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductPriceController as AdminProductPriceController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Dealer\DashboardController as DealerDashboardController;
use App\Http\Controllers\Dealer\EarningController as DealerEarningController;
use App\Http\Controllers\Dealer\LandingPageController as DealerLandingPageController;
use App\Http\Controllers\Dealer\OrderController as DealerOrderController;
use App\Http\Controllers\Dealer\PendingController as DealerPendingController;
use App\Http\Controllers\Dealer\PayoutController as DealerPayoutController;
use App\Http\Controllers\Dealer\ProductController as DealerProductController;
use App\Http\Controllers\Dealer\ProfileController as DealerProfileController;
use App\Http\Controllers\Operation\DashboardController as OperationDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lp/{landingPage}', [PublicLandingPageController::class, 'show'])
    ->middleware('landing.active')
    ->name('public.landing.show');
Route::post('/lp/{landingPage}/orders', [PublicOrderController::class, 'store'])
    ->middleware('landing.active')
    ->name('public.landing.orders.store');

Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth', 'user.active'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'user.active', 'role:super_admin,admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
        Route::get('/dealers/pending', [AdminDealerController::class, 'pending'])->name('dealers.pending');
        Route::post('/dealers/{dealer}/approve', [AdminDealerController::class, 'approve'])->name('dealers.approve');
        Route::post('/dealers/{dealer}/reject', [AdminDealerController::class, 'reject'])->name('dealers.reject');
        Route::resource('dealers', AdminDealerController::class)->only(['index', 'show']);
        Route::resource('product-categories', AdminProductCategoryController::class)
            ->parameters(['product-categories' => 'category'])
            ->except(['show', 'destroy']);
        Route::resource('products', AdminProductController::class)->except(['show', 'destroy']);
        Route::resource('product-prices', AdminProductPriceController::class)
            ->parameters(['product-prices' => 'productPrice'])
            ->except(['show', 'destroy']);
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
        Route::resource('earnings', AdminEarningController::class)->only(['index']);
        Route::resource('payouts', AdminPayoutController::class)->only(['index']);
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    });

Route::middleware(['auth', 'verified', 'user.active', 'role:operation_staff,admin,super_admin'])
    ->prefix('operation')
    ->name('operation.')
    ->group(function (): void {
        Route::get('/dashboard', OperationDashboardController::class)->name('dashboard');
    });

Route::middleware(['auth', 'verified', 'user.active', 'role:dealer'])
    ->prefix('dealer')
    ->name('dealer.')
    ->group(function (): void {
        Route::get('/pending', DealerPendingController::class)->name('pending');

        Route::middleware('dealer.approved')->group(function (): void {
            Route::get('/dashboard', DealerDashboardController::class)->name('dashboard');
            Route::get('/products', [DealerProductController::class, 'index'])->name('products.index');
            Route::patch('/products/{dealerProduct}/price', [DealerProductController::class, 'updatePrice'])->name('products.price.update');
            Route::resource('landing-pages', DealerLandingPageController::class)
                ->parameters(['landing-pages' => 'landingPage'])
                ->except(['show', 'destroy']);
            Route::get('/orders', [DealerOrderController::class, 'index'])->name('orders.index');
            Route::get('/orders/{order}', [DealerOrderController::class, 'show'])->name('orders.show');
            Route::get('/cargo-tracking', [DealerOrderController::class, 'cargo'])->name('cargo.index');
            Route::get('/earnings', [DealerEarningController::class, 'index'])->name('earnings.index');
            Route::get('/payouts', [DealerPayoutController::class, 'index'])->name('payouts.index');
            Route::get('/profile', [DealerProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [DealerProfileController::class, 'update'])->name('profile.update');
        });
    });

Route::middleware(['auth', 'user.active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
