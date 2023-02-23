<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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

// Route::get('/', function () {
//     return view('opac.index');
// });

// Route::get('/search-result', function () {
//     return view('opac.search-result');
// });

// Route::get('/full-description', function () {
//     return view('opac.full-description');
// });

// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index']);

require __DIR__.'/auth.php';


//RESULTS
use App\Http\Controllers\ResultController;
//Route::post('/results', [ResultController::class, 'index']);
Route::get('/results', [ResultController::class, 'index']);



//FULL DESCRIPTION
use App\Http\Controllers\HoldingController;
Route::post('/full-description', [HoldingController::class, 'index']);
Route::get('/full-description', [HoldingController::class, 'index2']);

//OPAC
use App\Http\Controllers\OPACController;

Route::get('/profile', [OPACController::class, 'profile']);
Route::get('/barrowed', [OPACController::class, 'barrowed']);
Route::get('/to-review', [OPACController::class, 'toReview']);

use App\Http\Controllers\DownloadController;
Route::post('/download', [DownloadController::class, 'index']);


//REVIEW
use App\Http\Controllers\ReviewController;
Route::post('/review', [ReviewController::class, 'index']);
Route::post('/review/submit', [ReviewController::class, 'create']);
// Route::get('/thank-you', [ReviewController::class, 'thanks']);