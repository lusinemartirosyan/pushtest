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
    return view('home');
});
Route::get('home', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//////notification dashboard
Route::get('/admin/notification', 'DashboardController@index')->name('notification');
Route::post('/admin/notification/create', 'DashboardController@createNotification')->name('create.notification');
Route::get('/admin/notifications', 'DashboardController@AllNotifications')->name('all.notifications');
Route::get('/api/notification', 'DashboardController@GetNotification')->name('one.notification');

Route::post('admin/notification/send', 'DashboardController@SendNotification')->name('send.notification');

/////////service worker back-end
Route::get('/api/save-subscription', 'ServiceWorkerController@SaveSubscription');
Route::post('/api/send-notification/{id}', 'ServiceWorkerController@SendNotification');

Route::get('/subscribed/users', 'ServiceWorkerController@index');



