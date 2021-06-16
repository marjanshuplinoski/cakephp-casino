<?php

App::uses('AppController', 'Controller');

class MessagesController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Messages';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Message');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('sendTransactionalEmail', 'listMessages','getMessage','getArchivedMessage');
		parent::beforeFilter();
	}

	public function sendTransactionalEmail()
	{
		//test data
		$data = array(
			'transactional_message_id' => 2,
			'to' => 'player3@example.com',
			'identifiers' =>
				array(
					'id' => 12345,
				),
			'message_data' =>
				array(
					'password_reset_token' => 'abcde-12345-fghij-d888',
					'account_id' => '123dj',
				),
			'bcc' => 'bcc@example.com',
			'disable_message_retention' => false,
			'send_to_unsubscribed' => true,
			'tracked' => true,
			'queue_draft' => false,
			'disable_css_preprocessing' => true,
		);

		$response = $this->Message->sendTransactionalEmail($data);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listMessages()
	{
		//test data

		$response = $this->Message->listMessages();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getMessage()
	{
		//test data
		$message_id ='dgOHwQaHwQYCAAF6D2BVCgT59qVfVQrNwqE=';
		$response = $this->Message->getMessage($message_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getArchivedMessage()
	{
		//test data
		$message_id ='dgOHwQaHwQYCAAF6D2BVCgT59qVfVQrNwqE=';
		$response = $this->Message->getArchivedMessage($message_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
