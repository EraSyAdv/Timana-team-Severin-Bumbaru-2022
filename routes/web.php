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
*/

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'homePage'])->name('home');
Route::get('/universities', [App\Http\Controllers\HomeController::class, 'universitiesPage'])->name('universities');

Route::group(['prefix' => 'university', 'as' => 'university.'], function()
{
	Route::get('{universityID}', [App\Http\Controllers\HomeController::class, 'universityView'])->name('view');

	Route::get('schedulefile/{universityID}', [App\Http\Controllers\HomeController::class, 'universityScheduleFile'])->name('scheduleFile');
	Route::post('schedulefile/post', [App\Http\Controllers\HomeController::class, 'universityScheduleFilePost'])->name('scheduleFilePost');

	Route::get('schedule/{universityID}', [App\Http\Controllers\HomeController::class, 'universitySchedule'])->name('schedule');
	Route::post('schedule/post', [App\Http\Controllers\HomeController::class, 'universitySchedulePost'])->name('schedulePost');

	Route::get('schedules/{universityID}', [App\Http\Controllers\HomeController::class, 'universitySchedules'])->name('schedules')->middleware(['auth', 'can:view.universitydata,universityID']);

	Route::post('scheduleadelete/', [App\Http\Controllers\HomeController::class, 'universityScheduleADelete'])->name('scheduleA.delete')->middleware(['auth']);
	Route::post('scheduledelete/', [App\Http\Controllers\HomeController::class, 'universityScheduleDelete'])->name('schedule.delete')->middleware(['auth']);
});

Route::get('/adduniversity', [App\Http\Controllers\HomeController::class, 'addUniversity'])->name('addUniversity')->middleware(['auth', 'can:add.university']);
Route::post('/addcity', [App\Http\Controllers\HomeController::class, "addCityPost"])->name('addCity')->middleware(['auth', 'can:add.university']);
Route::post('/addspeciality', [App\Http\Controllers\HomeController::class, "addSpeciality"])->name('addSpeciality')->middleware(['auth', 'can:add.university']);
Route::post('/adduniversitypost', [App\Http\Controllers\HomeController::class, "addUniversityPost"])->name('addUniversityPost')->middleware(['auth', 'can:add.university']);

Route::group(['prefix' => 'review', 'as' => 'review.'], function()
{
	Route::get('write', [App\Http\Controllers\HomeController::class, 'reviewWrite'])->name('write');
	Route::post('post', [App\Http\Controllers\HomeController::class, 'reviewPost'])->name('post');
});

Route::get('/search', [App\Http\Controllers\HomeController::class, 'redirectToHome']);
Route::post('/search', [App\Http\Controllers\HomeController::class, 'universitySearch'])->name('universitySearch');

require __DIR__.'/auth.php';
