<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Users\UserDashsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use Spatie\Permission\Models\Role;

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

// Frontend
Route::get('/', [FrontendController::class, 'index'])->name('frontend');
Route::get('/marketplace', [FrontendController::class, 'allnft'])->name('allnft');
Route::get('/load-more', [FrontendController::class, 'loadMorePosts'])->name('loadMorePosts');
Route::get('/nftdetails/{sellcode}', [FrontendController::class, 'nftDetails'])->name('nftDetails');
Route::get('/category/{id}', [FrontendController::class, 'category'])->name('category');
Route::get('/page/{slug}', [FrontendController::class, 'pages'])->name('pages');
Route::get('/userole', [FrontendController::class, 'userRole'])->name('userRole');




// Users
Route::middleware('auth', 'checkStatus', 'role:user')->prefix('/user')->name('user.')->group(function () {
    Route::get('', [UserDashsController::class, 'index'])->name('index');
    Route::get('/deposit', [UserDashsController::class, 'deposit'])->name('deposit');
    Route::post('/depositform', [UserDashsController::class, 'depositform'])->name('depositform');
    Route::get('/confirmdeposit', [UserDashsController::class, 'confirmDeposit'])->name('confirmdeposit');
    Route::post('/confirmdepositstore', [UserDashsController::class, 'confirmDepositstore'])->name('confirmdepositstore');
    Route::get('/withdrawal', [UserDashsController::class, 'withdrawal'])->name('withdrawal');
    Route::post('/withdrawalform', [UserDashsController::class, 'withdrawalform'])->name('withdrawalform');
    Route::get('/mint', [UserDashsController::class, 'mint'])->name('mint');
    Route::get('/myNFT', [UserDashsController::class, 'myNFT'])->name('myNFT');
    Route::get('/history', [UserDashsController::class, 'history'])->name('history');
    Route::post('/mintNFT', [UserDashsController::class, 'mintNFT'])->name('mintNFT');
    Route::put('/buy/{id}', [UserDashsController::class, 'buy'])->name('buy');
    Route::put('/list/{id}', [UserDashsController::class, 'list'])->name('list');
    Route::put('/updateNftPrice/{id}', [UserDashsController::class, 'updateNftPrice'])->name('updateNftPrice');
});


// Admin
Route::middleware('auth', 'role:admin')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::put('/suspenduser/{id}', [DashboardController::class, 'suspendUser'])->name('suspendUser');
    Route::put('/badge/{id}', [DashboardController::class, 'badge'])->name('badge');
    Route::get('/gateway', [DashboardController::class, 'gateway'])->name('gateway');
    Route::put('/gatewaystatus/{id}', [DashboardController::class, 'gatewaystatus'])->name('gatewaystatus');
    Route::put('/gatewayedit/{id}', [DashboardController::class, 'gatewayedit'])->name('gatewayedit');
    Route::get('/pending-deposit', [DashboardController::class, 'pendingDeposit'])->name('pendingDeposit');
    Route::put('/complete-deposit/{id}', [DashboardController::class, 'completeDeposit'])->name('completeDeposit');
    Route::put('/puged-deposit/{id}', [DashboardController::class, 'pugedDeposit'])->name('pugedDeposit');
    Route::get('/deposit-history', [DashboardController::class, 'depositHistory'])->name('depositHistory');
    Route::get('/mint', [DashboardController::class, 'mint'])->name('mint');
    Route::post('/mintNFT', [DashboardController::class, 'mintNFT'])->name('mintNFT');
    Route::get('/nfts', [DashboardController::class, 'nfts'])->name('nfts');
    Route::put('/mint-approval/{id}', [DashboardController::class, 'mintApproval'])->name('mintApproval');
    Route::put('/editNFT/{id}', [DashboardController::class, 'editNFT'])->name('editNFT');
    Route::get('/pending-withdrawal', [DashboardController::class, 'pendingWithdrawal'])->name('pendingWithdrawal');
    Route::put('/complete-withdrawal/{id}', [DashboardController::class, 'completeWithdrawal'])->name('completeWithdrawal');
    Route::put('/puged-withdrawal/{id}', [DashboardController::class, 'pugedWithdrawal'])->name('pugedWithdrawal');
    Route::get('/withdrawal-history', [DashboardController::class, 'withdrawalHistory'])->name('withdrawalHistory');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settingsupdate', [SettingController::class, 'update'])->name('settingsupdate');
    Route::resource('/page', PageController::class);
    Route::resource('/email', EmailController::class);
});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('msg', 'Verfication Link Sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Auth::routes(['verify' => true]);
//Language Translation
Route::get('index/{locale}', [HomeController::class, 'lang']);


Route::get('/dash', [HomeController::class, 'root'])->name('root');



//Update User Details
Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [HomeController::class, 'index'])->name('index');




