<?php

App::uses('AppController', 'Controller');

class EventsController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Events';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Event');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('trackCustomerEvent', 'trackAnonymousEvent', 'reportPushEvent');
		parent::beforeFilter();
	}

	public function trackCustomerEvent()
	{
		//test data
		$identifier = "player3@example.com";
		$data = array(
			'name' => 'purchase',
			'data' =>
				array(
					'price' => 231.45,
					'product' => 'shoes',
				),
		);

		$response = $this->Event->trackCustomerEvent($identifier, $data);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function trackAnonymousEvent()
	{
		//test data
		$data = array(
			'name' => 'purchase',
			'data' =>
				array(
					'price' => 111.45,
					'product' => 'shoes',
				),
		);

		$response = $this->Event->trackAnonymousEvent($data);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function reportPushEvent()
	{
		//test data
		$data = array(
			'delivery_id' => '11RPILAgUBcRhIBqSfeiIwdIYJKxTY',
			'event' => 'opened',
			'device_id' => 'CIO-Delivery-Token from the notification',
			'timestamp' => time(),
		);

		$response = $this->Event->reportPushEvent($data);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
