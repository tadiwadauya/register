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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    Route::get('/', 'WelcomeController@welcome')->name('welcome');
    Route::get('/terms', 'TermsController@terms')->name('terms');
    Route::get('/getTitles/{department}','JobTitleController@getTitles')->name('jobtitles.fetch');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
    Route::put('/updateFirstPwd/{id}', 'UsersManagementController@updateUserPassword')->name('forcePasswordChange');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'checkpass','activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');

    Route::get('find', 'SearchController@find');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'checkpass','activated', 'activity', 'twostep', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth','checkpass', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController',
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);

    Route::put('profile/{username}/updateUserPassword', [
        'as'   => 'changemypwd',
        'uses' => 'ProfilesController@updateMyPassword',
    ]);
    Route::get('changemypass', 'ProfilesController@getChangePwdForm');
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth','checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ])->middleware(['admin']);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
});

Route::group(['middleware' => ['auth','checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('departments', 'DepartmentController', [
        'names' => [
            'index'   => 'departments',
            'destroy' => 'department.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth','checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('jobtitles', 'JobTitleController', [
        'names' => [
            'index'   => 'jobtitles',
            'destroy' => 'jobtitle.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth','checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/iassets/deleted', 'SoftDeleteAssetController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('iassets', 'AssetController', [
        'names' => [
            'index'   => 'assets',
            'destroy' => 'asset.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::get('/assetsreport','AssetController@getAssetsReport')->name('assets.report');
    Route::get('/assetsbatcher','AssetController@updateAssetsAge')->name('assets.updater');

});

Route::group(['middleware' => ['auth','checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('desktops', 'DesktopController', [
        'names' => [
            'index'   => 'desktops',
            'destroy' => 'desktop.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('laptops', 'LaptopController', [
        'names' => [
            'index'   => 'laptops',
            'destroy' => 'laptop.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

// Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

//     Route::resource('nonallocatedlap', 'LaptopController@nonallocatedlap', [
//         'names' => [
//             'nonallocatedlap'   => 'nonlaptops',
//             'destroy' => 'laptop.destroy',
//         ],
//         'except' => [
//             'deleted',
//         ],
//     ]);

// });

Route::get('nonlaptops', 'NonLaptopController@index')->middleware('auth', 'checkpass', 'activated','activity','twostep', 'checkblocked');
Route::get('nondesktops', 'NonallocatedDesktop@index')->middleware('auth', 'checkpass', 'activated','activity','twostep', 'checkblocked');

Route::group(['middleware' => ['auth','checkpass', 'activated','role:admin', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('brands', 'BrandController', [
        'names' => [
            'index'   => 'brands',
            'destroy' => 'brand.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated','role:admin', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('harddrives', 'HarddriveController', [
        'names' => [
            'index'   => 'harddrives',
            'destroy' => 'harddrive.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('printers', 'PrinterController', [
        'names' => [
            'index'   => 'printers',
            'destroy' => 'printer.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('aothers', 'AotherController', [
        'names' => [
            'index'   => 'aothers',
            'destroy' => 'aother.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/sgvpns/deleted', 'SoftDeleteSgvpnController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('sgvpns', 'SgvpnController', [
        'names' => [
            'index'   => 'sgvpns',
            'destroy' => 'sgvpn.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/sophosvpns/deleted', 'SoftDeleteSophosvpnController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('sophosvpns', 'SophosvpnController', [
        'names' => [
            'index'   => 'sophosvpns',
            'destroy' => 'sophosvpn.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('zamaccounts', 'ZamaccountController', [
        'names' => [
            'index'   => 'zamaccounts',
            'destroy' => 'zamaccount.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('hreaccounts', 'HreaccountController', [
        'names' => [
            'index'   => 'hreaccounts',
            'destroy' => 'hreaccount.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});
Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('beitaccounts', 'BeitaccountController', [
        'names' => [
            'index'   => 'beitaccounts',
            'destroy' => 'beitaccount.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('vicfallsaccounts', 'VicfallsaccountController', [
        'names' => [
            'index'   => 'vicfallsaccounts',
            'destroy' => 'vicfallsaccount.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('licences', 'LicenceController', [
        'names' => [
            'index'   => 'licences',
            'destroy' => 'licence.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('maintenances', 'MaintenanceController', [
        'names' => [
            'index'   => 'maintenances',
            'destroy' => 'maintenance.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::get('noncompliant', 'MaintenanceController@getNonCompliantUsers')->middleware('activity');

});

Route::get('maintenance-log', 'MaintenanceController@getMaintenanceLog')->middleware('activity');
Route::post('post-maintenance-log', 'MaintenanceController@saveMaintenanceLog')->name('selflog.maintenance')->middleware('activity');
Route::get('non-complied-user', 'MaintenanceController@getUserAramba')->middleware('activity');

Route::group(['middleware' => ['auth', 'checkpass', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('backups', 'BackupController', [
        'names' => [
            'index'   => 'backups',
            'destroy' => 'backup.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

});

Route::group(['middleware' => ['auth','checkpass', 'activated','role:admin', 'activity', 'twostep', 'checkblocked']], function () {

    Route::resource('wifis', 'WifiController', [
        'names' => [
            'index'   => 'wifis',
            'destroy' => 'wifi.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ])->middleware(['admin']);

});

Route::redirect('/php', '/phpinfo', 301);
Route::get('/unauthorized', 'WelcomeController@unauthorized');
Route::get('/change-password', 'WelcomeController@changepassword');

Route::group(['prefix' => 'activity', 'middleware' => ['web', 'auth', 'activity']], function () {

    // Dashboards
    Route::get('/', 'LaravelLoggerController@showAccessLog')->name('activity');
    Route::get('/cleared', ['uses' => 'LaravelLoggerController@showClearedActivityLog'])->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', 'LaravelLoggerController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', 'LaravelLoggerController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', ['uses' => 'LaravelLoggerController@clearActivityLog'])->name('clear-activity');
    Route::delete('/destroy-activity', ['uses' => 'LaravelLoggerController@destroyActivityLog'])->name('destroy-activity');
    Route::post('/restore-log', ['uses' => 'LaravelLoggerController@restoreClearedActivityLog'])->name('restore-activity');
});
