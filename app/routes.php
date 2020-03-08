<?php

/**
 * List of route paths
 *
 * Here's an example of a simple route:
 * assign('MyTestRoute ->> /test', 'TestController@index()')
 */

assign('welcome -> /=/welcome', '/cms/WelcomeController@index');

assign('cms.articles.index   -> /=/articles', '/cms/ArticlesController@index');
post  ('cms.articles.fetch   -> /=/articles/fetch', '/cms/ArticlesController@fetch');
assign('cms.articles.create  -> /=/articles/create', '/cms/ArticlesController@create');
post  ('cms.articles.store   -> /=/articles/store', '/cms/ArticlesController@store');
assign('cms.articles.edit    -> /=/articles/edit/:any', '/cms/ArticlesController@edit');
assign('cms.articles.publish -> /=/articles/publish/:any', '/cms/ArticlesController@publish');
post  ('cms.articles.update  -> /=/articles/update', '/cms/ArticlesController@update');


assign('cms.media.index    -> /=/media-library', '/cms/MediaController@index');
assign('cms.media.fetch    -> /=/media-library/fetch/:any/:str/:any', '/cms/MediaController@fetch');
assign('cms.media.upload   -> /=/media-library/upload', '/cms/MediaController@upload');
post  ('cms.media.store    -> /=/media-library/store', '/cms/MediaController@store');
assign('cms.media.download -> /=/media-library/download/:int', '/cms/MediaController@download');


assign('cms.users.index  -> /=/users', '/cms/UsersController@index');
assign('cms.users.fetch  -> /=/users/fetch/:any/:str/:any', '/cms/UsersController@fetch');

assign('cms.users.create -> /=/users/create', '/cms/UsersController@create');
post  ('cms.users.store  -> /=/users/store', '/cms/UsersController@store');
assign('cms.users.edit   -> /=/users/edit', '/cms/UsersController@edit');
assign('cms.users.show   -> /=/users/:int', '/cms/UsersController@show');
post  ('cms.users.update -> /=/users/update', '/cms/UsersController@update');
post  ('cms.users.toggle -> /=/users/active/:int', '/cms/UsersController@toggle');





/**
 * Authentication & Password
 * reset routes
 */
assign('auth.login         -> /login', 'AuthController@index');
assign('auth.logout        -> /logout', 'AuthController@logout');
post('auth.attempt         -> /attempt', 'AuthController@attempt');
assign('auth.forgot.index  -> /forgot-password', 'AuthController@forgotPassword');
post('auth.forgot.email    -> /forgot-password/send-email', 'AuthController@sendEmail');
assign('auth.forgot.failed -> /password-reset/failed', 'AuthController@passwordTokenFailed');
post('auth.forgot.update   -> /password-reset/update', 'AuthController@updatePassword');
assign('auth.forgot.token  -> /password-reset/:token', 'AuthController@verifyToken');
