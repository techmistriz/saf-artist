<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::get('/clear-cache', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
   return "Cleared!";

});

Route::get('/clear-flush', function() {

    Artisan::call('cache:flush');
   return "Cleared!";
   
});


Route::get('/route-test', function (Request $request) {

	$usercreate = [
	    'email' => 'support@testmail.com',
	    'password' => \Hash::make('123456'),
	];

	//      \App\User::create($usercreate);

	 $cred = [
            'email' => 'support@testmail.com',
            'password' => '123456',
        ];
    return ["success"=>1, "message"=>'Success', 'attempt' => \Auth::attempt($cred), 'user_submit' => $cred, 'user' => \Auth::user()];
});


/* Static routes
 */
Route::get('/', 'HomeController@index');
Route::get('/Terms-of-Use', 'FooterController@terms');
Route::get('/Privacy-Policy', 'FooterController@privacy');

/* Registration route
 */
Route::get('register', 'Auth\AuthController@getRegister');
Route::get('soar', 'Auth\AuthController@soar');
Route::get('newtampa', 'Auth\AuthController@newtampa');
Route::get('pathtomastery', 'Auth\AuthController@pathtomastery');
Route::get('class', 'Auth\AuthController@classpage');
Route::get('bold', 'Auth\AuthController@boldpage');
Route::get('activechoices', 'Auth\AuthController@activeChoices');
Route::get('noagentleftbehind', 'Auth\AuthController@noagentleftbehind');
Route::get('MAPS', 'Auth\AuthController@mapspage');
Route::get('maps', 'Auth\AuthController@mapspage');
Route::get('referthree', 'Auth\AuthController@referthree');
Route::get('titansprofit', 'Auth\AuthController@titansprofit');
Route::get('cassyliles', 'Auth\AuthController@cassyliles');

Route::get('testlogin', 'Auth\AuthController@testlogin');

Route::get('kwplatinum', 'Auth\AuthController@kwplatinum');
Route::get('KWPlatinum', 'Auth\AuthController@kwplatinum');
Route::get('nalb/cassyliles', 'Auth\AuthController@cassylilesnalb');
Route::get('drulee', 'Auth\AuthController@drulee');
Route::get('amina', 'Auth\AuthController@amina');

Route::get('kw-initiate-login', 'Auth\AuthController@kwInitiateLogin');
Route::get('kw-callback', 'Auth\AuthController@kwCallback');


Route::post('registermobile', 'Auth\AuthController@registerMobile');
Route::post('updatesubscriptionmobile', 'Auth\AuthController@updateSubscriptionMobile');
Route::post('altLogin', 'Auth\AuthController@altLogin');
// Authentication routes
//Route::post('auth/login', 'Auth\AuthController@postLogin');

Route::get('profile', 'Auth\UserController@editView');
Route::get('subscription', 'Auth\UserController@editBillingView');
Route::put('users/self/update', 'Auth\UserController@update');
Route::get('users/self', 'Auth\UserController@getCurrentUser');
Route::put('users/self/update-subscription', 'Auth\UserController@updateSubscription');
Route::put('users/self/cancel-subscription', 'Auth\UserController@cancelSubscription');
Route::put('users/self/resume-subscription', 'Auth\UserController@resumeSubscription');
Route::put('users/self/update-payment', 'Auth\UserController@updatePayment');
Route::get('users/self/preference', 'Auth\UserController@getUserPreference');
Route::put('users/self/preference', 'Auth\UserController@setUserPreference');

//our market centers
Route::get('get-market-centers', 'MarketCenterController@getDetailedMarketCategories');

//Referral Types
Route::get('referral-types', 'WelcomeController@getReferralTypes');

//register/management page
Route::post('cardUpdate', 'Auth\UserController@putUpdateCC');
Route::post('controlplan', 'Auth\UserController@controlPlan');
Route::post('UpdateStates', 'Auth\AuthController@state');
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'myaccount' => 'Auth\UserController'
]);
Route::get('myaccount/edit/{id}', 'Auth\UserController@getEdit');
Route::put('myaccount/updateaccount/{id}', [
    'as' => 'updateaccount', 'uses' => 'Auth\UserController@putUpdateAccount'
]);
Route::put('myaccount/updatecc/{id}', [
    'as' => 'updatecc', 'uses' => 'Auth\UserController@putUpdateCC'
]);

/* Update routes
 */
Route::post('updateaccountdata', 'UpdateController@index');


/* Dashboard routes
 */
Route::get('home', 'Report\ReportController@PLReport');
Route::get('exportcsv', 'Report\PLReportController@exportCSV');
Route::get('dashboard', 'DashboardController@index');
Route::post('dashboard/fisearch', 'DashboardController@fisearch');
Route::get('dashboard/addfi/{id}', 'DashboardController@addfi');
Route::get('dashboard/editfi/{id}', 'DashboardController@editfi');

/* FIData routes
 */
Route::get('fidata/getaccounts', 'FIDataController@getAccounts');
Route::post('fidata/addaccount', 'FIDataController@addFIaccount');
Route::get('fidata/deletecustomer', 'FIDataController@deleteCustomer');
Route::post('fidata/updateaccount', 'FIDataController@editFIaccount');
Route::get('fidata/deleteaccount', 'FIDataController@deleteFIaccount');


/* Accounts routes
 */
Route::resource('accounts', 'AccountController');
Route::get('account/debittranscats/{tran_id}', 'AccountController@debittranscats');
Route::post('account/updatetrans', 'AccountController@updatetrans');
Route::get('account/transactionDescription', 'AccountController@transactionDescription');
Route::get('account/addtransactionsdesc/{id}', 'AccountController@addtransactionsDesc');
Route::get('account/splittransaction/{id}', 'AccountController@splittransaction');
Route::post('account/deletetrans/{id}', 'AccountController@deletetrans');
Route::get('account/{id?}/page/{page?}', 'AccountController@accountDetails');
Route::get('account/{id?}', 'AccountController@accountDetails');
Route::delete('account/delete/{id}', [
    'as' => 'account.destroysub',
    'uses' => 'AccountController@destroySubAccount'
]);
Route::get('subaccount/{id?}/{subid?}/reactivate', 'AccountController@reactiveSubAccount');
Route::get('subaccount/{id?}/{subid?}/page/{page?}', 'AccountController@accountDetail');
Route::get('subaccount/{id?}/{subid?}', 'AccountController@accountDetail');
Route::get('account/{id}/{subid}/transactions', 'AccountController@transactions');
Route::post('account/requesttransactions', 'AccountController@requesttransactions');
Route::post('account/addtransactionsdescinfo', 'AccountController@addtransactionsDescInfo');

//Budget Routes
Route::resource('budgets', 'BudgetController');


/* Users routes
 */
Route::post('comment', 'Auth\UserController@doComment');
Route::post('like', 'Auth\UserController@doLike');
//Route::get('training', 'Auth\UserController@training');
Route::get('settings', 'Auth\UserController@viewSettings');


/* BudgetReport routes
 */
Route::post('getbugets', 'Report\BudgetReportController@index');
Route::get('get-budget-summary', 'Report\PLReportController@getBudgetSummary');


/* Report routes
 */
Route::get('ROI', 'Report\ReportController@ROI');
Route::get('PLReport', 'Report\ReportController@PLReport');
//Route::get('budget-reports', 'Report\ReportController@index');

/* Accounts routes
 */
Route::post('getroireport', 'Report\ROIReportController@index');

/* PL Report routes
 */
//Route::post('getPLReport', 'Report\PLReportController@index');
Route::post('getPLReportnav', 'Report\PLReportController@navCalculations');
Route::get('income-details', 'Report\PLReportController@getIncomeDetails');
Route::get('cost-of-sales-details', 'Report\PLReportController@getCostOfSalesDetails');
Route::get('pl-summary', 'Report\PLReportController@getPLSummary');
Route::get('expense-categories', 'Report\PLReportController@getExpenseCategories');
Route::put('update-tax-estimate', 'Report\PLReportController@putUpdateTaxEstimate');

/* ROI Report routes
 */
Route::get('get-roi-summary', 'Report\ROIReportController@getRoiTotals');

/* Transaction routes
*/
Route::delete('transactions/bulk-delete', 'TransactionController@destroyInBulk');
Route::delete('transactions/bulk-delete-permanently', 'TransactionController@destroyPermanentlyInBulk');
Route::put('transactions/bulk-restore', 'TransactionController@restoreInBulk');
Route::post('transactions/bulk-undo', 'TransactionController@undoInBulk');
Route::post('transactions/undo-last-import/{id}', 'TransactionController@undoLastImport');
Route::post('transactions/split-transaction/{id}', 'TransactionController@split');
Route::post('transactions/transaction-description/{id}', 'TransactionController@description');
Route::post('transactions/transaction-details/{id}', 'TransactionController@details');
Route::resource('transactions', 'TransactionController');
Route::get('v/transactions', 'TransactionController@indexView');

/* Transaction Category routes
*/
Route::resource('transaction-categories', 'TransactionCategoryController');

/* Transaction Subcategory routes
*/
Route::resource('transaction-subcategories', 'TransactionSubcategoryController');
Route::get('detailed-transaction-subcategories', 'TransactionSubcategoryController@getDetailedSubcategories');

// Financial Account routes
Route::put('financial-accounts/restore-subaccounts', 'FinancialAccountController@restoreWithSubaccounts');
Route::put('financial-accounts/merge', 'FinancialAccountController@merge');
Route::resource('financial-accounts', 'FinancialAccountController');
Route::get('financial-accounts/purge/{id}', 'FinancialAccountController@destroyAndPurge');
Route::get('financial-accounts/finicity-redirect', 'FinancialAccountController@finicityRedirect');
Route::get('financial-accounts/connect-fix/{id}', 'FinancialAccountController@connectFix');
Route::put('financial-accounts/restore/{id}', 'FinancialAccountController@restore');
Route::put('financial-accounts/refresh/{id}', 'FinancialAccountController@refreshInstitutionLogin');
Route::put('financial-accounts/restore-including-subaccounts/{id}', 'FinancialAccountController@restoreIncludingSubaccounts');
Route::put('financial-accounts/archive/{id}', 'FinancialAccountController@archive');
Route::put('financial-accounts/modify-credentials/{id}', 'FinancialAccountController@modifyFinancialInstitutionLoginCredentials');

Route::get('/v/financial-accounts/refresh/{id}', 'FinancialAccountController@reauthenticateView');

Route::get('/v/financial-accounts', 'FinancialAccountController@indexView');



// Financial Subccount routes
Route::resource('financial-subaccounts', 'FinancialSubaccountController');
Route::put('financial-subaccounts/restore/{id}', 'FinancialSubaccountController@restore');
Route::put('financial-subaccounts/archive/{id}', 'FinancialSubaccountController@archive');


//Financial Institution routes
Route::get('financial-institutions/search', 'FinancialInstitutionController@searchFinancialInstitution');
Route::get('financial-institutions/{id}', 'FinancialInstitutionController@show');

// Routes used for importing csv file
Route::post('addTransaction', 'ImportController@addTransaction');
Route::post('importFile', 'ImportController@importCSV');
Route::post('importQFXFile', 'ImportController@importQuickbookFile');
Route::post('undo-last-import/{id}', 'ImportController@undoLastImport');

// Mileage
Route::get('mileage/all', 'MileageController@all');
Route::post('mileage/save', 'MileageController@save');
Route::get('mileage/report', 'MileageController@report');
Route::get('mileage/export', 'MileageController@export');

// Stripe webhook
Route::post('stripe-webhook', 'StripeWebhookController@webhook');
Route::get('stripe-replay', 'StripeWebhookController@replay');


// Display all SQL executed in Eloquent
// Event::listen('illuminate.query', function($query)
// {
//     var_dump($query);
// });

//FINICITY TEST
Route::get('finicity/login', 'WelcomeController@finRefreshOAuth');


Route::group(['middleware' => ['auth', 'transition']], function() {
   Route::get('admin/', function() {});
   Route::post('admin/impersonate', function() {});
});

// Route::get('finicity/institutions', 'WelcomeController@finGetInstitutions');
// Route::get('finicity/institutionLogin', 'WelcomeController@finGetInstitutionLoginForm');
// Route::get('finicity/searchusers', 'WelcomeController@finSearchUsers');
// Route::get('finicity/addtestuser', 'WelcomeController@finAddTestUser');
// Route::get('finicity/deleteuser', 'WelcomeController@finDeleteUser');
// Route::get('finicity/discoveraccounts', 'WelcomeController@finDiscoverFinancialAccount');
// Route::get('finicity/submitmfa', 'WelcomeController@finSubmitMFAAnswers');
// Route::get('finicity/transactions', 'WelcomeController@finGetTransactions');
// Route::get('finicity/activateaccounts', 'WelcomeController@finActivateCustomerAccounts');
// Route::get('finicity/refreshaccount', 'WelcomeController@finRefreshCustomerAccount');




