<?php

App::uses('AppController', 'Controller');

class CampaignsController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Campaigns';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Campaign');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('listCampaigns', 'getCampaign', 'getCampaignMetrics', 'getCampaignLinkMetrics', 'listCampaignActions',
			'getCampaignMessageMetadata', 'getCampaignAction', 'updateCampaignAction','getCampaignActionMetrics','getLinkMetricsForAction');
		parent::beforeFilter();
	}

	public function listCampaigns()
	{
		//test data

		$response = $this->Campaign->listCampaigns();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getCampaign()
	{
		//test data
		$campaign_id = 1;

		$response = $this->Campaign->getCampaign($campaign_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getCampaignMetrics()
	{
		//test data
		$campaign_id = 1;

		$response = $this->Campaign->getCampaignMetrics($campaign_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getCampaignLinkMetrics()
	{
		//test data
		$campaign_id = 1;

		$response = $this->Campaign->getCampaignLinkMetrics($campaign_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listCampaignActions()
	{
		//test data
		$campaign_id = 1;

		$response = $this->Campaign->listCampaignActions($campaign_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getCampaignMessageMetadata()
	{
		//test data
		$campaign_id = 1;

		$response = $this->Campaign->getCampaignMessageMetadata($campaign_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getCampaignAction()
	{
		//test data
		$campaign_id = 1;
		$action_id = 3;

		$response = $this->Campaign->getCampaignAction($campaign_id, $action_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function updateCampaignAction()
	{
		//test data
		$campaign_id = 1;
		$action_id = 3;
		$body = 'string';
		$sending_state = 'automatic';
		$from_id = NULL;
		$reply_to_id = NULL;
		$recipient = 'test@example.com';
		$subject = 'New subject';
		$headers = array(
			0 =>
				array(
					'property1' => 'string',
					'property2' => 'string'
				)
		);

		$response = $this->Campaign->updateCampaignAction($campaign_id, $action_id,  $body, $sending_state, $from_id, $reply_to_id, $recipient, $subject, $headers);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getCampaignActionMetrics()
	{
		//test data
		$campaign_id = 1;
		$action_id = 3;

		$response = $this->Campaign->getCampaignActionMetrics($campaign_id, $action_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getLinkMetricsForAction()
	{
		//test data
		$campaign_id = 1;
		$action_id = 3;

		$response = $this->Campaign->getLinkMetricsForAction($campaign_id, $action_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}
}
