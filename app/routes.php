<?php

$router->get('', 'PagesController@login');
$router->get('register', 'PagesController@register');
$router->get('panel', 'PagesController@panel');

$router->post('register', 'UsersController@store');
$router->post('login', 'UsersController@login');
$router->get('logout', 'UsersController@logout');
$router->get('reset', 'UsersController@reset');
$router->post('reset', 'UsersController@sendPassword');
$router->post('newpass', 'UsersController@newPassword');

$router->get('companies', 'CompaniesController@show');
$router->get('companies/sort', 'CompaniesController@showSorted');
$router->get('companies/add', 'CompaniesController@create');
$router->post('companies/add', 'CompaniesController@store');
$router->get('companies/edit', 'CompaniesController@editForm');
$router->post('companies/edit', 'CompaniesController@edit');
$router->post('companies/delete', 'CompaniesController@delete');

$router->get('contacts', 'ContactsController@show');
$router->get('contacts/add', 'ContactsController@create');
$router->post('contacts/add', 'ContactsController@store');
$router->get('contacts/edit', 'ContactsController@editForm');
$router->post('contacts/edit', 'ContactsController@edit');
$router->post('contacts/delete', 'ContactsController@delete');

$router->get('traders', 'TradersController@show');
$router->get('traders/add', 'TradersController@create');
$router->post('traders/add', 'TradersController@store');
$router->get('traders/edit', 'TradersController@editForm');
$router->post('traders/edit', 'TradersController@edit');
$router->post('traders/delete', 'TradersController@delete');

$router->get('photos', 'PhotosController@show');
$router->get('photos/add', 'PhotosController@create');
$router->post('photos/add', 'PhotosController@store');
$router->get('photos/edit', 'PhotosController@editForm');
$router->post('photos/edit', 'PhotosController@edit');
$router->post('photos/delete', 'PhotosController@delete');

$router->get('questions', 'QuestionsController@show');
$router->get('questions/add', 'QuestionsController@create');
$router->post('questions/add', 'QuestionsController@store');
$router->get('questions/edit', 'QuestionsController@editForm');
$router->post('questions/edit', 'QuestionsController@edit');
$router->post('questions/delete', 'QuestionsController@delete');

$router->get('results', 'QuestionnaireController@show');
$router->get('showka', 'QuestionnaireController@showka');
$router->post('results', 'QuestionnaireController@showQuestions');
$router->post('questionnaire/add', 'QuestionnaireController@store');
