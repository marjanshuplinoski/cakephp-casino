<?php

App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');

class Export extends CustomerIOAppModel
{

	/**
	 * Model name
	 * @var string
	 */
	public $name = 'Export';
	public $useTable = false;

//BETA API START

	/* List exports
	 * Return a list of your exports. Exports are point-in-time people or campaign metrics.
	 */

	public function listExports()
	{
		$url = $this->getBetaAPIURL() . 'exports';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Get an export
	 * Return information about a specific export.
	 */

	public function getExport($export_id)
	{
		$url = $this->getBetaAPIURL() . 'exports/' . $export_id;
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Download an export
	 * This endpoint returns a signed link to download an export. The link expires after 15 minutes.
	 */

	public function downloadExport($export_id)
	{
		$url = $this->getBetaAPIURL() . 'exports/' . $export_id . '/download';
		$header = $this->getHeaderAuthBearer();
		$request = json_decode($this->cURLGet($url, $header));
		return $request;
	}

	/*
	 * Export customer data
	 * Provide filters and attributes describing the customers you want to export. This endpoint returns export metadata; use the /exports/{export_id}/endpoint to download your export.
	 */

	public function exportCustomerData($segment_id, $orField1, $orValue1, $orField2, $orValue2, $notField, $notValue)
	{
		$url = $this->getBetaAPIURL() . 'exports/customers';
		$header = $this->getHeaderAuthBearerJson();
		$data = array(
			"filters" => array(
				"and" => array(
					array(
						"segment" => array(
							"id" => $segment_id
						)
					),
					array(
						"or" => array(
							array(
								"attribute" => array(
									"field" => $orField1,
									"operator" => "eq",
									"value" => $orValue1
								)
							),
							array(
								"attribute" => array(
									"field" => $orField2,
									"operator" => "eq",
									"value" => $orValue2
								)
							),
							array(
								"not" => array(
									"attribute" => array(
										"field" => $notField,
										"operator" => "eq",
										"value" => $notValue
									)
								)
							)
						)
					)
				)
			)
		);
		$request = json_decode($this->cURLPost($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Export information about deliveries
	 * Provide filters for the newsletter, campaign, or action you want to return delivery information from.
	 * This endpoint returns information about an export; use the /exports/{export_id} endpoint to download your export.
	 *
	 * Newsletter
	 */

	public function exportInfoAboutDeliveriesNewsletter($newsletter_id, $attribute, $metric, $drafts)
	{
		$url = $this->getBetaAPIURL() . 'exports/deliveries';
		$header = $this->getHeaderAuthBearerJson();
		$data = array(
			"newsletter_id" => $newsletter_id,
			"start" => time(),
			"end" => time(),
			"attribute" => $attribute,
			"metric" => $metric,
			"drafts" => $drafts
		);
		$request = json_decode($this->cURLPost($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Campaign
	 */

	public function exportInfoAboutDeliveriesCampaign($campaign_id, $attribute, $metric, $drafts)
	{
		$url = $this->getBetaAPIURL() . 'exports/deliveries';
		$header = $this->getHeaderAuthBearerJson();
		$data = array(
			"campaign_id" => $campaign_id,
			"start" => time(),
			"end" => time(),
			"attribute" => $attribute,
			"metric" => $metric,
			"drafts" => $drafts
		);
		$request = json_decode($this->cURLPost($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Transactional Message
	 */

	public function exportInfoAboutDeliveriesTransactionalMessage($trans_message_id, $attribute, $metric, $drafts)
	{
		$url = $this->getBetaAPIURL() . 'exports/deliveries';
		$header = $this->getHeaderAuthBearerJson();
		$data = array(
			"transactional_message_id" => $trans_message_id,
			"start" => time(),
			"end" => time(),
			"attribute" => $attribute,
			"metric" => $metric,
			"drafts" => $drafts
		);
		$request = json_decode($this->cURLPost($url, $header, json_encode($data)));
		return $request;
	}

	/*
	 * Transactional Message
	 */

	public function exportInfoAboutDeliveriesAction($action_id, $attribute, $metric, $drafts)
	{
		$url = $this->getBetaAPIURL() . 'exports/deliveries';
		$header = $this->getHeaderAuthBearerJson();
		$data = array(
			"action_id" => $action_id,
			"start" => time(),
			"end" => time(),
			"attribute" => $attribute,
			"metric" => $metric,
			"drafts" => $drafts
		);
		$request = json_decode($this->cURLPost($url, $header, json_encode($data)));
		return $request;
	}
	//BETA API END
}
