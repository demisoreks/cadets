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

Route::get('regions/{region_id}/getLocations', [
    'as' => 'regions.getLocations', 'uses' => 'RegionsController@getLocations'
]);
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

Route::get('locations/{location_id}/getCoursesDesc', [
    'as' => 'locations.getCoursesDesc', 'uses' => 'LocationsController@getCoursesDesc'
]);
Route::get('locations/{location}/disable', [
    'as' => 'locations.disable', 'uses' => 'LocationsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::get('locations/{location}/enable', [
    'as' => 'locations.enable', 'uses' => 'LocationsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::resource('locations', 'LocationsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
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

Route::get('bands/{band}/delete', [
    'as' => 'bands.delete', 'uses' => 'BandsController@destroy'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::resource('bands', 'BandsController', ['except' => 'destroy'])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::bind('bands', function($value, $route) {
    return App\CdtBand::findBySlug($value)->first();
});

Route::get('assessments/{assessment}/disable', [
    'as' => 'assessments.disable', 'uses' => 'AssessmentsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::get('assessments/{assessment}/enable', [
    'as' => 'assessments.enable', 'uses' => 'AssessmentsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::resource('assessments', 'AssessmentsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::bind('assessments', function($value, $route) {
    return App\CdtAssessment::findBySlug($value)->first();
});

Route::get('instructor_details', [
    'as' => 'instructor_details.index', 'uses' => 'InstructorDetailsController@index'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::get('instructor_details/{employee_id}/edit', [
    'as' => 'instructor_details.edit', 'uses' => 'InstructorDetailsController@edit'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::post('instructor_details/store', [
    'as' => 'instructor_details.store', 'uses' => 'InstructorDetailsController@store'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin']);
Route::bind('instructor_details', function($value, $route) {
    return App\CdtInstructorDetail::findBySlug($value)->first();
});

Route::get('courses/{course}/approve', [
    'as' => 'courses.approve', 'uses' => 'CoursesController@approve'
])->middleware(['auth.user', 'auth.access:'.$link_id.',RegionalManager']);
Route::get('courses/{course}/cadets', [
    'as' => 'courses.cadets', 'uses' => 'CoursesController@cadets'
])->middleware(['auth.user', 'auth.access:'.$link_id.',RegionalManager']);
Route::get('courses/approvals', [
    'as' => 'courses.approvals', 'uses' => 'CoursesController@approvals'
])->middleware(['auth.user', 'auth.access:'.$link_id.',RegionalManager']);
Route::get('courses/{course}/disable', [
    'as' => 'courses.disable', 'uses' => 'CoursesController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::get('courses/{course}/enable', [
    'as' => 'courses.enable', 'uses' => 'CoursesController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::resource('courses', 'CoursesController')->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::bind('courses', function($value, $route) {
    return App\CdtCourse::findBySlug($value)->first();
});

Route::get('cadets', [
    'as' => 'cadets.index', 'uses' => 'CadetsController@index'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::post('cadets/store', [
    'as' => 'cadets.store', 'uses' => 'CadetsController@store'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::get('cadets/search', [
    'as' => 'cadets.search', 'uses' => 'CadetsController@search'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin,Instructor']);
Route::post('cadets/fetch', [
    'as' => 'cadets.fetch', 'uses' => 'CadetsController@fetch'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin,Instructor']);
Route::get('cadets/{cadet}/view', [
    'as' => 'cadets.view', 'uses' => 'CadetsController@view'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin,Instructor']);
Route::get('cadets/{cadet}/manage', [
    'as' => 'cadets.manage', 'uses' => 'CadetsController@manage'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::post('cadets/{cadet}/update_exam', [
    'as' => 'cadets.update_exam', 'uses' => 'CadetsController@update_exam'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::post('cadets/{cadet}/update_quality', [
    'as' => 'cadets.update_quality', 'uses' => 'CadetsController@update_quality'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::get('courses/{course}/applicants', [
    'as' => 'courses.applicants', 'uses' => 'CadetsController@applicants'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::get('cadets/{cadet}/treat', [
    'as' => 'cadets.treat', 'uses' => 'CadetsController@treat'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::post('cadets/{cadet}/admit', [
    'as' => 'cadets.admit', 'uses' => 'CadetsController@admit'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::post('cadets/{cadet}/complete', [
    'as' => 'cadets.complete', 'uses' => 'CadetsController@complete'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::post('cadets/{cadet}/update', [
    'as' => 'cadets.update', 'uses' => 'CadetsController@update'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::get('cadets/waiver', [
    'as' => 'cadets.waiver', 'uses' => 'CadetsController@waiver'
])->middleware(['auth.user', 'auth.access:'.$link_id.',SeniorInstructor']);
Route::post('cadets/waiver_fetch', [
    'as' => 'cadets.waiver_fetch', 'uses' => 'CadetsController@waiver_fetch'
])->middleware(['auth.user', 'auth.access:'.$link_id.',SeniorInstructor']);
Route::post('cadets/{cadet}/waive', [
    'as' => 'cadets.waive', 'uses' => 'CadetsController@waive'
])->middleware(['auth.user', 'auth.access:'.$link_id.',SeniorInstructor']);
Route::post('cadets/{cadet}/change', [
    'as' => 'cadets.change', 'uses' => 'CadetsController@change'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::post('cadets/{cadet}/reject', [
    'as' => 'cadets.reject', 'uses' => 'CadetsController@reject'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Instructor']);
Route::bind('cadets', function($value, $route) {
    return App\CdtCadet::findBySlug($value)->first();
});

Route::get('streams', [
    'as' => 'streams', 'uses' => 'CadetsController@streams'
]);
Route::get('streams/{course}/register', [
    'as' => 'streams.register', 'uses' => 'CadetsController@register'
]);
Route::post('streams/{course}/submit', [
    'as' => 'streams.submit', 'uses' => 'CadetsController@submit'
]);