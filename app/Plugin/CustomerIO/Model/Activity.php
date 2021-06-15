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

	public function listActivities($start_string, $type, $name, $deleted, $customer_id, $limit)
	{
		$url = $this->getBetaAPIURL() . 'activities?start=' . $start_string . '&type=' . $type . '&name=' . $name . '&deleted=' . $deleted . '&customer_id=' . $customer_id . '&limit=' . $limit;

		$header = $this->getHeaderAuthBearer();

		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	//BETA API END
}
