<?php

    ASWRouter::get('login', 'SessionController@login', 'login');
    ASWRouter::post('login/do', 'SessionController@loginPost', 'login.post');
    ASWRouter::get('logout', 'SessionController@logout', 'logout');

    ASWRouter::get('', 'HomeController@index', 'home');

    // CONTACTS
    ASWRouter::get('contacts', 'ContactController@index', 'contacts');
    ASWRouter::get('contact/create', 'ContactController@create', 'contact.create');
    ASWRouter::post('contact/save', 'ContactController@save', 'contact.create.post');
    ASWRouter::get('contact/:id/edit', 'ContactController@edit', 'contact.edit');
    ASWRouter::post('contact/:id/update', 'ContactController@update', 'contact.edit.post');
    ASWRouter::post('contact/:id/delete', 'ContactController@delete', 'contact.delete');
    ASWRouter::get('contact/:id/popup', 'ContactController@popup', 'contact.popup');

    // USERS
    ASWRouter::get('users',                     'UserController@index',     'users');
    ASWRouter::get('user/create',               'UserController@create',    'user.create');
    ASWRouter::post('user/save',         'UserController@createPost',    'user.create.post');
    ASWRouter::get('user/:id/edit',             'UserController@edit',      'user.edit');
    ASWRouter::post('user/:id/update',       'UserController@editPost',      'user.edit.post');
    ASWRouter::post('user/:id/delete',          'UserController@delete',    'user.delete.post');
    ASWRouter::post('user/:id/change-status',   'UserController@changeStatus', 'user.change.status');

    // PROJECTS
    ASWRouter::get( 'projects', 'ProjectController@index', 'projects');
    ASWRouter::get( 'project/create', 'ProjectController@create', 'project.create');
    ASWRouter::post('project/save', 'ProjectController@save', 'project.save');
    ASWRouter::get( 'project/:id',          'ProjectController@show',    'project.show');
    ASWRouter::get( 'project/:id/popup',          'ProjectController@popup',    'project.popup');
    ASWRouter::get( 'project/:id/edit', 'ProjectController@edit', 'project.edit');
    ASWRouter::post('project/:id/update', 'ProjectController@update', 'project.update');
    ASWRouter::post('project/:id/delete',          'ProjectController@delete',    'project.delete');


    // PROJECT DATAS
    ASWRouter::get( 'project/:id/data/create', 'ProjectDataController@create', 'project.data.create');
    ASWRouter::post('project/:id/data/save', 'ProjectDataController@save', 'project.data.save');
    ASWRouter::get( 'project/data/:id/edit', 'ProjectDataController@edit', 'project.data.edit');
    ASWRouter::post('project/data/:id/update', 'ProjectDataController@update', 'project.data.update');
    ASWRouter::post('project/data/:id/decrypt', 'ProjectDataController@decrypt', 'project.data.decrypt');
    ASWRouter::post('project/data/:id/delete',          'ProjectDataController@delete',    'project.data.delete');

    // PROJECT TAGS
    ASWRouter::get( 'projects/tags', 'ProjectTagController@index', 'project.tags');
    ASWRouter::post('project/tag/save', 'ProjectTagController@save', 'project.tag.save');
    ASWRouter::get( 'project/tag/:id/edit', 'ProjectTagController@edit', 'project.tag.edit');
    ASWRouter::post('project/tag/:id/update', 'ProjectTagController@update', 'project.tag.update');
    ASWRouter::post('project/tag/:id/delete', 'ProjectTagController@delete', 'project.tag.delete');

    // TASKS
    ASWRouter::get( 'tasks',         'TaskController@index',     'tasks');
    ASWRouter::get( 'task/filter/:key/:val', 'TaskController@filter', "task.filter");
    ASWRouter::get( 'task/create',  'TaskController@create',    'task.create');
    ASWRouter::post('task/save',    'TaskController@save',    'task.save');
    ASWRouter::get( 'task/:id',          'TaskController@show',    'task.show');
    ASWRouter::get( 'task/:id/popup',          'TaskController@popup',    'task.popup');
    ASWRouter::get( 'task/:id/edit',    'TaskController@edit',      'task.edit');
    ASWRouter::post('task/:id/update',    'TaskController@update',      'task.update');
    ASWRouter::post('task/:id/delete',  'TaskController@delete',    'task.delete');
    

    ASWRouter::get('404', 'ErrorController@not_found', '404');
    
?>