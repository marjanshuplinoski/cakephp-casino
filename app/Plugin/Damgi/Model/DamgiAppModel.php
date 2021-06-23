<?php

App::uses('AppModel', 'Model');

class DamgiAppModel extends AppModel
{


	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);
		Configure::load('Damgi.Damgi');

		if (Configure::read('Damgi.Config') == 0)
			throw new Exception('Config not found', 500);

		$this->config = Configure::read('Damgi.Config');
	}

	/*
	 * Initiate a deposit request
	 * An endpoint for initiating a payment deposit request. Upon success, a unique paymentUrlisprovided in the response which can be served within an iframe.
	 */

	public function initiateDepositRequest($body)
	{
		$method = 'POST';
		$endpoint = 'api/v1/payments';
		$request = $this->makeRequest($method, $endpoint, $body, array());
		return $request;
	}

	/*
	 * Submit deposit data
	 * In case you'd like to spin off your own UI, this endpoint allows you to submit the details from the end-user
	 * for the initiated deposit request. The end-user will be required to choose a depositCurrency i.e. the
	 * cryptocurrency they want to deposit in. Once the request is submitted, the end-user will be supplied with a
	 * walletAddress and the expectedDepositAmount calculated using the most recent exchange rate.
	 */

	public function SubmitDepositData($paymentID, $body)
	{
		$method = 'PATCH';
		$endpoint = 'api/v1/payments/' . $paymentID;
		$request = $this->makeRequest($method, $endpoint, $body, array());
		return $request;
	}

	/*
	 * Get deposit data
	 * Get payment details for a specific payment ID. The payment ID is provided as a response of POST /payments
	 */

	public function getDepositData($paymentID)
	{
		$method = 'GET';
		$endpoint = 'api/v1/payments/' . $paymentID;
		$request = $this->makeRequest($method, $endpoint, array(), array());
		return $request;
	}

	/*
	 * Initiate withdrawal request
	 * An endpoint for initiating cryptocurrency withdrawals.
	 * The amount can be selected either in fiat or crypto which is being defined by the targetAmountPolicy
	 */

	public function initiateWithdrawalRequest($body)
	{
		$method = 'POST';
		$endpoint = 'api/v1/withdrawals';
		$request = $this->makeRequest($method, $endpoint, $body, array());
		return $request;
	}

	/*
	 *Validate address
	 * An endpoint for checking if a wallet address is valid according to the coin-specific format.
	 */

	public function validateAddress($body)
	{
		$method = 'POST';
		$endpoint = 'api/v1/addresses/validate';
		$request = $this->makeRequest($method, $endpoint, $body, array());
		return $request;
	}


	/*
	 * Get Business by ID
	 * This endpoint allows you to get the business information
	 */

	public function getBusinessByID($ID)
	{
		$method = 'GET';
		$endpoint = 'api/v1/businesses/' . $ID;
		$request = $this->makeRequest($method, $endpoint, array(), array());
		return $request;
	}

	/*
	 * Get business deposits
	 * Allows you to get all deposits per business ID
	 */

	public function getBusinessDeposits($ID, $query = array())
	{
		$method = 'GET';
		$endpoint = 'api/v1/businesses/' . $ID . '/payments';
		$request = $this->makeRequest($method, $endpoint, array(), $query);
		return $request;
	}

	/*
	 * Get business withdrawals
	 * Allows you to fetch all withdrawals for a business
	 */

	public function getBusinessWithdrawals($query = array())
	{
		$method = 'GET';
		$endpoint = 'api/v1/businesses/withdrawals';
		$request = $this->makeRequest($method, $endpoint, array(), $query);
		return $request;
	}

	/*
	 * Get business balance
	 * Allows you to fetch the current business balance and allocation ratio of a given business.
	 */

	public function getBusinessBalance($ID)
	{
		$method = 'GET';
		$endpoint = 'api/v1/businesses/' . $ID . '/balance';
		$request = $this->makeRequest($method, $endpoint, array(), array());
		return $request;
	}


	/*
	 * Get all currencies
	 * Allows you to list all supported currencies at Damgi.gi
	 */

	public function getAllCurrencies()
	{
		$method = 'GET';
		$endpoint = 'api/v1/currencies';
		$request = $this->makeRequest($method, $endpoint, array(), array());
		return $request;
	}

	/*
	 *Get withdrawal (on-chain) fees & minimum withdrawal amounts
	 * Damgi.gi does not cover the associated on-chain fees for crypto withdrawals. The endpoint allows you to get the
	 * current on-chain fees and minimum withdrawal amounts per coin. You can add query param to display the fees
	 * and the minimum amounts in fiat.
	 */

	public function getWithdrawalFees($coin, $query)
	{
		$method = 'GET';
		$endpoint = 'api/v1/fees/withdraw' . $coin;
		$request = $this->makeRequest($method, $endpoint, array(), $query);
		return $request;
	}

	/*
	 *Get exchange rates for multiple currencies
	 * Allows you to fetch most recent exchange rates for all cryptocurrencies. Supports all fiat currencies for
	 * pairing e.g. you can get the exchange rates for Bitcoin into USD,GBP,EUR,TRY etc. with one request.
	 */

	public function getExchangeRatesCrypto($query)
	{
		$method = 'GET';
		$endpoint = 'api/v1/exchange/rates/deposit';
		$request = $this->makeRequest($method, $endpoint, array(), $query);
		return $request;
	}
	public function getExchangeRatesFiat($query)
	{
		$method = 'GET';
		$endpoint = 'api/v1/exchange/rates/fiat';
		$request = $this->makeRequest($method, $endpoint, array(), $query);
		return $request;
	}

	public function makeRequest($method, $endpoint, array $body = [], array $query = [])
	{
		$method = strtoupper($method);
		$qs = http_build_query($query, '', '&');
		$path = ($qs == '') ? $endpoint : $endpoint . '?' . $qs;
		$ch = curl_init();
		$jsonBody = '';
		if ($method == 'POST' || $method == 'PUT' || $method == 'PATCH') {
			$jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
		}
		curl_setopt_array($ch, [
			CURLOPT_URL => $this->config['Config']['API_URL'] . $path,
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => [
				'Content-Type: application/json',
				'Authorization: ' . $this->buildAuthorizationHeaderValue($path, $jsonBody)
			]
		]);
		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response, true);
	}


	private function buildAuthorizationHeaderValue($path, $jsonBody = '')
	{
		$timestamp = intval(microtime(true) * 1000);
		$signaturePayload = $path . $timestamp . $jsonBody;
		$signature = hash_hmac('sha256', $signaturePayload, $this->config['Config']['API_SECRET_KEY']);
		return "FRX-API API-Key={$this->config['Config']['API_KEY']}," .
			"Signature={$signature}," .
			"Timestamp={$timestamp}";
	}
}
