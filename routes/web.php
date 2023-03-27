<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\site\MainController;
use App\Http\Controllers\admin\FactController;
use App\Http\Controllers\admin\MailController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\admin\SkillsController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SocialController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        Route::prefix('')->group(function () {
            Route::get('/', function () {
                return view('welcome');
            });


            Route::controller(MainController::class)->name('main.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::delete('/{uuid}', 'destroy')->name('delete');
                Route::get('/getData', 'getData')->name('getData');
            });
        });




        Route::prefix('admin')->group(function () {
            Route::get('/', function () {
                return view('layouts.admin.app');
            });

            Route::post('send-mail', [MailController::class, 'index'])->name('demoMail');

            Route::controller(AboutController::class)->prefix('about')->name('about.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::delete('/{uuid}', 'destroy')->name('delete');
                Route::get('/getData', 'getData')->name('getData');
            });
            Route::controller(FactController::class)->prefix('facts')->name('facts.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/activate/{id}', 'activate')->name('activate');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::delete('/{uuid}', 'destroy')->name('delete');
                Route::get('/getData', 'getData')->name('getData');
            });
            Route::controller(SkillsController::class)->prefix('skills')->name('skills.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/activate/{id}', 'activate')->name('activate');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::delete('/{uuid}', 'destroy')->name('delete');
                Route::get('/getData', 'getData')->name('getData');
            });
            Route::controller(ServiceController::class)->prefix('services')->name('services.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/activate/{id}', 'activate')->name('activate');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::delete('/{uuid}', 'destroy')->name('delete');
                Route::get('/getData', 'getData')->name('getData');
            });
            Route::controller(JobController::class)->prefix('jobs')->name('jobs.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/activate/{id}', 'activate')->name('activate');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::delete('/{uuid}', 'destroy')->name('delete');
                Route::get('/getData', 'getData')->name('getData');
            });
            Route::controller(SocialController::class)->prefix('social')->name('social.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/activate/{id}', 'activate')->name('activate');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::delete('/{uuid}', 'destroy')->name('delete');
                Route::get('/getData', 'getData')->name('getData');
            });
        });
    }
);
