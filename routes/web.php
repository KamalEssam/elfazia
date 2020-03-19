<?php

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

use Illuminate\Support\Facades\Route;

Route::get('admin', function () {
    return redirect('admin/home');
});



// Login Routes...
Route::get('admin/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('admin/login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('admin/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes...
Route::get('admin/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('admin/register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);
// add new user as doctor or manager or teacher
Route::post('admin/user/add','UserController@addUser')->name('add.new.user');

// Password Reset Routes...
Route::get('admin/password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('admin/password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('admin/password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('admin/password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);


//web routes
Route::get('admin/home', 'HomeController@index');
Route::get('admin', 'HomeController@index');

Route::get('', 'HomeController@index');
Route::post('', 'HomeController@index');



//generator routes
Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');
Route::get('generator_builder/availableSchema', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@availableSchema');
//



Route::resource('admin/centers', 'CenterController');
Route::get('admin/centers/data/table', 'CenterController@data')->name('centers.ajax');
Route::get('admin/centers/delete/records', 'CenterController@destroy')->name('centers.delete');


Route::resource('admin/curricula', 'CurriculumController');
Route::get('admin/curricula/student/show', 'CurriculumController@studentShow')->name('curricula.student');
Route::get('admin/curricula/data/table', 'CurriculumController@data')->name('curricula.ajax');
Route::get('admin/curricula/delete/records', 'CurriculumController@destroy')->name('curricula.delete');


Route::resource('admin/groups', 'GroupController');
Route::get('admin/groups/ajax/{id}', 'GroupController@ajax');
Route::get('admin/groups/data/table', 'GroupController@data')->name('groups.ajax');
Route::get('admin/groups/delete/records', 'GroupController@destroy')->name('groups.delete');


Route::resource('admin/levels', 'LevelController');
Route::get('admin/levels/data/table', 'LevelController@data')->name('levels.ajax');
Route::get('admin/levels/delete/records', 'LevelController@destroy')->name('levels.delete');


Route::resource('admin/questions', 'QuestionController');
Route::get('admin/questions/data/table', 'QuestionController@data')->name('questions.ajax');
Route::get('admin/questions/delete/records', 'QuestionController@destroy')->name('questions.delete');


Route::resource('admin/questionAnswers', 'QuestionAnswerController');
Route::get('admin/questionAnswers/data/table', 'QuestionAnswerController@data')->name('questionAnswers.ajax');
Route::get('admin/questionAnswers/delete/records', 'QuestionAnswerController@destroy')->name('questionAnswers.delete');


Route::resource('admin/questionBanks', 'QuestionBankController');
Route::get('admin/questionBanks/exams/index', 'QuestionBankController@exams')->name('questionBanks.exams');
Route::get('admin/questionBanks/exams/create', 'QuestionBankController@createExam')->name('questionBanks.createExam');
Route::get('admin/questionBanks/data/table/exams', 'QuestionBankController@dataExams')->name('questionBanks.examsAjax');
Route::get('admin/questionBanks/data/table', 'QuestionBankController@data')->name('questionBanks.ajax');
Route::get('admin/questionBanks/delete/records', 'QuestionBankController@destroy')->name('questionBanks.delete');

Route::get('admin/questionBanks/student/index', 'QuestionBankController@student')->name('questionBanks.student');
Route::get('admin/questionBanks/data/table/student', 'QuestionBankController@dataStudent')->name('questionBanks.studentAjax');
Route::get('admin/questionBanks/student/test', 'QuestionBankController@studentTest')->name('questionBanks.testNow');
Route::post('admin/questionBanks/student/test', 'QuestionBankController@studentTest')->name('questionBanks.testNow');
Route::get('admin/questionsBank/ajax/check', 'QuestionBankController@checkAnswerAjax')->name('questionBanks.ajaxCheck');
Route::get('admin/questionsBank/generate/ajax', 'QuestionBankController@generateFromBank')->name('questionBanks.generateFromBank');
Route::get('admin/questionBanks/student/test/result', 'QuestionBankController@testResult')->name('questionBanks.testResult');
Route::get('admin/exams/student/report', 'QuestionBankController@studentReport')->name('studentExams.report');

Route::get('admin/questionBanks/print/bank', 'QuestionBankController@printBank')->name('questionBanks.printBank');


Route::resource('admin/questionBankGroups', 'QuestionBankGroupController');
Route::get('admin/questionBankGroups/data/table', 'QuestionBankGroupController@data')->name('questionBankGroups.ajax');
Route::get('admin/questionBankGroups/delete/records', 'QuestionBankGroupController@destroy')->name('questionBankGroups.delete');


Route::resource('admin/questionDrags', 'QuestionDragController');
Route::get('admin/questionDrags/data/table', 'QuestionDragController@data')->name('questionDrags.ajax');
Route::get('admin/questionDrags/delete/records', 'QuestionDragController@destroy')->name('questionDrags.delete');


Route::resource('admin/questionOptions', 'QuestionOptionController');
Route::get('admin/questionOptions/data/table', 'QuestionOptionController@data')->name('questionOptions.ajax');
Route::get('admin/questionOptions/delete/records', 'QuestionOptionController@destroy')->name('questionOptions.delete');


Route::resource('admin/questionPowers', 'QuestionPowerController');
Route::get('admin/questionPowers/data/table', 'QuestionPowerController@data')->name('questionPowers.ajax');
Route::get('admin/questionPowers/delete/records', 'QuestionPowerController@destroy')->name('questionPowers.delete');


Route::resource('admin/questionTypes', 'QuestionTypeController');
Route::get('admin/questionTypes/data/table', 'QuestionTypeController@data')->name('questionTypes.ajax');
Route::get('admin/questionTypes/delete/records', 'QuestionTypeController@destroy')->name('questionTypes.delete');


Route::resource('admin/reservationRequests', 'ReservationRequestController');
Route::get('admin/reservationRequests/data/table', 'ReservationRequestController@data')->name('reservationRequests.ajax');
Route::get('admin/reservationRequests/delete/records', 'ReservationRequestController@destroy')->name('reservationRequests.delete');


Route::resource('admin/students', 'StudentController');
Route::get('admin/students/data/table', 'StudentController@data')->name('students.ajax');
Route::get('admin/students/delete/records', 'StudentController@destroy')->name('students.delete');
Route::get('admin/students/banks/report', 'StudentController@banksReport')->name('students.banks');
Route::get('admin/students/banks/correction', 'StudentController@bankCorrection')->name('students.banks.correction');
Route::post('admin/students/banks/correction', 'StudentController@bankCorrectionStore')->name('students.banks.correction.store');


Route::resource('admin/examQuestions', 'ExamQuestionController');
Route::get('admin/examQuestions/data/table', 'ExamQuestionController@data')->name('examQuestions.ajax');
Route::get('admin/examQuestions/delete/records', 'ExamQuestionController@destroy')->name('examQuestions.delete');


Route::resource('admin/studentExams', 'StudentExamController');
Route::get('admin/studentExams/data/table', 'StudentExamController@data')->name('studentExams.ajax');
Route::get('admin/studentExams/delete/records', 'StudentExamController@destroy')->name('studentExams.delete');


Route::resource('admin/questionEssays', 'QuestionEssayController');
Route::get('admin/questionEssays/data/table', 'QuestionEssayController@data')->name('questionEssays.ajax');
Route::get('admin/questionEssays/delete/records', 'QuestionEssayController@destroy')->name('questionEssays.delete');

Route::get('admin/info/point/teacher/{id}', 'pointController@getInfoPage')->name('get.info.page');
Route::post('admin/info/add/new/student', 'pointController@addStudent')->name('add.new.student');

Route::get('admin/get/card/generator','generateCardController@getcardGenerator');
Route::post('admin/generate/code','generateCardController@postcardGenerator');
Route::post('admin/charge/point','generateCardController@chargeCard');

