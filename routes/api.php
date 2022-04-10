<?php

use App\Http\Controllers\NewPasswordController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Laravue\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Laravue\Acl;
use \App\Laravue\Faker;
use \App\Laravue\JsonResponse;

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

Route::namespace('Api')->group(function () {
    Route::post('auth/login', 'AuthController@login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Auth routes
        Route::get('auth/user', 'AuthController@user');
        Route::post('auth/logout', 'AuthController@logout');

        Route::get('/user', function (Request $request) {
            return new UserResource($request->user());
        });

        // Api resource routes
        Route::apiResource('roles', 'RoleController')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('users', 'UserController')->middleware('permission:' . Acl::PERMISSION_USER_MANAGE);
        Route::apiResource('permissions', 'PermissionController')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);

        // Custom routes
        Route::put('users/{user}', 'UserController@update');
        Route::get('users/{user}/permissions', 'UserController@permissions')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
        Route::put('users/{user}/permissions', 'UserController@updatePermissions')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
        Route::get('roles/{role}/permissions', 'RoleController@permissions')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
    });
});

// Fake APIs

Route::get('/table/list', function () {
    $rowsNumber = mt_rand(20, 30);
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'author' => Faker::randomString(mt_rand(5, 10)),
            'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
            'id' => mt_rand(100000, 100000000),
            'pageviews' => mt_rand(100, 10000),
            'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
            'title' => Faker::randomString(mt_rand(20, 50)),
        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data]));
});

Route::get('/orders', function () {
    $rowsNumber = 8;
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'order_no' => 'LARAVUE' . mt_rand(1000000, 9999999),
            'price' => mt_rand(10000, 999999),
            'status' => Faker::randomInArray(['success', 'pending']),
        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data]));
});

Route::get('/articles', function () {
    $rowsNumber = 10;
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'id' => mt_rand(100, 10000),
            'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
            'title' => Faker::randomString(mt_rand(20, 50)),
            'author' => Faker::randomString(mt_rand(5, 10)),
            'comment_disabled' => Faker::randomBoolean(),
            'content' => Faker::randomString(mt_rand(100, 300)),
            'content_short' => Faker::randomString(mt_rand(30, 50)),
            'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
            'forecast' => mt_rand(100, 9999) / 100,
            'image_uri' => 'https://via.placeholder.com/400x300',
            'importance' => mt_rand(1, 3),
            'pageviews' => mt_rand(10000, 999999),
            'reviewer' => Faker::randomString(mt_rand(5, 10)),
            'timestamp' => Faker::randomDateTime()->getTimestamp(),
            'type' => Faker::randomInArray(['US', 'VI', 'JA']),

        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data, 'total' => mt_rand(1000, 10000)]));
});

Route::get('articles/{id}', function ($id) {
    $article = [
        'id' => $id,
        'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
        'title' => Faker::randomString(mt_rand(20, 50)),
        'author' => Faker::randomString(mt_rand(5, 10)),
        'comment_disabled' => Faker::randomBoolean(),
        'content' => Faker::randomString(mt_rand(100, 300)),
        'content_short' => Faker::randomString(mt_rand(30, 50)),
        'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
        'forecast' => mt_rand(100, 9999) / 100,
        'image_uri' => 'https://via.placeholder.com/400x300',
        'importance' => mt_rand(1, 3),
        'pageviews' => mt_rand(10000, 999999),
        'reviewer' => Faker::randomString(mt_rand(5, 10)),
        'timestamp' => Faker::randomDateTime()->getTimestamp(),
        'type' => Faker::randomInArray(['US', 'VI', 'JA']),

    ];

    return response()->json(new JsonResponse($article));
});

Route::get('articles/{id}/pageviews', function ($id) {
    $pageviews = [
        'PC' => mt_rand(10000, 999999),
        'Mobile' => mt_rand(10000, 999999),
        'iOS' => mt_rand(10000, 999999),
        'android' => mt_rand(10000, 999999),
    ];
    $data = [];
    foreach ($pageviews as $device => $pageview) {
        $data[] = [
            'key' => $device,
            'pv' => $pageview,
        ];
    }

    return response()->json(new JsonResponse(['pvData' => $data]));
});

// Forgot  &&  Rest Password Url
Route::Post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
Route::Post('reset-password', [NewPasswordController::class, 'reset']);

// getCount users
Route::get('/UsersCount', function () {
    $usersCount = User::distinct('email')->count('email');

    return response()->json(['UsersNbr' => $usersCount]);
});

// get all users
Route::get('/users', function () {
    $Users = User::all();
    return new UserCollection($Users);
});
// Show user
Route::get('/user/{id}', function (Request $request) {
    $Users = User::findOrFail($request->id);
    return new UserResource($Users);
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    // Sujet resource route

    // Route::apiResource('/Sujet',SujetsController::class);

    // Count Sujet method route
    Route::get('/SujetsCount', 'SujetsController@getCount');
    // Sorte method
    Route::put('/SortCause/{id}', 'SujetsController@SortCause');
    // Activate Sujet method
    Route::put('/ActivateSujet/{id}', 'SujetsController@Activate');

    // Eleveurproprietaires Resource route



    // Count Eleveurproprietaire method route
    Route::get('/EpCount', 'EleveurproprietairesController@getCount');

    // Activaet Proprietaire method route
    Route::put('/ActivatePropr/{id}', 'EleveurproprietairesController@Activate');

    // Éleveursnaisseurs Resource route
    Route::apiResource('/Eleveursnaisseurs', EleveursnaisseursController::class);
    // Route::apiResource('/Eleveursnaisseurs',EleveursnaisseursController::class);

    // Activate Naisseur method route
    Route::put('/ActivateNaisseur/{id}', 'EleveursnaisseursController@Activate');

    // Count Eleveursnaisseurs method route
    Route::get('/EnCount', 'EleveursnaisseursController@getCount');

    //Grandmerematernelles Resource route
    Route::apiResource('/Grandmerematernelles', GrandmerematernellesController::class);

    // Indexeslaitiersperesr Resource Route
    Route::apiResource('/Indexeslaitiersperes', IndexeslaitiersperesController::class);
    // Indexfonctionnelsperes Resource Route
    Route::apiResource('/Indexfonctionnelsperes', IndexfonctionnelsperesController::class);

    // Grandperematernels Resource route
    Route::apiResource('/Grandperematernels', GrandperematernelsController::class);

    // Grandperepaternels Resource route
    Route::apiResource('/Grandperepaternels', GrandperepaternelsController::class);

    // Historiques Resource route
    Route::apiResource('/Historiques', HistoriquesController::class);



    //Productionlaitieremeres Resource Route
    Route::apiResource('/Productionlaitieremeres', ProductionlaitieremeresController::class);
    //Productionlaitieresujets Resource Route
    Route::apiResource('/Productionlaitieresujets', ProductionlaitieresujetsController::class);



    // Meree Resource Route
    Route::apiResource('/Meres', MeresController::class);

    // Peres Resource Route
    Route::apiResource('/Peres', PeresController::class);





    // Indexesmorphologiquesperes Resource Route
    Route::apiResource('/Indexesmorphologiquesperes', IndexesmorphologiquesperesController::class);
    // Grandmerepaternelles Resource route
    Route::apiResource('/Grandmerepaternelles', GrandmerepaternellesController::class);
    // Productionlaitieregrandmerematernelles Resource Route
    Route::apiResource('/Plaitieregrandmerematernelles', ProductionlaitieregrandmerematernellesController::class);
});
  Route::apiResource('/Sujet', SujetsController::class);
 Route::apiResource('/Eleveurproprietaire', EleveurproprietairesController::class);

    Route::get('/PdfData/{id}/{status}', 'SujetsController@pdfGeneratorData');

