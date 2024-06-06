<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CMSPageController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\LeaderboardController;
use App\Http\Controllers\Admin\TournamentsController;
use App\Http\Controllers\Admin\AffiliateAdsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WinningController;

use App\Http\Controllers\Front\FrontLoginController;
use App\Http\Controllers\Front\FrontRegisterController;
use App\Http\Controllers\Front\FrontPasswordResetController;
use App\Http\Controllers\Front\FrontUserController;
use App\Http\Controllers\Front\FrontTournamentController;
use App\Http\Controllers\Front\SocialLoginController;

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
/* front routes */
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/home', [HomeController::class,'index'])->name('index');
Route::group(['as' => 'front.', 'namespace' => 'Front'], function () {
    Route::get('/login', [FrontLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [FrontLoginController::class, 'login'])->name('login.submit');
    Route::get('/logout', [FrontLoginController::class, 'logout'])->name('logout');
    Route::get('/register', [FrontRegisterController::class, 'showrRegisterForm'])->name('register');
    Route::post('/register', [FrontRegisterController::class, 'register'])->name('register.submit');
    Route::get('activation_link/{token}', [FrontRegisterController::class, 'activationLink']);
    /* Forgot Password */
    Route::get('/resetPassword', [FrontPasswordResetController::class, 'showPasswordRest'])->name('resetpassword');
    Route::get('login/{provider}', [SocialLoginController::class, 'redirect'])->name('socialLogin');
    Route::get('login/{provider}/callback',[SocialLoginController::class, 'Callback']);
    Route::group([
        'prefix' => 'password'
        ], function () {
            Route::post('create', [FrontPasswordResetController::class, 'create'])->name('sendLinkToUser');
            Route::get('find/{token}', [FrontPasswordResetController::class, 'find']);
            Route::post('reset', [FrontPasswordResetController::class, 'reset'])->name('resetPassword');
        });
    /* End Forgot Password */
    Route::get('/practice-room/{slug}', [HomeController::class, 'practiceRoom'])->name('practice-room');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
    Route::post('/contact-us', [HomeController::class, 'postcontactUs'])->name('contact-us.submit');
    Route::get('/pages/{slug}', [HomeController::class, 'cmsPages'])->name('cmsPages');
    Route::get('/submit-game', [FrontUserController::class, 'submitGame'])->name('submitGame');
    Route::get('/search',[HomeController::class,'search'])->name('search');
});
Route::group(['as' => 'front.', 'namespace' => 'Front', 'middleware' => ['auth:web']], function () {
    Route::get('/profile', [FrontUserController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [FrontUserController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [FrontUserController::class, 'updateProfile'])->name('update-profile');
    Route::get('tournaments', [FrontTournamentController::class, 'index'])->name('tournaments');
    Route::get('/tournaments-room/{slug}/{id}/{user_id}', [FrontTournamentController::class, 'tournamentsRoom'])->name('tournaments-room');
    Route::post('/tournaments/start-game',[FrontTournamentController::class, 'startGame'])->name('start-game');
    Route::get('linked-account/{provider}', [FrontUserController::class, 'linkedAccount'])->name('linked-account');
});


/* admin routes */
Route::group(['as' => 'admin.','prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/profile',[DashboardController::class,'getProfile'])->name('profile');
    Route::post('/update-profile',[DashboardController::class,'updateProfile'])->name('updateProfile');
    Route::post('/change-password',[DashboardController::class,'changePassword'])->name('changePassword');

    /* Forgot Password */
    Route::get('/resetPassword', [PasswordResetController::class, 'showPasswordRest'])->name('resetpassword');
    Route::group([
        'prefix' => 'password'
        ], function () {
            Route::post('create', [PasswordResetController::class, 'create'])->name('sendLinkToUser');
            Route::get('find/{token}', [PasswordResetController::class, 'find']);
            Route::post('reset', [PasswordResetController::class, 'reset'])->name('resetPassword');
        });
    /* End Forgot Password */
});
Route::group(['as' => 'admin.','prefix' => 'admin'], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('cms-page', CMSPageController::class);
    Route::resource('game', GameController::class);
    Route::resource('tournaments', TournamentsController::class);
    Route::resource('affiliate-ads', AffiliateAdsController::class);
    Route::resource('user', UserController::class);
    Route::post('category/category-status',[CategoryController::class, 'changeStatus'])->name('category.changeStatus');
    Route::post('game/game-status',[GameController::class, 'changeStatus'])->name('game.changeStatus');
    Route::post('user/user-status',[UserController::class, 'changeStatus'])->name('user.changeStatus');
    Route::resource('winner', WinningController::class);
    Route::post('tournaments/winner-list',[TournamentsController::class, 'winnerList'])->name('tournaments.winner-list');
    Route::get('tournaments/leaderboard/{id}',[TournamentsController::class, 'leaderboard'])->name('tournaments.leaderboard');
    Route::get('tournaments/leaderboard-logs/{user_id}/{id}/{leaderboard}',[TournamentsController::class, 'leaderboardLogs'])->name('tournaments.leaderboard-report');
});