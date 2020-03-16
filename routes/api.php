<?php


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





//Route::get('apiKey/{device_id}', 'ApiController@getApiKey');
//Route::get('api_access/apiKey/{device_id}', 'ApiController@getApiKey');


Route::group(["prefix"=> "v1"], function () {
    \App\Traits\Api\RegisterTrait::routesRegister();
    \App\Traits\Api\LoginTrait::routesLogin();
    \App\Traits\Api\PasswordTrait::routesPassword();
    \App\Traits\Api\PassportTrait::routesPassport();

});

Route::group(["prefix"=> "v1"], function () {

    Route::group(["middleware"=>"auth:api"], function () {

        Route::post('update', 'UserController@update');

    });
});

Route::resource('centers', 'CenterAPIController');

Route::resource('curricula', 'CurriculumAPIController');

Route::resource('groups', 'GroupAPIController');

Route::resource('levels', 'LevelAPIController');

Route::resource('questions', 'QuestionAPIController');

Route::resource('question_answers', 'QuestionAnswerAPIController');

Route::resource('question_banks', 'QuestionBankAPIController');

Route::resource('question_bank_groups', 'QuestionBankGroupAPIController');

Route::resource('question_drags', 'QuestionDragAPIController');

Route::resource('question_options', 'QuestionOptionAPIController');

Route::resource('question_powers', 'QuestionPowerAPIController');

Route::resource('question_types', 'QuestionTypeAPIController');

Route::resource('reservation_requests', 'ReservationRequestAPIController');

Route::resource('students', 'StudentAPIController');

Route::resource('exam_questions', 'ExamQuestionAPIController');

Route::resource('student_exams', 'StudentExamAPIController');

Route::resource('question_essays', 'QuestionEssayAPIController');