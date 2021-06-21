<?php

App::uses('AppController', 'Controller');

class ActivitiesController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Activities';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Activity');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('listActivities');
		parent::beforeFilter();
	}

	public function listActivities()
	{
		//test data

		$start = '';
		$type = ''; // "page" "event" "attribute_change" "failed_attribute_change" "stripe_event" "drafted_email" "failed_email" "dropped_email" "sent_email" "spammed_email" "bounced_email" "delivered_email" "triggered_email" "opened_email" "clicked_email" "converted_email" "unsubscribed_email" "attempted_email" "undeliverable_email" "device_change" "attempted_action" "drafted_action" "sent_action" "delivered_action" "bounced_action" "failed_action" "converted_action" "undeliverable_action" "opened_action" "secondary:dropped_email" "secondary:spammed_email" "secondary:bounced_email" "secondary:delivered_email" "secondary:opened_email" "secondary:clicked_email" "secondary:failed_email"
		$name = '';  // name of event or attribute
		$deleted = 0;
		$customer_id = '888';
		$limit = '1';

		$response = $this->Activity->listActivities($start, $type, $name, $deleted, $customer_id, $limit);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
