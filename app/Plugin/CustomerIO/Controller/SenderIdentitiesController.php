<?php

App::uses('AppController', 'Controller');

class SenderIdentitiesController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'SenderIdentities';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.SenderIdentity');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('listSenderIdentities', 'getSender', 'getSenderUsageData');
		parent::beforeFilter();
	}

	public function listSenderIdentities()
	{
		//test data
		$start = '';
		$limit = 1;
		$sort = 'asc';				//"asc" "desc"

		$response = $this->SenderIdentity->listSenderIdentities($start, $limit, $sort);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getSender()
	{
		//test data
		$sender_id = 1;
		$response = $this->SenderIdentity->getSender($sender_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getSenderUsageData()
	{
		//test data
		$sender_id = 1;
		$response = $this->SenderIdentity->getSenderUsageData($sender_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
