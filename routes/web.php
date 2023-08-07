<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendCandidateController;
use App\Http\Controllers\FrontendAuthController;

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

Route::get('/', [FrontendCandidateController::class , 'candidate']);
Route::post('candidates', [FrontendCandidateController::class , 'store']);
Route::get('candidate-view', [FrontendCandidateController::class , 'candidate_view']);
Route::get('candidate-delete', [FrontendCandidateController::class , 'candidate_delete']);
Route::post('candidate-edit', [FrontendCandidateController::class , 'candidate_edit']);
Route::get('candidates-list', [FrontendCandidateController::class , 'candidates_list']);
Route::get('logout', [FrontendCandidateController::class , 'logout']);
Route::post('login', [FrontendAuthController::class , 'login'])
    ->name('login.custom');
Route::post('register', [FrontendAuthController::class , 'register'])
    ->name('register.custom');

