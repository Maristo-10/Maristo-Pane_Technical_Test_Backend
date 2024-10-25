<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadfollowupController;
use App\Http\Controllers\SalespersonController;
use App\Http\Controllers\SurveyController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/salespersons', [SalespersonController::class, 'store']);
Route::post('/leads', [LeadController::class, 'store']);

Route::patch('/leads/{id}/status', [LeadController::class, 'updateStatus']);
Route::patch('/leads/{id}/transfer', [LeadController::class, 'transferLead']);

Route::patch('/salesperson/{id}/penalize', [SalespersonController::class, 'penalize']);

Route::post('/leadfollowup/{id}', [LeadfollowupController::class, 'store']);

Route::post('/survey/{id}', [SurveyController::class, 'store']);
