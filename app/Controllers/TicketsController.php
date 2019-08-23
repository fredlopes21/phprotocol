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

	public function show($request, $response, $args)
	{
		$ticket = Ticket::findOrFail($args['id']);
        if (empty($ticket)) {
            $this->flash->addMessage('error', 'Ticket not found');
			return $response->withRedirect($this->router->pathFor('tickets.index'));
        }
		return $this->view->render($response,'tickets/show.twig', [
			'ticket' => $ticket
		]);
	}

	public function create($request, $response)
	{
		return $this->view->render($response,'tickets/create.twig');
	}
	
	public function store($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'user' => v::noWhitespace()->notEmpty(),
			'company' => v::noWhitespace()->notEmpty(),
			'channel' => v::noWhitespace()->notEmpty(),
			'type' => v::noWhitespace()->notEmpty(),
			'module' => v::noWhitespace()->notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('tickets.create'));
		}
		$params = $request->getParams();
		$params['id_user'] = $this->auth->user()->id;
		$ticket = new Ticket($params);
		$ticket->save();
		$this->flash->addMessage('info', 'Ticket created successfully');
		return $response->withRedirect($this->router->pathFor('tickets.index'));
	}

	public function edit($request, $response, $args)
    {
        $ticket = Ticket::findOrFail($args['id']);
        if (empty($ticket)) {
            $this->flash->addMessage('error', 'Ticket not found');
			return $response->withRedirect($this->router->pathFor('tickets.index'));
        }
		return $this->view->render($response,'tickets/edit.twig', [
			'ticket' => $ticket
		]);
	}
	
	public function update($request, $response, $args)
    {
        $ticket = Ticket::findOrFail($args['id']);
        if (empty($ticket)) {
            $this->flash->addMessage('error', 'Ticket not found');
			return $response->withRedirect($this->router->pathFor('tickets.index'));
        }
        $validation = $this->validator->validate($request, [
			'user' => v::noWhitespace()->notEmpty(),
			'company' => v::noWhitespace()->notEmpty(),
			'channel' => v::noWhitespace()->notEmpty(),
			'type' => v::noWhitespace()->notEmpty(),
			'module' => v::noWhitespace()->notEmpty(),
		]);
		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('tickets.edit'));
		}
		$ticket->update($request->getParams());
		$this->flash->addMessage('info', 'Ticket updated successfully');
		return $response->withRedirect($this->router->pathFor('tickets.show', [
			'id' => $ticket->id
		]));
    }

	public function destroy($request, $response, $args)
    {
        $ticket = Ticket::findOrFail($args['id']);
        if (empty($ticket)) {
            $this->flash->addMessage('error', 'Ticket not found');
        } else {
			$ticket->delete();
			$this->flash->addMessage('info', 'Ticket deleted successfully');
		}
        return $response->withRedirect($this->router->pathFor('tickets.index'));
    }
}