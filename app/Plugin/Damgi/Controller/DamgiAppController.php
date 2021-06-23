<?php

App::uses('AppController', 'Controller');

class DamgiAppController extends AppController
{
	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'DamgiApp';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('Damgi.Damgi');

	public $components = array('Auth');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('initiateDepositRequest', 'SubmitDepositData', 'getDepositData', 'initiateWithdrawalRequest', 'validateAddress',
			'getBusinessByID', 'getBusinessDeposits', 'getBusinessWithdrawals', 'getBusinessBalance',
			'getAllCurrencies','getWithdrawalFees','getExchangeRatesCrypto','getExchangeRatesFiat');
		parent::beforeFilter();
	}

	public function initiateDepositRequest()
	{
		//test data
		$body = array(
			'redirectUrl' => 'http://someurl.com/paymentRedirect',
			'rateType' => 'FIXED',                                            //[FIXED, FLOATING]
			'type' => 'ONE_TIME',                                            //[ONE_TIME, REUSABLE]
			'businessId' => '1',
			'expirationMinutes' => 10,                                        //A value of 0 will make the payment to not expire. Defaults to 30min
			'displayCurrency' => 'EUR',                                        //EUR, USD, TRY, GBP, etc.
			'displayAmount' => 1,
			'locale' => 'en-US',                                                //en-US, de-DE, es-ES, fr-FR
			'clientPaymentId' => '11'
		);
		$response = $this->Damgi->initiateDepositRequest($body);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function SubmitDepositData()
	{
		//test data
		$paymentID = 1;
		$body = array(
			'depositCurrency' => '11',
			'displayCurrency' => 'dis',                                        //Fiat currency code, if not supplied in POST /payments
			'displayAmount' => 11
		);

		$response = $this->Damgi->SubmitDepositData($paymentID, $body);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getDepositData()
	{
		$paymentID = 1;

		$response = $this->Damgi->getDepositData($paymentID);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function initiateWithdrawalRequest()
	{

		$body = array(
			'businessId' => '11',
			'clientWithdrawalId' => '11',
			'recipientAddress' => 'Wallet-address',
			'withdrawCurrency' => 'BTC',                                    //e.g. BTC  ETH  XRP
			'displayCurrency' => 'USD',                                    //Fiat currency abbreviation for pairing e.g. USD  EUR  GBP
			'targetAmountPolicy' => 'fiat',                                //The requested amount to be withdrawn in fiat or crypto
			'targetAmount' => 'fiat',                                        //The requested amount to be withdrawn in fiat or crypto
			'destinationTag' => '0'                                        //Applicable for XRP and XLM If no destinationTag is needed 0 should be entered
		);

		$response = $this->Damgi->initiateWithdrawalRequest($body);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function validateAddress()
	{

		$body = array(
			'coin' => 'BTC',                                                //BTC  ETH  XRP
			'address' => 'walletAddr'                                        //Wallet address to be checked
		);

		$response = $this->Damgi->validateAddress($body);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


	public function getBusinessByID()
	{
		//test data
		$ID = 1;

		$response = $this->Damgi->getBusinessByID($ID);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBusinessDeposits()
	{
		//test data
		$ID = 1;
		$query = array(
			'coins' => array('BTC', 'ETH', 'XRP'),                           // need info to get all coins
			'statuses' => 'NEW',                                             //NEW PENDING  DEPOSITED  AWAITING  EXPIRED
			'paymentId' => 'UUID',
			'clientPaymentId' => '1',
			'descending' => false,
			'before' => 1,                                                  //End date of the report UNIX
			'after' => 1,                                                   //Start date of the report UNIX
			'sortBy' => 'status',                                           //Sort payment by status, created
			'limit' => 1                                                    // max 2000

		);
		$response = $this->Damgi->getBusinessDeposits($ID, $query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBusinessWithdrawals()
	{
		//test data
		$query = array(
			'businessId' => '12',
			'limit' => 1,                                                    // default 25
			'coins' => array('BTC', 'ETH', 'XRP'),                           // need info to get all coins
			'statuses' => 'NEW',                                             //NEW  PENDING  COMPLETED  FAILED
			'clientWithdrawId' => '123',
			'before' => 1,                                                  //End date of the report UNIX
			'after' => 1,                                                   //Start date of the report UNIX
			'sortBy' => 'created',                                           //Sort payment by created

		);
		$response = $this->Damgi->getBusinessWithdrawals($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


	public function getBusinessBalance()
	{
		//test data
		$ID = 1;
		$response = $this->Damgi->getBusinessBalance($ID);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getAllCurrencies()
	{
		$response = $this->Damgi->getAllCurrencies();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getWithdrawalFees()
	{
		$coin = '';                                                //BTC  ETH  XRP
		$query = array(
			'displayCurrency' => 'USD'                                //EUR  USD  GBP
		);
		$response = $this->Damgi->getWithdrawalFees($coin, $query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getExchangeRatesCrypto()
	{
		$query = array(
			'fromCurrency' => 'BTC',                                //Accepts all supported cryptocurrencies comma delimited
			'toCurrency'=>'USD'										// EUR USD GBP
		);
		$response = $this->Damgi->getExchangeRatesCrypto($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getExchangeRatesFiat()
	{
		$query = array(
			'fromCurrency' => 'USD',                                //Accepts all supported cryptocurrencies comma delimited
			'toCurrency'=>'EUR,GBP'										// EUR USD GBP
		);
		$response = $this->Damgi->getExchangeRatesFiat($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}
}
