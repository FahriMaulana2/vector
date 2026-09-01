<?php

use App\Livewire\Admin\About\Form as AboutForm;
use App\Livewire\Admin\About\Index as AboutIndex;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Faqs\Form as FaqsForm;
use App\Livewire\Admin\Faqs\Index as FaqsIndex;
use App\Livewire\Admin\Hero\Edit as HeroEdit;
use App\Livewire\Admin\Hero\Form as HeroForm;
use App\Livewire\Admin\Hero\Index as HeroIndex;
use App\Livewire\Admin\Orders\Index as OrdersIndex;
use App\Livewire\Admin\Orders\Show as OrdersShow;
use App\Livewire\Admin\Portfolios\Form as PortfoliosForm;
use App\Livewire\Admin\Portfolios\Index as PortfoliosIndex;
use App\Livewire\Admin\Portfolios\PageContent as PortfolioPageContent;
use App\Livewire\Admin\Products\Form as ProductsForm;
use App\Livewire\Admin\Products\Index as ProductsIndex;
use App\Livewire\Admin\Products\PageContent as ProductsPageContent;
use App\Livewire\Admin\Services\Form as ServicesForm;
use App\Livewire\Admin\Services\Index as ServicesIndex;
use App\Livewire\Admin\Settings\Index as SettingsIndex;
use App\Livewire\Admin\WhyChooseUs\Form as WhyChooseUsForm;
use App\Livewire\Admin\WhyChooseUs\Index as WhyChooseUsIndex;
use App\Livewire\Admin\Workflow\Form as WorkflowForm;
use App\Livewire\Admin\Workflow\Index as WorkflowIndex;
use App\Livewire\Home;
use App\Livewire\OrderTracking;
use App\Livewire\Portfolio as PortfolioPage;
use App\Livewire\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', Home::class)->name('home');
Route::get('/products', Products::class)->name('products.index');
Route::get('/portfolio', PortfolioPage::class)->name('portfolio.index');
Route::get('/lacak-pesanan/{order?}', OrderTracking::class)->name('orders.track');

// Admin Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', Login::class)->name('admin.login');
});

// Admin Dashboard Routes (Auth required)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login');
    })->name('logout');

    // Kelola Website
    Route::prefix('hero')->name('hero.')->group(function () {
        Route::get('/', HeroIndex::class)->name('index');
        Route::get('/create', HeroForm::class)->name('create');
        Route::get('/{hero}/edit', HeroEdit::class)->name('edit');
    });

    Route::prefix('about')->name('about.')->group(function () {
        Route::get('/', AboutIndex::class)->name('index');
        Route::get('/create', AboutForm::class)->name('create');
        Route::get('/{about}/edit', AboutForm::class)->name('edit');
    });

    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', ServicesIndex::class)->name('index');
        Route::get('/create', ServicesForm::class)->name('create');
        Route::get('/{service}/edit', ServicesForm::class)->name('edit');
    });

    Route::prefix('why-choose-us')->name('why-choose-us.')->group(function () {
        Route::get('/', WhyChooseUsIndex::class)->name('index');
        Route::get('/create', WhyChooseUsForm::class)->name('create');
        Route::get('/{item}/edit', WhyChooseUsForm::class)->name('edit');
    });

    Route::prefix('workflow')->name('workflow.')->group(function () {
        Route::get('/', WorkflowIndex::class)->name('index');
        Route::get('/create', WorkflowForm::class)->name('create');
        Route::get('/{workflow}/edit', WorkflowForm::class)->name('edit');
    });

    Route::prefix('faqs')->name('faqs.')->group(function () {
        Route::get('/', FaqsIndex::class)->name('index');
        Route::get('/create', FaqsForm::class)->name('create');
        Route::get('/{faq}/edit', FaqsForm::class)->name('edit');
    });

    // Katalog & Portofolio
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', ProductsIndex::class)->name('index');
        Route::get('/page-content', ProductsPageContent::class)->name('page-content');
        Route::get('/create', ProductsForm::class)->name('create');
        Route::get('/{product}/edit', ProductsForm::class)->name('edit');
    });

    Route::prefix('portfolios')->name('portfolios.')->group(function () {
        Route::get('/', PortfoliosIndex::class)->name('index');
        Route::get('/page-content', PortfolioPageContent::class)->name('page-content');
        Route::get('/create', PortfoliosForm::class)->name('create');
        Route::get('/{portfolio}/edit', PortfoliosForm::class)->name('edit');
    });

    // Operasional
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', OrdersIndex::class)->name('index');
        Route::get('/{order}', OrdersShow::class)->name('show');
    });

    // Pengaturan
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', SettingsIndex::class)->name('index');
    });
});
