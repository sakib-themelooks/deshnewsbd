<?php

use Illuminate\Support\Facades\Route;

route::group(['middleware' => ['auth']], function(){

});

//profile image change for all user
Route::post('change/profile/image', 'AjaxController@changeProfileImage')->name('changeProfileImage');

//ajax route
Route::get('get_subcategoryBy_id/{id}', 'AjaxController@get_subcategoryBy_id')->name('get_subcategory');

Route::get('get_district/{id}', 'AjaxController@get_district')->name('get_district');

Route::get('get/upazila/{id}', 'AjaxController@get_upazila')->name('get_upzilla');

Route::get('check/unique/value', 'AjaxController@checkField')->name('checkField');

//delete data common all table
Route::get('/delete/data/common', 'AjaxController@deleteDataCommon')->name('deleteDataCommon');

//get search keyword in header
Route::get('search/keyword', 'AjaxController@search_keyword')->name('search_keyword');

//change status active/deactive
Route::get('status/change', 'AjaxController@satusActiveDeactive')->name('statusChange');
Route::get('status/approve/Unapprove', 'AjaxController@approveUnapprove')->name('approveUnapprove');
Route::get('news/approval/{id}', 'AjaxController@newApproveUnapprove')->name('newApproveUnapprove');
Route::get('breaking_news/{status}', 'AjaxController@breaking_news')->name('breaking_news');

Route::get('currency/change', 'CurrencyController@changeCurrency')->name('changeCurrency');
//get products by anyone field
Route::get('get/products/by/{field}', 'AjaxController@getProductsByField')->name('admin.getProductsByField');

//position sorting
Route::get('position/sorting', 'AjaxController@positionSorting')->name('positionSorting');

Route::get('news-slug/create', 'AjaxController@createUniqueSlug')->name('news.slug');
Route::get('news/selectImage', 'AjaxController@selectImage')->name('selectImage');
Route::get('photo/file/browse/', 'AjaxController@photoFileBrowse')->name('photoFileBrowse');

Route::get('get/state/{country_id?}', 'AjaxController@get_state')->name('get_state');
Route::get('get/city/{state_id?}', 'AjaxController@get_city')->name('get_city');
Route::get('get/area/{city_id?}', 'AjaxController@get_area')->name('get_area');