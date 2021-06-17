<?php

App::uses('AppController', 'Controller');

class BroadcastsController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Broadcasts';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Broadcast');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('triggerBroadcast', 'getStatusBroadcast', 'listErrorsFromBroadcast', 'listBroadcasts', 'getBroadcast',
			'getMetricsForBroadcast', 'getBroadcastLinkMetrics', 'listBroadcastActions', 'getMessageMetadataForBroadcast', 'getBroadcastAction',
			'updateBroadcastAction', 'getBroadcastActionMetrics', 'getBroadcastActionLinkMetrics', 'getBroadcastTriggers');
		parent::beforeFilter();
	}

	public function triggerBroadcast()
	{
		//test data
		$broadcast_id = 7;
		$segmentID = 3;
		$orField = "interest";
		$orField2 = "roadrunners";
		$orValue = "state";
		$orValue2 = "NM";
		$orNotField = "species";
		$orNotValue = "roadrunners";
		$dataHeadline = "Roadrunner spotted in Albuquerque!!!!";
		$dataText = "We received reports of a roadrunner in your immediate area! Head to your dashboard to view more information";

		$response = $this->Broadcast->triggerBroadcast($broadcast_id, $segmentID, $orField, $orField2, $orValue, $orValue2, $orNotField, $orNotValue, $dataHeadline, $dataText);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getStatusBroadcast()
	{
		//test data
		$broadcast_id = 7;
		$trigger_id = 2;
		$response = $this->Broadcast->getStatusBroadcast($broadcast_id, $trigger_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listErrorsFromBroadcast()
	{
		//test data
		$broadcast_id = 7;
		$trigger_id = 2;
		$response = $this->Broadcast->listErrorsFromBroadcast($broadcast_id, $trigger_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listBroadcasts()
	{
		//test data
		$response = $this->Broadcast->listBroadcasts();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcast()
	{
		//test data
		$broadcast_id = 7;
		$response = $this->Broadcast->getBroadcast($broadcast_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getMetricsForBroadcast()
	{
		//test data
		$broadcast_id = 7;
		$response = $this->Broadcast->getMetricsForBroadcast($broadcast_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcastLinkMetrics()
	{
		//test data
		$broadcast_id = 7;
		$response = $this->Broadcast->getBroadcastLinkMetrics($broadcast_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listBroadcastActions()
	{
		//test data
		$broadcast_id = 7;
		$response = $this->Broadcast->listBroadcastActions($broadcast_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getMessageMetadataForBroadcast()
	{
		//test data
		$broadcast_id = 7;
		$response = $this->Broadcast->getMessageMetadataForBroadcast($broadcast_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcastAction()
	{
		//test data
		$broadcast_id = 7;
		$action_id = 41;
		$response = $this->Broadcast->getBroadcastAction($broadcast_id, $action_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function updateBroadcastAction()
	{
		//test data
		$broadcast_id = 7;
		$action_id = 41;
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

		$response = $this->Broadcast->updateBroadcastAction($broadcast_id, $action_id, $body, $sending_state, $from_id, $reply_to_id, $recipient, $subject, $headers);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcastActionMetrics()
	{
		//test data
		$broadcast_id = 7;
		$action_id = 41;

		$response = $this->Broadcast->getBroadcastActionMetrics($broadcast_id, $action_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcastActionLinkMetrics()
	{
		//test data
		$broadcast_id = 7;
		$action_id = 41;

		$response = $this->Broadcast->getBroadcastActionLinkMetrics($broadcast_id, $action_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcastTriggers()
	{
		//test data
		$broadcast_id = 7;

		$response = $this->Broadcast->getBroadcastTriggers($broadcast_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
