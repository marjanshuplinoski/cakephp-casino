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

	/*
	Account Region
	Determine whether your account and data are hosted in the US or EU data center using your Track API Key.
	This endpoint returns the appropriate region and URL for your Track API credentials.
	Use it to determine the URLs you should use to successfully complete other requests.
	You can perform this operation against either of the track API regional URLs; it returns your region in either case.
	This endpoint also returns an environment_id, which represents the workspace the credentials are valid for.
	*/
	// TRACK API
	public function getRegion()
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'accounts/region';
		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}


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

	public function deleteCustomer($identifier)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

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

	public function deleteCustomerDevice($identifier, $device_id)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/devices/' . $device_id;

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLDelete($url, $header));
		return $request;
	}

	public function suppressCustomerProfile($identifier)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/suppress';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLPost($url, $header));
		return $request;
	}

	public function unSuppressCustomerProfile($identifier)
	{
		$url = $this->config['Config']['US']['TRACK_API_URL'] . 'customers/' . $identifier . '/unsuppress';

		$header = array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);

		$request = json_decode($this->cURLPost($url, $header));
		return $request;
	}

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

	public function cURLPost($URL, $header = null, $data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_POST, 1);

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
