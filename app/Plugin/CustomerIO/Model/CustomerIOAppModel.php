<?php

App::uses('AppModel', 'Model');

class CustomerIOAppModel extends AppModel
{

	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);
		Configure::load('CustomerIO.CustomerIO');

		if (Configure::read('CustomerIO.Config') == 0)
			throw new Exception('Config not found', 500);

		$this->config = Configure::read('CustomerIO.Config');
	}

	// TRACK API

	/*
	 *  Account Region
	 * 	Determine whether your account and data are hosted in the US or EU data center using your Track API Key.
	 * 	This endpoint returns the appropriate region and URL for your Track API credentials.
	 * 	Use it to determine the URLs you should use to successfully complete other requests.
	 * 	You can perform this operation against either of the track API regional URLs; it returns your region in either case.
	 * 	This endpoint also returns an environment_id, which represents the workspace the credentials are valid for.
	*/


	public function getRegion()
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'accounts/region';
		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	// Customers

	/*
	 * Add or update a customer
	 * If the identifier in the path and identifiers in the request body belong to different people,
	 * your request will produce an Attribute Update Failure. If your workspace uses email as an identifier,
	 * we treat person@example.com and PERSON@example.com as duplicates; these addresses represent the same person.
	 */

	public function addEditCustomer($identifier, $data)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	/*
	 * Delete a customer
	 * Deleting a customer removes them, and all of their information, from Customer.io.
	 */

	public function deleteCustomer($identifier)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	/*
	 * Add or update a customer device
	 * Customers can have more than one device. Use this method to add iOS and Android devices to,
	 *  or update devices for, a customer profile.
	 */

	public function addUpdateCustomerDevice($identifier, $data)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/devices';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);

		$request = json_decode($this->cURLPut($url, $header, $data));
		return $request;
	}

	/*
	 * Delete a customer device
	 * Remove a device from a customer profile. If you continue sending data about a device to Customer.io,
	 * you may inadvertently re-add the device to the customer profile.
	 */

	public function deleteCustomerDevice($identifier, $device_id)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/devices/' . $device_id;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

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
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/suppress';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

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

	public function unSuppressCustomerProfile($identifier)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/unsuppress';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

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

	public function unsubscribe($delivery_id)
	{
		$url = $this->config['Config']['US']['UNSUBSCRIBE_API_URL'] . $delivery_id;

		$header = array(
			'content-type: application/json'
		);

		$data = '{"unsubscribe":true}';
		$request = json_decode($this->cURLPost($url, $header, $data));
		return $request;
	}



	/*
	 * ==============================================================
	 * ==============================================================
	 */

	// BETA API
	public function getCustomersByEmail($email)
	{
		$url = $this->config['Config']['US']['BETA_API_URL'] . 'customers?email=' . $email;
		$header = array(
			'Authorization: Bearer ' . $this->config['Config']['API_KEY']
		);
		$request = json_decode($this->cURLGet($url, $header));
		return $request;

	}

	public function cURLGet($URL, $header)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		if (curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $response;
	}

	public function cURLPost($URL, $header = null, $data = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_POST, 1);

		if (!empty($data))
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	public function cURLPut($URL, $header = null, $data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	public function cURLDelete($URL, $header = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

		if (!empty($header))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}


}
