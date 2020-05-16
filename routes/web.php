<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::prefix('horarios')->group(function () {
    Route::get('horario', 'ShedulesController@index')->name('shedules.index');
    Route::get('horario/dt', 'ShedulesController@dt')->name('shedules.dt');
    Route::get('generar', 'ShedulesController@generate')->name('shedules.generete');
    Route::get('crear', 'ShedulesController@create')->name('shedules.create');
    Route::post('store', 'ShedulesController@store')->name('shedules.store');
    Route::post('update/{id}', 'ShedulesController@update')->name('shedules.update');
    Route::get('horario/{id}/edit', 'ShedulesController@edit')->name('shedules.edit');
    Route::post('horario/delete', 'ShedulesController@delete')->name('shedules.delete');
    Route::get('horario/pdf', 'ShedulesController@exportPDF')->name('shedules.pdf');

    Route::get('asistencia', 'AsistenceController@index')->name('asistence.index');
    Route::get('asistencia/dt', 'AsistenceController@dt')->name('asistence.dt');
    Route::get('asistencia/generar', 'AsistenceController@generate')->name('asistence.generete');
    Route::get('asistencia/crear', 'AsistenceController@create')->name('asistence.create');
    Route::post('asistencia/store', 'AsistenceController@store')->name('asistence.store');
    Route::post('asistencia/update/{id}', 'AsistenceController@update')->name('asistence.update');
    Route::get('asistencia/{id}/edit', 'AsistenceController@edit')->name('asistence.edit');
    Route::post('asistencia/delete', 'AsistenceController@delete')->name('asistence.delete');
    Route::get('asistencia/pdf', 'AsistenceController@exportPDF')->name('asistence.pdf');
});
Route::prefix('configuracion')->group(function () {
    // Users Routes
    Route::get('usuarios', 'UsersController@index')->name('users.index');
    Route::get('usuarios/dt', 'UsersController@dt_users')->name('users.dt');
    Route::get('usuarios/crear', 'UsersController@create')->name('users.create');
    Route::post('usuarios/store', 'UsersController@store')->name('users.store');
    Route::post('usuarios/update/{id}', 'UsersController@update')->name('users.update');
    Route::post('usuarios/disable', 'UsersController@disable')->name('users.disable');
    Route::post('usuarios/enable', 'UsersController@enable')->name('users.enable');
    Route::post('usuarios/delete', 'UsersController@delete')->name('users.delete');
    Route::get('usuarios/{id}/edit', 'UsersController@edit')->name('users.edit');

    // Roles Routes
    Route::get('roles', 'RoleController@index')->name('roles.index');
    Route::get('roles/dt', 'RoleController@dt_roles')->name('roles.dt');
    Route::get('roles/crear', 'RoleController@create')->name('roles.create');
    Route::post('roles/store', 'RoleController@store')->name('roles.store');
    Route::post('roles/update/{id}', 'RoleController@update')->name('roles.update');
    Route::post('roles/delete', 'RoleController@delete')->name('roles.delete');
    Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit');
});