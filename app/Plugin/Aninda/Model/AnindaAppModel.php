<?php

App::uses('AppModel', 'Model');

class AnindaAppModel extends AppModel
{

	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);
		Configure::load('Aninda.Aninda');

		if (Configure::read('Aninda.Config') == 0)
			throw new Exception('Config not found', 500);

		$this->config = Configure::read('Aninda.Config');
	}

	/*
	 * Add Deposit & Deposit Callback(Only Success)
	 */

	public function addDeposit($BUID, $BCSubID, $Name, $TC, $PGTransactionID, $BCID)
	{
		$url = $this->config['Config']['API_URL'] . 'send' . '?BUID=' . $BUID . '&BCSubID=' . $BCSubID . '&Name=' . $Name
			. '&TC=' . $TC . '&PGTransactionID=' . $PGTransactionID . '&BCID=' . $BCID;
		$url = str_replace(" ", "%20", $url); // to properly format the url

		$request = json_decode($this->cURLGet($url));
		return $request;
	}

	/*
	 * Add Withdraw & Withdraw Callback(Success, Cancel)
	 */

	public function addWithdraw($BUID, $BCSubID, $Name, $TC, $IBAN, $DRefID, $Amount, $BanksID, $BCID)
	{
		$url = $this->config['Config']['API_URL'] . 'send/uwdraw' . '?BUID=' . $BUID . '&BCSubID=' . $BCSubID . '&Name=' . $Name
			. '&TC=' . $TC . '&IBAN=' . $IBAN . '&DRefID=' . $DRefID . '&Amount=' . $Amount . '&BanksID=' . $BanksID . '&BCID=' . $BCID;
		$url = str_replace(" ", "%20", $url); // to properly format the url

		$request = json_decode($this->cURLGet($url));
		return $request;
	}

	/*
	 * Withdraw Cancel Request
	 */

	public function addWithdrawCancel($BCSubID, $DRefID, $BCID)
	{
		$url = $this->config['Config']['API_URL'] . 'send/uwdraw_cancel' . '?BCSubID=' . $BCSubID . '&DRefID=' . $DRefID . '&BCID=' . $BCID;
		$url = str_replace(" ", "%20", $url); // to properly format the url

		$request = json_decode($this->cURLGet($url));
		return $request;
	}

	public function cURLGet($URL)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_PORT, 188);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		if (curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $response;
	}
}
