<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Campaign extends CustomerIOAppModel
{

	/**
	 * Model name
	 * @var string
	 */
	public $name = 'Campaign';
	public $useTable = false;

	//BETA API START
	/*
	 * List campaigns
	 * Returns a list of your campaigns and associated metadata.
	 */

	public function listCampaigns()
	{
		$url = $this->getBetaAPIURL() . 'campaigns';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a campaign
	 * Returns metadata for an individual campaign.
	 */

	public function getCampaign($campaign_id)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id;
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get campaign metrics
	 * Returns a list of metrics for an individual campaign both in total and in steps (days, weeks, etc).
	 * Stepped series metrics return from oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getCampaignMetrics($campaign_id)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id . '/metrics';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get campaign link metrics
	 * Returns metrics for link clicks within a campaign, both in total and in series periods (days, weeks, etc).
	 * series metrics are ordered oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getCampaignLinkMetrics($campaign_id)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id . '/metrics/links';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * List campaign actions
	 * Returns the operations in a campaign workflow. Each object in the response represents a 'tile' in the campaign builder.
	 */

	public function listCampaignActions($campaign_id)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id . '/actions';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get campaign message metadata
	 * Returns metadata for the messages in a campaign. Provide query parameters to refine the metrics you want to return.
	 */

	public function getCampaignMessageMetadata($campaign_id)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id . '/messages';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get a campaign action
	 * Returns information about a specific action in a campaign.
	 */

	public function getCampaignAction($campaign_id, $action_id)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id . '/actions/' . $action_id;
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Update a campaign action
	 * Update the contents of a campaign action, including the body of messages and HTTP requests.
	 */

	public function updateCampaignAction($campaign_id, $action_id, $data)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id . '/actions/' . $action_id;
		$header = $this->getHeaderAuthBearerJson();
		$request = json_decode($this->cURLPut($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Get campaign action metrics
	 * Returns a list of metrics for an individual action both in total and in steps (days, weeks, etc) over a period of time.
	 * Stepped series metrics return from oldest to newest (i.e. the 0-index for any result is the oldest step/period).
	 */

	public function getCampaignActionMetrics($campaign_id, $action_id)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id . '/actions/' . $action_id . '/metrics';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get link metrics for an action
	 * Returns link click metrics for an individual action. Unless you specify otherwise, the response contains data for the maximum period by days (45 days).
	 */

	public function getLinkMetricsForAction($campaign_id, $action_id)
	{
		$url = $this->getBetaAPIURL() . 'campaigns/' . $campaign_id . '/actions/' . $action_id . '/metrics/links';
		$header = $this->getHeaderAuthBearerJson();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	//BETA API END
}
