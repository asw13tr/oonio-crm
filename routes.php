<?php
    

    ASWRouter::get('', 'HomeController@index', 'home');

    ASWRouter::get('contacts', 'ContactController@index', 'contacts');
    ASWRouter::get('contact/create', 'ContactController@create', 'contact.create');
    ASWRouter::post('contact/save', 'ContactController@save', 'contact.create.post');
    ASWRouter::get('contact/:id/edit', 'ContactController@edit', 'contact.edit');
    ASWRouter::post('contact/:id/update', 'ContactController@update', 'contact.edit.post');
    ASWRouter::post('contact/:id/delete', 'ContactController@delete', 'contact.delete');


    ASWRouter::get('users',                     'UserController@index',     'users');
    ASWRouter::get('user/create',               'UserController@create',    'user.create');
    ASWRouter::post('user/save',         'UserController@createPost',    'user.create.post');
    ASWRouter::get('user/:id/edit',             'UserController@edit',      'user.edit');
    ASWRouter::post('user/:id/update',       'UserController@editPost',      'user.edit.post');
    ASWRouter::post('user/:id/delete',          'UserController@delete',    'user.delete.post');
    ASWRouter::post('user/:id/change-status',   'UserController@changeStatus', 'user.change.status');


    ASWRouter::get('todo',         'TodoController@index',     'todo');
    ASWRouter::get('todo/create',  'TodoController@create',    'todo.create');
    ASWRouter::get('todo/:id/edit',    'TodoController@edit',      'todo.edit');
    ASWRouter::get('todo/:id/delete',  'TodoController@delete',    'todo.delete');


    ASWRouter::get('documents',        'DocumentController@index',     'documents');
    ASWRouter::get('document/create',  'DocumentController@create',    'document.create');
    ASWRouter::get('document/:id/edit',    'DocumentController@edit',      'document.edit');
    ASWRouter::get('document/:id/delete',  'DocumentController@delete',    'document.delete');
    

    ASWRouter::get('404', 'ErrorController@not_found', '404');
    
?>