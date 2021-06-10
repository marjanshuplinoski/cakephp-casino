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

	public function test()
	{
		return "a";
	}

	public function addDeposit($BUID, $BCSubID, $Name, $TC, $PGTransactionID, $BCID)
	{
		http://145.239.255.238:188/send?BUID=1&BCSubID=@QWERTY123!&Name=First Last&TC=1&PGTransactionID=1&BCID=Bn8urgacNrgYTuwstsUuJLB06K
		$url = $this->config['Config']['API_URL'] . 'send' . '?BUID=' . $BUID . '&BCSubID=' . $BCSubID . '&Name=' . $Name
			. '&TC=' . $TC . '&PGTransactionID=' . $PGTransactionID . '&BCID=' . $BCID;

		$request = json_decode($this->cURLGet($url));
		return $request;
	}

	public function cURLGet($URL)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
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
