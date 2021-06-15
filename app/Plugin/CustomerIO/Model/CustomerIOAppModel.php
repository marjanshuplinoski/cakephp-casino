<?php

App::uses('AppModel', 'Model');

class CustomerIOAppModel extends AppModel {

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        Configure::load('CustomerIO.CustomerIO');

        if (Configure::read('CustomerIO.Config') == 0)
            throw new Exception('Config not found', 500);

        $this->config = Configure::read('CustomerIO.Config');
    }

    public function getRegion() {
        $url = $this->config['Config']['US']['TRACK_API_URL'] . 'accounts/region';
        $header = $this->getHeaderAuthBasic();
        $request = json_decode($this->cURLGet($url, $header));
        return json_decode($request->data);
    }

    public function setRegion($region = 'us') {
        $region = $this->getRegion();
        return $region->region;
    }


    public function getTrackAPIURL() {
        $region = $this->setRegion();
        return $this->config['Config'][strtoupper($region)]['TRACK_API_URL'];
    }

    public function getGeneralAPIURL() {
        $region = $this->setRegion();
        return $this->config['Config'][strtoupper($region)]['GENERAL_API_URL'];
    }

    public function getBetaAPIURL() {
        $region = $this->setRegion();
        return $this->config['Config'][strtoupper($region)]['BETA_API_URL'];
    }

	public function getAPPAPIURL(){
    	$region = $this->setRegion();
    	return $this->config['Config'][strtoupper($region)]['APP_API_URL'];
	}
	public function getTrackAPIAuth() {
	return base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']);
}
    public function getHeaderAuthBasic(){
    	return array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY'])
		);
	}

	public function getHeaderAuthBasicJson(){
    	return array(
			'Authorization: Basic ' . base64_encode($this->config['Config']['SITE_ID'] . ':' . $this->config['Config']['API_KEY']),
			'content-type: application/json'
		);
	}

	public function getHeaderAuthBearer(){
    	return array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY']
		);
	}
	public function getHeaderAuthBearerJson(){
		return array(
			'Authorization: Bearer ' . $this->config['Config']['BETA_API_KEY'],
			'content-type: application/json'
		);
	}

	public function getHeaderJson(){
    	return array(
			'content-type: application/json'
		);
}

    public function cURLPost($URL, $header = null, $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_POST, 1);

        if(!empty($data))
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        if (!empty($header))
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); //FOR THE TEST URL API
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); //FOR THE TEST URL API

		$response = curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ((int)$status_code == 200) {
			return json_encode(array('status' => 'success', 'status_code' => $status_code, 'data' => $response));
		} else {
			return json_encode(array('status' => 'error' ,'status_code' => $status_code, 'data' => $response));
		}
//        $response = curl_exec($ch);
//        var_dump($response);
//        curl_close($ch);
//        return $response;
    }

    public function cURLGet($URL, $header = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        if (!empty($header))
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ((int)$status_code == 200) {
			return json_encode(array('status' => 'success', 'status_code' => $status_code, 'data' => $response));
		} else {
			return json_encode(array('status' => 'error' ,'status_code' => $status_code, 'data' => $response));
		}

//        $response = curl_exec($ch);
//        if (curl_errno($ch)) {
//            return curl_error($ch);
//        }
//        curl_close($ch);
//        return $response;
    }

    public function cURLPut($URL, $header = null, $data) {
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
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ((int)$status_code == 200) {
			return json_encode(array('status' => 'success', 'status_code' => $status_code, 'data' => $response));
		} else {
			return json_encode(array('status' => 'error' ,'status_code' => $status_code, 'data' => $response));
		}

        //return $response;
    }

    public function cURLDelete($URL, $header = null) {
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
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ((int)$status_code == 200 || (int)$status_code == 204) {
			return json_encode(array('status' => 'success', 'status_code' => $status_code, 'data' => $response));
		} else {
			return json_encode(array('status' => 'error' ,'status_code' => $status_code, 'data' => $response));
		}
    }

}
