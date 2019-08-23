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
	$this->post('/tickets', 'TicketsController:create')->setName('tickets.create');
	$this->get('/tickets/create', 'TicketsController:getCreationForm')->setName('tickets.getCreationForm');
	$this->get('/tickets/{id}', 'TicketsController:show')->setName('tickets.show');
	$this->get('/tickets/{id}/edit', 'TicketsController:getEditionForm')->setName('tickets.getEditionForm');
	$this->get('/tickets/{id}/delete', 'TicketsController:destroy')->setName('tickets.delete');
	
	$this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
	$this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/auth/password/change', 'PasswordController:postChangePassword');
})->add(new AuthMiddleware($container));



