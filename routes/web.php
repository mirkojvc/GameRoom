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

/*Route::get('/', function () {
    return view('components.index');
});*/

Route::get('/', 'HomeController@index');

Route::get('/category/{category_id}'      , 'HomeController@category');
Route::get('/category/{category_id}/pagination/{page}', 'HomeController@category_pagination')->where('page', '[0-9]+');;

Route::get('/ajax', 'HomeController@test');
Route::get('/pagination/{page}', 'HomeController@ajax_pagination')->where('page', '[0-9]+');


Route::middleware(['CheckAdmin'])->group(function () { 
    Route::prefix('admin')->group(function () {

        Route::get('/', 'AdminController@admin');

        Route::get('posts/{id?}', 'AdminController@posts');
        Route::get('posts/delete/{id}', 'AdminController@deletePost');
        Route::post('posts/update/{id}', 'AdminController@updatePost');
        Route::post('posts/save', 'AdminController@createPost');
        

        Route::get('categories/{id?}', 'AdminController@categories');
        Route::get('categories/delete/{id}', 'AdminController@deleteCategory');
        Route::post('categories/update/{id}', 'AdminController@updateCategory');
        Route::post('categories/save', 'AdminController@createCategory');
        Route::get('categories', 'AdminController@categories');


        Route::get('gallery', 'AdminController@gallery');

        Route::get('surveys/{id?}', 'AdminController@survey');
        Route::get('survey/delete/{id}', 'AdminController@deleteSurvey');
        Route::post('survey/update/{id}', 'AdminController@updateSurvey');
        Route::post('survey/save', 'AdminController@createSurvey');


        Route::get('surveys/{id}/answer/{anId?}', 'AdminController@surveyAnswer');
        Route::get('surveys/{id}/answer/delete/{anId}', 'AdminController@deleteAnswer');
        Route::post('surveys/{id}/answer/update/{anId}', 'AdminController@updateAnswer');
        Route::post('surveys/{id}/answer/save', 'AdminController@createSurveyAnswer');

    });     
});

Route::post('/userForm',
    [
        'as'    => 'userForm', 
        'uses'  => 'HomeController@userForm'
    ]
);

Route::post('/logout',
    [
        'as'    => 'logout', 
        'uses'  => 'HomeController@logout'
    ]
);
