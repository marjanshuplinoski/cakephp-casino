<?php

App::uses('AppController', 'Controller');

class CollectionsController extends CustomerIOAppController
{

	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Collections';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('CustomerIO.Collection');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('createCollection', 'listCollections', 'lookupCollection', 'deleteCollection', 'updateCollection', 'lookupCollectionContents', 'updateContentsOfCollection');
		parent::beforeFilter();
	}

	public function createCollection()
	{
		//test data
		$name = 'testCollection';
		$dataCollection = array(
			0 =>
				array(
					'eventName' => 'someEvent',
					'eventDate' => time(),
				),
		);

		$response = $this->Collection->createCollection($name, $dataCollection);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function listCollections()
	{
		//test data

		$response = $this->Collection->listCollections();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupCollection()
	{
		//test data
		$collection_id = 3;
		$response = $this->Collection->lookupCollection($collection_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function deleteCollection()
	{
		//test data
		$collection_id = 6;
		$response = $this->Collection->deleteCollection($collection_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function updateCollection()
	{
		//test data
		$collection_id = 9;
		$name = 'TestName';
		$dataCollection = array(
							0 =>
								array(
									'eventName' => "SomeEvent",
									'eventDate' => time(),
								),
						);
		$response = $this->Collection->updateCollection($collection_id, $name,$dataCollection);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function lookupCollectionContents()
	{
		//test data
		$collection_id = 9;

		$response = $this->Collection->lookupCollectionContents($collection_id);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function updateContentsOfCollection()
	{
		//test data
		$collection_id = 9;
		$eventName = "SuperEvent";

		$response = $this->Collection->updateContentsOfCollection($collection_id, $eventName);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

}
