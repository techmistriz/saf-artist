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

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset']);
    
    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');        
        Route::get('/profile/edit', [App\Http\Controllers\Admin\AdminProfileController::class, 'edit'])->name('profile.edit');        
        Route::put('/update/{id}', [App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('profile.update');        
        Route::get('/profile/change-password', [App\Http\Controllers\Admin\AdminProfileController::class, 'changePassword'])->name('profile.change_password');
        Route::put('/profile/update-password', [App\Http\Controllers\Admin\AdminProfileController::class, 'updatePassword'])->name('password.update');

        Route::group(['prefix' => 'user', 'middleware' => ['AdminPermissionCheck:UserController']], function(){

            // User routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'user.'], function(){
                Route::get('list/',                     'UserController@index')->name('index');
                Route::post('fetch-data/',              'UserController@fetchData')->name('fetch.data');
                Route::get('create/',                   'UserController@create')->name('create');
                Route::post('store/',                   'UserController@store')->name('store');
                Route::get('show/{id}',                 'UserController@show')->name('show');
                Route::get('edit/{id}',                 'UserController@edit')->name('edit');
                Route::put('update/{id}',               'UserController@update')->name('update');
                Route::get('delete/{id}',               'UserController@delete')->name('delete');
                Route::post('export/',                   'UserController@export')->name('export');
                Route::get('edit-category-details/{id}',	'UserController@editCategoryDetails')->name('edit.category.details');
                Route::get('show-category-details/{id}',	'UserController@showCategoryDetails')->name('show.category.details');
                Route::put('edit-category-details/{id}',	'UserController@updateCategoryDetails')->name('update.category.details');
                Route::get('edit-account-details/{id}',		'UserController@editAccountDetails')->name('edit.account.details');
                Route::put('edit-account-details/{id}',		'UserController@updateAccountDetails')->name('update.account.details');
                Route::get('show-account-details/{id}',		'UserController@showAccountDetails')->name('show.account.details');
                Route::get('update-freeze-status/{id}',		'UserController@updateFreezeStatus')->name('update.freeze.status');
            });
        });

        Route::group(['prefix' => 'category', 'middleware' => ['AdminPermissionCheck:CategoryController']], function(){

            // Accessibility routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'category.'], function(){
                Route::get('list/',                     'CategoryController@index')->name('index');
                Route::post('fetch-data/',              'CategoryController@fetchData')->name('fetch.data');
                Route::get('create/',                   'CategoryController@create')->name('create');
                Route::post('store/',                   'CategoryController@store')->name('store');
                Route::get('show/{id}',                 'CategoryController@show')->name('show');
                Route::get('edit/{id}',                 'CategoryController@edit')->name('edit');
                Route::put('update/{id}',               'CategoryController@update')->name('update');
                Route::get('delete/{id}',               'CategoryController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'admin-user', 'middleware' => ['AdminPermissionCheck:AdminUserController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin_user.'], function(){
                Route::get('list/',                     'AdminUserController@index')->name('index');
                Route::post('fetch-data/',              'AdminUserController@fetchData')->name('fetch.data');
                Route::get('create/',                   'AdminUserController@create')->name('create');
                Route::post('store/',                   'AdminUserController@store')->name('store');
                Route::get('show/{id}',                 'AdminUserController@show')->name('show');
                Route::get('edit/{id}',                 'AdminUserController@edit')->name('edit');
                Route::put('update/{id}',               'AdminUserController@update')->name('update');
                Route::get('delete/{id}',               'AdminUserController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'system-settings', 'middleware' => ['AdminPermissionCheck:SystemSettingsController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'system_settings.'], function(){
                Route::get('list/',                     'SystemSettingsController@index')->name('index');
                Route::post('fetch-data/',              'SystemSettingsController@fetchData')->name('fetch.data');
                Route::get('create/',                   'SystemSettingsController@create')->name('create');
                Route::post('store/',                   'SystemSettingsController@store')->name('store');
                Route::get('show/{id}',                 'SystemSettingsController@show')->name('show');
                Route::get('edit/{id}',                 'SystemSettingsController@edit')->name('edit');
                Route::put('update/{id}',               'SystemSettingsController@update')->name('update');
                Route::get('delete/{id}',               'SystemSettingsController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'admin-settings', 'middleware' => ['AdminPermissionCheck:AdminSettingsController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin_settings.'], function(){
                Route::get('list/',                     'AdminSettingsController@index')->name('index');
                Route::post('fetch-data/',              'AdminSettingsController@fetchData')->name('fetch.data');
                Route::get('create/',                   'AdminSettingsController@create')->name('create');
                Route::post('store/',                   'AdminSettingsController@store')->name('store');
                Route::get('show/{id}',                 'AdminSettingsController@show')->name('show');
                Route::get('edit/{id}',                 'AdminSettingsController@edit')->name('edit');
                Route::put('update/{id}',               'AdminSettingsController@update')->name('update');
                Route::get('delete/{id}',               'AdminSettingsController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'sms-template', 'middleware' => ['AdminPermissionCheck:SmsTemplateController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'sms_template.'], function(){
                Route::get('list/',                     'SmsTemplateController@index')->name('index');
                Route::post('fetch-data/',              'SmsTemplateController@fetchData')->name('fetch.data');
                Route::get('create/',                   'SmsTemplateController@create')->name('create');
                Route::post('store/',                   'SmsTemplateController@store')->name('store');
                Route::get('show/{id}',                 'SmsTemplateController@show')->name('show');
                Route::get('edit/{id}',                 'SmsTemplateController@edit')->name('edit');
                Route::put('update/{id}',               'SmsTemplateController@update')->name('update');
                Route::get('delete/{id}',               'SmsTemplateController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'email-template', 'middleware' => ['AdminPermissionCheck:EmailTemplateController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'email_template.'], function(){
                Route::get('list/',                     'EmailTemplateController@index')->name('index');
                Route::post('fetch-data/',              'EmailTemplateController@fetchData')->name('fetch.data');
                Route::get('create/',                   'EmailTemplateController@create')->name('create');
                Route::post('store/',                   'EmailTemplateController@store')->name('store');
                Route::get('show/{id}',                 'EmailTemplateController@show')->name('show');
                Route::get('edit/{id}',                 'EmailTemplateController@edit')->name('edit');
                Route::put('update/{id}',               'EmailTemplateController@update')->name('update');
                Route::get('delete/{id}',               'EmailTemplateController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'user-role', 'middleware' => ['AdminPermissionCheck:UserRoleController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'user_role.'], function(){
                Route::get('list/',                     'UserRoleController@index')->name('index');
                Route::post('fetch-data/',              'UserRoleController@fetchData')->name('fetch.data');
                Route::get('create/',                   'UserRoleController@create')->name('create');
                Route::post('store/',                   'UserRoleController@store')->name('store');
                Route::get('show/{id}',                 'UserRoleController@show')->name('show');
                Route::get('edit/{id}',                 'UserRoleController@edit')->name('edit');
                Route::put('update/{id}',               'UserRoleController@update')->name('update');
                Route::get('delete/{id}',               'UserRoleController@delete')->name('delete');
                Route::get('permission/{id}',           'UserRoleController@permission')->name('permission');
                Route::post('save_permission',          'UserRoleController@save_permission')->name('save_permission');
            });
        });

        Route::group(['prefix' => 'permission', 'middleware' => ['AdminPermissionCheck:PermissionController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'permission.'], function(){
                Route::get('list/',                     'PermissionController@index')->name('index');
                Route::post('fetch-data/',              'PermissionController@fetchData')->name('fetch.data');
                Route::get('create/',                   'PermissionController@create')->name('create');
                Route::post('store/',                   'PermissionController@store')->name('store');
                Route::get('show/{id}',                 'PermissionController@show')->name('show');
                Route::get('edit/{id}',                 'PermissionController@edit')->name('edit');
                Route::put('update/{id}',               'PermissionController@update')->name('update');
                Route::get('delete/{id}',               'PermissionController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'admin-module', 'middleware' => ['AdminPermissionCheck:AdminModuleController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin_module.'], function(){
                Route::get('list/',                     'AdminModuleController@index')->name('index');
                Route::post('fetch-data/',              'AdminModuleController@fetchData')->name('fetch.data');
                Route::get('create/',                   'AdminModuleController@create')->name('create');
                Route::post('store/',                   'AdminModuleController@store')->name('store');
                Route::get('show/{id}',                 'AdminModuleController@show')->name('show');
                Route::get('edit/{id}',                 'AdminModuleController@edit')->name('edit');
                Route::put('update/{id}',               'AdminModuleController@update')->name('update');
                Route::get('delete/{id}',               'AdminModuleController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'ticket-booking', 'middleware' => ['AdminPermissionCheck:TicketBookingController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'ticket_booking.'], function(){
                Route::get('list/',                     'TicketBookingController@index')->name('index');
                Route::post('fetch-data/',              'TicketBookingController@fetchData')->name('fetch.data');
                Route::get('create/',                   'TicketBookingController@create')->name('create');
                Route::post('store/',                   'TicketBookingController@store')->name('store');
                Route::get('show/{id}',                 'TicketBookingController@show')->name('show');
                Route::get('edit/{id}',                 'TicketBookingController@edit')->name('edit');
                Route::put('update/{id}',               'TicketBookingController@update')->name('update');
                Route::get('delete/{id}',               'TicketBookingController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'hotel-booking', 'middleware' => ['AdminPermissionCheck:HotelBookingController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'hotel_booking.'], function(){
                Route::get('list/',                     'HotelBookingController@index')->name('index');
                Route::post('fetch-data/',              'HotelBookingController@fetchData')->name('fetch.data');
                Route::get('create/',                   'HotelBookingController@create')->name('create');
                Route::post('store/',                   'HotelBookingController@store')->name('store');
                Route::get('show/{id}',                 'HotelBookingController@show')->name('show');
                Route::get('edit/{id}',                 'HotelBookingController@edit')->name('edit');
                Route::put('update/{id}',               'HotelBookingController@update')->name('update');
                Route::get('delete/{id}',               'HotelBookingController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'project', 'middleware' => ['AdminPermissionCheck:ProjectController']], function(){

            // program routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'project.'], function(){
                Route::get('list/',                     'ProjectController@index')->name('index');
                Route::post('fetch-data/',              'ProjectController@fetchData')->name('fetch.data');
                Route::get('create/',                   'ProjectController@create')->name('create');
                Route::post('store/',                   'ProjectController@store')->name('store');
                Route::get('show/{id}',                 'ProjectController@show')->name('show');
                Route::get('edit/{id}',                 'ProjectController@edit')->name('edit');
                Route::put('update/{id}',               'ProjectController@update')->name('update');
                Route::get('delete/{id}',               'ProjectController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'faq', 'middleware' => ['AdminPermissionCheck:FaqController']], function(){

            //FAQ routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'faq.'], function(){
                Route::get('list/',              'FaqController@index')->name('index');
                Route::post('fetch-data/',       'FaqController@fetchData')->name('fetch.data');
                Route::get('create/',            'FaqController@create')->name('create');
                Route::post('store/',            'FaqController@store')->name('store');
                Route::get('show/{id}',          'FaqController@show')->name('show');
                Route::get('edit/{id}',          'FaqController@edit')->name('edit');
                Route::put('update/{id}',        'FaqController@update')->name('update');
                Route::get('delete/{id}',        'FaqController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'artist-member', 'middleware' => ['AdminPermissionCheck:ArtistMemberController']], function(){

            //ArtistMember routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'artist_member.'], function(){
                Route::get('list/',              'ArtistMemberController@index')->name('index');
                Route::post('fetch-data/',       'ArtistMemberController@fetchData')->name('fetch.data');
                Route::get('create/',            'ArtistMemberController@create')->name('create');
                Route::post('store/',            'ArtistMemberController@store')->name('store');
                Route::get('show/{id}',          'ArtistMemberController@show')->name('show');
                Route::get('edit/{id}',          'ArtistMemberController@edit')->name('edit');
                Route::put('update/{id}',        'ArtistMemberController@update')->name('update');
                Route::get('delete/{id}',        'ArtistMemberController@delete')->name('delete');
                Route::post('export/',           'ArtistMemberController@export')->name('export');
            });
        });

        Route::group(['prefix' => 'curator', 'middleware' => ['AdminPermissionCheck:CuratorController']], function(){

            // Accessibility routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'curator.'], function(){
                Route::get('list/',                     'CuratorController@index')->name('index');
                Route::post('fetch-data/',              'CuratorController@fetchData')->name('fetch.data');
                Route::get('create/',                   'CuratorController@create')->name('create');
                Route::post('store/',                   'CuratorController@store')->name('store');
                Route::get('show/{id}',                 'CuratorController@show')->name('show');
                Route::get('edit/{id}',                 'CuratorController@edit')->name('edit');
                Route::put('update/{id}',               'CuratorController@update')->name('update');
                Route::get('delete/{id}',               'CuratorController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'artist-type', 'middleware' => ['AdminPermissionCheck:ArtistTypeController']], function(){

            // Accessibility routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'artist_type.'], function(){
                Route::get('list/',                     'ArtistTypeController@index')->name('index');
                Route::post('fetch-data/',              'ArtistTypeController@fetchData')->name('fetch.data');
                Route::get('create/',                   'ArtistTypeController@create')->name('create');
                Route::post('store/',                   'ArtistTypeController@store')->name('store');
                Route::get('show/{id}',                 'ArtistTypeController@show')->name('show');
                Route::get('edit/{id}',                 'ArtistTypeController@edit')->name('edit');
                Route::put('update/{id}',               'ArtistTypeController@update')->name('update');
                Route::get('delete/{id}',               'ArtistTypeController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'venue', 'middleware' => ['AdminPermissionCheck:VenueController']], function(){

            // Accessibility routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'venue.'], function(){
                Route::get('list/',                     'VenueController@index')->name('index');
                Route::post('fetch-data/',              'VenueController@fetchData')->name('fetch.data');
                Route::get('create/',                   'VenueController@create')->name('create');
                Route::post('store/',                   'VenueController@store')->name('store');
                Route::get('show/{id}',                 'VenueController@show')->name('show');
                Route::get('edit/{id}',                 'VenueController@edit')->name('edit');
                Route::put('update/{id}',               'VenueController@update')->name('update');
                Route::get('delete/{id}',               'VenueController@delete')->name('delete');
            });
        });


        Route::group(['prefix' => 'pincode', 'middleware' => ['AdminPermissionCheck:PincodeController']], function(){

            // Pincode routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'pincode.'], function(){
                Route::get('list/',                     'PincodeController@index')->name('index');
                Route::post('fetch-data/',              'PincodeController@fetchData')->name('fetch.data');
                Route::get('create/',                   'PincodeController@create')->name('create');
                Route::post('store/',                   'PincodeController@store')->name('store');
                Route::get('show/{id}',                 'PincodeController@show')->name('show');
                Route::get('edit/{id}',                 'PincodeController@edit')->name('edit');
                Route::put('update/{id}',               'PincodeController@update')->name('update');
                Route::get('delete/{id}',               'PincodeController@delete')->name('delete');
            });
        });

        Route::group(['prefix' => 'festival', 'middleware' => ['AdminPermissionCheck:FestivalController']], function(){

            // Festival routes
            Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'festival.'], function(){
                Route::get('list/',                     'FestivalController@index')->name('index');
                Route::post('fetch-data/',              'FestivalController@fetchData')->name('fetch.data');
                Route::get('create/',                   'FestivalController@create')->name('create');
                Route::post('store/',                   'FestivalController@store')->name('store');
                Route::get('show/{id}',                 'FestivalController@show')->name('show');
                Route::get('edit/{id}',                 'FestivalController@edit')->name('edit');
                Route::put('update/{id}',               'FestivalController@update')->name('update');
                Route::get('delete/{id}',               'FestivalController@delete')->name('delete');
            });
        });

    });
});