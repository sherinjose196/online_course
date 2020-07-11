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
Route::group(['middleware' => 'guest'], function () {
				
		Route::post('user/auth', ['as' => 'AdminAuthManage', 'uses' => 'SettingsController@authManage']);

        
       Route::get('user', ['as' => 'User', 'uses' => 'SettingsController@getView']);
       Route::get('register', ['as' => 'Register', 'uses' => 'SettingsController@getView']);		
			});

Route::group(['middleware' => ['auth']], function () {

	Route::get('categorys', ['as' => 'Categorys', 'uses' => 'SettingsController@getView']);
    Route::get('create_category', ['as' => 'NewCategory', 'uses' => 'SettingsController@getView']);
    Route::get('edit_category/{token?}', ['as' => 'EditCategory', 'uses' => 'SettingsController@getView']);

    Route::get('courses', ['as' => 'Courses', 'uses' => 'SettingsController@getView']);
    Route::get('create_course', ['as' => 'NewCourse', 'uses' => 'SettingsController@getView']);
    Route::get('edit_course/{token?}', ['as' => 'EditCourse', 'uses' => 'SettingsController@getView']);

    Route::get('logout', ['as' => 'AdminLogout', 'uses' => 'SettingsController@logout']);
	Route::post('post-image', ['as' => 'PostImageUpload', 'uses' => 'PostController@postFileUpload']);

    Route::post('post-data', ['as' => 'postData', 'uses' => 'PostController@postManage']);
	 });


Route::get('online_course', ['as' => 'OnlineCourse', 'uses' => 'SettingsController@getView']);
Route::get('/', function () {
    return view('welcome');
});
