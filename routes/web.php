<?php
use Illuminate\Support\Facades\Route;
Auth::routes();


Route::get('/testsms/{phone}', [App\Http\Controllers\PlaymobileSMSController::class, 'test']);
Route::group(['middleware' => 'auth'],function (){

    Route::get('/', [App\Http\Controllers\Blade\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\Blade\HomeController::class,'index'])->name('home');

    Route::group(['prefix'=>'card', 'namespace'=>'\App\Http\Controllers'], function(){
        Route::get('/', 'CardController@index')->name('cardIndex');
        Route::get('/show/{id}', 'CardController@show')->name('cardShow');
    });

    Route::group(['prefix'=>'transfer', 'namespace'=>'\App\Http\Controllers'], function(){
        Route::get('/', 'TransferController@index')->name('transferIndex');
    });
    // User
    Route::group(['prefix'=>'user', 'namespace'=>'\App\Http\Controllers\Blade'], function(){
        Route::get('/', 'UserController@index')->name('userIndex');
        Route::get('/add','UserController@add')->name('userAdd');
        Route::post('/create','UserController@create')->name('userCreate');
        Route::get('/{id}/edit','UserController@edit')->name('userEdit');
        Route::post('/update/{id}','UserController@update')->name('userUpdate');
        Route::delete('/delete/{id}','UserController@destroy')->name('userDestroy');
        Route::get('/theme-set/{id}','UserController@setTheme')->name('userSetTheme');
    });

    // Permission
    Route::group(['prefix'=>'permission', 'namespace'=>'\App\Http\Controllers\Blade'], function(){
        Route::get('/', 'PermissionController@index')->name('permissionIndex');
        Route::get('/add','PermissionController@add')->name('permissionAdd');
        Route::post('/create','PermissionController@create')->name('permissionCreate');
        Route::get('/{id}/edit','PermissionController@edit')->name('permissionEdit');
        Route::post('/update/{id}','PermissionController@update')->name('permissionUpdate');
        Route::delete('/delete/{id}','PermissionController@destroy')->name('permissionDestroy');
    });

    // Role
    Route::group(['prefix'=>'role', 'namespace'=>'\App\Http\Controllers\Blade'], function(){
        Route::get('/', 'RoleController@index')->name('roleIndex');
        Route::get('/add','RoleController@add')->name('roleAdd');
        Route::post('/create','RoleController@create')->name('roleCreate');
        Route::get('/{id}/edit','RoleController@edit')->name('roleEdit');
        Route::post('/update/{id}','RoleController@update')->name('roleUpdate');
        Route::delete('/delete/{id}','RoleController@destroy')->name('roleDestroy');
    });
});

// Change language session condition
Route::get('/language/{lang}',function ($lang){
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz')
    {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
});
