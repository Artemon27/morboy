<?php


use App\Http\Controllers\MorBoyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MafkaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [MorBoyController::class, 'osnova']);
//Админка:
Route::get('admin',[MorBoyController::class, 'admin']);
Route::post('admins',[MorBoyController::class, 'createStore']);
Route::post('admins2',[MorBoyController::class, 'createAdmin']);
Route::post('admins3',[MorBoyController::class, 'createDostup']);
Route::post('slovaDlyaVystrela',[MorBoyController::class, 'createSlovaDlyaVystrela']);

Route::get('admin/users',[MorBoyController::class, 'admin']); 
Route::get('admin/pole',[MorBoyController::class, 'adminPole']); 
Route::get('admin/frazy',[MorBoyController::class, 'adminFrazy']); 

//Само поле:
Route::get('morboy',[MorBoyController::class, 'osnova']);
//После выстрела:
Route::post('proverka',[MorBoyController::class, 'proverka']);
//Ввод сообщения в чат
Route::post('sendmsg',[MorBoyController::class, 'sendmsg']);
//есть ли новые сообщения?
Route::post('newmsg',[MorBoyController::class, 'newmsg']);
//Кто онлайн?
Route::post('chatonline',[MorBoyController::class, 'chatonline']);
//Удаление сообщений:
Route::post('delmsg',[MorBoyController::class, 'delmsg']);
//
//
//
//
//Личная страничка пользователя:
Route::get('mypage',[MorBoyController::class, 'mypage']);

//
//
//
//
//
//
//
//Логи:
Route::get('log/{idgame}',[MorBoyController::class, 'log']);

Route::get('log',[MorBoyController::class, 'log']);


Auth::routes();


Route::get('/home',[HomeController::class, 'index']);

Route::post('/proverka2',[MorBoyController::class, 'proverka2']);


////////////Мафия:
Route::get('/mafka',[MafkaController::class, 'mafka']); 
Route::get('/mafka/game/{id}',[MafkaController::class, 'partia']); 
Route::get('/mafkagame',[MafkaController::class, 'game']);

Route::post('/mafka/gameonline', [MafkaController::class, 'gameonline']);
Route::post('/mafka/deystvie',[MafkaController::class, 'deystvie']);
Route::post('/mafka/create',[MafkaController::class, 'create']); 
Route::post('/mafka/gameorno', [MafkaController::class, 'gameorno']);

