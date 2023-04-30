<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\OrganizationTypeController;
use App\Http\Controllers\ProfileController;
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
| Role
| 0 = Admin
| 1 = Receiver
| 2 = Donor
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});



Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'register', [UserController::class, 'register'])->name('register');
Route::get('verify{phone}', [UserController::class, 'verify'])->name('verify');
Route::post('verified', [UserController::class, 'verified'])->name('verified');


Route::middleware(['role:0'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');

        Route::prefix('cities')->name('city.')->group(function () {
            Route::get('/', [CityController::class, 'index'])->name('index');
            Route::post('/submit', [CityController::class, 'submit'])->name('submit');
            Route::post('/update/{city}', [CityController::class, 'update'])->name('update');
            Route::get('/delete/{city}', [CityController::class, 'delete'])->name('delete');
        });

        Route::prefix('organization-type')->name('org-type.')->group(function () {
            Route::get('/', [OrganizationTypeController::class, 'index'])->name('index');
            Route::post('/submit', [OrganizationTypeController::class, 'submit'])->name('submit');
            Route::post('/update/{ogt}', [OrganizationTypeController::class, 'update'])->name('update');
            Route::get('/delete/{ogt}', [OrganizationTypeController::class, 'delete'])->name('delete');
        });

        Route::prefix('food-category')->name('food-cat.')->group(function () {
            Route::get('/', [FoodCategoryController::class, 'index'])->name('index');
            Route::post('/submit', [FoodCategoryController::class, 'submit'])->name('submit');
            Route::post('/update/{foodCat}', [FoodCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{foodCat}', [FoodCategoryController::class, 'delete'])->name('delete');
        });

        Route::prefix('receiver')->name('receiver.')->group(function () {
            Route::get('/', [ProfileController::class, 'receiverList'])->name('list');
            Route::post('/submit', [ProfileController::class, 'submit'])->name('submit');
            Route::post('/update/{profile}', [ProfileController::class, 'update'])->name('update');
            Route::get('/delete/{profile}', [ProfileController::class, 'delete'])->name('delete');
        });

        Route::get('/donor', [UserController::class, 'listDonor'])->name('donor.list');
        Route::get('/receiver', [UserController::class, 'listReceiver'])->name('receiver.list');
        Route::get('/unverified', [UserController::class, 'listUnverified'])->name('unverified.list');
        Route::get('user/detail/{id}', [UserController::class, 'details'])->name('user.detail');
        Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

        Route::name('admin.')->group(function () {
            Route::get('/approved-donation', [DonationController::class, 'approvedDonation'])->name('donation.approved');
            Route::get('/pending-donation', [DonationController::class, 'pendingDonation'])->name('donation.pending');
            Route::get('/rejected-donation', [DonationController::class, 'rejectedDonation'])->name('donation.rejected');
            Route::get('/hidden-donation', [DonationController::class, 'hiddenDonation'])->name('donation.hidden');
            Route::get('/donation-details/{id}', [DonationController::class, 'detailDonation'])->name('donation.details');
            Route::post('/donation-approve/{id}', [DonationController::class, 'approveDonation'])->name('donation.approve');
            Route::post('/donation-reject/{id}', [DonationController::class, 'rejectDonation'])->name('donation.reject');
            Route::post('/donation-hide/{id}', [DonationController::class, 'hideDonation'])->name('donation.hide');
        });
    });
});

Route::middleware(['role:1'])->group(function () {
    Route::prefix('receiver')->name('receiver.')->group(function () {
        Route::get('/dashboard', function () {
            return view('receiver.dashboard');
        })->name('dashboard');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/donations', [DonationController::class, 'listDonations'])->name('donations');
        Route::get('/donations-near-me', [DonationController::class, 'nearMe'])->name('donations.nearme');
    });
});

Route::middleware(['role:2'])->group(function () {
    Route::prefix('donor')->name('donor.')->group(function () {
        Route::view('/dashboard', 'donor.dashboard')->name('dashboard');
        Route::view('/abc', 'welcome');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
        Route::view('/profile', 'donor.profile')->name('profile');
    });

    Route::prefix('donation')->name('donation.')->group(function () {
        Route::get('/', [DonationController::class, 'index'])->name('index');
        Route::get('/create', [DonationController::class, 'add'])->name('add');
        Route::post('/submit', [DonationController::class, 'submit'])->name('submit');
        Route::get('/edit/{id}', [DonationController::class, 'edit'])->name('edit');
        Route::post('/update', [DonationController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [DonationController::class, 'delete'])->name('delete');
        Route::get('/my-donation', [DonationController::class, 'myDonation'])->name('mydonation');
        Route::post('/status-change/{id}', [DonationController::class, 'status'])->name('status');
        Route::post('/hide/{id}', [DonationController::class, 'hide'])->name('hide');
    });
});

Route::middleware(['role:1|2'])->group(function () {

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/create', [ProfileController::class, 'add'])->name('add');
        Route::post('/submit', [ProfileController::class, 'submit'])->name('submit');
        Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
    });

    Route::get('donation/details/{id}', [DonationController::class, 'details'])->name('donation.details');

    Route::fallback(function () {
        return view('error404');
    });
});
