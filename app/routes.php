<?php
use App\Middleware\GuestMiddleware;
use App\Middleware\AuthMiddleware;

$app->group('', function () {
	$this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$this->post('/auth/signup', 'AuthController:postSignUp');
	$this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
	$this->post('/auth/signin', 'AuthController:postSignIn');
})->add(new GuestMiddleware($container));

$app->group('', function () {
	$this->get('/', 'TicketsController:index')->setName('home');
	$this->get('/tickets', 'TicketsController:index')->setName('tickets.index');
	$this->post('/tickets', 'TicketsController:store')->setName('tickets.store');
	$this->get('/tickets/create', 'TicketsController:create')->setName('tickets.create');
	$this->get('/tickets/{id}', 'TicketsController:show')->setName('tickets.show');
	$this->get('/tickets/{id}/edit', 'TicketsController:edit')->setName('tickets.edit');
	$this->post('/tickets/{id}', 'TicketsController:update')->setName('tickets.update');
	$this->get('/tickets/{id}/delete', 'TicketsController:destroy')->setName('tickets.delete');
	
	$this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
	$this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/auth/password/change', 'PasswordController:postChangePassword');
})->add(new AuthMiddleware($container));



