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
			'listCustomersAndAttributes','lookupMessagesSentToCustomer','lookupCustomerSegments');
		parent::beforeFilter();
	}

	public function addUpdateCustomer()
	{
		//test data
		$user_id = 888;
		$email = "player17@mail.com";
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
		$identifier = 887;

		$response = $this->Customer->deleteCustomer($identifier);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function addUpdateCustomerDevice()
	{
		//test data
		$identifier = 888;

		$attributes = array(
			"id" => "231a",
			"platform" => "ios",
			"last_used" => time()
		);

		$response = $this->Customer->addUpdateCustomerDevice($identifier, $attributes);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function deleteCustomerDevice()
	{
		//test data
		$identifier = 888;
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
		$delivery_id = 888;
		$data = array("unsubscribe" => "true");

		$response = $this->Customer->customerUnsubscribeHandling($delivery_id, $data);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getCustomersByEmail()
	{
		//test data
		$email = "player17@mail.com";

		$response = $this->Customer->getCustomersByEmail($email);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function searchForCustomers()
	{
		//test data
		$search_query = 'MD';
		$data = array('filter' => array('and' => array(0 => array('and' => array(0 => array('segment' => array('id' => 'string',), 'attribute' => array('field' => 'unsubscribed', 'operator' => 'eq', 'value' => true,),),), 'or' => array(0 => array('segment' => array('id' => 'string',), 'attribute' => array('field' => 'unsubscribed', 'operator' => 'eq', 'value' => true,),),), 'not' => array('and' => array(0 => array('segment' => array('id' => 'string',), 'attribute' => array('field' => 'unsubscribed', 'operator' => 'eq', 'value' => true,),),), 'or' => array(0 => array('segment' => array('id' => 'string',), 'attribute' => array('field' => 'unsubscribed', 'operator' => 'eq', 'value' => true,),),), 'segment' => array('id' => 'string',), 'attribute' => array('field' => 'unsubscribed', 'operator' => 'eq', 'value' => true,),), 'segment' => array('id' => '1',), 'attribute' => array('field' => 'unsubscribed', 'operator' => 'eq', 'value' => true,),),),),);
		$limit = 1;

		$response = $this->Customer->searchForCustomers($search_query, $limit, $data);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupCustomerAttributes()
	{
		//test data
		$customer_id = 887;

		$response = $this->Customer->lookupCustomerAttributes($customer_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listCustomersAndAttributes()
	{
		//test data
		$data = array('ids' => array('test1'));

		$response = $this->Customer->listCustomersAndAttributes($data);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupCustomerSegments()
	{
		//test data
		$customer_id= 887;

		$response = $this->Customer->lookupCustomerSegments($customer_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupMessagesSentToCustomer()
	{
		//test data
		$customer_id= 887;

		$response = $this->Customer->lookupMessagesSentToCustomer($customer_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}
	public function lookupCustomerActivities()
	{
		//test data
		$customer_id= 887;

		$response = $this->Customer->lookupCustomerActivities($customer_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
