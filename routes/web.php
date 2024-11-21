<?php

use App\Models\User;
use App\Mail\WelcomeMail;
use App\Http\Livewire\Main\Blog;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Main\Plans;
use App\Http\Livewire\Main\Afilate;
use App\Http\Livewire\Main\Archive;
use App\Http\Livewire\Main\Profile;
use App\Http\Livewire\Main\Support;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Main\Products;
use Illuminate\Support\Facades\Mail;
use App\Http\Livewire\Main\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Livewire\Main\SummaryOrder;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Main\AffiliateSales;
use App\Http\Livewire\Main\AffiliateStats;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Livewire\Main\AffiliateDashboard;
use App\Http\Livewire\Main\Tickets\AllTickets;
use App\Http\Livewire\Main\Tickets\CreateTicket;
use App\Http\Controllers\Voyager\ToolsController;
use App\Http\Livewire\Main\Tickets\ShowTheTicket;
use App\Http\Controllers\TicketResponseController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Voyager\MailingController;
use App\Http\Controllers\Voyager\CurrencyController;
use App\Http\Controllers\Voyager\PackagesController;
use App\Http\Controllers\Voyager\AffiliateController;
use App\Http\Controllers\Voyager\AnalyticsController;
use App\Http\Controllers\Voyager\AdminTicketController;
use App\Http\Controllers\Voyager\ToolsActiveController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Payment\PaymentWebhookController;
use App\Http\Controllers\Voyager\PackagesActiveController;
use App\Http\Controllers\Voyager\UserManagementController;

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


// Route::post('/payment/razorpay/webhook', [PaymentWebhookController::class, 'handleRazorpayCallback'])->name('payment.webhook.razorpay');

Route::post('/webhook/razorpay', [PaymentWebhookController::class, 'handleRazorpayCallback'])->name('payment.webhook.razorpay');

Route::middleware('auth')->get('/check-login2', function () {
    return response()->json(['status' => 'authenticated']);
});

Route::get('/test', function() {
    Mail::to('shiro3662@gmail.com')->send(new WelcomeMail('asdada'));
});

Route::middleware(['guest'])->group(function() {

    Route::get('/register', Register::class)->name('auth.showRegister');
    Route::get('/login', Login::class)->name('auth.showLogin');

    Route::prefix('password')->name('password.')->group(function() {
        Route::get('/reset/{token}', ResetPassword::class)->name('reset');
        Route::get('/reset', ForgotPassword::class)->name('request');
    });

    Route::controller(AuthController::class)->group(function() {
        Route::post('/register', 'register')->name('auth.register');
        Route::post('/login', 'login')->name('auth.login');

        Route::post('/register/business-purchase', 'businessPurchase')->middleware('redirected')->name('auth.businessPurchase');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/plans', Plans::class)->name('plans');
    Route::get('/blog', Blog::class)->name('blog');
    Route::get('/archive', Archive::class)->name('archive');
    Route::get('/affiliate', Afilate::class)->name('affiliate');
    Route::get('/affiliate/dashboard', AffiliateDashboard::class)->name('affiliate.dashboard');
    Route::get('/affiliate/sales', AffiliateSales::class)->name('affiliate.sales');
    Route::get('/affiliate/stats', AffiliateStats::class)->name('affiliate.stats');
    Route::get('/cart', SummaryOrder::class)->name('summaryOrder');
    Route::get('/support', Support::class)->name('support');
    Route::get('/check-login', function () {
        return response()->json(['status' => 'authenticated']);
    });
    Route::get('/get-user-id', function () {
        // The user is authenticated, so you can retrieve the user's ID
        $userId = auth()->id();
        return response()->json(['user_id' => $userId]);
    });

    Route::get('support/tickets/create', CreateTicket::class)->name('support.tickets.create');
    Route::get('support/tickets', AllTickets::class)->name('support.tickets.index');
    Route::get('support/tickets/{id}', ShowTheTicket::class)->name('support.tickets.show');

    Route::post('/support/tickets/{id}/response', [TicketResponseController::class, 'responseToTheTicket'])->name('support.tickets.response.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/user/profile', Profile::class)->name('user.profile');
    Route::post('/user/update-name', [UserController::class, 'updateName'])->name('user.updateName');
    Route::post('/user/update-phone', [UserController::class, 'updatePhone'])->name('user.updatePhone');
    Route::get('/user/products', Products::class)->name('products');

    Route::controller(CartController::class)->name('cart.')->group(function() {
        Route::post('/cart/add', 'add')->name('add');
        Route::post('/cart/remove', 'remove')->name('remove');
        Route::post('/cart/session/reload', 'sessionReload')->name('session.reload');
    });

    Route::name('payment.')->prefix('payment')->group(function() {
        Route::post('/razorpay', [PaymentController::class, 'payWithRazorpay'])->name('razorpay');
    });

    Route::get('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

    Route::get('/download', [DownloadController::class, 'download'])->name('download');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();


    Route::get('/users', [UserManagementController::class, 'getAllUsers'])->name('voyager.users.index');
    Route::get('/users/{id}', [UserManagementController::class, 'getUserData'])->name('voyager.users.show') ;
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('voyager.users.create');

    Route::group(['as' => 'admin.'], function() {
        Route::get('/subs', [UserManagementController::class, 'getAllSubs'])->name('subs.index');

        Route::resource('tools', ToolsController::class);
        Route::singleton('tools.active', ToolsActiveController::class)->only(['update']);
        Route::resource('packages', PackagesController::class);
        Route::singleton('packages.active', PackagesActiveController::class)->only(['update']);
        Route::resource('affiliates', AffiliateController::class);

        Route::controller(AdminTicketController::class)->name('tickets.')->prefix('tickets')->group(function() {
            Route::get('/', 'main')->name('main');
            Route::get('/get-ticket', 'gitTicket')->name('get');
            Route::get('/closed', 'getClosedTickets')->name('closed');
            Route::get('/opened', 'getOpenedTickets')->name('opened');
            Route::get('/{id}', 'showTheTicket')->name('show');
        });

        Route::post('/users/search', [UserManagementController::class, 'searchUser'])->name('users.search');
        Route::get('/users/{id}/products', [UserManagementController::class, 'getProducts'])->name('users.products');
        Route::post('/users/{id}/products', [UserManagementController::class, 'updateProducts'])->name('users.products.update');
        Route::get('/users/{id}/products/manage', [UserManagementController::class, 'manageUserProducts'])->name('users.products.manage');
        Route::post('/users/{id}/products/manage/add', [UserManagementController::class, 'addProduct'])->name('users.products.manage.add');
        Route::post('/users/{id}/products/manage/remove', [UserManagementController::class, 'removeProduct'])->name('users.products.manage.remove');
        Route::post('/users/{id}/update/block', [UserManagementController::class, 'blockUser'])->name('users.update.block');
        Route::post('/users/{id}/update/unblock', [UserManagementController::class, 'unblockUser'])->name('users.update.unblock');
        Route::put('/users/{id}/update', [UserManagementController::class, 'update'])->name('users.update');
        Route::post('/users/store', [UserManagementController::class, 'store'])->name('users.store');

        Route::controller(AnalyticsController::class)->prefix('analytics')->name('analytics.')->group(function() {
            Route::get('/latest-logins', 'showLatestLogins')->name('showLatestLogins');
            Route::get('/daily-signups', 'getDailySignups')->name('dailySignups');
            Route::get('/payments', 'getPayments')->name('payments');
        });

        Route::controller(CurrencyController::class)->prefix('currencies')->name('currencies.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/update-currencies', 'updateCurrencies')->name('updateCurrencies');
        });
    });

    Route::prefix('mailing')->name('mailing.')->controller(MailingController::class)->group(function() {
        Route::get('/', 'sendMailForm')->name('form');
        Route::post('/send', 'sendMail')->name('form.send');
        Route::match(['get', 'post'],'/preview', 'generatePreview')->name('form.preview');
        Route::get('/show/{id}', 'showMail')->name('show');
    });


});
