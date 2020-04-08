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

use App\User;
use App\Question;
use App\Answer;
use App\Follow;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->middleware('admin')->name('dashboard.index');

    Route::get('/home', 'HomeController@index')->name('home.index');

    Route::resource('/settings', 'SettingsController');

    Route::get('/friends', 'ProfileController@friends')->name('profile.friends');

    Route::get('/search', 'ProfileController@find')->name('profile.find');
    // Questions
    // Ask User
    Route::post('AskUser', 'QuestionsController@Ask')->name('profile.ask');
    // Show My Questions Recived to me
    Route::get('/questions', 'QuestionsController@index')->name('profile.questions');
    // Delete The Question Recived to me
    Route::get('/questions/{QuestionID}', 'QuestionsController@delete')->name('question.delete');
    // Show to the Question to answer
    Route::get('/questions-answer/{QuestionID}', 'QuestionsController@show')->name('question.show');
    // Answer Question Recieved to me
    Route::post('/questions-answer/{QuestionID}/answer', 'QuestionsController@answer')->name('question.answer');

    //Answers
    // show the Answer
    Route::get('/answer/{AnswerID}', 'AnswersController@index')->name('answer.index');
    // Delete Answer That i did
    Route::post('/answer/{AnswerID}/delete', 'AnswersController@delete')->name('answer.delete');


    Route::get('/{profile}', function ($profile) {
        if ($profile == Auth::user()->user_name) {
            return view('profile.index')
                ->with('user', User::all()->where('id', Auth::user()->id)->first())
                ->with('questions', Question::where('to_id', Auth::user()->id)->where('answerd', '1')->get())
                ->with('answers', Answer::where('to_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get())
                ->with('other_user', User::all())
                ->with('following', Follow::all());


        } else {
            $UserID = User::all()->where('user_name', $profile)->first()->id;
            return view('user.index')
                ->with('user', User::all()->where('user_name', $profile)->first())
                ->with('questions', Question::where('to_id', $UserID)->where('answerd', '1')->get())
                ->with('answers', Answer::where('to_id', $UserID)->orderBy('updated_at', 'DESC')->get())
                ->with('other_user', User::all());

        }

    })->name('profile.index');
    Route::get('/{profile}/follow', 'ProfileController@follow')->name('profile.follow');


});



