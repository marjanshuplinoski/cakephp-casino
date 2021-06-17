<?php

App::uses('AppController', 'Controller');

class NewslettersController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Newsletters';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Newsletter');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('listNewsletters', 'getNewsletter', 'getNewsletterMetrics', 'getNewsletterLinkMetrics', 'listNewsletterVariants',
			'getNewsletterMessageMetadata', 'getNewsletterVariant', 'updateNewsletterVariant', 'getMetricsForVariant', 'getNewsletterVariantLinkMetrics');
		parent::beforeFilter();
	}

	public function listNewsletters()
	{
		//test data

		$response = $this->Newsletter->listNewsletters();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getNewsletter()
	{
		//test data
		$newsletter_id = 3;

		$response = $this->Newsletter->getNewsletter($newsletter_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getNewsletterMetrics()
	{
		//test data
		$newsletter_id = 3;

		$response = $this->Newsletter->getNewsletterMetrics($newsletter_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getNewsletterLinkMetrics()
	{
		//test data
		$newsletter_id = 3;

		$response = $this->Newsletter->getNewsletterLinkMetrics($newsletter_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listNewsletterVariants()
	{
		//test data
		$newsletter_id = 3;

		$response = $this->Newsletter->listNewsletterVariants($newsletter_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getNewsletterMessageMetadata()
	{
		//test data
		$newsletter_id = 3;

		$response = $this->Newsletter->getNewsletterMessageMetadata($newsletter_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getNewsletterVariant()
	{
		//test data
		$newsletter_id = 3;
		$contents_id = 22;

		$response = $this->Newsletter->getNewsletterVariant($newsletter_id, $contents_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function updateNewsletterVariant()
	{
		//test data
		$newsletter_id = 3;
		$contents_id = 22;
		$body = '<strong>Hello from the API</strong>';
		$from_id = NULL;
		$reply_to_id = NULL;
		$recipient = 'example@mail.com';
		$subject = 'Did you get that thing I sent you?!!!???????';
		$headers = array(
			0 =>
				array(
					'property1' => 'string',
					'property2' => 'string',
				),
		);

		$response = $this->Newsletter->updateNewsletterVariant($newsletter_id, $contents_id, $body, $from_id, $reply_to_id, $recipient, $subject, $headers);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getMetricsForVariant()
	{
		//test data
		$newsletter_id = 3;
		$contents_id = 22;

		$response = $this->Newsletter->getMetricsForVariant($newsletter_id, $contents_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getNewsletterVariantLinkMetrics()
	{
		//test data
		$newsletter_id = 3;
		$contents_id = 22;

		$response = $this->Newsletter->getNewsletterVariantLinkMetrics($newsletter_id, $contents_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
