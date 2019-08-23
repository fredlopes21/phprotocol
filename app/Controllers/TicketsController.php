<?php

namespace App\Controllers;

use App\Models\Ticket;
use Respect\Validation\Validator as v;

/**
 * TicketsController
 *
 * @author    Lucas Rocha <lucasrochabr[at]outlook[dot]com>
 * @copyright    Copyleft (c) Lucas Rocha
 */
class TicketsController extends Controller
{
	public function index($request, $response)
	{
		return $this->view->render($response,'tickets/index.twig', [
			'tickets' => Ticket::all()
		]);
	}

	public function getCreationForm($request, $response)
	{
		return $this->view->render($response,'tickets/create.twig');
	}
	
	public function create($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'user' => v::noWhitespace()->notEmpty(),
			'company' => v::noWhitespace()->notEmpty(),
			'channel' => v::noWhitespace()->notEmpty(),
			'type' => v::noWhitespace()->notEmpty(),
			'module' => v::noWhitespace()->notEmpty(),
		]);

		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('tickets.getCreationForm'));
		}

		$ticket = new Ticket($request->getParams());
		$ticket->save();

		$this->flash->addMessage('info', 'Ticket created');

		return $response->withRedirect($this->router->pathFor('tickets.index'));
	}
}