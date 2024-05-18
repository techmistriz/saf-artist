<?php

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
*/

// Common Routes
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

Auth::routes(['verify' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('user/register', [App\Http\Controllers\HomeController::class, 'register'])->name('user.register');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/term-conditions', '\App\Http\Controllers\HomeController@terms');

Route::group(['middleware' => ['verified']], function () {
	
	// start group-member route
	Route::get('/dashboard', [App\Http\Controllers\Frontend\UserController::class, 'index'])->name('dashboard');
	Route::post('/fetch-user-data', [App\Http\Controllers\Frontend\UserController::class, 'fetchData'])->name('fetch.user.data');
	Route::get('/user/create', [App\Http\Controllers\Frontend\UserController::class, 'create'])->name('user.create');
	Route::post('/user/store', [App\Http\Controllers\Frontend\UserController::class, 'store'])->name('user.store');
	Route::get('/user/show/{id}', [App\Http\Controllers\Frontend\UserController::class, 'show'])->name('user.show');
	Route::get('/user/edit/{id}', [App\Http\Controllers\Frontend\UserController::class, 'edit'])->name('user.edit');
	Route::put('/user-update/{id}', [App\Http\Controllers\Frontend\UserController::class, 'update'])->name('user.update');
	// end group-member route

	Route::put('/profile-update', [App\Http\Controllers\Frontend\UserController::class, 'updateProfile'])->name('update.profile');
	Route::put('/profile-picture-update', [App\Http\Controllers\Frontend\UserController::class, 'updateProfilePicture'])->name('update.profile.picture');

	Route::get('/category-details', [App\Http\Controllers\Frontend\UserController::class, 'editCategoryDetails'])->name('edit.category.details');

	Route::put('/category-details', [App\Http\Controllers\Frontend\UserController::class, 'updateCategoryDetails'])->name('update.category.details');

	Route::put('/category', [App\Http\Controllers\Frontend\UserController::class, 'updateCategory'])->name('update.category');

	Route::get('/account-details', [App\Http\Controllers\Frontend\UserController::class, 'editAccountDetails'])->name('edit.account.details');

	Route::put('/account-details', [App\Http\Controllers\Frontend\UserController::class, 'updateAccountDetails'])->name('update.account.details');
	
	Route::get('/faq-details', [App\Http\Controllers\Frontend\UserController::class, 'FaqDetails'])->name('faq.details');

	Route::get('/ticket-booking/details', [App\Http\Controllers\Frontend\UserController::class, 'editTicketBookingDetails'])->name('edit.ticket.booking.details');

	Route::put('/travel-boarding-details', [App\Http\Controllers\Frontend\UserController::class, 'updateTravelBoardingDetails'])->name('update.travel_boarding.details');

	Route::get('/hotel-booking/details', [App\Http\Controllers\Frontend\UserController::class, 'editHotelBookingDetails'])->name('edit.hotel.booking.details');

	// start group-member route
	Route::get('/group-member/list', [App\Http\Controllers\Frontend\GroupMemberController::class, 'index'])->name('group.member.list');
	Route::post('/fetch-group-member-data', [App\Http\Controllers\Frontend\GroupMemberController::class, 'fetchData'])->name('fetch.group.member.data');
	Route::get('/group-member/create', [App\Http\Controllers\Frontend\GroupMemberController::class, 'create'])->name('group.member.create');
	Route::post('/store-group-member', [App\Http\Controllers\Frontend\GroupMemberController::class, 'store'])->name('store.group.member');
	Route::get('/group-member/edit/{id}', [App\Http\Controllers\Frontend\GroupMemberController::class, 'edit'])->name('group.member.edit');
	Route::put('/group-member-update/{id}', [App\Http\Controllers\Frontend\GroupMemberController::class, 'update'])->name('store.group.update');
	Route::get('/group-member/show/{id}', [App\Http\Controllers\Frontend\GroupMemberController::class, 'show'])->name('group.member.show');
	Route::get('/group-member/delete/{id}', [App\Http\Controllers\Frontend\GroupMemberController::class, 'delete'])->name('group.member.delete');
	Route::post('/group-members/import', [App\Http\Controllers\Frontend\GroupMemberController::class, 'import'])->name('group.members.import');
	// end group-member route


	// start ticket-booking route
	Route::get('/ticket-booking/list', [App\Http\Controllers\Frontend\TicketBookingController::class, 'index'])->name('ticket.booking.list');
	Route::post('/fetch-ticket-booking-data', [App\Http\Controllers\Frontend\TicketBookingController::class, 'fetchData'])->name('fetch.ticket.booking.data');
	Route::get('/ticket-booking/create', [App\Http\Controllers\Frontend\TicketBookingController::class, 'create'])->name('ticket.booking.create');
	Route::post('/store-ticket-booking', [App\Http\Controllers\Frontend\TicketBookingController::class, 'store'])->name('store.ticket.booking');
	Route::get('/ticket-booking/edit/{id}', [App\Http\Controllers\Frontend\TicketBookingController::class, 'edit'])->name('ticket.booking.edit');
	Route::put('/ticket-booking-update/{id}', [App\Http\Controllers\Frontend\TicketBookingController::class, 'update'])->name('ticket.booking.update');
	Route::get('/ticket-booking/show/{id}', [App\Http\Controllers\Frontend\TicketBookingController::class, 'show'])->name('ticket.booking.show');
	Route::get('/ticket-booking/delete/{id}', [App\Http\Controllers\Frontend\TicketBookingController::class, 'delete'])->name('ticket.booking.delete');
	// end ticket-booking route


	// start hotel-booking route
	Route::get('/hotel-booking/list', [App\Http\Controllers\Frontend\HotelBookingController::class, 'index'])->name('hotel.booking.list');
	Route::post('/fetch-hotel-booking-data', [App\Http\Controllers\Frontend\HotelBookingController::class, 'fetchData'])->name('fetch.hotel.booking.data');
	Route::get('/hotel-booking/create', [App\Http\Controllers\Frontend\HotelBookingController::class, 'create'])->name('hotel.booking.create');
	Route::post('/store-hotel-booking', [App\Http\Controllers\Frontend\HotelBookingController::class, 'store'])->name('store.hotel.booking');
	Route::get('/hotel-booking/edit/{id}', [App\Http\Controllers\Frontend\HotelBookingController::class, 'edit'])->name('hotel.booking.edit');
	Route::put('/hotel-booking-update/{id}', [App\Http\Controllers\Frontend\HotelBookingController::class, 'update'])->name('hotel.booking.update');
	Route::get('/hotel-booking/show/{id}', [App\Http\Controllers\Frontend\HotelBookingController::class, 'show'])->name('hotel.booking.show');
	Route::get('/hotel-booking/delete/{id}', [App\Http\Controllers\Frontend\HotelBookingController::class, 'delete'])->name('hotel.booking.delete');
	// end hotel-booking route

});


// Cron Routes
Route::get('check-session', [App\Http\Controllers\Cron\CronController::class, 'checkSession']);

// Ajax Routes
Route::get('countries', 'App\Http\Controllers\AjaxController@getCountry')->name('ajax.countries');
Route::get('states/{country_id?}', 'App\Http\Controllers\AjaxController@getState')->name('ajax.states');
Route::get('cities/{state_id?}', 'App\Http\Controllers\AjaxController@getCity')->name('ajax.cities');
Route::get('festivals/{year?}', 'App\Http\Controllers\AjaxController@getFestival')->name('ajax.festivals');
Route::get('projects/{festival?}', 'App\Http\Controllers\AjaxController@getProject')->name('ajax.projects');

Route::post('send-otp', 'App\Http\Controllers\AjaxController@sendOtp')->name('ajax.send.otp');
Route::get('fetch-member-detail', 'App\Http\Controllers\AjaxController@getMember')->name('ajax.fetch.member.detail');
// Route::get('fetch-pincode', 'App\Http\Controllers\AjaxController@getPincodeDate')->name('ajax.fetch.pincode');

Route::get('delete-share-room/{id?}', 'App\Http\Controllers\AjaxController@deleteShareRoom')->name('ajax.delete.share.room');

