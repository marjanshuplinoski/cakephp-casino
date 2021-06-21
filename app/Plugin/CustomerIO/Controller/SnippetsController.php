<?php

App::uses('AppController', 'Controller');

class SnippetsController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Snippets';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Snippet');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('listSnippets', 'updateSnippets', 'deleteSnippet');
		parent::beforeFilter();
	}

	public function listSnippets()
	{
		//test data

		$response = $this->Snippet->listSnippets();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function updateSnippets()
	{
		//test data
		$name = 'Snippet 4';
		$value = '<strong>My Company</strong></br>1234 Fake St<br/>Fake,NY<br/>10111';

		$response = $this->Snippet->updateSnippets($name, $value);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function deleteSnippet()
	{
		//test data
		$snipet_name = 'Snippet 4';
		$response = $this->Snippet->deleteSnippet($snipet_name);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}
}
