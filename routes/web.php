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

Route::get('/', 'QuestionController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('question', 'QuestionController')->except('show');

Route::get('question/{slug}', 'QuestionController@show')->name('question.show');
//Route::post('question/{question}/answer', 'AnswersController@store')->name('answer.store');

Route::resource('question.answer', 'AnswersController')->only(['store', 'edit', 'update', 'destroy', 'index']);

Route::post('/answers/{answer}/accept', 'AcceptAnswersController@accept')->name('answers.accept');

Route::post('/question/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');
Route::delete('/question/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');

Route::post('/question/{question}/vote', 'VoteQuestionController@vote')->name('questions.vote');

Route::post('/answers/{answer}/vote', 'VoteAnswerController@vote')->name('answers.vote');
