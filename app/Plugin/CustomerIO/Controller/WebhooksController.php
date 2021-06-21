<?php

App::uses('AppController', 'Controller');

class WebhooksController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Webhooks';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Webhook');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('reportingWebhook', 'listReportingWebhooks', 'getReportingWebhook', 'updateWebhookConfig', 'deleteReportingWebhook');
		parent::beforeFilter();
	}

	public function reportingWebhook()
	{
		//test data
		$name = 'my 7th webhook';
		$endpoint = 'http://example.com/webhook7';
		$disabled = false;
		$full_resolution = true;
		$with_content = false;
		$events = array(
			'customer' =>
				array(
					'subscribed' => true,
					'unsubscribed' => true,
				),
			'email' =>
				array(
					'attempted' => true,
					'bounced' => true,
					'clicked' => true,
					'converted' => true,
					'deferred' => true,
					'delivered' => true,
					'drafted' => true,
					'dropped' => true,
					'failed' => true,
					'opened' => true,
					'sent' => true,
					'spammed' => true,
					'unsubscribed' => true,
				),
			'push' =>
				array(
					'attempted' => true,
					'bounced' => true,
					'clicked' => true,
					'converted' => true,
					'delivered' => true,
					'drafted' => true,
					'dropped' => true,
					'failed' => true,
					'opened' => true,
					'sent' => true,
				),
			'slack' =>
				array(
					'attempted' => true,
					'clicked' => true,
					'converted' => true,
					'drafted' => true,
					'failed' => true,
					'sent' => true,
				),
			'sms' =>
				array(
					'attempted' => true,
					'bounced' => true,
					'clicked' => true,
					'converted' => true,
					'delivered' => true,
					'drafted' => true,
					'failed' => true,
					'sent' => true,
				),
			'webhook' =>
				array(
					'attempted' => true,
					'clicked' => true,
					'drafted' => true,
					'failed' => true,
					'sent' => true,
				),
		);
		$response = $this->Webhook->reportingWebhook($name, $endpoint, $disabled, $full_resolution, $with_content, $events);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listReportingWebhooks()
	{
		//test data

		$response = $this->Webhook->listReportingWebhooks();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getReportingWebhook()
	{
		//test data
		$webhook_id = 6;

		$response = $this->Webhook->getReportingWebhook($webhook_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function updateWebhookConfig()
	{
		//test data
		$webhook_id = 6;
		$name = 'my super webhook';
		$endpoint = 'http://example.com/webhook';
		$disabled = false;
		$full_resolution = true;
		$with_content = false;

		$events = array(
			'customer' =>
				array(
					'subscribed' => true,
					'unsubscribed' => false,
				),
			'email' =>
				array(
					'attempted' => true,
					'bounced' => true,
					'clicked' => true,
					'converted' => true,
					'deferred' => true,
					'delivered' => true,
					'drafted' => true,
					'dropped' => true,
					'failed' => true,
					'opened' => true,
					'sent' => true,
					'spammed' => true,
					'unsubscribed' => true,
				),
			'push' =>
				array(
					'attempted' => true,
					'bounced' => true,
					'clicked' => true,
					'converted' => true,
					'delivered' => true,
					'drafted' => true,
					'dropped' => true,
					'failed' => true,
					'opened' => true,
					'sent' => true,
				),
			'slack' =>
				array(
					'attempted' => true,
					'clicked' => true,
					'converted' => true,
					'drafted' => true,
					'failed' => true,
					'sent' => true,
				),
			'sms' =>
				array(
					'attempted' => true,
					'bounced' => true,
					'clicked' => true,
					'converted' => true,
					'delivered' => true,
					'drafted' => true,
					'failed' => true,
					'sent' => true,
				),
			'webhook' =>
				array(
					'attempted' => true,
					'clicked' => true,
					'drafted' => true,
					'failed' => true,
					'sent' => true,
				),
		);


		$response = $this->Webhook->updateWebhookConfig($webhook_id, $name, $endpoint, $disabled, $full_resolution, $with_content, $events);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function deleteReportingWebhook()
	{
		//test data
		$webhook_id = 6;

		$response = $this->Webhook->deleteReportingWebhook($webhook_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
