<?php

Route::namespace('Site')->group(function () {
    Auth::routes();
    Route::get('/', ['as' => 'site.home', 'uses' => 'SiteController@index']);
});

Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('/login', ['as' => 'admin.login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('/login', ['as' => 'admin.login.submit', 'uses' => 'Auth\LoginController@login']);
        Route::post('/logout', ['as' => 'admin.logout', 'uses' => 'Auth\LoginController@logout']);
        Route::post('/password/email', ['as' => 'admin.password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
        Route::get('/password/reset', ['as' => 'admin.password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
        Route::post('/password/reset', ['as' => 'admin.password.reset.request', 'uses' => 'Auth\ResetPasswordController@reset']);
        Route::get('/password/reset/{token}', ['as' => 'admin.password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

        Route::get('/', ['as' => 'admin.home', 'uses' => 'AdminController@index']);

        Route::resource('permissions', 'PermissionController', [
            'names' => [
                'index' => 'admin.permissions',
                'create' => 'admin.permission.create',
                'store' => 'admin.permission.store',
                'edit' => 'admin.permission.edit',
                'update' => 'admin.permission.update',
                'destroy' => 'admin.permission.destroy',
            ],
            'except' => ['view'],
        ]);
        Route::get('/permissions/delete/{id}', ['as' => 'admin.permission.delete', 'uses' => 'PermissionController@delete']);

        Route::resource('roles', 'RoleController', [
            'names' => [
                'index' => 'admin.roles',
                'show' => 'admin.role.show',
                'create' => 'admin.role.create',
                'store' => 'admin.role.store',
                'edit' => 'admin.role.edit',
                'update' => 'admin.role.update',
                'destroy' => 'admin.role.destroy',
            ],
        ]);
        Route::get('/roles/delete/{id}', ['as' => 'admin.role.delete', 'uses' => 'RoleController@delete']);

        Route::resource('admins', 'AdminUserController', [
            'names' => [
                'index' => 'admin.admins',
                'show' => 'admin.admin.show',
                'create' => 'admin.admin.create',
                'store' => 'admin.admin.store',
                'edit' => 'admin.admin.edit',
                'update' => 'admin.admin.update',
                'destroy' => 'admin.admin.destroy',
            ],
        ]);
        Route::get('/admins/delete/{id}', ['as' => 'admin.admin.delete', 'uses' => 'AdminUserController@delete']);
    });
});
