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

$link_id = (int) config('var.link_id');

Route::get('/', [
    'as' => 'welcome', 'uses' => 'WelcomeController@index'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin,Instructor']);

Route::get('config', [
    'as' => 'config', 'uses' => 'ConfigController@index'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::put('config/update', [
    'as' => 'config.update', 'uses' => 'ConfigController@update'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);

Route::get('regions/{region}/disable', [
    'as' => 'regions.disable', 'uses' => 'RegionsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::get('regions/{region}/enable', [
    'as' => 'regions.enable', 'uses' => 'RegionsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::resource('regions', 'RegionsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::bind('regions', function($value, $route) {
    return App\CdtRegion::findBySlug($value)->first();
});

Route::get('regions/{region}/locations/{location}/disable', [
    'as' => 'regions.locations.disable', 'uses' => 'LocationsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::get('regions/{region}/locations/{location}/enable', [
    'as' => 'regions.locations.enable', 'uses' => 'LocationsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::resource('regions.locations', 'LocationsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::bind('locations', function($value, $route) {
    return App\CdtLocation::findBySlug($value)->first();
});

Route::get('regions/{region}/instructors/{instructor}/delete', [
    'as' => 'regions.instructors.delete', 'uses' => 'InstructorsController@destroy'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::resource('regions.instructors', 'InstructorsController', ['except' => 'destroy'])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::bind('instructors', function($value, $route) {
    return App\CdtInstructor::findBySlug($value)->first();
});

Route::get('metrics/{metric}/disable', [
    'as' => 'metrics.disable', 'uses' => 'MetricsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::get('metrics/{metric}/enable', [
    'as' => 'metrics.enable', 'uses' => 'MetricsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::resource('metrics', 'MetricsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::bind('metrics', function($value, $route) {
    return App\CdtMetric::findBySlug($value)->first();
});

Route::get('measures/{measure}/disable', [
    'as' => 'measures.disable', 'uses' => 'MeasuresController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::get('measures/{measure}/enable', [
    'as' => 'measures.enable', 'uses' => 'MeasuresController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::resource('measures', 'MeasuresController')->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::bind('measures', function($value, $route) {
    return App\CdtMeasure::findBySlug($value)->first();
});