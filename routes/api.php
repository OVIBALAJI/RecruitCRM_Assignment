<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CandidateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router)
{
    Route::post('/login', [AuthController::class , 'login']);
    Route::post('/register', [AuthController::class , 'register']);
    Route::post('/logout', [AuthController::class , 'logout']);
    Route::post('/refresh', [AuthController::class , 'refresh']);
    Route::get('candidates', [CandidateController::class , 'index']);
    Route::get('candidates/{id}', [CandidateController::class , 'show']);
    Route::post('candidates', [CandidateController::class , 'store']);
    Route::delete('candidates/{id}', [CandidateController::class , 'destroy']);
    Route::put('candidates/{id}', [CandidateController::class , 'update']);
    Route::post('candidates/search', [CandidateController::class , 'search']);

});

