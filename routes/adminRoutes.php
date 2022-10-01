<?php

use Illuminate\Support\Facades\Route;

	Route::get('/login', 'Backend\AdminLoginController@LoginForm')->name('adminLoginForm');
	Route::post('/validate-login-credentials', 'Backend\AdminLoginController@validateLoginCredentials')->name('validate.login.credentials');
	Route::post('/verify-email-otp', 'Backend\AdminLoginController@verifyEmailOtp')->name('verify.email.otp');
	
	Route::post('/send-email-otp', 'Backend\AdminLoginController@sendEmailOtp')->name('send.email.otp');
	Route::post('/login', 'Backend\AdminLoginController@login')->name('adminLogin');
	Route::get('/register', 'Backend\AdminLoginController@RegisterForm')->name('adminRegisterForm');
	Route::post('/register', 'Backend\AdminLoginController@register')->name('adminRegister');
	Route::post('/logout', 'Backend\AdminLoginController@logout')->name('adminLogout');

	route::get('message/{username?}', 'MessageController@message')->name('messageAdmin');
    //not use now
    // Route::post('news/image_upload', 'NewsController@image_upload')->name('image_upload');

	
	Route::prefix('photo')->name('photo.')->group( function(){
	    Route::get('gallery', 'Backend\MediaGalleryController@photo_list')->name('gallery');
	    Route::get('create', 'Backend\MediaGalleryController@photo_create')->name('create');
	    Route::post('upload', 'Backend\MediaGalleryController@photo_upload')->name('upload');
	    Route::get('edit/{id}', 'Backend\MediaGalleryController@photo_edit')->name('edit');
	    Route::post('update', 'Backend\MediaGalleryController@photo_update')->name('update');
	    Route::get('delete/{id}', 'Backend\MediaGalleryController@photo_delete')->name('delete');

	    Route::post('upload/CKEditor', 'Backend\MediaGalleryController@photo_uploadCKEditor')->name('photo_uploadCKEditor');
	});

	Route::prefix('video')->name('video.')->group( function(){
	    Route::get('gallery', 'Backend\MediaGalleryController@video_list')->name('gallery');
	    Route::get('create', 'Backend\MediaGalleryController@video_create')->name('create');
	    Route::post('upload', 'Backend\MediaGalleryController@video_upload')->name('upload');
	    Route::get('edit/{id}', 'Backend\MediaGalleryController@video_edit')->name('edit');
	    Route::post('update', 'Backend\MediaGalleryController@video_update')->name('update');
	    Route::get('delete/{id}', 'Backend\MediaGalleryController@video_delete')->name('delete');
	});

		Route::group(['middleware' => 'auth:admin'], function(){
		Route::get('manage/menus/{id?}','MenuItemController@index')->name('menuBuilder');
		Route::post('create/menu','MenuItemController@store')->name('createMenu');	
		Route::get('add/item/menu','MenuItemController@addItemToMenu')->name('addItemToMenu');
		Route::get('update/menu','MenuItemController@updateMenu')->name('updateMenu');	
		Route::post('update/menuitem/{id}','MenuItemController@updateMenuItem')->name('updateMenuItem');
		Route::get('delete/menuitem/{id}','MenuItemController@deleteMenuItem')->name('deleteMenuItem');
		Route::get('delete/menu/{id}','MenuItemController@destroy')->name('deleteMenu');	
	});

	Route::prefix('service')->name('service.')->group( function(){
		Route::get('list', 'ServiceController@index')->name('list');
		Route::get('create', 'ServiceController@create')->name('create');
		Route::post('store', 'ServiceController@store')->name('store');
		Route::get('edit/{slug}', 'ServiceController@edit')->name('edit');
		Route::post('update/{id}', 'ServiceController@update')->name('update');
		Route::get('delete/{id}', 'ServiceController@delete')->name('delete');
	});	

	Route::get('service/query', 'ServiceController@serviceQueryList')->name('serviceQueryList');


	Route::prefix('service-type')->name('serviceType.')->group( function(){
		Route::get('list', 'ServiceController@serviceTypeList')->name('list');
		Route::get('create', 'ServiceController@serviceTypeCeate')->name('create');
		Route::post('store', 'ServiceController@serviceTypeStore')->name('store');
		Route::get('edit/{slug}', 'ServiceController@serviceTypeEdit')->name('edit');
		Route::post('update', 'ServiceController@serviceTypeUpdate')->name('update');
		Route::get('delete/{id}', 'ServiceController@serviceTypeDelete')->name('delete');
	});

Route::group(['middleware' => 'auth:admin', 'namespace' => 'Backend'], function(){

	Route::get('/', 'DashboardController@dashboard')->name('admin.dashboard');

	//setting
	Route::get('general/setting', 'GeneralSettingController@generalSetting')->name('generalSetting');
	Route::post('general/setting/update/{id}', 'GeneralSettingController@generalSettingUpdate')->name('generalSettingUpdate');

	Route::get('logo/setting', 'GeneralSettingController@logoSetting')->name('logoSetting');
	Route::post('logo/setting/update/{id}', 'GeneralSettingController@logoSettingUpdate')->name('logoSettingUpdate');
	Route::match(['get', 'post'], 'google/setting', 'GeneralSettingController@googleSetting')->name('googleSetting');
	Route::match(['get', 'post'], 'google/recaptcha', 'SiteSettingController@google_recaptcha')->name('google_recaptcha');
	Route::get('popular/news/day', 'SiteSettingController@popularNewsCountDay')->name('popularNewsCountDay');
	Route::get('news/view/amount', 'SiteSettingController@news_view_amount')->name('news_view_amount');
	Route::match(['get', 'post'], 'seo/setting', 'GeneralSettingController@seoSetting')->name('seoSetting');
	Route::post('sitemap/setting','SitemapController@sitemapSetting')->name('sitemapSetting');

	Route::get('header/setting', 'GeneralSettingController@headerSetting')->name('headerSetting');
	Route::post('header/setting/update/{id}', 'GeneralSettingController@headerSettingUpdate')->name('headerSettingUpdate');
	Route::get('footer/setting', 'GeneralSettingController@footerSetting')->name('footerSetting');
	Route::post('footer/setting/update/{id}', 'GeneralSettingController@footerSettingUpdate')->name('footerSettingUpdate');

	Route::get('profile/update', 'AdminController@profileEdit')->name('admin.profileUpdate');
	Route::post('profile/update', 'AdminController@profileUpdate')->name('admin.profileUpdate');

	Route::get('change/password', 'AdminController@passwordChange')->name('admin.passwordChange');
	Route::post('change/password', 'AdminController@passwordUpdate')->name('admin.passwordChange');

	Route::get('social/login/setting', 'SocialController@socialLoginSetting')->name('socialLoginSetting');
	Route::post('social/login/setting/update', 'SocialController@socialLoginSettingUpdate')->name('socialLoginSettingUpdate');

	Route::get('social/setting', 'SocialController@socialSetting')->name('socialSetting');
	Route::post('social/setting/store', 'SocialController@socialSettingStore')->name('socialSettingStore');
	Route::get('social/setting/edit/{id}', 'SocialController@socialSettingEdit')->name('socialSettingEdit');
	Route::post('social/setting/update/{id}', 'SocialController@socialSettingUpdate')->name('socialSettingUpdate');
	Route::get('social/setting/delete/{id}', 'SocialController@socialSettingDelete')->name('socialSettingDelete');

	// site setting
	Route::get('site/setting', 'SiteSettingController@siteSettings')->name('site_settings');
	Route::get('smtp/configurations', 'SiteSettingController@smtp_settings')->name('smtp_settings');
	Route::match(['get', 'post'], 'otp/configurations', 'SiteSettingController@otp_configurations')->name('otp_configurations');
	Route::post('env_key_update', 'SiteSettingController@env_key_update')->name('env_key_update');
	Route::post('update-verification-media', 'SiteSettingController@updateVerificationMedia')->name('update.verification.media');

	Route::get('site/setting/update/status', 'SiteSettingController@siteSettingActiveDeactive')->name('siteSettingActiveDeactive');
	Route::post('site/setting/update/status', 'SiteSettingController@siteSettingActiveDeactive')->name('siteSettingActiveDeactive');
	Route::match(['get', 'post'], 'site/setting/update', 'SiteSettingController@siteSettingUpdate')->name('siteSettingUpdate');

	//category
	Route::get('category', 'CategoryController@index')->name('category.list');
	Route::get('category/create', 'CategoryController@create')->name('category.create');
	Route::post('category/store', 'CategoryController@store')->name('category.store');
	Route::get('category/show/{id}', 'CategoryController@show')->name('category.show');
	Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
	Route::post('category/update', 'CategoryController@update')->name('category.update');
	Route::get('category/delete/{id}', 'CategoryController@delete')->name('category.delete');

	Route::get('subcategory', 'CategoryController@subcategory')->name('subcategory.list');
	Route::post('subcategory/store', 'CategoryController@subcategory_store')->name('subcategory.store');
	Route::get('subcategory/edit/{id}', 'CategoryController@subcategory_edit')->name('subcategory.edit');
	Route::post('subcategory/update', 'CategoryController@subcategory_update')->name('subcategory.update');
	Route::get('subcategory/delete/{id}', 'CategoryController@subcategory_delete')->name('subcategory.delete');

	Route::get('subchild/category', 'CategoryController@subchildcategory')->name('subchildcategory');
	Route::post('subchild/category/store', 'CategoryController@subchildcategory_store')->name('subchildcategory.store');
	Route::get('subchild/category/edit/{id}', 'CategoryController@subchildcategory_edit')->name('subchildcategory.edit');
	Route::post('subchild/category/update', 'CategoryController@subchildcategory_update')->name('subchildcategory.update');
	Route::get('subchild/category/delete/{id}', 'CategoryController@subchildcategory_delete')->name('subchildcategory.delete');
	
	
	// banner routes
	Route::get('banner/list/{type?}', 'BannerController@index')->name('banner');
	Route::post('banner/store', 'BannerController@store')->name('banner.store');

	Route::get('banner/{id}/edit', 'BannerController@edit')->name('banner.edit');
	Route::post('banner/update', 'BannerController@update')->name('banner.update');
	Route::get('banner/delete/{id}', 'BannerController@delete')->name('banner.delete');
	Route::get('banner/image/delete', 'BannerController@bannerImage_delete')->name('bannerImage_delete');

	Route::prefix('division')->name('division.')->group( function() {
        Route::get('/', 'DeshjureController@division')->name('index');
        Route::post('store', 'DeshjureController@division_store')->name('store');
        Route::get('edit/{id}', 'DeshjureController@division_edit')->name('edit');
        Route::post('update', 'DeshjureController@division_update')->name('update');
        Route::get('delete/{id}', 'DeshjureController@division_delete')->name('delete');
    });
    Route::prefix('district')->name('district.')->group( function() {
        Route::get('/', 'DeshjureController@district')->name('index');
        Route::post('store', 'DeshjureController@district_store')->name('store');
        Route::get('edit/{id}', 'DeshjureController@district_edit')->name('edit');
        Route::post('update', 'DeshjureController@district_update')->name('update');
        Route::get('delete/{id}', 'DeshjureController@district_delete')->name('delete');
    });
    Route::prefix('upzilla')->name('upzilla.')->group( function() {
        Route::get('/', 'DeshjureController@upzilla')->name('index');
        Route::post('store', 'DeshjureController@upzilla_store')->name('store');
        Route::get('edit/{id}', 'DeshjureController@upzilla_edit')->name('edit');
        Route::post('update', 'DeshjureController@upzilla_update')->name('update');
        Route::get('delete/{id}', 'DeshjureController@upzilla_delete')->name('delete');
	});

	Route::get('speciality', 'SpecialityController@index')->name('speciality.list');
	Route::get('speciality/create', 'SpecialityController@create')->name('speciality.create');
	Route::post('speciality/store', 'SpecialityController@store')->name('speciality.store');
	Route::get('speciality/show/{id}', 'SpecialityController@show')->name('speciality.show');
	Route::get('speciality/edit/{id}', 'SpecialityController@edit')->name('speciality.edit');
	Route::post('speciality/update', 'SpecialityController@update')->name('speciality.update');
	Route::get('speciality/delete/{id}', 'SpecialityController@delete')->name('speciality.delete');

	// homepage routes
	Route::get('homepage/section', 'HomepageSectionController@index')->name('admin.homepageSection');
	Route::post('homepage/section/store', 'HomepageSectionController@store')->name('admin.homepageSection.store');
	Route::get('homepage/section/edit/{id}', 'HomepageSectionController@edit')->name('admin.homepageSection.edit');
	Route::post('homepage/section/update', 'HomepageSectionController@update')->name('admin.homepageSection.update');
	Route::get('homepage/section/delete/{id}', 'HomepageSectionController@delete')->name('admin.homepageSection.delete');
	Route::get('homepage/section/sorting', 'HomepageSectionController@homepageSectionSorting')->name('admin.homepageSectionSorting');
		Route::get('homepage/section/image/delete/{id}', 'HomepageSectionController@sectionImageDelete')->name('sectionImageDelete');


	// homepage section routes
	Route::get('page/section/item/{slug?}', 'HomepageSectionItemController@index')->name('admin.homepageSectionItem');
	Route::post('page/section/item/store', 'HomepageSectionItemController@store')->name('admin.homepageSectionItem.store');
	Route::get('page/section/item/edit/{id}', 'HomepageSectionItemController@edit')->name('admin.homepageSectionItem.edit');
	Route::post('page/section/item/update', 'HomepageSectionItemController@update')->name('admin.homepageSectionItem.update');
	Route::get('page/section/item/remove/{id}', 'HomepageSectionItemController@itemRemove')->name('admin.homepageSectionItem.remove');

	//get course ajax request
	Route::get('section/get/all/course', 'HomepageSectionItemController@getAllItems')->name('section.getAllItems');
	Route::get('section/get/all/categories', 'HomepageSectionItemController@getAllcategories')->name('section.getAllcategories');
	Route::get('section/get/all/banners', 'HomepageSectionItemController@getAllBanners')->name('section.getAllBanners');

	Route::get('section/single/item/store', 'HomepageSectionItemController@sectionSingleItemStore')->name('admin.sectionSingleItemStore');
	Route::post('section/item/store', 'HomepageSectionItemController@sectionMultiItemStore')->name('admin.sectionMultiItemStore');

 	//Bangla News Route
    Route::get('news/create', 'NewsController@create')->name('news.create');
    Route::get('news/edit/{news_slug}', 'NewsController@edit')->name('news.edit');
   	Route::get('news/list/{status?}', 'NewsController@index')->name('news.list');

    //English News Route
    Route::get('english/news/create', 'EnglishNewsController@create')->name('englishNews.create');
    Route::get('english/news/edit/{news_slug}', 'EnglishNewsController@edit')->name('englishNews.edit');
    Route::get('english/news/{status?}', 'EnglishNewsController@index')->name('englishNews.list');
 
   	//store, update, delete route same both news
   	Route::post('news/store', 'NewsController@store')->name('news.store');
    Route::post('news/update/{id}', 'NewsController@update')->name('news.update');
    Route::get('news/delete/{id}', 'NewsController@delete')->name('news.delete');
    Route::get('news/attachFile/delete/{id}', 'NewsController@deleteAttachFile')->name('deleteAttachFile');

    // payment route
	Route::get('payment/gateway', 'PaymentGatewayController@index')->name('paymentGateway');
	Route::post('payment/gateway/store', 'PaymentGatewayController@store')->name('paymentGateway.store');
	Route::get('payment/gateway/edit/{id}', 'PaymentGatewayController@edit')->name('paymentGateway.edit');
	Route::post('payment/gateway/update', 'PaymentGatewayController@update')->name('paymentGateway.update');
	Route::get('payment/gateway/delete/{id}', 'PaymentGatewayController@delete')->name('paymentGateway.delete');

    //withdraw request list
    Route::get('wallet/withdraw/configuration', 'WithdrawController@userWithdrawConfigure')->name('withdrawConfigure');
	Route::get('wallet/withdraw/request', 'WithdrawController@withdrawRequest')->name('withdrawRequest');
	Route::get('get/withdraw/history/{user_id}', 'WithdrawController@getWithdrawHistory')->name('getWithdrawHistory');
	Route::get('withdraw/request/update', 'WithdrawController@changeWithdrawStatus')->name('changeWithdrawStatus');
	Route::get('transactions', 'WithdrawController@wallet_transactions')->name('admin.transactions');

	Route::post('wallet/recharge', 'WithdrawController@walletRecharge')->name('walletRecharge');
	Route::get('get/wallet/information', 'WithdrawController@getWalletInfo')->name('getWalletInfo');
 
	Route::prefix('reporter')->name('reporter.')->group( function(){
	    Route::get('list/{status?}', 'ReporterController@index')->name('list');
	    Route::get('create', 'ReporterController@create')->name('create');
	    Route::post('store', 'ReporterController@store')->name('store');
	    Route::get('edit/{id}', 'ReporterController@edit')->name('edit');
	    Route::post('update/{id}', 'ReporterController@update')->name('update');
	    Route::get('delete/{id}', 'ReporterController@delete')->name('delete');
	    Route::get('status/{id}', 'ReporterController@reporterStatus')->name('status');
	    Route::get('reporter/secret/login/{id}', 'ReporterController@reporterSecretLogin')->name('secretLogin');
	    Route::get('profile/{slug}', 'ReporterController@reporterProfile')->name('viewProfile');
	});

	Route::prefix('reporter-request')->name('reporterRequest.')->group( function(){
	    Route::get('list', 'ReporterController@manage_request')->name('list');
	    Route::get('rejected/List', 'ReporterController@rejectedList')->name('rejectedList');
	    Route::get('AcceptReject/{status}', 'ReporterController@statusAcceptReject')->name('status');
	});

	Route::prefix('user')->name('admin.')->group( function() {
		Route::post('store', 'UserAdminController@store')->name('user.store');
		Route::get('edit/{id}', 'UserAdminController@edit')->name('user.edit');
		Route::post('update', 'UserAdminController@update')->name('user.update');
		Route::get('delete/{id}', 'UserAdminController@delete')->name('user.delete');

		Route::get('list/{status?}', 'UserAdminController@userList')->name('user.list');
		Route::get('secret/login/{id}', 'UserAdminController@userSecretLogin')->name('userSecretLogin');
		Route::get('profile/{username}', 'UserAdminController@userProfile')->name('userProfile');
	});


	Route::prefix('page')->name('page.')->group( function(){
		Route::get('list', 'PageController@list')->name('list');
		Route::get('create', 'PageController@create')->name('create');
		Route::post('store', 'PageController@store')->name('store');
		Route::get('edit/{slug}', 'PageController@edit')->name('edit');
		Route::post('update', 'PageController@update')->name('update');
		Route::get('delete/{id}', 'PageController@delete')->name('delete');
	});

	// page section routes
	Route::get('section/{page_slug}', 'PageSectionController@index')->name('admin.pageSection');
	Route::post('section/store', 'PageSectionController@store')->name('admin.pageSection.store');
	Route::get('section/edit/{id}', 'PageSectionController@edit')->name('admin.pageSection.edit');
	Route::post('section/update', 'PageSectionController@update')->name('admin.pageSection.update');
	Route::get('section/delete/{id}', 'PageSectionController@delete')->name('admin.pageSection.delete');

	Route::prefix('poll')->name('admin.poll.')->group( function(){
		Route::get('list', 'PollController@list')->name('list');
		Route::post('store', 'PollController@store')->name('store');
		Route::get('edit/{slug}', 'PollController@edit')->name('edit');
		Route::post('update', 'PollController@update')->name('update');
		Route::get('delete/{id}', 'PollController@delete')->name('delete');

		Route::get('option/delete/{id}', 'PollController@pollOptionDelete')->name('option.delete');
		Route::get('result/{poll_id}', 'PollController@pollResult')->name('result');
	});

	Route::prefix('advertisement')->name('addvertisement.')->group( function(){
        Route::get('list', 'AddvertisementController@index')->name('list');
		Route::get('create', 'AddvertisementController@create')->name('create');
		Route::post('store', 'AddvertisementController@store')->name('store');
		Route::get('edit/{id}', 'AddvertisementController@edit')->name('edit');
		Route::post('update', 'AddvertisementController@update')->name('update');
		Route::get('delete/{id}', 'AddvertisementController@delete')->name('delete');
	});

    Route::prefix('setting')->name('setting.')->group( function() {
        Route::get('/', 'SettingController@index')->name('index');
        Route::post('store', 'SettingController@setting_store')->name('store');
        Route::get('edit/{id}', 'SettingController@setting_edit')->name('edit');
        Route::post('update', 'SettingController@setting_update')->name('update');
        Route::get('delete/{id}', 'SettingController@setting_delete')->name('delete');
    });



    Route::get('comment/list', 'CommentController@allComments')->name('allComments');
	Route::post('comment/update', 'CommentController@commentUpdate')->name('commentUpdate');

	    	//working task routes
	route::get('working-task/create/new', 'WorkingTaskController@workingTaskCreate')->name('admin.workingTaskCreate');
	route::get('working-task/{type?}', 'WorkingTaskController@workingTask')->name('admin.workingTask');
	route::post('working-task/store/{update?}', 'WorkingTaskController@workingTaskStore')->name('workingTask.store');
	route::get('working-task/edit/{slug}', 'WorkingTaskController@workingTaskEdit')->name('admin.workingTask.edit');
	route::get('working-task/details/{slug}/{conversation?}', 'WorkingTaskController@workingTaskDetails')->name('admin.workingTaskDetails');
	route::post('working/task/conversation', 'WorkingTaskController@workingTaskConversation')->name('admin.workingTaskConversation');
	route::get('working/task/delete/{id}', 'WorkingTaskController@workingTaskDelete')->name('workingTask.delete'); 
	route::get('working/task/status/{slug}', 'WorkingTaskController@workingTaskStatus')->name('admin.workingTaskStatus');

});


