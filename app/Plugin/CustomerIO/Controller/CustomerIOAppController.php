<?php
App::uses('AppController', 'Controller');

class CustomerIOAppController extends AppController {

    /**
     * Controller name
     * @var $name string
     */
    public $name = 'CustomerIOApp';

    /**
     * Paginate
     * @var array
     */
    public $paginate = array();

    /**
     * Models
     * @var array
     */
    public $uses = array('CustomerIOAppModel');
	/**
	 * Auth
	 * @var array
	 */
	public $components = array('Auth');

    /**
     * Called before the controller action.
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }
}
