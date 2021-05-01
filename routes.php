<?php
    

    ASWRouter::get('', 'HomeController@index', 'home');

    // CONTACTS
    ASWRouter::get('contacts', 'ContactController@index', 'contacts');
    ASWRouter::get('contact/create', 'ContactController@create', 'contact.create');
    ASWRouter::post('contact/save', 'ContactController@save', 'contact.create.post');
    ASWRouter::get('contact/:id/edit', 'ContactController@edit', 'contact.edit');
    ASWRouter::post('contact/:id/update', 'ContactController@update', 'contact.edit.post');
    ASWRouter::post('contact/:id/delete', 'ContactController@delete', 'contact.delete');

    // USERS
    ASWRouter::get('users',                     'UserController@index',     'users');
    ASWRouter::get('user/create',               'UserController@create',    'user.create');
    ASWRouter::post('user/save',         'UserController@createPost',    'user.create.post');
    ASWRouter::get('user/:id/edit',             'UserController@edit',      'user.edit');
    ASWRouter::post('user/:id/update',       'UserController@editPost',      'user.edit.post');
    ASWRouter::post('user/:id/delete',          'UserController@delete',    'user.delete.post');
    ASWRouter::post('user/:id/change-status',   'UserController@changeStatus', 'user.change.status');

    // PROJECTS
    ASWRouter::get('projects', 'ProjectController@index', 'projects');
    ASWRouter::get('project/create', 'ProjectController@create', 'project.create');
    ASWRouter::post('project/save', 'ProjectController@save', 'project.save');
    ASWRouter::get('project/:id/edit', 'ProjectController@edit', 'project.edit');
    ASWRouter::post('project/:id/update', 'ProjectController@update', 'project.update');
    ASWRouter::post('project/:id/delete',          'ProjectController@delete',    'project.delete');

    // PROJECT TAGS
    ASWRouter::get('projects/tags', 'ProjectTagController@index', 'project.tags');
    ASWRouter::post('project/tag/save', 'ProjectTagController@save', 'project.tag.save');
    ASWRouter::get('project/tag/:id/edit', 'ProjectTagController@edit', 'project.tag.edit');
    ASWRouter::post('project/tag/:id/update', 'ProjectTagController@update', 'project.tag.update');
    ASWRouter::post('project/tag/:id/delete', 'ProjectTagController@delete', 'project.tag.delete');

    // TASKS
    ASWRouter::get('todo',         'TodoController@index',     'todo');
    ASWRouter::get('todo/create',  'TodoController@create',    'todo.create');
    ASWRouter::get('todo/:id/edit',    'TodoController@edit',      'todo.edit');
    ASWRouter::get('todo/:id/delete',  'TodoController@delete',    'todo.delete');

    // DOCUMENTS
    ASWRouter::get('documents',        'DocumentController@index',     'documents');
    ASWRouter::get('document/create',  'DocumentController@create',    'document.create');
    ASWRouter::get('document/:id/edit',    'DocumentController@edit',      'document.edit');
    ASWRouter::get('document/:id/delete',  'DocumentController@delete',    'document.delete');
    

    ASWRouter::get('404', 'ErrorController@not_found', '404');
    
?>