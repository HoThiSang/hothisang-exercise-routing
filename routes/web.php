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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    global $users;
    // return $users;
    $result = '';   
    for ($i = 0; $i < count($users); $i++) {
        $result .= $users[$i]['name'];
        if($i<count($users)-1){
                $result .= ', ';
        }
        
    }
    return 'The users are : ' . $result;
});


