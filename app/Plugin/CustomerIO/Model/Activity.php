<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Activity extends CustomerIOAppModel
{

	/**
	 * Model name
	 * @var string
	 */
	public $name = 'Activity';
	public $useTable = false;

	//BETA API START

	/* List activities
	 * This endpoint returns a list of activities in your workspace.
	 */

	public function listActivities($start, $type, $name, $deleted, $customer_id, $limit)
	{
		$url = $this->getBetaAPIURL() . 'activities?start=' . $start . '&type=' . $type . '&name=' . $name . '&deleted=' . $deleted . '&customer_id=' . $customer_id . '&limit=' . $limit;
		$url = str_replace(" ", "%20", $url);
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	//BETA API END
}
