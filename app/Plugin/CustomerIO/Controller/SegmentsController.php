<?php

App::uses('AppController', 'Controller');

class SegmentsController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Segments';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Segment');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('addSegment', 'removeSegment', 'createManualSegment', 'listSegments', 'getSegment', 'deleteSegment', 'getSegmentDependencies', 'getSegmentCustomerCount',
			'listCustomersInSegment');
		parent::beforeFilter();
	}

	public function addSegment()
	{
		//test data
		$segment_id = 11;
		$ids = array(
			0 => '995',
			1 => '993'
		);                                        // up to 1000 records

		$response = $this->Segment->addSegment($segment_id, $ids);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function removeSegment()
	{
		//test data
		$segment_id = 11;
		$ids = array(
			0 => '995',
			1 => '993'
		);                                        // up to 1000 records

		$response = $this->Segment->removeSegment($segment_id, $ids);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function createManualSegment()
	{
		//test data
		$name = 'Manual Segment 5';
		$description = 'My 5 manual segment';

		$response = $this->Segment->createManualSegment($name, $description);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listSegments()
	{
		//test data

		$response = $this->Segment->listSegments();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getSegment()
	{
		//test data
		$segment_id = 16;

		$response = $this->Segment->getSegment($segment_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


	public function deleteSegment()
	{
		//test data
		$segment_id = 13;

		$response = $this->Segment->deleteSegment($segment_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getSegmentDependencies()
	{
		//test data
		$segment_id = 1;

		$response = $this->Segment->getSegmentDependencies($segment_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


	public function getSegmentCustomerCount()
	{
		//test data
		$segment_id = 1;

		$response = $this->Segment->getSegmentCustomerCount($segment_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


	public function listCustomersInSegment()
	{
		//test data
		$segment_id = 10;
		$start = '';
		$limit = 1;

		$response = $this->Segment->listCustomersInSegment($segment_id, $start, $limit);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
