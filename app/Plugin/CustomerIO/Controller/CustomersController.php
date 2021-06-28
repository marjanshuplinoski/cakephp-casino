<?php

App::uses('AppController', 'Controller');

class CustomersController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Customers';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Customer');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('addUpdateCustomer', 'deleteCustomer', 'addUpdateCustomerDevice', 'deleteCustomerDevice', 'suppressCustomerProfile',
			'unSuppressCustomerProfile', 'customerUnsubscribeHandling', 'getCustomersByEmail', 'searchForCustomers', 'lookupCustomerAttributes',
			'listCustomersAndAttributes', 'lookupMessagesSentToCustomer', 'lookupCustomerSegments', 'lookupMessagesSentToCustomer', 'lookupCustomerActivities');
		parent::beforeFilter();
	}

	public function addUpdateCustomer()
	{
		//test data
		$user_id = 889;
		$email = "player18@mail.com";
		$update = false;
		$attributes = array(
			"first_name" => "John",
			"last_name" => "Doe"
		);

		$response = $this->Customer->addUpdateCustomer($user_id, $email, $update, $attributes);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function deleteCustomer()
	{
		//test data
		$identifier = 889;

		$response = $this->Customer->deleteCustomer($identifier);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function addUpdateCustomerDevice()
	{
		//test data
		$identifier = 889;
		$device_id = "231a";
		$device_platform = "ios";
		$device_last_used = time();

		$response = $this->Customer->addUpdateCustomerDevice($identifier, $device_id, $device_platform, $device_last_used);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function deleteCustomerDevice()
	{
		//test data
		$identifier = 889;
		$device_id = '231a';

		$response = $this->Customer->deleteCustomerDevice($identifier, $device_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function suppressCustomerProfile()
	{
		//test data
		$identifier = 888;

		$response = $this->Customer->suppressCustomerProfile($identifier);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function unSuppressCustomerProfile()
	{
		//test data
		$identifier = 888;

		$response = $this->Customer->unSuppressCustomerProfile($identifier);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function customerUnsubscribeHandling()
	{
		//test data
		$delivery_id = 'delivery_id'; // need to get delivery ID from real message sent via CustomerIO to customer with unsubscribe button
		$unsubscribe = true;
		$response = $this->Customer->customerUnsubscribeHandling($delivery_id, $unsubscribe);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getCustomersByEmail()
	{
		//test data
		$email = "player18@mail.com";

		$response = $this->Customer->getCustomersByEmail($email);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function searchForCustomers()
	{
		//test data
		$search = '';
		$limit = 1;
		$operator = 'and';
		$attributeField = 'email';
		$attributeValue = 'player6@mail.com';

		$response = $this->Customer->searchForCustomers($search, $limit, $operator, $attributeField, $attributeValue);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupCustomerAttributes()
	{
		//test data
		$customer_id = 887;
		$start = "";
		$limit = 1;
		$response = $this->Customer->lookupCustomerAttributes($customer_id, $start, $limit);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listCustomersAndAttributes()
	{
		//test data
		$ids = array("998", "997", "996", "995", "994", "993", "992", "991", "990", "899", "888", "654", "889");         // up to 100 ids

		$response = $this->Customer->listCustomersAndAttributes($ids);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupCustomerSegments()
	{
		//test data
		$customer_id = 887;

		$response = $this->Customer->lookupCustomerSegments($customer_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupMessagesSentToCustomer()
	{
		//test data
		$customer_id = 887;
		$start = '';
		$limit = 1;

		$response = $this->Customer->lookupMessagesSentToCustomer($customer_id, $start, $limit);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupCustomerActivities()
	{
		//test data
		$customer_id = 887;
		$start = '';
		$limit = 1;
		$type = 'event';            //"page" "event" "attribute_change" "failed_attribute_change" "stripe_event" "drafted_email" "failed_email" "dropped_email" "sent_email" "spammed_email" "bounced_email" "delivered_email" "triggered_email" "opened_email" "clicked_email" "converted_email" "unsubscribed_email" "attempted_email" "undeliverable_email" "device_change" "attempted_action" "drafted_action" "sent_action" "delivered_action" "bounced_action" "failed_action" "converted_action" "undeliverable_action" "opened_action" "secondary:dropped_email" "secondary:spammed_email" "secondary:bounced_email" "secondary:delivered_email" "secondary:opened_email" "secondary:clicked_email" "secondary:failed_email"
		$name = "someevent";

		$response = $this->Customer->lookupCustomerActivities($customer_id, $start, $limit, $type, $name);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
