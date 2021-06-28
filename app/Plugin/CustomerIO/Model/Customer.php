<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Customer extends CustomerIOAppModel
{

	/**
	 * Model name
	 * @var string
	 */
	public $name = 'Customer';
	public $useTable = false;

	//TRACK API START

	/*
	 * Add or update a customer
	 * If the identifier in the path and identifiers in the request body belong to different people,
	 * your request will produce an Attribute Update Failure. If your workspace uses email as an identifier,
	 * we treat person@example.com and PERSON@example.com as duplicates; these addresses represent the same person.
	 */

	public function addUpdateCustomer($identifier, $email, $update = false, $attributes = array())
	{
		$url = $this->getTrackAPIURL() . 'customers/' . $identifier;
		//var_dump($url);
		$header = $this->getHeaderAuthBasicJson();
		//var_dump($header);
		$data = array_merge(array(
			"email" => $email,
			"created_at" => time(),
			"_update" => $update,
		), $attributes);
		//var_dump($data);
		$request = json_decode($this->cURLPut($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Delete a customer
	 * Deleting a customer removes them, and all of their information, from Customer.io.
	 */

	public function deleteCustomer($identifier)
	{
		$url = $this->getTrackAPIURL() . 'customers/' . $identifier;
		$header = $this->getHeaderAuthBasic();
		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	/*
	 * Add or update a customer device
	 * Customers can have more than one device. Use this method to add iOS and Android devices to,
	 *  or update devices for, a customer profile.
	 */

	public function addUpdateCustomerDevice($identifier, $device_id, $device_platform, $device_last_used)
	{
		$url = $this->getTrackAPIURL() . 'customers/' . $identifier . '/devices';
		$header = $this->getHeaderAuthBasicJson();
		$data = array(
			'device' =>
				array(
					'id' => $device_id,
					'platform' => $device_platform,
					'last_used' => $device_last_used
				)
		);
//        var_dump($data);
//        die();

		$request = json_decode($this->cURLPut($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Delete a customer device
	 * Remove a device from a customer profile. If you continue sending data about a device to Customer.io,
	 * you may inadvertently re-add the device to the customer profile.
	 */

	public function deleteCustomerDevice($identifier, $device_id)
	{
		$url = $this->getTrackAPIURL() . 'customers/' . $identifier . '/devices/' . $device_id;
		$header = $this->getHeaderAuthBasic();
		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	/*
	 * Suppress a customer profile
	 * Delete a customer profile and prevent the ID from being re-added to your workspace.
	 * Any future API calls or operations referencing the specified ID are ignored.
	 */

	public function suppressCustomerProfile($identifier)
	{
		$url = $this->getTrackAPIURL() . 'customers/' . $identifier . '/suppress';
		$header = $this->getHeaderAuthBasic();
		$request = json_decode($this->cURLPost($url, $header));
		return $request;
	}

	/*
	 * Unsuppress a customer profile
	 * Unsuppressing a profile ID allows you to add the customer back to Customer.io.
	 * Unsuppressing a profile does not recreate the profile that you previously suppressed.
	 * Rather, it just makes the identifier available again. Identifying a person after unsuppressing
	 * them creates a new profile, with none of the history of the previously suppressed ID.
	 */

	public function unsuppressCustomerProfile($identifier)
	{
		$url = $this->getTrackAPIURL() . 'customers/' . $identifier . '/unsuppress';
		$header = $this->getHeaderBasicAuth();
		$request = json_decode($this->cURLPost($url, $header));
		return $request;
	}

	/*
	 * Custom unsubscribe handling
	 * If you use custom unsubscribe links, you can host a custom unsubscribe page and use this API to send unsubscribe data,
	 * associated with a particular delivery, to Customer.io. This endpoint does not require an Authorization header.
	 * Your request sets a person's unsubscribed attribute to true, attributes their unsubscribe request to the individual
	 * email/delivery that they they unsubscribed from, and lets you segment your audience based on email_unsubscribed events
	 * when you use a custom subscription center.
	 */

	public function customerUnsubscribeHandling($delivery_id, $unsubscribe)
	{
		$url = $this->getGeneralAPIURL() . 'unsubscribe/' . $delivery_id;
		$header = $this->getHeaderJson();
		$data = array("unsubscribe" => $unsubscribe);
		$request = json_decode($this->cURLPost($url, $header, json_encode($data)));
		return $request;
	}

	//TRACK API END
	//BETA API START
	/*
	 * Get customers by email
	 * Return a list of people in your workspace matching an email address.
	 */

	public function getCustomersByEmail($email)
	{
		$url = $this->getBetaAPIURL() . 'customers?email=' . $email;
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Search for customers
	 * Provide a filter to search for people in your workspace. You can return up to 1000 people per request.
	 * If you want to return a larger set of people in a single request, you may want to use the /exports API instead.
	 */

	public function searchForCustomers($search, $limit, $operator, $attributeField, $attributeValue)
	{
		$url = $this->getBetaAPIURL() . 'customers?start=' . $search . '&limit=' . $limit;


		$header = $this->getHeaderAuthBearerJson();
		$data = array(
			"filter" => array(
				$operator =>
					array(
						array(
							'attribute' =>
								array(
									'field' => $attributeField,
									'operator' => 'eq',
									'value' => $attributeValue,
								)
						)
					)
			)
		);                // up to 1000 results per page
		$request = json_decode($this->cURLPost($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Lookup a customer's attributes
	 * Return a list of attributes for a customer profile. You can use attributes to fashion segments or as liquid merge fields in your messages.
	 */

	public function lookupCustomerAttributes($customer_id, $start, $limit)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/' . $customer_id . '/attributes' . '?start=' . $start . '&limit=' . $limit;
		$url = str_replace(" ", "%20", $url);
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * List customers and attributes
	 * Return attributes for up to 100 customers by ID. If an ID in the request does not exist, the response omits it.
	 */

	public function listCustomersAndAttributes($ids)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/attributes';
		$header = $this->getHeaderAuthBearerJson();
		$data = array('ids' => $ids);

		$request = json_decode($this->cURLPost($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Lookup a customer's segments
	 * Returns a list of segments that a customer profile belongs to.
	 */

	public function lookupCustomerSegments($customer_id)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/' . $customer_id . '/segments';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Lookup messages sent to a customer
	 * Return metadata for the messages sent to a customer profile.
	 */

	public function lookupMessagesSentToCustomer($customer_id, $start, $limit)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers/' . $customer_id . '/messages' . '?start=' . $start . '&limit=' . $limit;
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Lookup a customer's activities
	 * Return a list of activities performed by, or for, a customer. Activities are things like attribute changes and message sends.
	 */

	public function lookupCustomerActivities($customer_id, $start, $limit, $type, $name)
	{
		$url = $this->getBetaAPIURL() . 'customers/' . $customer_id . '/activities' . '?start=' . $start . '&limit=' . $limit . '&type=' . $type . '&name=' . $name;
		$url = str_replace(" ", "%20", $url);
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	//BETA API END
}
