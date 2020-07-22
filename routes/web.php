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

use App\Http\Controllers\Blog\PostController;

Auth::routes(['verify' => true]);

/* BLOG */

Route::get('/', 'WelcomeController@index')->name('blogwelcome');

Route::get('blog/post/{post}', [PostController::class, 'show'])->name('blog.show');
Route::get('blog/categories/{category}', [PostController::class, 'category'])->name('blog.category');
Route::get('blog/tags/{tag}', [PostController::class, 'tag'])->name('blog.tag');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoriesController');
    Route::resource('posts', 'PostsController');
    Route::resource('tags', 'TagsController');
    Route::resource('comments', 'CommentsController');

    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
    Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-post');

    Route::post('/reply/store', 'CommentsController@replyStore')->name('reply.add');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');

    Route::put('users/profile', 'UsersController@update')->name('users.update-profile');

    Route::post('users/{users}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('users/{users}/make-writer', 'UsersController@makeWriter')->name('users.make-writer');
});


/* FORUM */
Route::get('/discuss', function () {
    return view('discuss');
});

Route::get('/forum', [
    'uses' => 'ForumsController@index',
    'as' => 'forum'
]);

Route::get('/search', [
    'uses' => 'ForumsController@search',
    'as' => 'search'
]);

Route::get('{provider}/auth', [
    'uses' => 'SocialsController@auth',
    'as' => 'social.auth'
]);

Route::get('/{provider}/redirect', [
    'uses' => 'SocialsController@auth_callback',
    'as' => 'social.callback'
]);

Route::get('discussions/{slug}', [
    'uses' => 'DiscussionsController@show',
    'as' => 'discussions'
]);

Route::get('channel/{slug}', [
    'uses' => 'ForumsController@channel',
    'as' => 'channel'
]);

Route::get('contact', [
    'uses'=>'ContactFormController@create',
    'as'=>'contactformcreate'
]);

Route::post('contact', [
    'uses'=>'ContactFormController@store',
    'as'=>'contactformstore'
]);

// Route::group(['middleware' => ['auth', 'verify']], function () {

Route::group(['middleware' => ['auth']], function () {

    Route::resource('channels', 'ChannelsController');
    Route::resource('profiles', 'ProfilesController');
    Route::resource('users', 'UsersController');

    Route::get('discussions/create/new', [
        'uses' => 'DiscussionsController@create',
        'as' => 'discussions.create'
    ]);

    Route::post('discussions/store', [
        'uses' => 'DiscussionsController@store',
        'as' => 'discussions.store'
    ]);

    Route::post('discussions/reply/{id}', [
        'uses' => 'DiscussionsController@reply',
        'as' => 'discussions.reply'
    ]);

    Route::get('/reply/like/{id}', [
        'uses' => 'RepliesController@like',
        'as' => 'reply.like'
    ]);

    Route::get('/reply/unlike/{id}', [
        'uses' => 'RepliesController@unlike',
        'as' => 'reply.unlike'
    ]);

    Route::get('/discussion/watch/{id}', [
        'uses' => 'WatchersController@watch',
        'as' => 'discussion.watch'
    ]);

    Route::get('/discussion/unwatch/{id}', [
        'uses' => 'WatchersController@unwatch',
        'as' => 'discussion.unwatch'
    ]);

    Route::get('/discussion/best/reply/{id}', [
        'uses' => 'RepliesController@best_answer',
        'as' => 'discussion.best.answer'
    ]);

    Route::get('/discussion/edit/{slug}', [
        'uses' => 'DiscussionsController@edit',
        'as' => 'discussion.edit'
    ]);

    Route::post('/discussions/update/{id}', [
        'uses' => 'DiscussionsController@update',
        'as' => 'discussion.update'
    ]);

    Route::delete('/discussions/delete/{id}', [
        'uses' => 'DiscussionsController@destroy',
        'as' => 'discussion.destroy'
    ]);

    Route::get('/reply/edit/{id}', [
        'uses' => 'RepliesController@edit',
        'as' => 'reply.edit'
    ]);

    Route::post('/reply/update/{id}', [
        'uses' => 'RepliesController@update',
        'as' => 'reply.update'
    ]);

    Route::get('users/{id}/discussions', [
        'uses' => 'UsersController@userDiscussions',
        'as' => 'users.discussions'
    ]);

    Route::get('/searchuser', [
        'uses' => 'UsersController@searchUser',
        'as' => 'searchuser'
    ]);

});






