<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Auth::routes(['logout'=> false]);

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/logoutApi', 'Auth\LoginController@logoutApi');
    Route::post('/logout', function (){
        return redirect('/logoutApi');
    });
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/users', 'HomeController@users');
    Route::post('/createRoom', 'MessageController@room');
    Route::post('/chat', 'MessageController@index');
    Route::post('/send', 'MessageController@store');



	Route::prefix('chats')->group(function () {
		Route::get('/', 'ChatNewController@index');
		Route::get('{chat}/messages', 'MessageNewController@getChatMessages');
		Route::post('{chat}/messages', 'MessageNewController@storeChatMessage');
	});
	Route::prefix('messages')->group(function () {
		Route::post('mark-read', 'MessageNewController@markReadMessage');
		Route::get('/', 'MessageNewController@getMessages');

		/*Route::prefix('{message:id}')->group(function() {
			Route::get('file', 'MessagesController@getFile')->middleware('isChatMember')->name('api.client.message.file');
		});*/
	});
});
