<?php

App::uses('AppController', 'Controller');

class MessagesController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Messages';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Message');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('sendTransactionalEmail', 'listMessages', 'getMessage', 'getArchivedMessage', 'listTransactionalMessages', 'getTransactionalMessage',
			'getTransactionalMessageMetrics', 'getTransactionalMessageLinkMetrics', 'getTransactionalMessageLinkMetrics', 'getTransactionalMessageDeliveries');
		parent::beforeFilter();
	}

	public function sendTransactionalEmail()
	{
		//test data "with template"
		$transactional_msg_id = 2;
		$to = 'player3@example.com';
		$identifier = array(
			'id' => 12345,
		);
		$body = 'Some body';
		$subject = 'Some subject';
		$from = 'admin@admin.com';
		$message_data = array(
			'password_reset_token' => 'abcde-12345-fghij-d888',
			'account_id' => '123dj',
		);
		$bcc = 'bcc@example.com';
		$reply_to = "other@admin.com";
		$preheader = 'Some preheader';
		$plaintext_body = 'some plaintext body';
		$attachments = array('1');										//Request entity must be JSON encoded and not exceed 2548 KB
		$headers = array('1');											//Request entity must be JSON encoded and not exceed 2548 KB
		$disable_message_retention = false;
		$send_to_unsubscribed = true;
		$tracked = true;
		$queue_draft = false;
		$disable_css_preprocessing = true;

		$response = $this->Message->sendTransactionalEmailWithTemplate($transactional_msg_id, $to, $identifier, $body, $subject, $from, $message_data, $bcc, $reply_to, $preheader,
			$plaintext_body, $attachments, $headers, $disable_message_retention, $send_to_unsubscribed, $tracked, $queue_draft, $disable_css_preprocessing);
		//end test data "with template"
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//		test data "without template"
//		$body = 'Some body';
//		$subject = 'Some subject';
//		$from = 'admin@admin.com';
//		$to = 'player3@example.com';
//		$identifier = array(
//			'id' => 12345,
//		);
//		$message_data = array(
//			'password_reset_token' => 'abcde-12345-fghij-d888',
//			'account_id' => '123dj',
//		);
//		$bcc = 'bcc@example.com';
//		$reply_to = "other@admin.com";
//		$preheader = 'Some preheader';
//		$plaintext_body = 'some plaintext body';
//		$attachments = array('1');										//Request entity must be JSON encoded and not exceed 2548 KB
//		$headers = array('1');											//Request entity must be JSON encoded and not exceed 2548 KB
//		$disable_message_retention = false;
//		$send_to_unsubscribed = true;
//		$tracked = true;
//		$queue_draft = false;
//		$disable_css_preprocessing = true;
//
//		$response = $this->Message->sendTransactionalEmailWithoutTemplate($body, $subject,$from, $to, $identifier, $message_data, $bcc, $reply_to, $preheader, $plaintext_body, $attachments, $headers, $disable_message_retention, $send_to_unsubscribed, $tracked, $queue_draft, $disable_css_preprocessing);
		//end test data "without template"

		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listMessages()
	{
		//test data
		$start = '';
		$limit = 1;
		$type = 'email';                    //"email" "webhook" "twilio" "urban_airship" "slack" "push"
		$metric = 'created';                //"created" "attempted" "sent" "delivered" "opened" "clicked" "converted" "bounced" "spammed" "unsubscribed" "dropped" "failed" "undeliverable"
		$drafts = false;
		$campaign_id = 1;
		$newsletter_id = 1;
		$action_id = 1;

		$response = $this->Message->listMessages($start, $limit, $type, $metric, $drafts, $campaign_id, $newsletter_id, $action_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getMessage()
	{
		//test data
		$message_id = 'dgOHwQaHwQYCAAF6D2BVCgT59qVfVQrNwqE=';

		$response = $this->Message->getMessage($message_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getArchivedMessage()
	{
		//test data
		$message_id = 'dgOHwQaHwQYCAAF6D2BVCgT59qVfVQrNwqE=';

		$response = $this->Message->getArchivedMessage($message_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listTransactionalMessages()
	{
		//test data

		$response = $this->Message->listTransactionalMessages();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getTransactionalMessage()
	{
		//test data
		$message_id = 1;
		$period = 'days';                    //hours" "days" "weeks" "months"
		$steps = 12;                        //Maximums are 24 hours, 45 days, 12 weeks, or 120 months.

		$response = $this->Message->getTransactionalMessage($message_id, $period, $steps);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getTransactionalMessageMetrics()
	{
		//test data
		$message_id = 1;
		$period = 'days';                    //hours" "days" "weeks" "months"
		$steps = 12;                        //Maximums are 24 hours, 45 days, 12 weeks, or 120 months.

		$response = $this->Message->getTransactionalMessageMetrics($message_id, $period, $steps);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getTransactionalMessageLinkMetrics()
	{
		//test data
		$message_id = 1;
		$period = 'days';                    //hours" "days" "weeks" "months"
		$steps = 12;                        //Maximums are 24 hours, 45 days, 12 weeks, or 120 months.
		$unique = false;

		$response = $this->Message->getTransactionalMessageLinkMetrics($message_id, $period, $steps, $unique);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getTransactionalMessageDeliveries()
	{
		//test data
		$message_id = 1;
		$start = "";
		$limit = 12;
		$metric = 'created';                        //"created" "attempted" "sent" "delivered" "opened" "clicked" "converted" "bounced" "spammed" "unsubscribed" "dropped" "failed" "undeliverable"
		$state = 'failed';                            //"failed" "sent" "drafted" "attempted"

		$response = $this->Message->getTransactionalMessageDeliveries($message_id, $start, $limit, $metric, $state);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}
}
