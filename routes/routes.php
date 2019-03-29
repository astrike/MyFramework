<?php

use SDK\Facades\Route;

Route::get('/', ['controller' => 'MainController', 'action' => 'index']);

Route::get('about',    ['controller' => 'MainController',  'action' => 'about'    ]);
Route::get('contacts', ['controller' => 'MainController',  'action' => 'contacts' ]);


Route::get('articleCatalog',               ['controller' => 'ArticleController',  'action' => 'articleFullCatalog']);
Route::get('articleCatalog/category/{i}',  ['controller' => 'ArticleController',  'action' => 'findCategory'    ]);
Route::get('article/{i}',                  ['controller' => 'ArticleController',  'action' => 'articleView'      ]);


Route::get( 'login',    ['controller' => 'AuthController',  'action' => 'login'       ]);
Route::get( 'logout',   ['controller' => 'AuthController',  'action' => 'logout'      ]);
Route::get( 'register', ['controller' => 'AuthController',  'action' => 'register'    ]);
Route::post('login',    ['controller' => 'AuthController',  'action' => 'postLogin'   ]);
Route::post('register', ['controller' => 'AuthController',  'action' => 'postRegister']);


Route::get( 'admin',                 ['controller' => 'AdminController',  'action' => 'adminPanel',      'middleware' => 'isAdmin']);
Route::post('admin/aboutMeEdit',     ['controller' => 'AdminController',  'action' => 'aboutMeEditPost', 'middleware' => 'isAdmin']);
Route::post('admin/socialEdit',      ['controller' => 'AdminController',  'action' => 'socialEditPost',  'middleware' => 'isAdmin']);
Route::get( 'admin/articles',        ['controller' => 'AdminController',  'action' => 'articlesCatalog', 'middleware' => 'isAdmin']);
Route::get( 'admin/categories',      ['controller' => 'AdminController',  'action' => 'categories'     , 'middleware' => 'isAdmin']);
Route::get( 'admin/aboutMePageEdit', ['controller' => 'AdminController',  'action' => 'aboutMePageEdit', 'middleware' => 'isAdmin']);
Route::post('admin/aboutMePageEdit', ['controller' => 'AdminController',  'action' => 'aboutMePagePost', 'middleware' => 'isAdmin']);


Route::post('comment',       ['controller' => 'CommentController', 'action' => 'store']);
Route::get( 'commentDelete', ['controller' => 'CommentController', 'action' => 'delete', 'middleware' => 'isAdmin']);


Route::post('search',              ['controller' => 'ArticleController',  'action' => 'search']);
Route::get( 'articleCreate',       ['controller' => 'ArticleController',  'action' => 'create'           , 'middleware' => 'isAdmin']);
Route::post('articleCreate',       ['controller' => 'ArticleController',  'action' => 'createPost'       , 'middleware' => 'isAdmin']);
Route::get( 'articleEdit/{id}',    ['controller' => 'ArticleController',  'action' => 'edit'             , 'middleware' => 'isAdmin']);
Route::post('articleEdit',         ['controller' => 'ArticleController',  'action' => 'editPost'         , 'middleware' => 'isAdmin']);
Route::get( 'article/delete/{id}', ['controller' => 'ArticleController',  'action' => 'delete'           , 'middleware' => 'isAdmin']);


Route::post('ulogin', ['controller' => 'uLoginController', 'action' => 'login']);
