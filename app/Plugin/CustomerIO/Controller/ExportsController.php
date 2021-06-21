<?php

App::uses('AppController', 'Controller');

class ExportsController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Exports';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Export');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('listExports', 'getExport', 'downloadExport', 'exportCustomerData', 'exportInfoAboutDeliveries');
		parent::beforeFilter();
	}

	public function listExports()
	{
		//test data

		$response = $this->Export->listExports();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getExport()
	{
		//test data
		$export_id = 3;

		$response = $this->Export->getExport($export_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function downloadExport()
	{
		//test data
		$export_id = 3;

		$response = $this->Export->downloadExport($export_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function exportCustomerData()
	{
		//test data
		$segment_id = 1;

		$response = $this->Export->exportCustomerData($segment_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function exportInfoAboutDeliveries()
	{
		//test data
		$newsletter_id = 1;
		$segment_id = 1;
		$attributes = array(
			"and" => array(
				array(
					"and" => array(
						array(
							"and" => array(
								array(
									"segment" => array(
										"id" => "2"
									),
									"attribute" => array(
										"field" => "unsubscribed",
										"operator" => "eq",
										"value" => true
									)
								)
							),
							"or" => array(
								array(
									"segment" => array(
										"id" => "1"
									),
									"attribute" => array(
										"field" => "unsubscribed",
										"operator" => "eq",
										"value" => true
									)
								)
							),
							"not" => array(
								"and" => array(
									array(
										"segment" => array(
											"id" => "1"
										),
										"attribute" => array(
											"field" => "unsubscribed",
											"operator" => "eq",
											"value" => true
										)
									)
								),
								"or" => array(
									array(
										"segment" => array(
											"id" => "2"
										),
										"attribute" => array(
											"field" => "unsubscribed",
											"operator" => "eq",
											"value" => true
										)
									)
								),
								"segment" => array(
									"id" => "3"
								),
								"attribute" => array(
									"field" => "unsubscribed",
									"operator" => "eq",
									"value" => true
								)
							),
							"segment" => array(
								"id" => "4"
							),
							"attribute" => array(
								"field" => "unsubscribed",
								"operator" => "eq",
								"value" => true
							)
						)
					)
				)
			)
		);
		$metric = 'created';                        //"created" "attempted" "sent" "delivered" "opened" "clicked" "converted" "bounced" "spammed" "unsubscribed" "dropped" "failed" "undeliverable"
		$drafts = false;

		$response = $this->Export->exportInfoAboutDeliveries($newsletter_id, $attributes, $metric, $drafts);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
