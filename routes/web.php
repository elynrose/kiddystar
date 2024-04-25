<?php
Route::get('optimize-clear', function () {
    Artisan::call('optimize:clear');
});
Route::get('storage-link', function () {
    Artisan::call('storage:link');
});
Route::get('/scan/{card}', 'ScanController@index')->name('scan');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Cards
    Route::delete('cards/destroy', 'CardsController@massDestroy')->name('cards.massDestroy');
    Route::post('cards/parse-csv-import', 'CardsController@parseCsvImport')->name('cards.parseCsvImport');
    Route::post('cards/process-csv-import', 'CardsController@processCsvImport')->name('cards.processCsvImport');
    Route::resource('cards', 'CardsController');

    // Card Batch
    Route::delete('card-batches/destroy', 'CardBatchController@massDestroy')->name('card-batches.massDestroy');
    Route::resource('card-batches', 'CardBatchController');

    // User Card
    Route::delete('user-cards/destroy', 'UserCardController@massDestroy')->name('user-cards.massDestroy');
    Route::resource('user-cards', 'UserCardController');

    // Points
    Route::delete('points/destroy', 'PointsController@massDestroy')->name('points.massDestroy');
    Route::resource('points', 'PointsController');

        // Children
        Route::delete('children/destroy', 'ChildrenController@massDestroy')->name('children.massDestroy');
        Route::post('children/media', 'ChildrenController@storeMedia')->name('children.storeMedia');
        Route::post('children/ckmedia', 'ChildrenController@storeCKEditorImages')->name('children.storeCKEditorImages');
        Route::resource('children', 'ChildrenController')->except('delete', 'show');

        
    // Claims
    Route::delete('claims/destroy', 'ClaimsController@massDestroy')->name('claims.massDestroy');
    Route::resource('claims', 'ClaimsController');

    // Configuration
    Route::delete('configurations/destroy', 'ConfigurationController@massDestroy')->name('configurations.massDestroy');
    Route::post('configurations/media', 'ConfigurationController@storeMedia')->name('configurations.storeMedia');
    Route::post('configurations/ckmedia', 'ConfigurationController@storeCKEditorImages')->name('configurations.storeCKEditorImages');
    Route::post('configurations/parse-csv-import', 'ConfigurationController@parseCsvImport')->name('configurations.parseCsvImport');
    Route::post('configurations/process-csv-import', 'ConfigurationController@processCsvImport')->name('configurations.processCsvImport');
    Route::resource('configurations', 'ConfigurationController');

        // Category
        Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
        Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
        Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
        Route::resource('categories', 'CategoryController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);


    // Tasks
    Route::delete('tasks/destroy', 'TasksController@massDestroy')->name('tasks.massDestroy');
    Route::resource('tasks', 'TasksController');


    // Rewards
    Route::delete('rewards/destroy', 'RewardsController@massDestroy')->name('rewards.massDestroy');
    Route::post('rewards/media', 'RewardsController@storeMedia')->name('rewards.storeMedia');
    Route::post('rewards/ckmedia', 'RewardsController@storeCKEditorImages')->name('rewards.storeCKEditorImages');
    Route::post('rewards/parse-csv-import', 'RewardsController@parseCsvImport')->name('rewards.parseCsvImport');
    Route::post('rewards/process-csv-import', 'RewardsController@processCsvImport')->name('rewards.processCsvImport');
    Route::resource('rewards', 'RewardsController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');

    //Register Customers
    Route::post('scan/{card}', 'AddController@create')->name('add');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Cards
    Route::delete('cards/destroy', 'CardsController@massDestroy')->name('cards.massDestroy');
    Route::resource('cards', 'CardsController');

    // Card Batch
    Route::delete('card-batches/destroy', 'CardBatchController@massDestroy')->name('card-batches.massDestroy');
    Route::resource('card-batches', 'CardBatchController');

    // User Card
    Route::delete('user-cards/destroy', 'UserCardController@massDestroy')->name('user-cards.massDestroy');
    Route::resource('user-cards', 'UserCardController')->only('create', 'update', 'store', 'index', 'destroy');
    
    // Add user card using this route
    Route::get('user-cards/create/{card}', 'UserCardController@create')->name('user-cards.add');
    Route::post('completed', 'UserCardController@addPoints')->name('completed');

    // Points
    Route::resource('points', 'PointsController')->only(['create', 'store']);
    Route::get('points/create/{card}', 'PointsController@create')->name('add_points');


    // Claims
    Route::delete('claims/destroy', 'ClaimsController@massDestroy')->name('claims.massDestroy');
    Route::resource('claims', 'ClaimsController');
    Route::get('claims/create/{card}', 'ClaimsController@create')->name('add_claims');

    // Configuration
    Route::delete('configurations/destroy', 'ConfigurationController@massDestroy')->name('configurations.massDestroy');
    Route::post('configurations/media', 'ConfigurationController@storeMedia')->name('configurations.storeMedia');
    Route::post('configurations/ckmedia', 'ConfigurationController@storeCKEditorImages')->name('configurations.storeCKEditorImages');
    Route::resource('configurations', 'ConfigurationController')->except('show');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

        // Category
        Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
        Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
        Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
        Route::resource('categories', 'CategoryController');
        
    // Rewards
    Route::delete('rewards/destroy', 'RewardsController@massDestroy')->name('rewards.massDestroy');
    Route::post('rewards/media', 'RewardsController@storeMedia')->name('rewards.storeMedia');
    Route::post('rewards/ckmedia', 'RewardsController@storeCKEditorImages')->name('rewards.storeCKEditorImages');
    Route::resource('rewards', 'RewardsController');

        // Children
        Route::delete('children/destroy', 'ChildrenController@massDestroy')->name('children.massDestroy');
        Route::post('children/media', 'ChildrenController@storeMedia')->name('children.storeMedia');
        Route::post('children/ckmedia', 'ChildrenController@storeCKEditorImages')->name('children.storeCKEditorImages');
        Route::resource('children', 'ChildrenController');
    

    // Tasks
    Route::delete('tasks/destroy', 'TasksController@massDestroy')->name('tasks.massDestroy');
    Route::resource('tasks', 'TasksController');


    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
