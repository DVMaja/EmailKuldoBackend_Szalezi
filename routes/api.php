<?php

use App\Http\Controllers\MailSenderController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\Sent_letterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentMailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//Json file készítése
//Route::get('mail_data_jsonbe', [StudentMailController::class, 'mailDatasJsonba']);



//Ez kell!
Route::get('data_jsonbe', [StudentController::class, 'studentDatasJsonba']);

//CSV fájl feltöltése
Route::post('/upload_csv', [StudentController::class, 'uploadCsv']);




//Major
Route::get('/majors', [MajorController::class, 'index']);
Route::get('/majors/{id}', [MajorController::class, 'show']);
Route::post('/majors', [MajorController::class, 'store']);
Route::put('/majors/{id}', [MajorController::class, 'update']);
Route::delete('/majors{id}', [MajorController::class, 'destroy']);

//Student
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{student_id}', [StudentController::class, 'show']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{student_id}', [StudentController::class, 'update']);
Route::delete('/students{student_id}', [StudentController::class, 'destroy']);

//MailSender
Route::get('/mail_senders', [MailSenderController::class, 'index']);
Route::get('/mail_senders/{id}', [MailSenderController::class, 'show']);
Route::post('/mail_senders', [MailSenderController::class, 'store']);
Route::put('/mail_senders/{id}', [MailSenderController::class, 'update']);
Route::delete('/mail_senders{id}', [MailSenderController::class, 'destroy']);

//Sent_letter
Route::get('/sent_letters', [Sent_letterController::class, 'index']);
Route::get('/sent_letters/{id}', [Sent_letterController::class, 'show']);
Route::post('/sent_letters', [Sent_letterController::class, 'store']);
Route::put('/sent_letters/{id}', [Sent_letterController::class, 'update']);
Route::delete('/sent_letters{id}', [Sent_letterController::class, 'destroy']);

//User
