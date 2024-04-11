<?php

use Illuminate\Support\Facades\Route;
// echo "string";die;
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

Route::get('/clear-cache', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
   return "Cleared!";

});

Route::get('/clear-flush', function() {

    Artisan::call('cache:flush');
   	return "Cleared!";
   
});

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('user/register', [App\Http\Controllers\HomeController::class, 'register'])->name('user.register');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/term-conditions', '\App\Http\Controllers\HomeController@terms');

Route::group(['middleware' => ['verified']], function () {
	
	Route::get('/dashboard', [App\Http\Controllers\Frontend\UserController::class, 'index'])->name('dashboard');

	Route::put('/profile-update', [App\Http\Controllers\Frontend\UserController::class, 'updateProfile'])->name('update.profile');
	Route::put('/profile-picture-update', [App\Http\Controllers\Frontend\UserController::class, 'updateProfilePicture'])->name('update.profile.picture');

	Route::get('/category-details', [App\Http\Controllers\Frontend\UserController::class, 'editCategoryDetails'])->name('edit.category.details');

	Route::put('/category-details', [App\Http\Controllers\Frontend\UserController::class, 'updateCategoryDetails'])->name('update.category.details');

	Route::put('/category', [App\Http\Controllers\Frontend\UserController::class, 'updateCategory'])->name('update.category');

	Route::get('/account-details', [App\Http\Controllers\Frontend\UserController::class, 'editAccountDetails'])->name('edit.account.details');

	Route::put('/account-details', [App\Http\Controllers\Frontend\UserController::class, 'updateAccountDetails'])->name('update.account.details');
	
	Route::get('/faq-details', [App\Http\Controllers\Frontend\UserController::class, 'FaqDetails'])->name('faq.details');

	Route::get('/ticket-booking-details', [App\Http\Controllers\Frontend\UserController::class, 'editTicketBookingDetails'])->name('edit.ticket.booking.details');

	Route::put('/travel-boarding-details', [App\Http\Controllers\Frontend\UserController::class, 'updateTravelBoardingDetails'])->name('update.travel_boarding.details');

	Route::get('/hotel-booking-details', [App\Http\Controllers\Frontend\UserController::class, 'editHotelBookingDetails'])->name('edit.hotel.booking.details');

	Route::get('/add-member', [App\Http\Controllers\Frontend\UserController::class, 'addMember'])->name('add.member');
	Route::post('/store-member', [App\Http\Controllers\Frontend\UserController::class, 'storeMember'])->name('store.member');
	Route::get('/member-list', [App\Http\Controllers\Frontend\UserController::class, 'memberIndex'])->name('members.list');
	Route::post('/fetch-member-data', [App\Http\Controllers\Frontend\UserController::class, 'fetchData'])->name('fetch.member.data');

});

Route::get('/mail-test', function() {

    (new App\Http\Controllers\TestMailController)->mailable();

});

Route::get('/mail-test-simple/{email?}', function($to = 'pk836746@gmail.com') {

    $to = "somebody@example.com";
	$subject = "My subject";
	$txt = "Hello world!";
	$headers = "From: webmaster@example.com" . "\r\n" .
	"CC: somebodyelse@example.com";

	$sendStatus = mail($to,$subject,$txt,$headers);

	return $sendStatus;
});

Route::get('countries', 'App\Http\Controllers\AjaxController@getCountry')->name('ajax.countries');
Route::get('states/{country_id?}', 'App\Http\Controllers\AjaxController@getState')->name('ajax.states');
Route::get('cities/{state_id?}', 'App\Http\Controllers\AjaxController@getCity')->name('ajax.cities');
Route::get('projects', 'App\Http\Controllers\AjaxController@getProject')->name('ajax.projects');

Route::post('send-otp', 'App\Http\Controllers\AjaxController@sendOtp')->name('ajax.send.otp');

