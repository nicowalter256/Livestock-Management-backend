<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\CattleBreedController;
use App\Http\Controllers\CattleController;
use App\Http\Controllers\MilkController;
use App\Http\Controllers\IncomeTypeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InseminationController;
use App\Http\Controllers\FeedsController;
use App\Http\Controllers\CalfsController;
use App\Http\Controllers\AnalyticsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('throttle:9000000')->group(function () {
    Route::post('manager/login', [AuthController::class, 'loginManager']);
    Route::get('incomes/sum', [AnalyticsController::class, 'getIncomes']);
    Route::get('milk/all', [AnalyticsController::class, 'getMilk']);
    Route::post('admin/login', [AuthController::class, 'loginAdmin']);
    Route::apiResources([
        'managers' => ManagersController::class,
    ]);
    Route::apiResource('milk', MilkController::class)->except(['store', 'destroy', 'update']);
    Route::apiResource('cattleBreed', CattleBreedController::class)->except(['store', 'destroy', 'update']);
    Route::apiResource('cattle', CattleController::class)->except(['store', 'destroy', 'update']);
    Route::apiResource('incomeTypes', IncomeTypeController::class)->except(['store', 'destroy', 'update']);
    Route::apiResource('expenseTypes', ExpenseTypeController::class)->except(['store', 'destroy', 'update']);
    Route::apiResource('inseminations', InseminationController::class)->except(['store', 'destroy', 'update']);
    Route::apiResource('expenses', ExpensesController::class)->except(['store', 'destroy', 'update']);
    Route::apiResource('calfs', CalfsController::class)->except(['store', 'destroy', 'update']);
    Route::apiResource('feeds', FeedsController::class)->except(['store', 'destroy', 'update']);
});


Route::middleware('auth:api-manager,api-admin')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::apiResources([
        'incomes' => IncomeController::class,
    ]);
    Route::apiResource('expenses', ExpensesController::class)->only(['store', 'destroy', 'update']);
    Route::apiResource('cattleBreed', CattleBreedController::class)->only(['store', 'destroy', 'update']);
    Route::apiResource('cattle', CattleController::class)->only(['store', 'destroy', 'update']);
    Route::apiResource('milk', MilkController::class)->only(['store', 'destroy', 'update']);
    Route::apiResource('incomeTypes', IncomeTypeController::class)->only(['store', 'destroy', 'update']);
    Route::apiResource('expenseTypes', ExpenseTypeController::class)->only(['store', 'destroy', 'update']);
    Route::apiResource('inseminations', InseminationController::class)->only(['store', 'destroy', 'update']);
    Route::apiResource('calfs', CalfsController::class)->only(['store', 'destroy', 'update']);
    Route::apiResource('feeds', FeedsController::class)->only(['store', 'destroy', 'update']);
});
