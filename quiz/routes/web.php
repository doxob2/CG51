<?php


use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'main']);


Route::get('/quiz', [MainController::class, 'quiz']);


Route::get('/create', [MainController::class, 'create']);


Route::get('/result', [MainController::class, 'get_result']);





Route::post('/add', [MainController::class, 'add_question_into_db']);


Route::post('/add_result', [MainController::class, 'add_result_into_db']);


Route::get('/question', [MainController::class, 'get_question_from_db']);
