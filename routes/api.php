<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('/user')->group(function () {
    // global $users;
    Route::get('/', function () {
        global $users;
        for ($i = 0; $i < count($users); $i++) {
            return $users;
        }
    });

    Route::get('/{userIndex}', function ($userIndex) {
        global $users;

        for ($i = 0; $i < count($users); $i++) {
            if ($i == $userIndex) {
                return $users[$i];
            }
        }
        // return "Cannot find the user with id is " . $userIndex;
    })->where(['userIndex' => '[0-9]+']);

    Route::get('/{userName}', function ($userName) {
        global $users;
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['name'] == $userName) {
                return $users[$i];
            }
        }
    })->where(['userName' => '[a-zA-Z]+']);

    Route::fallback(function () {
        return "You cannot get the user like this !";
    });

    Route::get('/{userIndex}/post/{postIndex}', function ($userIndex, $postIndex) {
        global $users;

        foreach ($users as $index => $user) {
            if ($userIndex == $index) {
                foreach ($user['posts'] as $key => $post) {
                    if ($key == $postIndex) {
                        return $post;
                    }
                }
            }
        }
        return "Canot find  post index " . $postIndex . ' for the user index ' . $userIndex;
    })->where(['userName' => '[0-9]+', 'userIndex' => '[0-9]+']);
});

