<?php

use Illuminate\Support\Facades\Route;

Route::get('reporter/login', 'Reporter\ReporterLoginController@LoginForm');
Route::post('reporter/validate-reporter-login', 'Reporter\ReporterLoginController@validateReporterLogin')->name('validate.reporter.login');
Route::post('reporter/send-reporter-email-otp', 'Reporter\ReporterLoginController@sendReporterEmailOtp')->name('send.reporter.email.otp');
Route::post('reporter/verify-reporter-email-otp', 'Reporter\ReporterLoginController@verifyReporterEmailOtp')->name('verify.reporter.email.otp');
Route::post('reporter/login', 'Reporter\ReporterLoginController@login')->name('reporterLogin');
Route::post('reporter/logout', 'Reporter\ReporterLoginController@logout')->name('reporterLogout');

Route::get('reporter/register', 'Reporter\ReporterRegController@registerForm')->name('reporterRegister');
Route::post('reporter/register', 'Reporter\ReporterRegController@register')->name('reporterRegister');
Route::get('get_ upazila/by-zilla/{id}', 'AjaxController@get_upazila_by_zilla')->name('get_upazila_by_zilla');

//reset for
Route::get('reporter/password/recover', 'Auth\ForgotPasswordController@reporterPasswordRecover')->name('reporter.password.recover');
//forgot password notify send
Route::match(array('GET','POST'), 'reporter/password/recover/notify', 'Auth\ForgotPasswordController@reporterPasswordRecoverNotify')->name('reporter.password.recover');
//verify token or otp
Route::get('reporter/password/recover/verify', 'Auth\ForgotPasswordController@reporterPasswordRecoverVerify')->name('reporter.password.recoverVerify');
//passord update
Route::post('reporter/password/recover/update', 'Auth\ForgotPasswordController@reporterPasswordRecoverUpdate')->name('reporter.password.recoverUpdate');

// Authenticate routes & check role reporter
route::group(['middleware' => ['auth:reporter'], 'prefix' => 'reporter'], function(){

	//namespace 
	route::group(['namespace' => 'Reporter'], function(){

		Route::get('/', 'ReporterController@dashboard')->name('reporter.dashboard');
		Route::get('profile', 'ReporterController@profileEdit')->name('reporter.profile');
		Route::post('profile/update', 'ReporterController@profileUpdate')->name('reporter.profileUpdate');
				//profile image change for all user
		Route::post('change/profile/image', 'ReporterController@changeProfileImage')->name('reporter.changeProfileImage');
 		
		Route::get('change-password', 'ReporterController@passwordChange')->name('reporter.change-password');
		Route::post('change-password', 'ReporterController@passwordUpdate')->name('reporter.change-password');
		//Bangla News Route
	    Route::get('news/create', 'ReporterNewsController@create')->name('reporter.news.create');
	    Route::post('news/store', 'ReporterNewsController@store')->name('reporter.news.store');
	    Route::get('news/edit/{news_slug}', 'ReporterNewsController@edit')->name('reporter.news.edit');
	    Route::post('news/update/{id}', 'ReporterNewsController@update')->name('reporter.news.update');
	   	Route::get('news/list/{status?}', 'ReporterNewsController@index')->name('reporter.news.list');
	   	Route::get('news/delete/{id}', 'ReporterNewsController@delete')->name('reporter.news.delete');

	   	Route::get('wallet', 'WalletController@walletHistory')->name('reporter.walletHistory');
		Route::post('wallet/withdraw/request', 'WalletController@withdrawRequest')->name('reporter.withdrawRequest');

	
		//working task routes
		route::get('working/task/create/new', 'WorkingTaskController@workingTaskCreate')->name('reporter.workingTaskCreate');
		route::get('working/task/{type?}', 'WorkingTaskController@workingTask')->name('reporter.workingTask');
		route::post('working/task/store/{update?}', 'WorkingTaskController@workingTaskStore')->name('reporter.workingTask.store');
		route::get('working/task/edit/{slug}', 'WorkingTaskController@workingTaskEdit')->name('reporter.workingTask.edit');
		route::get('working/task/details/{slug}/{conversation?}', 'WorkingTaskController@workingTaskDetails')->name('reporter.workingTaskDetails');
		route::post('working/task/conversation', 'WorkingTaskController@workingTaskConversation')->name('reporter.workingTaskConversation');
		route::get('working/task/delete/{id}', 'WorkingTaskController@workingTaskDelete')->name('workingTask.delete'); 
		route::get('working/task/status/{slug}', 'WorkingTaskController@workingTaskStatus')->name('reporter.workingTaskStatus');
	});


});


