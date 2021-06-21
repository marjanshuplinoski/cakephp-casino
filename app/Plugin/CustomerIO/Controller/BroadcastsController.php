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
		//test data "Audience Filter"
		$broadcast_id = 7;
		$segmentID = 4;
		$orField = "interest";
		$orField2 = "roadrunners";
		$orValue = "state";
		$orValue2 = "NM";
		$orNotField = "species";
		$orNotValue = "roadrunners";
		$dataHeadline = "Roadrunner spotted in Albuquerque!!!!";
		$dataText = "We received reports of a roadrunner in your immediate area! Head to your dashboard to view more information";
		$email_add_duplicates = false;
		$email_ignore_missing = false;
		$id_ignore_missing = false;

		$response = $this->Broadcast->triggerBroadcastAudienceFilter($broadcast_id, $segmentID, $orField, $orField2, $orValue, $orValue2, $orNotField, $orNotValue, $dataHeadline, $dataText, $email_add_duplicates, $email_ignore_missing, $id_ignore_missing);
		//end test data "Audience Filter"
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//		//test data "Emails"
//		$broadcast_id = 7;
//		$emails = array(
//			"player17@mail.com",
//			"player18@mail.com"
//		);
//		$dataHeadline = "Roadrunner spotted in Albuquerque!!!!";
//		$dataText = "We received reports of a roadrunner in your immediate area! Head to your dashboard to view more information";
//		$email_add_duplicates = false;
//		$email_ignore_missing = false;
//		$id_ignore_missing = false;
//
//		$response = $this->Broadcast->triggerBroadcastEmail($broadcast_id, $emails, $dataHeadline, $dataText, $email_add_duplicates, $email_ignore_missing, $id_ignore_missing);
//		//end test data "Emails"
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//		//test data "Ids"
//		$broadcast_id = 7;
//		$ids = array(
//			"887",
//			"test1"
//		);
//		$dataHeadline = "Roadrunner spotted in Albuquerque!!!!";
//		$dataText = "We received reports of a roadrunner in your immediate area! Head to your dashboard to view more information";
//		$email_add_duplicates = false;
//		$email_ignore_missing = false;
//		$id_ignore_missing = false;
//
//		$response = $this->Broadcast->triggerBroadcastIds($broadcast_id, $ids, $dataHeadline, $dataText, $email_add_duplicates, $email_ignore_missing, $id_ignore_missing);
//		//end test data "Ids"
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//		//test data "User Maps"
//		$broadcast_id = 7;
//		$per_user_data = array(
//			array(
//				"id" => "887",
//				"data" => array(
//					"voucher_code" => "FESwYm"
//				)
//			),
//			array(
//				"email" => "player18@mail.com",
//				"data" => array(
//					"voucher_code" => "cYm6XJ"
//				)
//			)
//		);
//		$dataHeadline = "Roadrunner spotted in Albuquerque!!!!";
//		$dataText = "We received reports of a roadrunner in your immediate area! Head to your dashboard to view more information";
//		$email_add_duplicates = false;
//		$email_ignore_missing = false;
//		$id_ignore_missing = false;
//
//		$response = $this->Broadcast->triggerBroadcastUserMaps($broadcast_id, $per_user_data, $dataHeadline, $dataText, $email_add_duplicates, $email_ignore_missing, $id_ignore_missing);
//		//end test data "User Maps"
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//		//test data "Data file URL"
//		$broadcast_id = 7;
//		$DataURL = 'https://someurl.com/file.json';
//		$dataHeadline = "Roadrunner spotted in Albuquerque!!!!";
//		$dataText = "We received reports of a roadrunner in your immediate area! Head to your dashboard to view more information";
//		$email_add_duplicates = false;
//		$email_ignore_missing = false;
//		$id_ignore_missing = false;
//
//		$response = $this->Broadcast->triggerBroadcastURL($broadcast_id, $DataURL, $dataHeadline, $dataText, $email_add_duplicates, $email_ignore_missing, $id_ignore_missing);
//		//test data "Data file URL"

		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getStatusBroadcast()
	{
		//test data
		$broadcast_id = 7;
		$trigger_id = 4;

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
		$start = "";
		$limit = 1;

		$response = $this->Broadcast->listErrorsFromBroadcast($broadcast_id, $trigger_id, $start, $limit);
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
		$period = "days";                //"hours" "days" "weeks" "months"
		$steps = 12;                    //Maximums are 24 hours, 45 days, 12 weeks, or 120 months.
		$type = 'email';                //"email" "webhook" "twilio" "urban_airship" "slack" "push"

		$response = $this->Broadcast->getMetricsForBroadcast($broadcast_id, $period, $steps, $type);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcastLinkMetrics()
	{
		//test data
		$broadcast_id = 7;
		$period = "days";                //"hours" "days" "weeks" "months"
		$steps = 12;                    //Maximums are 24 hours, 45 days, 12 weeks, or 120 months.
		$unique = false;

		$response = $this->Broadcast->getBroadcastLinkMetrics($broadcast_id, $period, $steps, $unique);
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
		$start = "";
		$limit = 1;
		$metric = 'created';                //"created" "attempted" "sent" "delivered" "opened" "clicked" "converted" "bounced" "spammed" "unsubscribed" "dropped" "failed" "undeliverable"
		$state = 'failed';                    //"failed" "sent" "drafted" "attempted"
		$type = 'email';                    //"email" "webhook" "twilio" "urban_airship" "slack" "push"

		$response = $this->Broadcast->getMessageMetadataForBroadcast($broadcast_id, $start, $limit, $metric, $state, $type);
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
		//test data for "Email / message"
		$broadcast_id = 7;
		$action_id = 41;
		$body = 'string';
		$sending_state = 'automatic';					//"automatic" "draft" "off"
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

		$response = $this->Broadcast->updateBroadcastActionEmail($broadcast_id, $action_id, $body, $sending_state, $from_id, $reply_to_id, $recipient, $subject, $headers);
		//end test data for "Email / message"

//		//test data for "Webhook "
//		$broadcast_id = 7;
//		$action_id = 41;
//		$body = "{\"attribute\":\"cool-webhook\"}";
//		$DataURL = "http://someurl.com/webhook";
//		$headers = array(
//			0 =>
//				array(
//					'property1' => 'string',
//					'property2' => 'string'
//				)
//		);
//		$method = "get";                            //"get" "post" "put" "delete" "patch"
//		$sending_state = 'automatic';                    //"automatic" "draft" "off"
//
//		$response = $this->Broadcast->updateBroadcastActionWebhook($broadcast_id, $action_id, $body, $DataURL, $headers, $method, $sending_state);
//		//end test data for "Webhook"
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcastActionMetrics()
	{
		//test data
		$broadcast_id = 7;
		$action_id = 41;
		$period = "days";                //"hours" "days" "weeks" "months"
		$steps = 12;                    //Maximums are 24 hours, 45 days, 12 weeks, or 120 months.
		$type = 'email';                //"email" "webhook" "twilio" "urban_airship" "slack" "push"


		$response = $this->Broadcast->getBroadcastActionMetrics($broadcast_id, $action_id, $period, $steps, $type);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getBroadcastActionLinkMetrics()
	{
		//test data
		$broadcast_id = 7;
		$action_id = 41;
		$period = "days";                //"hours" "days" "weeks" "months"
		$steps = 12;                    //Maximums are 24 hours, 45 days, 12 weeks, or 120 months.
		$type = 'email';                //"email" "webhook" "twilio" "urban_airship" "slack" "push"


		$response = $this->Broadcast->getBroadcastActionLinkMetrics($broadcast_id, $action_id, $period, $steps, $type);
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
