<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



Route::middleware('auth', 'role:customer')->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'CustomerDashboard'])->name('customer.dashboard');
    Route::get('/customer/logout', [CustomerController::class, 'CustomerLogOut'])->name('customer.logout');

    //orders
    Route::get('/order', [OrderController::class, 'customerOrder'])->name('customer.orders');
    Route::get('/book', [CustomerController::class, 'customerBooking'])->name('customer.book');
    Route::post('/order/save', [CustomerController::class, 'OrderSave'])->name('orderSave');
    Route::get('/customer/profile', [CustomerController::class, 'CustomerProfile'])->name('customer.profile');
    Route::post('/testPost/sdf', [CustomerController::class, 'testPosted'])->name('testPost');
    Route::get('/pack/{id}', [CustomerController::class, 'showPackageCustomer'])->name('customer.packageCustomer');
    Route::post('/bookings', [BookingController::class, 'Bookstore'])->name('bookStore');

    //transactions
    Route::get('/trasanctions', [CustomerController::class, 'transactions'])->name('customer.transaction');
    Route::get('/invoice', [CustomerController::class, 'invoice'])->name('customer.invoice');
    Route::get('/payment', [BookingController::class, 'showPaymentPage'])->name('payment');
    Route::post('/submit-payment', [BookingController::class, 'submitPayment'])->name('submitPayment');


    //bookStatus
    Route::post('/updateBookStatus', [CustomerController::class, 'bookCancelUpdate'])->name('customer.update.book');
    Route::get('cancelbook/{id}', [CustomerController::class, 'bookCancelView'])->name('customer.cancel');
    Route::get('/waiting-page/{id}', [CustomerController::class, 'showWaitingPage'])->name('waitingPage');
    Route::post('/cancel-booking/{booking_id}', [CustomerController::class, 'cancelBooking'])->name('cancelBooking');
});


Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/sample', [PackagesController::class, 'index'])->name('admin.index');

    //book


    Route::get('/booking', [BookingController::class, 'index'])->name('admin.book');
    Route::get('/approved', [BookingController::class, 'approvedBook'])->name('admin.book.approve');
    Route::get('/incoming', [BookingController::class, 'incomingPackages'])->name('admin.book.incoming');
    Route::post('/udpateStatus', [BookingController::class, 'updateBook'])->name('admin.book.update');
    Route::get('/cancelled', [BookingController::class, 'cancelledBook'])->name('admin.book.cancel');
    Route::get('showBook/{id}', [BookingController::class, 'show4'])->name('admin.show.approve');
    Route::get('/viewBook/{id}', [BookingController::class, 'show5'])->name('admin.book.view');



    //category
    Route::get('/category/CatOptions', [CategoryController::class, 'CatOptions'])->name('category.captions');
    Route::post('/storePrice', [CategoryController::class, 'storePrice']);
    Route::post('/savePackage', [CategoryController::class, 'savePackage'])->name('save.Package');
    Route::get('/package/{id}', [CategoryController::class, 'showPackage'])->name('show.package');
    Route::put('/package/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/package/delete/{id}', [CategoryController::class, 'destroy']);
    Route::delete('/package/delete-variant/{variant}', [CategoryController::class, 'deleteVariant']);
    Route::get('/category/add', [CategoryController::class, 'AddPackAge'])->name('category.add');




    Route::get('/data-tables', [AdminController::class, 'dataTables'])->name('admin.tables');
    //customer
    Route::get('/customers', [BookingController::class, 'customerList'])->name('admin.customer.customerList');
    Route::get('/admin/users', [AdminController::class, 'ShowUsers'])->name('admin.users');
    //reports
    Route::get('/sales', [AdminController::class, 'salesReport'])->name('admin.sales');
});


Route::middleware('auth', 'role:staff')->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'StaffDashboard'])->name('staff.dashboard');
    Route::get('/staff/logout', [StaffController::class, 'StaffLogout'])->name('staff.logout');
});
