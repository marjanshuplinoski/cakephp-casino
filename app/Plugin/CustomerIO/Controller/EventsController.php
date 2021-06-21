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
		$identifier = "player18@example.com";
		$name = 'purchase';
		$type = 'event';
		$dataEvent = array(
			'price' => 231.45,
			'product' => 'shoes'
		);

		$response = $this->Event->trackCustomerEvent($identifier, $name, $type, $dataEvent);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function trackAnonymousEvent()
	{
		//test data
		$name = 'purchase';
		$type = 'event';
		$dataEvent = array(
			'price' => 231.45,
			'product' => 'shoes'
		);

		$response = $this->Event->trackAnonymousEvent($name, $type, $dataEvent);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function reportPushEvent()
	{
		//test data
		$delivery_id = '11RPILAgUBcRhIBqSfeiIwdIYJKxTY';
		$event = 'opened';											// "opened" "converted" "delivered"
		$device_id = 'CIO-Delivery-Token from the notification';

		$response = $this->Event->reportPushEvent($delivery_id, $event, $device_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
