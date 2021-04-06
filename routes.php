<?php
    

    ASWRouter::get('', 'HomeController@index', 'home');

    ASWRouter::get('customers', 'CustomerController@index', 'customers');
    ASWRouter::get('customer/create', 'CustomerController@create', 'customer.create');
    ASWRouter::get('customer/:id/edit', 'CustomerController@edit', 'customer.edit');
    ASWRouter::get('customer/:id/delete', 'CustomerController@delete', 'customer.delete');


    ASWRouter::get('users',        'UserController@index',     'users');
    ASWRouter::get('user/create',  'UserController@create',    'user.create');
    ASWRouter::post('user/create/post',  'UserController@createPost',    'user.create.post');
    ASWRouter::get('user/:id/edit',    'UserController@edit',      'user.edit');
    ASWRouter::post('user/:id/edit/post',    'UserController@editPost',      'user.edit.post');
    ASWRouter::get('user/:id/delete',  'UserController@delete',    'user.delete');


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