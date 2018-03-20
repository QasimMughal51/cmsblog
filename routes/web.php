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

Route::get('/', [
    'uses'=>'Frontend@index',
    'as'=>'welcome'

    ]);
Route::get('/post/{slug}', [
    'uses'=>'Frontend@post',
    'as'=>'post.single'

]);
Route::get('/category/{id}',[

    'uses'=>'Frontend@category',
    'as'=>'category.single'
]);
Route::get('/tag/{id}',[

    'uses'=>'Frontend@tag',
    'as'=>'tag.single'
]);
Route::get('/search',function (){

    $posts=\App\Post::where('title','like','%'.request('search').'%')->get();
    return view('search')
        ->with('title', request()->search)
        ->with('categories', App\Category::take(6)->get())
        ->with('tags', App\Tag::all())
        ->with('settings',App\ Setting::first())
        ->with('posts',$posts);
})->name('search');

Auth::routes();


Route::group(['prefix'=>'admin' ,'middleware'=>'auth'],function (){

    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('/category/create',[

        'uses'=> 'CategoriesControlle@create',
        'as' =>'category.create'

    ]);
    Route::post('/category/store',[

        'uses' => 'CategoriesControlle@store',
        'as'   => 'category.store'
    ]);

    Route::get('/categories',[

        'uses'=>'CategoriesControlle@index',
        'as'=>'categories'
    ]);
    Route::get('category/edit/{id}',[

        'uses'=> 'CategoriesControlle@edit',
        'as'=>'category.edit'
    ]);

    Route::Post('category/update/{id}',[

        'uses'=> 'CategoriesControlle@update',
        'as'=>'category.update'
    ]);
    Route::get('category/delete/{id}',[

        'uses'=> 'CategoriesControlle@destroy',
        'as'=>'category.destroy'
    ]);
    Route::get('/post/create',[

        'uses'=> 'PostsController@create',
        'as'=> 'post.create'

    ]);
    Route::post('/post/store',[

        'uses'=> 'PostsController@store',
        'as'=> 'post.store'

    ]);
    Route::get('/posts',[

        'uses'=>'PostsController@index',
        'as'=>'posts'
    ]);
    Route::get('/post/edit{id}',[

        'uses'=>'PostsController@edit',
        'as'=>'post.edit'
    ]);
    Route::post('/post/update/{id}',[

        'uses'=>'PostsController@update',
        'as'=>'post.update'
    ]);
    Route::get('/post/trashed/{id}',[

        'uses'=>'PostsController@trashed',
        'as'=>'post.trashed'
    ]);
    Route::get('/post/trash',[

        'uses'=>'PostsController@trashedPosts',
        'as'=>'post.trash'
    ]);
    Route::get('/post/delete/{id}',[

        'uses'=> 'PostsController@destroy',
        'as'=>'post.delete'
    ]);
    Route::get('/post/restore/{id}',[

        'uses'=>'PostsController@restore',
        'as'=>'post.restore'
    ]);
    Route::get('/tag/create',[

        'uses'=>'TagsController@create',
        'as'=>'tag.create'
    ]);
    Route::get('/tags',[
        'uses'=>'TagsController@index',
        'as'=>'tags'
        ]);
    Route::post('/tag/store',[

        'uses'=>'TagsController@store',
        'as'=>'tag.store'
    ]);
    Route::get('/tag/edit/{id}',[

        'uses'=>'TagsController@edit',
        'as'=>'tag.edit'
    ]);
    Route::get('/tag/delete/{id}',[

        'uses'=>'TagsController@destroy',
        'as'=>'tag.delete'
    ]);
    Route::post('/tag/update/{id}',[

        'uses'=>'TagsController@update',
        'as'=>'tag.update'
    ]);
    Route::get('user/delete/{id}',[
        'uses'=>'UsersController@destroy',
        'as'=>'user.delete'

        ]);
    Route::get('/users',[

        'uses'=>'UsersController@index',
        'as'=>'users'
    ]);
    Route::get('/user/create',[

       'uses'=>'UsersController@create',
       'as'=>'user.create'
    ]);
    Route::post('user/store',[

        'uses'=>'UsersController@store',
        'as'=>'user.store'
    ]);
    Route::get('/user/admin/make/{id}',[

        'uses'=>'UsersController@make_admin',
        'as'=>'user.make.admin'
    ]);

    Route::get('/user/admin/remove/{id}',[

        'uses'=>'UsersController@remove_admin',
        'as'=>'user.remove.admin'
    ]);

    Route::get('/profile',[
        'uses'=>'UsersController@edit',
        'as'=>'user.edit'
    ]);
    Route::post('/profile/update/{id}',[

        'uses'=>'UsersController@update',
        'as'=>'user.update'
    ]);

    Route::get('/settings',[

        'uses'=>'SettingsController@edit',
        'as'=>'settings.update'
    ]);

});